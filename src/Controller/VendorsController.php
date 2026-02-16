<?php
declare(strict_types=1);

namespace App\Controller;

use Cake\Http\Exception\ForbiddenException;
use Cake\Http\Exception\NotFoundException;

class VendorsController extends AppController
{
    /**
     * APPLY AS VENDOR
     */
     public function add()
    {
        if ($this->currentUser['role'] !== 3) {
            throw new ForbiddenException();
        }

        $vendors = $this->fetchTable('Vendors');
        $vendor = $vendors->newEmptyEntity();

        // 🔥 AMBIL CATEGORY LIST
   $categories = $this->fetchTable('Categories')
        ->find('list', keyField: 'category_id', valueField: 'category_name')
        ->toArray();

    $this->set(compact('categories'));

        if ($this->request->is('post')) {

            $data = $this->request->getData();
            $data['user_id'] = $this->currentUser['id'];
            $data['vendor_status'] = 0; // Pending

            /** ================= FILE UPLOAD ================= */

            $uploadPath = WWW_ROOT . 'uploads/vendors/';
            if (!is_dir($uploadPath)) {
                mkdir($uploadPath, 0775, true);
            }

            // SSM FILE
            $ssmFile = $this->request->getData('ssm_file');
            if ($ssmFile && $ssmFile->getError() === UPLOAD_ERR_OK) {
                $ssmName = uniqid('ssm_') . '.pdf';
                $ssmFile->moveTo($uploadPath . $ssmName);
                $data['ssm_file'] = $ssmName;
            }

            // TCC FILE
            $tccFile = $this->request->getData('tcc_file');
            if ($tccFile && $tccFile->getError() === UPLOAD_ERR_OK) {
                $tccName = uniqid('tcc_') . '.pdf';
                $tccFile->moveTo($uploadPath . $tccName);
                $data['tcc_file'] = $tccName;
            }

            /** ================================================= */

            $vendor = $vendors->patchEntity($vendor, $data);

            if ($vendors->save($vendor)) {
                $this->Flash->success('Vendor application submitted successfully.');
                return $this->redirect(['controller' => 'Dashboard', 'action' => 'vendor']);
            }

            $this->Flash->error('Failed to submit vendor application.');
        }

        $this->set(compact('vendor'));
    }

    /**
     * VIEW PROFILE
     */
    public function profile()
    {
        if ($this->currentUser['role'] !== 3) {
            throw new ForbiddenException();
        }

        $vendor = $this->Vendors->find()
            ->where(['user_id' => $this->currentUser['id']])
            ->first();

        if (!$vendor) {
            return $this->redirect(['action' => 'add']);
        }

        $this->set(compact('vendor'));
    }



    public function editProfile()
{
    if ($this->currentUser['role'] !== 3) {
        throw new ForbiddenException();
    }

    $vendor = $this->Vendors->find()
        ->where(['user_id' => $this->currentUser['id']])
        ->firstOrFail();

   $categories = $this->fetchTable('Categories')
    ->find(
        'list',
        keyField: 'category_id',
        valueField: 'category_name'
    )
    ->toArray();

    if ($this->request->is(['post', 'put', 'patch'])) {

        $data = $this->request->getData();

        // ❌ vendor TAK BOLEH tukar dokumen
        unset($data['ssm_file'], $data['tcc_file'], $data['ssm_number']);

        $this->Vendors->patchEntity($vendor, $data);

        if ($this->Vendors->save($vendor)) {
            $this->Flash->success('Profile updated successfully.');
            return $this->redirect(['action' => 'profile']);
        }

        $this->Flash->error('Failed to update profile.');
    }

    $this->set(compact('vendor', 'categories'));
    $this->render('edit_profile');
}

public function updateStatus($id = null)
{
    if (!in_array($this->currentUser['role'], [1, 2], true)) {
        throw new ForbiddenException();
    }

    $vendor = $this->Vendors->get($id);

    if ($this->request->is(['post', 'put'])) {

        $status = (int)$this->request->getData('vendor_status');

        if (!in_array($status, [1, 2, 3], true)) {
            $this->Flash->error('Invalid status.');
            return $this->redirect(['action' => 'index']);
        }

        $vendor->vendor_status = $status;
        $this->Vendors->save($vendor);

        // 🔔 Notify Vendor
        $this->fetchTable('Notifications')->save(
            $this->fetchTable('Notifications')->newEntity([
                'user_id' => $vendor->user_id,
                'role' => 3,
                'type' => 'vendor_status_update',
                'message' => $status === 1
                    ? 'Your vendor account has been approved. You may now apply for tenders.'
                    : 'Your vendor account status has been updated.',
                'reference_type' => 'vendor',
                'reference_id' => $vendor->vendor_id
            ])
        );

        $this->Flash->success('Vendor status updated.');
        return $this->redirect(['action' => 'index']);
    }
}
/**
 * ADMIN + STAFF
 * List vendors (approval & monitoring)
 */
public function index()
{
   if (!in_array($this->currentUser['role'], [1, 2], true)) {
    throw new ForbiddenException();
}

    $q = $this->request->getQuery('q');

    $query = $this->Vendors->find()
        ->contain(['Users']);

    if (!empty($q)) {
        $query->where([
            'Vendors.company_name LIKE' => '%' . $q . '%'
        ]);
    }

    $vendors = $query->all();

    $this->set(compact('vendors', 'q'));
}


public function view($id = null)
{
    if (!in_array($this->currentUser['role'], [1, 2], true)) {
        throw new ForbiddenException();
    }

   $vendor = $this->Vendors->get(
    $id,
    contain: ['Users', 'Categories']
);

    // Tender history vendor
    $applications = $this->fetchTable('TenderApplications')
        ->find()
        ->contain(['Tenders'])
        ->where(['vendor_id' => $vendor->vendor_id])
        ->orderBy(['applied_at' => 'DESC']);

    $this->set(compact('vendor', 'applications'));
}

}
