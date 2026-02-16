<?php
declare(strict_types=1);

namespace App\Controller;

class AdministrationController extends AppController
{
    public function staff()
{
    $Users = $this->fetchTable('Users');

    $query = $Users->find()
        ->contain(['Staff'])
        ->where([
            'Users.role IN' => [1, 2] // Admin & Staff
        ]);

    // SEARCH
    $search = $this->request->getQuery('search');

    if (!empty($search)) {
        $query->where([
            'OR' => [
                'Users.name LIKE' => '%' . $search . '%',
                'Users.email LIKE' => '%' . $search . '%',
            ]
        ]);
    }

    $staffList = $query->all();

    $this->set(compact('staffList','search'));
}
    // VIEW STAFF DETAIL
    public function view($id)
    {
        $Users = $this->fetchTable('Users');

        $staff = $Users->get($id, [
            'contain' => ['Staff']
        ]);

        $this->set(compact('staff'));
    }

    // DELETE STAFF
    public function delete($id)
    {
        $this->request->allowMethod(['post','delete']);

        $Users = $this->fetchTable('Users');

        $user = $Users->get($id);

        if ($Users->delete($user)) {
            $this->Flash->success('Staff deleted successfully.');
        } else {
            $this->Flash->error('Unable to delete staff.');
        }

        return $this->redirect(['action' => 'staff']);
    }


    
    public function edit($id)
{
    $Users  = $this->fetchTable('Users');
    $Staff  = $this->fetchTable('Staff');

    $user = $Users->get($id);

    $staff = $Staff
        ->find()
        ->where(['user_id' => $id])
        ->first();

    if (!$staff) {
        $staff = $Staff->newEmptyEntity();
        $staff->user_id = $id;
    }

    if ($this->request->is(['patch','post','put'])) {

        $data = $this->request->getData();

        // Update password (optional)
        if (!empty($data['new_password'])) {

            if ($data['new_password'] !== $data['confirm_password']) {
                $this->Flash->error('Password confirmation does not match.');
                return;
            }

            $user->password = password_hash($data['new_password'], PASSWORD_DEFAULT);
        }

        $user  = $Users->patchEntity($user, $data);
        $staff = $Staff->patchEntity($staff, $data);

        if ($Users->save($user) && $Staff->save($staff)) {

            $this->Flash->success('Staff updated successfully.');
            return $this->redirect(['action'=>'staff']);
        }

        $this->Flash->error('Unable to update staff.');
    }

    $this->set(compact('user','staff'));
}
}
