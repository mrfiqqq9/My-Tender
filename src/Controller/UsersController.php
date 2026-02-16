<?php
declare(strict_types=1);

namespace App\Controller;

use Cake\Http\Exception\ForbiddenException;
use Cake\Http\Exception\NotFoundException;

class UsersController extends AppController
{
    public function index()
    {
        if ($this->currentUser['role'] !== 1) {
            throw new ForbiddenException('Admin only');
        }

        $q    = $this->request->getQuery('q');
        $role = $this->request->getQuery('role');
        $stat = $this->request->getQuery('status');

        $query = $this->Users->find();

        if (!empty($q)) {
            $query->where([
                'OR' => [
                    'Users.name LIKE'  => "%$q%",
                    'Users.email LIKE' => "%$q%",
                ]
            ]);
        }

        if ($role !== null && $role !== '') {
            $query->where(['Users.role' => (int)$role]);
        }

        if ($stat !== null && $stat !== '') {
            $query->where(['Users.status' => (int)$stat]);
        }

        $users = $query->orderBy(['Users.created_at' => 'DESC']);

        $this->set(compact('users', 'q', 'role', 'stat'));
    }

    public function add()
    {
        if ($this->currentUser['role'] !== 1) {
            throw new ForbiddenException('Admin only');
        }

        $user = $this->Users->newEmptyEntity();

        if ($this->request->is('post')) {
            $user = $this->Users->patchEntity($user, $this->request->getData());

            if ($this->Users->save($user)) {
                $this->Flash->success('User added');
                return $this->redirect(['action' => 'index']);
            }

            $this->Flash->error('Failed to add user');
        }

        $this->set(compact('user'));
    }

    public function edit($id = null)
    {
        if ($this->currentUser['role'] !== 1) {
            throw new ForbiddenException('Admin only');
        }

        $user = $this->Users->get($id);

        if ($this->request->is(['post', 'patch', 'put'])) {
            $this->Users->patchEntity($user, $this->request->getData());

            if ($this->Users->save($user)) {
                $this->Flash->success('User updated');
                return $this->redirect(['action' => 'index']);
            }

            $this->Flash->error('Failed to update user');
        }

        $this->set(compact('user'));
    }

    public function delete($id = null)
    {
        if ($this->currentUser['role'] !== 1) {
            throw new ForbiddenException('Admin only');
        }

        $this->request->allowMethod(['post']);

        $user = $this->Users->get($id);
        $this->Users->delete($user);

        $this->Flash->success('User deleted');
        return $this->redirect(['action' => 'index']);
    }
}
