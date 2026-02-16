<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;

class AuthController extends AppController
{
    public function initialize(): void
    {
        parent::initialize();
        $this->loadComponent('Flash');
    }

    public function login()
    {
        $this->viewBuilder()->setLayout('auth');
        if ($this->request->is('post')) {

            $email = $this->request->getData('email');
            $password = $this->request->getData('password');

            $users = TableRegistry::getTableLocator()->get('Users');

            $user = $users->find()
                ->where([
                    'email' => $email,
                    'status' => 1
                ])
                ->first();

            if ($user && password_verify($password, $user->password)) {

                $this->request->getSession()->write('Auth', [
                    'id'   => $user->user_id,
                    'name' => $user->name,
                    'role' => $user->role
                ]);

                return match ($user->role) {
                    1 => $this->redirect(['controller' => 'Dashboard', 'action' => 'index']),
                    2 => $this->redirect(['controller' => 'Dashboard', 'action' => 'index']),
                    default => $this->redirect(['controller' => 'Dashboard', 'action' => 'vendor']),
                };
            }

            $this->Flash->error('Email atau password salah.');
        }
    }

    public function signup()
    {
        $this->viewBuilder()->setLayout('auth');
        $users = TableRegistry::getTableLocator()->get('Users');
        $user = $users->newEmptyEntity();

        if ($this->request->is('post')) {

            $data = $this->request->getData();
            $data['role'] = 3; // vendor
            $data['status'] = 1;
            $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);

            $user = $users->patchEntity($user, $data);

            if ($users->save($user)) {
                $this->Flash->success('Akaun berjaya dicipta. Sila login.');
                return $this->redirect(['action' => 'login']);
            }

            $this->Flash->error('Pendaftaran gagal.');
        }

        $this->set(compact('user'));
    }

    public function logout()
    {
        $this->request->getSession()->destroy();
        return $this->redirect(['action' => 'login']);
    }
}
