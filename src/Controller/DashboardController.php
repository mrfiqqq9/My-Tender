<?php
declare(strict_types=1);

namespace App\Controller;

use Cake\Http\Exception\ForbiddenException;

class DashboardController extends AppController
{
    /**
     * ADMIN / STAFF Dashboard
     */
    public function index()
    {
        if (!in_array($this->currentUser['role'], [1, 2], true)) {
            throw new ForbiddenException();
        }

        // ================= TABLES =================
        $Tenders      = $this->fetchTable('Tenders');
        $Applications = $this->fetchTable('TenderApplications');
        $Vendors      = $this->fetchTable('Vendors');
        $Users        = $this->fetchTable('Users');
        $Staff        = $this->fetchTable('Staff');
        $News         = $this->fetchTable('News');

        // ================= CURRENT USER INFO =================
        $userId = $this->currentUser['id'];

        $user = $Users->get($userId);

        $staff = $Staff
            ->find()
            ->where(['user_id' => $userId])
            ->first();

        // ================= KPI =================
        $stats = [
            'totalTenders'         => $Tenders->find()->count(),
            'openTenders'          => $Tenders->find()->where(['status' => 1])->count(),

            'totalApplications'    => $Applications->find()->count(),
            'pendingApplications'  => $Applications->find()->where(['status' => 0])->count(),
            'approvedApplications' => $Applications->find()->where(['status' => 1])->count(),

            'totalVendors'         => $Vendors->find()->count(),
            'pendingVendors'       => $Vendors->find()->where(['vendor_status' => 0])->count(),

            'totalStaff'           => $Users->find()->where(['role' => 2])->count(),
        ];

        // ================= LATEST APPLICATIONS =================
        $latestApplications = $Applications
            ->find()
            ->contain(['Tenders', 'Vendors'])
            ->orderBy(['TenderApplications.applied_at' => 'DESC'])
            ->limit(5);

        // ================= LATEST VENDORS =================
        $latestVendors = $Vendors
            ->find()
            ->orderBy(['Vendors.created_at' => 'DESC'])
            ->limit(5);

        // ================= LATEST NEWS =================
        $latestNews = $News
            ->find()
            ->where(['status' => 1])
            ->orderBy(['created_at' => 'DESC'])
            ->limit(4);

        $this->set(compact(
            'stats',
            'latestApplications',
            'latestVendors',
            'latestNews',
            'user',
            'staff'
        ));
    }

    /**
     * VENDOR Dashboard
     */
    public function vendor()
    {
        if ($this->currentUser['role'] !== 3) {
            throw new ForbiddenException();
        }

        $Vendors      = $this->fetchTable('Vendors');
        $Tenders      = $this->fetchTable('Tenders');
        $Applications = $this->fetchTable('TenderApplications');
        $Users        = $this->fetchTable('Users');
        $News         = $this->fetchTable('News');

        $userId = $this->currentUser['id'];

        // ================= CURRENT USER INFO =================
        $user = $Users->get($userId);

        $vendor = $Vendors
            ->find()
            ->where(['user_id' => $userId])
            ->first();

        $tenders = $Tenders
            ->find()
            ->contain(['Categories'])
            ->where(['status' => 1])
            ->orderBy(['closing_date' => 'ASC']);

        $applications = [];
        if ($vendor) {
            $applications = $Applications
                ->find()
                ->contain(['Tenders'])
                ->where(['vendor_id' => $vendor->vendor_id]);
        }

        // ================= LATEST NEWS =================
        $latestNews = $News
            ->find()
            ->where(['status' => 1])
            ->orderBy(['created_at' => 'DESC'])
            ->limit(4);

        $this->set(compact(
            'vendor',
            'tenders',
            'applications',
            'latestNews',
            'user'
        ));
    }
}
