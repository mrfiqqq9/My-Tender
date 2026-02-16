<?php
declare(strict_types=1);

namespace App\Controller;

use Cake\Controller\Controller;
use Cake\Event\EventInterface;
use Cake\Http\Exception\ForbiddenException;

class AppController extends Controller
{
    protected array $currentUser = [];

    public function initialize(): void
    {
        parent::initialize();

        $this->loadComponent('Flash');

        $session = $this->request->getSession();

        /**
         * =====================
         * LOAD AUTH USER
         * =====================
         */
        if ($session->check('Auth')) {

            $this->currentUser = $session->read('Auth');

            /**
             * AUTO LOAD VENDOR DATA
             */
            if ((int)($this->currentUser['role'] ?? 0) === 3) {

                $vendor = $this->fetchTable('Vendors')
                    ->find()
                    ->select(['vendor_id', 'vendor_status'])
                    ->where(['user_id' => $this->currentUser['id']])
                    ->first();

                $this->currentUser['vendor_id']     = $vendor->vendor_id ?? null;
                $this->currentUser['vendor_status'] = $vendor->vendor_status ?? 0;

                $session->write('Auth.vendor_id', $this->currentUser['vendor_id']);
                $session->write('Auth.vendor_status', $this->currentUser['vendor_status']);
            }
        }
  /**
 * AUTO LOAD STAFF DATA
 */
if ((int)($this->currentUser['role'] ?? 0) === 2) {

    $staff = $this->fetchTable('Staff')
        ->find()
        ->where(['user_id' => $this->currentUser['id']])
        ->first();

    if ($staff) {
        $this->currentUser['staff_id'] = $staff->staff_id;
        $session->write('Auth.staff_id', $staff->staff_id);
    } else {
        $this->currentUser['staff_id'] = null;
    }
}

        /**
         * =====================
         * NOTIFICATION BADGE
         * =====================
         */
        $unreadCount = 0;

        if (!empty($this->currentUser)) {

            $conditions = [
                'is_read' => 0,
                'role'    => (int)$this->currentUser['role'],
            ];

            if ((int)$this->currentUser['role'] === 3) {
                $conditions['user_id'] = $this->currentUser['id'];
            }

            $unreadCount = $this->fetchTable('Notifications')
                ->find()
                ->where($conditions)
                ->count();
        }

        $this->set('currentUser', $this->currentUser);
        $this->set('unreadCount', $unreadCount);
    }

    public function beforeFilter(EventInterface $event)
    {
        parent::beforeFilter($event);

        /**
         * =====================
         * ALLOW STATIC FILES
         * =====================
         */
        $path = $this->request->getPath();

        if (
            str_starts_with($path, '/img/') ||
            str_starts_with($path, '/css/') ||
            str_starts_with($path, '/js/')
        ) {
            return;
        }

        $controller = $this->request->getParam('controller');
        $action     = $this->request->getParam('action');

        /**
         * =====================
         * ALLOW AUTH / LOGIN
         * =====================
         */
        if (
            $controller === 'Auth' ||
            ($controller === 'Users' && in_array($action, ['login'], true))
        ) {
            return;
        }

        /**
         * =====================
         * MUST LOGIN
         * =====================
         */
        if (empty($this->currentUser)) {
            throw new ForbiddenException('Please login first.');
        }

        $role = (int)$this->currentUser['role'];

        /**
         * =====================
         * ROLE PERMISSION MAP
         * =====================
         */
        $rules = [

            /**
             * ================= ADMIN =================
             */
            1 => [
                'Dashboard'          => ['index'],
                'Analytics'          => ['admin'],
                'Administration'     => ['staff','view','delete','edit'],
                'Users'              => ['index','add','edit','view'],
                'Vendors'            => ['index','view','updateStatus'],
                'Categories'         => ['index','add','edit','delete'],
                'Tenders'            => ['index','all','add','edit','archive','view'],
                'TenderRequirements' => ['index','add','edit','delete'],
                'TenderApplications' => ['index','view','updateStatus','audit'],
                'Notifications'      => ['index','view','markRead'],
                'News'               => ['index','add','edit','view','delete'],
                'Profiles'           => ['index','staffProfile'],
            ],

            /**
             * ================= STAFF =================
             */
            2 => [
                'Dashboard'          => ['index'],
                'Analytics'          => ['staff'],
                'Categories'         => ['index'],
                'Tenders'            => ['index','all','add','edit','archive','view'],
                'TenderRequirements' => ['index','add','edit','delete'],
                'TenderApplications' => ['index','view','updateStatus'],
                'Notifications'      => ['index','view','markRead'],
                'Profiles'           => ['index','staffProfile'],
            ],

            /**
             * ================= VENDOR =================
             */
            3 => [
                'Dashboard'          => ['vendor'],
                'Analytics'          => ['vendor'],
                'Vendors'            => ['profile','editProfile','add'],
                'Tenders'            => ['index','view'],
                'TenderApplications' => ['add','myApplications','view'],
                'Notifications'      => ['index','view','markRead'],
                'Profiles'           => ['index','vendorProfile'],
            ],
        ];

        /**
         * =====================
         * BLOCK ACCESS
         * =====================
         */
        if (
            !isset($rules[$role]) ||
            !isset($rules[$role][$controller]) ||
            !in_array($action, $rules[$role][$controller], true)
        ) {
            throw new ForbiddenException('You are not allowed to access this page.');
        }
    }
}
