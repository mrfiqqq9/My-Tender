<?php
declare(strict_types=1);

namespace App\Controller;

use Cake\Http\Exception\ForbiddenException;
use Cake\Http\Exception\NotFoundException;

class NewsController extends AppController
{

    public function index()
    {
        if (!in_array($this->currentUser['role'], [1,2], true)) {
            throw new ForbiddenException();
        }

        $news = $this->News
            ->find()
            ->contain(['Users', 'Tenders'])
            ->orderBy(['News.created_at' => 'DESC']);

        $this->set(compact('news'));
    }


    public function view($id = null)
    {
        if (!$id) {
            throw new NotFoundException();
        }

        $news = $this->News->get($id, [
            'contain' => ['Users', 'Tenders']
        ]);

        $this->set(compact('news'));
    }


    /* ======================================================
       ADD NEWS
    ====================================================== */

    public function add()
    {
        if ($this->currentUser['role'] !== 1) {
            throw new ForbiddenException();
        }

        $news = $this->News->newEmptyEntity();

        $tenders = $this->News->Tenders
            ->find('list', keyField: 'tender_id', valueField: 'title')
            ->toArray();

        if ($this->request->is('post')) {

            $data = $this->request->getData();

            /* ===== IMAGE UPLOAD ===== */
            $file = $this->request->getData('image');

            if ($file && $file->getError() === UPLOAD_ERR_OK) {

                $filename = uniqid('news_') . '.' .
                    pathinfo($file->getClientFilename(), PATHINFO_EXTENSION);

                $path = WWW_ROOT . 'img' . DS . 'news' . DS;

                if (!is_dir($path)) {
                    mkdir($path, 0775, true);
                }

                $file->moveTo($path . $filename);

                $data['image'] = $filename;

            } else {
                unset($data['image']);
            }

            $data['created_by'] = $this->currentUser['id'];

            $news = $this->News->patchEntity($news, $data);

            if ($this->News->save($news)) {
                $this->Flash->success('News added successfully.');
                return $this->redirect(['action' => 'index']);
            }

            $this->Flash->error('Failed to add news.');
        }

        $this->set(compact('news', 'tenders'));
    }


    /* ======================================================
       EDIT NEWS
    ====================================================== */

    public function edit($id = null)
    {
        if ($this->currentUser['role'] !== 1) {
            throw new ForbiddenException('Admin only');
        }

        if (!$id) {
            throw new NotFoundException();
        }

        $news = $this->News->get($id);

        $tenders = $this->News->Tenders
            ->find('list', keyField: 'tender_id', valueField: 'title')
            ->toArray();

        if ($this->request->is(['post','put','patch'])) {

            $data = $this->request->getData();

            /* ===== IMAGE UPLOAD ===== */
            $file = $this->request->getData('image');

            if ($file && $file->getError() === UPLOAD_ERR_OK) {

                $filename = uniqid('news_') . '.' .
                    pathinfo($file->getClientFilename(), PATHINFO_EXTENSION);

                $path = WWW_ROOT . 'img' . DS . 'news' . DS;

                if (!is_dir($path)) {
                    mkdir($path, 0775, true);
                }

                $file->moveTo($path . $filename);

                $data['image'] = $filename;

            } else {
                // kalau tak upload image baru, jangan overwrite image lama
                unset($data['image']);
            }

            $news = $this->News->patchEntity($news, $data);

            if ($this->News->save($news)) {
                $this->Flash->success('News updated successfully.');
                return $this->redirect(['action' => 'index']);
            }

            $this->Flash->error('Failed to update news.');
        }

        $this->set(compact('news', 'tenders'));
    }


    /* ======================================================
       DELETE
    ====================================================== */

    public function delete($id = null)
    {
        if ($this->currentUser['role'] !== 1) {
            throw new ForbiddenException();
        }

        $this->request->allowMethod(['post', 'delete']);

        $news = $this->News->get($id);

        if ($this->News->delete($news)) {
            $this->Flash->success('News deleted.');
        }

        return $this->redirect(['action' => 'index']);
    }
}
