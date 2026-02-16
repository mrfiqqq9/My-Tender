<?php
declare(strict_types=1);

namespace App\Controller;

class ProfilesController extends AppController
{
    public function index()
    {
        $role = $this->currentUser['role'];

        if ($role == 3) {
            return $this->redirect(['action' => 'vendorProfile']);
        }

        if ($role == 1 || $role == 2) {
            return $this->redirect(['action' => 'staffProfile']);
        }

        $this->Flash->error('Invalid role.');
        return $this->redirect('/');
    }

    // =====================================================
    // VENDOR PROFILE (USER INFO ONLY)
    // =====================================================
    public function vendorProfile()
    {
        $Users = $this->fetchTable('Users');

        $userId = $this->currentUser['id'];
        $user = $Users->get($userId);

        if ($this->request->is(['patch','post','put'])) {

            $data = $this->request->getData();

            // ================= PASSWORD CHANGE =================
            if (!empty($data['new_password'])) {

                if ($data['new_password'] !== $data['confirm_password']) {
                    $this->Flash->error('Password confirmation does not match.');
                    return;
                }

                if (!password_verify($data['current_password'], $user->password)) {
                    $this->Flash->error('Current password incorrect.');
                    return;
                }

                $user->password = password_hash($data['new_password'], PASSWORD_DEFAULT);
            }

            // ================= UPDATE USER INFO =================
            $user = $Users->patchEntity($user, $data, [
                'fields' => ['name','email']
            ]);

            if ($Users->save($user)) {

                $this->Flash->success('Profile updated successfully.');
                return $this->redirect(['action'=>'vendorProfile']);
            }

            $this->Flash->error('Unable to update profile.');
        }

        $this->set(compact('user'));
    }


    // =====================================================
    // STAFF & ADMIN PROFILE
    // =====================================================
    public function staffProfile()
{
    $Users  = $this->fetchTable('Users');
    $Staff  = $this->fetchTable('Staff');

    $userId = $this->currentUser['id'];
    $currentRole = $this->currentUser['role'];

    $user = $Users->get($userId);

    $staff = $Staff
        ->find()
        ->where(['user_id' => $userId])
        ->first();

    if (!$staff) {
        $staff = $Staff->newEmptyEntity();
        $staff->user_id = $userId;
    }

    if ($this->request->is(['patch','post','put'])) {

        $data = $this->request->getData();

        // PASSWORD CHANGE
        if (!empty($data['new_password'])) {

            if ($data['new_password'] !== $data['confirm_password']) {
                $this->Flash->error('Password confirmation does not match.');
                return;
            }

            if (!password_verify($data['current_password'], $user->password)) {
                $this->Flash->error('Current password incorrect.');
                return;
            }

            $user->password = password_hash($data['new_password'], PASSWORD_DEFAULT);
        }

        // UPDATE USER
        if ($currentRole == 1) {
            $user = $Users->patchEntity($user, $data);
        } else {
            $user = $Users->patchEntity($user, $data, [
                'fields' => ['name','email']
            ]);
        }

        // UPDATE STAFF
        $staff = $Staff->patchEntity($staff, $data);

        if ($Users->save($user) && $Staff->save($staff)) {

            $this->Flash->success('Profile updated successfully.');
            return $this->redirect(['action' => 'staffProfile']);
        }

        $this->Flash->error('Unable to update profile.');
    }

    $this->set(compact('user','staff','currentRole'));
}

}
