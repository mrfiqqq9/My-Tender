<?php
declare(strict_types=1);

namespace App\Controller;

use Cake\Http\Exception\ForbiddenException;
use Cake\Http\Exception\NotFoundException;

class NotificationsController extends AppController
{
    /**
     * LIST NOTIFICATIONS (ADMIN / STAFF / VENDOR)
     */
    public function index()
    {
        if (empty($this->currentUser)) {
            throw new ForbiddenException();
        }

        $conditions = [];

        // Vendor → hanya notification dia
        if ($this->currentUser['role'] === 3) {
            $conditions['user_id'] = $this->currentUser['id'];
        }

        // Role-based notification
        $conditions['role'] = $this->currentUser['role'];

        $notifications = $this->fetchTable('Notifications')
            ->find()
            ->where($conditions)
            ->orderBy(['created_at' => 'DESC']);

        $this->set(compact('notifications'));
    }

    /**
     * VIEW SINGLE NOTIFICATION
     */
    public function view($id = null)
{
    $notification = $this->Notifications->get($id);

    if ($this->currentUser['role'] === 3 &&
        $notification->user_id !== $this->currentUser['id']) {
        throw new ForbiddenException();
    }

    if (!$notification->is_read) {
        $notification->is_read = 1;
        $this->Notifications->save($notification);
    }

    // 🔁 AUTO REDIRECT
    if ($notification->reference_type === 'tender_application') {
        return $this->redirect([
            'controller' => 'TenderApplications',
            'action' => 'view',
            $notification->reference_id
        ]);
    }

    $this->set(compact('notification'));
}

    /**
     * MARK AS READ (quick action)
     */
    public function markRead($id = null)
    {
        if (!$id) {
            throw new NotFoundException();
        }

        $notification = $this->fetchTable('Notifications')->get($id);

        if (
            $this->currentUser['role'] === 3 &&
            $notification->user_id !== $this->currentUser['id']
        ) {
            throw new ForbiddenException();
        }

        $notification->is_read = 1;
        $this->fetchTable('Notifications')->save($notification);

        return $this->redirect(['action' => 'index']);
    }
}
