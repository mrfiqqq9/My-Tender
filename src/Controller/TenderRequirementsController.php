<?php
declare(strict_types=1);

namespace App\Controller;

use Cake\Http\Exception\NotFoundException;

class TenderRequirementsController extends AppController
{
    /**
     * List requirements by tender
     */
    public function index($tenderId = null)
    {
        if ($tenderId === null) {
            throw new NotFoundException('Tender not found.');
        }

        $requirements = $this->TenderRequirements
            ->find()
            ->where(['tender_id' => $tenderId])
            ->orderBy(['requirement_type' => 'ASC']);

        $this->set(compact('requirements', 'tenderId'));
    }

    /**
     * Add requirement
     */
    public function add($tenderId = null)
    {
        if ($tenderId === null) {
            throw new NotFoundException('Tender not found.');
        }

        $requirement = $this->TenderRequirements->newEmptyEntity();

        if ($this->request->is('post')) {
            $data = $this->request->getData();
            $data['tender_id'] = $tenderId;

            $requirement = $this->TenderRequirements->patchEntity($requirement, $data);

            if ($this->TenderRequirements->save($requirement)) {
                $this->Flash->success('Requirement added successfully.');
                return $this->redirect(['action' => 'index', $tenderId]);
            }

            $this->Flash->error('Failed to add requirement.');
        }

        $this->set(compact('requirement', 'tenderId'));
    }

    /**
     * Edit requirement
     */
    public function edit($id = null)
    {
        $requirement = $this->TenderRequirements->get($id);
        $tenderId = $requirement->tender_id;

        if ($this->request->is(['post', 'put'])) {
            $requirement = $this->TenderRequirements->patchEntity(
                $requirement,
                $this->request->getData()
            );

            if ($this->TenderRequirements->save($requirement)) {
                $this->Flash->success('Requirement updated.');
                return $this->redirect(['action' => 'index', $tenderId]);
            }

            $this->Flash->error('Failed to update requirement.');
        }

        $this->set(compact('requirement', 'tenderId'));
    }

    /**
     * Delete requirement
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);

        $requirement = $this->TenderRequirements->get($id);
        $tenderId = $requirement->tender_id;

        if ($this->TenderRequirements->delete($requirement)) {
            $this->Flash->success('Requirement deleted.');
        } else {
            $this->Flash->error('Failed to delete requirement.');
        }

        return $this->redirect(['action' => 'index', $tenderId]);
    }
}
