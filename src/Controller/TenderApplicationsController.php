<?php
declare(strict_types=1);

namespace App\Controller;

use Cake\Http\Exception\NotFoundException;
use Cake\Http\Exception\ForbiddenException;

class TenderApplicationsController extends AppController
{

    /**
     * ===============================
     * ADMIN + STAFF LIST
     * ===============================
     */
    public function index()
    {
        $applications = $this->TenderApplications
            ->find()
            ->contain(['Tenders', 'Vendors'])
            ->orderBy([
                'TenderApplications.applied_at' => 'DESC'
            ]);

        $this->set(compact('applications'));
    }



    /**
     * ===============================
     * VIEW DETAIL
     * ===============================
     */
    public function view($id = null)
    {
        if ($id === null) {
            throw new NotFoundException('Application not found');
        }

        $conditions = [
            'TenderApplications.application_id' => $id
        ];

        // Vendor hanya boleh tengok application sendiri
        if ($this->currentUser['role'] === 3) {
            $conditions['TenderApplications.vendor_id']
                = $this->currentUser['vendor_id'];
        }

        $application = $this->TenderApplications
            ->find()
            ->contain([
                'Tenders' => ['Categories', 'TenderRequirements'],
                'Vendors',
            ])
            ->where($conditions)
            ->firstOrFail();

        // 🔥 FIX ambiguous created_at
        $transactions = $this->fetchTable('ApplicationTransactions')
            ->find()
            ->contain(['Users'])
            ->where([
                'ApplicationTransactions.application_id' => $id
            ])
            ->orderBy([
                'ApplicationTransactions.created_at' => 'ASC'
            ]);

        $vendorHistory = $this->TenderApplications
    ->find()
    ->contain(['Tenders'])
    ->where([
        'vendor_id' => $application->vendor_id
    ])
    ->orderBy(['TenderApplications.applied_at' => 'DESC'])
    ->all();

$this->set(compact('application', 'transactions', 'vendorHistory'));
    }



    /**
     * ===============================
     * VENDOR APPLY
     * ===============================
     */
    public function add($tenderId = null)
    {
        if ($this->currentUser['role'] !== 3) {
            throw new ForbiddenException('Vendor only.');
        }

        if (($this->currentUser['vendor_status'] ?? 0) !== 1) {
            $this->Flash->warning('Vendor account not approved yet.');
            return $this->redirect(['controller' => 'Dashboard', 'action' => 'vendor']);
        }

        if ($tenderId === null) {
            throw new NotFoundException('Tender not found.');
        }

        $application = $this->TenderApplications->newEmptyEntity();

        if ($this->request->is('post')) {

            $data = $this->request->getData();
            $data['tender_id'] = $tenderId;
            $data['vendor_id'] = $this->currentUser['vendor_id'];
            $data['status'] = 0;

            // ===== FILE UPLOAD =====
            $file = $this->request->getData('quotation_file');

            if ($file && $file->getError() === UPLOAD_ERR_OK) {

                if ($file->getClientMediaType() !== 'application/pdf') {
                    $this->Flash->error('Only PDF allowed.');
                    return $this->redirect($this->referer());
                }

                $path = WWW_ROOT . 'uploads/quotations/';
                if (!is_dir($path)) {
                    mkdir($path, 0775, true);
                }

                $filename = uniqid('quotation_') . '.pdf';
                $file->moveTo($path . $filename);
                $data['quotation_file'] = $filename;
            }

            $application = $this->TenderApplications->patchEntity($application, $data);

            if ($this->TenderApplications->save($application)) {

                // 🔔 Notify Admin + Staff
                $users = $this->fetchTable('Users')
                    ->find()
                    ->where(['role IN' => [1, 2]])
                    ->all();

                foreach ($users as $user) {

                    $this->fetchTable('Notifications')->save(
                        $this->fetchTable('Notifications')->newEntity([
                            'user_id' => $user->user_id,
                            'role' => $user->role,
                            'type' => 'tender_applied',
                            'message' => 'New tender application submitted.',
                            'reference_type' => 'tender_application',
                            'reference_id' => $application->application_id
                        ])
                    );
                }

                $this->Flash->success('Tender application submitted successfully.');
                return $this->redirect(['action' => 'myApplications']);
            }

            $this->Flash->error('Failed to submit application.');
        }

        $this->set(compact('application'));
    }



    /**
     * ===============================
     * VENDOR MY APPLICATIONS
     * ===============================
     */
    public function myApplications()
    {
        $vendorId = $this->currentUser['vendor_id'];

        $applications = $this->TenderApplications
            ->find()
            ->contain(['Tenders'])
            ->where(['vendor_id' => $vendorId])
            ->orderBy([
                'TenderApplications.applied_at' => 'DESC'
            ])
            ->all();

        $total = $applications->count();
        $pending = 0;
        $approved = 0;
        $rejected = 0;

        foreach ($applications as $app) {
            if ((int)$app->status === 0) $pending++;
            if ((int)$app->status === 1) $approved++;
            if ((int)$app->status === 2) $rejected++;
        }

        $this->set(compact(
            'applications',
            'total',
            'pending',
            'approved',
            'rejected'
        ));
    }



    /**
     * ===============================
     * UPDATE STATUS (ADMIN/STAFF)
     * ===============================
     */
    public function updateStatus($id = null)
    {
        if (!in_array($this->currentUser['role'], [1, 2], true)) {
            throw new ForbiddenException();
        }

        if ($id === null) {
            throw new NotFoundException('Application not found.');
        }

        $application = $this->TenderApplications->get(
            $id,
            contain: ['Tenders', 'Vendors']
        );

        if ($this->request->is(['post', 'put'])) {

            $status = (int)$this->request->getData('status');
            $remarks = $this->request->getData('remarks');

            if (!in_array($status, [1, 2], true)) {
                $this->Flash->error('Invalid status.');
                return $this->redirect(['action' => 'index']);
            }

            $application->status = $status;

            if ($this->TenderApplications->save($application)) {

                // 📜 Audit Trail
                $this->fetchTable('ApplicationTransactions')->save(
                    $this->fetchTable('ApplicationTransactions')->newEntity([
                        'application_id' => $application->application_id,
                        'tender_id' => $application->tender_id,
                        'vendor_id' => $application->vendor_id,
                        'action' => $status === 1 ? 'approved' : 'rejected',
                        'performed_by' => $this->currentUser['id'],
                        'performed_role' => $this->currentUser['role'],
                        'remarks' => $remarks ?: null
                    ])
                );

                // 🔔 Notify Vendor
                $message = $status === 1
                    ? 'Your tender "' . $application->tender->title .
                        '" (RM ' . number_format($application->proposed_price, 2) .
                        ') has been APPROVED.'
                    : 'Your tender "' . $application->tender->title .
                        '" (RM ' . number_format($application->proposed_price, 2) .
                        ') has been REJECTED.';

                $this->fetchTable('Notifications')->save(
                    $this->fetchTable('Notifications')->newEntity([
                        'user_id' => $application->vendor->user_id,
                        'role' => 3,
                        'type' => 'tender_status_update',
                        'message' => $message,
                        'reference_type' => 'tender_application',
                        'reference_id' => $application->application_id
                    ])
                );

                $this->Flash->success('Application status updated.');
                return $this->redirect(['action' => 'index']);
            }

            $this->Flash->error('Failed to update application.');
        }

        $this->set(compact('application'));
    }



    /**
     * ===============================
     * DELETE (ADMIN)
     * ===============================
     */
    public function delete($id = null)
    {
        if ($this->currentUser['role'] !== 1) {
            throw new ForbiddenException('Admin only.');
        }

        $this->request->allowMethod(['post', 'delete']);

        $application = $this->TenderApplications->get($id);

        if ($this->TenderApplications->delete($application)) {
            $this->Flash->success('Application deleted successfully.');
        } else {
            $this->Flash->error('Failed to delete application.');
        }

        return $this->redirect(['action' => 'index']);
    }



    /**
     * ===============================
     * ADMIN AUDIT
     * ===============================
     */
    public function audit()
    {
        if ($this->currentUser['role'] !== 1) {
            throw new ForbiddenException();
        }

        $role   = $this->request->getQuery('role');
        $action = $this->request->getQuery('action');

        $logs = $this->fetchTable('ApplicationTransactions')
            ->find()
            ->contain(['Users', 'Vendors', 'Tenders']);

        if (!empty($role)) {
            $logs->where([
                'ApplicationTransactions.performed_role' => (int)$role
            ]);
        }

        if (!empty($action)) {
            $logs->where([
                'ApplicationTransactions.action' => $action
            ]);
        }

        // 🔥 FIX ambiguous created_at
        $logs->orderBy([
            'ApplicationTransactions.created_at' => 'DESC'
        ]);

        $this->set(compact('logs', 'role', 'action'));
    }
}
