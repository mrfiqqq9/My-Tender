<?php
declare(strict_types=1);

namespace App\Controller;

use Cake\Http\Exception\ForbiddenException;
use Cake\Http\Exception\NotFoundException;

class CategoriesController extends AppController
{
    /**
     * ADMIN + STAFF – List & Search
     */
    public function index()
    {
        $role = $this->currentUser['role'];

        if (!in_array($role, [1, 2], true)) {
            throw new ForbiddenException('Access denied.');
        }

        $q = $this->request->getQuery('q');

        $query = $this->Categories->find();

        if (!empty($q)) {
            $query->where([
                'Categories.category_name LIKE' => '%' . $q . '%'
            ]);
        }

        $categories = $query->orderBy(['category_name' => 'ASC']);

        $this->set(compact('categories', 'q', 'role'));
    }

    /**
     * ADMIN – Add
     */
    public function add()
    {
        if ($this->currentUser['role'] !== 1) {
            throw new ForbiddenException('Admin only.');
        }

        $category = $this->Categories->newEmptyEntity();

        if ($this->request->is('post')) {
            $category = $this->Categories->patchEntity(
                $category,
                $this->request->getData()
            );

            // 🔴 UNCOMMENT SEKALI UNTUK CONFIRM
            // dd($category->getErrors());

            if ($this->Categories->save($category)) {
                $this->Flash->success('Category added.');
                return $this->redirect(['action' => 'index']);
            }

            $this->Flash->error('Failed to add category.');
        }

        $this->set(compact('category'));
    }

    /**
     * ADMIN – Edit
     */
    public function edit($id = null)
    {
        if ($this->currentUser['role'] !== 1) {
            throw new ForbiddenException('Admin only.');
        }

        if (!$id) {
            throw new NotFoundException();
        }

        $category = $this->Categories->get($id);

        if ($this->request->is(['post', 'put'])) {
            $category = $this->Categories->patchEntity(
                $category,
                $this->request->getData()
            );

            if ($this->Categories->save($category)) {
                $this->Flash->success('Category updated.');
                return $this->redirect(['action' => 'index']);
            }

            $this->Flash->error('Failed to update category.');
        }

        $this->set(compact('category'));
    }

    /**
     * ADMIN – Delete
     */
    public function delete($id = null)
    {
        if ($this->currentUser['role'] !== 1) {
            throw new ForbiddenException('Admin only.');
        }

        $this->request->allowMethod(['post']);

        $category = $this->Categories->get($id);

        if ($this->Categories->delete($category)) {
            $this->Flash->success('Category deleted.');
        } else {
            $this->Flash->error('Failed to delete category.');
        }

        return $this->redirect(['action' => 'index']);
    }
}
