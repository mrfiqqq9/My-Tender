<?php
declare(strict_types=1);

namespace App\Controller;

use Cake\Http\Exception\ForbiddenException;
use Cake\Http\Exception\NotFoundException;

class TendersController extends AppController
{

    /**
     * INDEX
     */
    public function index()
    {
        $role = $this->currentUser['role'];

        // ================= VENDOR =================
        if ($role === 3) {

            if (($this->currentUser['vendor_status'] ?? 0) !== 1) {
                $this->Flash->warning('Vendor account not approved yet.');
                return $this->redirect([
                    'controller' => 'Dashboard',
                    'action' => 'vendor'
                ]);
            }

            $query = $this->Tenders->find()
                ->contain(['Categories'])
                ->where([
                    'Tenders.status' => 1,
                    'Tenders.closing_date >=' => date('Y-m-d')
                ])
                ->orderBy([
                    'Tenders.closing_date' => 'ASC'
                ]);
        }

        // ================= STAFF / ADMIN =================
        elseif (in_array($role, [1, 2], true)) {

            $q = $this->request->getQuery('q');

            $query = $this->Tenders->find()
                ->contain(['Categories']);

            if (!empty($q)) {
                $query->where([
                    'OR' => [
                        'Tenders.title LIKE' => "%$q%",
                        'Categories.category_name LIKE' => "%$q%"
                    ]
                ]);
            }

            $query->orderBy([
                'Tenders.created_at' => 'DESC'
            ]);
        }

        else {
            throw new ForbiddenException();
        }

        $tenders = $query->all();

        $this->set(compact('tenders'));
    }


    /**
     * VIEW
     */
    public function view($id = null)
    {
        if (!$id) {
            throw new NotFoundException('Tender not found');
        }

        if (
            $this->currentUser['role'] === 3 &&
            ($this->currentUser['vendor_status'] ?? 0) !== 1
        ) {
            $this->Flash->warning('Vendor account not approved yet.');
            return $this->redirect([
                'controller' => 'Dashboard',
                'action' => 'vendor'
            ]);
        }

        $tender = $this->Tenders->find()
            ->contain([
                'Categories',
                'TenderRequirements'
            ])
            ->where(['Tenders.tender_id' => $id])
            ->firstOrFail();

        $hasApplied = false;

        if ($this->currentUser['role'] === 3) {
            $hasApplied = $this->fetchTable('TenderApplications')
                ->exists([
                    'tender_id' => $tender->tender_id,
                    'vendor_id' => $this->currentUser['vendor_id']
                ]);
        }

        $this->set(compact('tender', 'hasApplied'));
    }


    /**
     * ADD (STAFF)
     */
    public function add()
    {
        if (!in_array($this->currentUser['role'], [1, 2], true)) {
    throw new ForbiddenException('Admin or Staff only.');
}
        $tender = $this->Tenders->newEmptyEntity();

        $categories = $this->Tenders->Categories
            ->find('list', keyField: 'category_id', valueField: 'category_name')
            ->toArray();

        $requirementTypes = \App\Model\Entity\TenderRequirement::TYPES;

        if ($this->request->is('post')) {

            $data = $this->request->getData();
            $data['status'] = 1;

            if (!empty($data['tender_requirements'])) {
                $data['tender_requirements'] = array_values(
                    array_filter(
                        $data['tender_requirements'],
                        fn($r) => !empty($r['requirement_type'])
                    )
                );
            }

            $tender = $this->Tenders->patchEntity(
                $tender,
                $data,
                ['associated' => ['TenderRequirements']]
            );

            if ($this->Tenders->save($tender)) {
                $this->Flash->success('Tender created.');
                return $this->redirect(['action' => 'index']);
            }

            $this->Flash->error('Failed to create tender.');
        }

        $this->set(compact('tender', 'categories', 'requirementTypes'));
    }


    /**
     * EDIT (STAFF)
     */
    public function edit($id = null)
    {
       if (!in_array($this->currentUser['role'], [1, 2], true)) {
    throw new ForbiddenException('Admin or Staff only.');
}

        if (!$id) {
            throw new NotFoundException();
        }

        $tender = $this->Tenders->get(
            $id,
            contain: ['TenderRequirements']
        );

        $categories = $this->Tenders->Categories
            ->find('list', keyField: 'category_id', valueField: 'category_name')
            ->toArray();

        $requirementTypes = \App\Model\Entity\TenderRequirement::TYPES;

        if ($this->request->is(['post','put','patch'])) {

            $data = $this->request->getData();
            $data['status'] = 1;

            if (!empty($data['tender_requirements'])) {
                $data['tender_requirements'] = array_values(
                    array_filter(
                        $data['tender_requirements'],
                        fn($r) => !empty($r['requirement_type'])
                    )
                );
            }

            $this->Tenders->patchEntity(
                $tender,
                $data,
                ['associated' => ['TenderRequirements']]
            );

            if ($this->Tenders->save($tender)) {
                $this->Flash->success('Tender updated.');
                return $this->redirect(['action' => 'index']);
            }

            $this->Flash->error('Failed to update tender.');
        }

        $this->set(compact('tender', 'categories', 'requirementTypes'));
    }


    /**
     * ALL (ADMIN / STAFF)
     */
    public function all()
    {
        $q = $this->request->getQuery('q');
        $status = $this->request->getQuery('status');

        $query = $this->Tenders
            ->find()
            ->contain(['Categories']);

        if (!empty($q)) {
            $query->where([
                'Tenders.title LIKE' => "%$q%"
            ]);
        }

        if ($status !== null && $status !== '') {
            $query->where([
                'Tenders.status' => (int)$status
            ]);
        }

        $tenders = $query
            ->orderBy(['Tenders.tender_id' => 'DESC'])
            ->all();

        $this->set(compact('tenders', 'q', 'status'));
    }

}
