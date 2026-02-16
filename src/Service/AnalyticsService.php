<?php
declare(strict_types=1);

namespace App\Service;

use Cake\ORM\TableRegistry;

class AnalyticsService
{
    private $Tenders;
    private $Applications;
    private $Vendors;
    private $Categories;
    private $Transactions;

    public function __construct()
    {
        $this->Tenders      = TableRegistry::getTableLocator()->get('Tenders');
        $this->Applications = TableRegistry::getTableLocator()->get('TenderApplications');
        $this->Vendors      = TableRegistry::getTableLocator()->get('Vendors');
        $this->Categories   = TableRegistry::getTableLocator()->get('Categories');
        $this->Transactions = TableRegistry::getTableLocator()->get('ApplicationTransactions');
    }

    /* =========================================================
       ADMIN ADVANCED ANALYTICS
    ========================================================= */

    public function getAdminAdvancedAnalytics(): array
    {

        /* 1️⃣ Tender Status Breakdown */
        $tenderStatus = $this->Tenders->find()
            ->select([
                'status',
                'count' => $this->Tenders->find()->func()->count('*')
            ])
            ->groupBy(['status'])
            ->enableHydration(false)
            ->toArray();


        /* 2️⃣ Monthly Applications */
        $monthlyApplications = $this->Applications->find()
            ->select([
                'month' => 'MONTH(applied_at)',
                'year'  => 'YEAR(applied_at)',
                'count' => $this->Applications->find()->func()->count('*')
            ])
            ->groupBy(['year','month'])
            ->orderBy(['year'=>'ASC','month'=>'ASC'])
            ->enableHydration(false)
            ->toArray();


        /* 3️⃣ Top 5 Vendors */
        $topVendors = $this->Applications->find()
            ->select([
                'vendor_id',
                'count' => $this->Applications->find()->func()->count('*')
            ])
            ->groupBy(['vendor_id'])
            ->orderBy(['count'=>'DESC'])
            ->limit(5)
            ->enableHydration(false)
            ->toArray();

        // attach company name manually
        foreach ($topVendors as &$vendor) {
            $company = $this->Vendors->find()
                ->select(['company_name'])
                ->where(['vendor_id' => $vendor['vendor_id']])
                ->enableHydration(false)
                ->first();

            $vendor['company_name'] = $company['company_name'] ?? 'Unknown';
        }


        /* 4️⃣ Application Status Breakdown */
        $applicationStatus = $this->Applications->find()
            ->select([
                'status',
                'count' => $this->Applications->find()->func()->count('*')
            ])
            ->groupBy(['status'])
            ->enableHydration(false)
            ->toArray();


        /* 5️⃣ Category Performance */
        $categoryPerformance = $this->Tenders->find()
            ->select([
                'category_id',
                'count' => $this->Tenders->find()->func()->count('*')
            ])
            ->groupBy(['category_id'])
            ->orderBy(['count'=>'DESC'])
            ->limit(5)
            ->enableHydration(false)
            ->toArray();


        /* 6️⃣ Overall Approval Rate */
        $totalApplications = $this->Applications->find()->count();

        $approvedApplications = $this->Applications->find()
            ->where(['status'=>2])
            ->count();

        $approvalRate = $totalApplications > 0
            ? round(($approvedApplications / $totalApplications) * 100, 2)
            : 0;


        /* 7️⃣ Total Revenue (Approved Only) */
        $approvedRows = $this->Applications->find()
            ->select(['proposed_price'])
            ->where([
                'status' => 2,
                'proposed_price IS NOT' => null
            ])
            ->enableHydration(false)
            ->toArray();

        $totalRevenue = 0;

        foreach ($approvedRows as $row) {
            $totalRevenue += (float) $row['proposed_price'];
        }


        /* 8️⃣ Monthly Revenue (Manual Sum – NO SUM FUNCTION) */
        $monthlyRaw = $this->Applications->find()
            ->select([
                'applied_at',
                'proposed_price'
            ])
            ->where([
                'status' => 2,
                'applied_at IS NOT' => null,
                'proposed_price IS NOT' => null
            ])
            ->enableHydration(false)
            ->toArray();

        $monthlyRevenue = [];

        foreach ($monthlyRaw as $row) {

           $month = $row['applied_at']->format('m');
$year  = $row['applied_at']->format('Y');
            $key = $year . '-' . $month;

            if (!isset($monthlyRevenue[$key])) {
                $monthlyRevenue[$key] = [
                    'month' => $month,
                    'year'  => $year,
                    'total' => 0
                ];
            }

            $monthlyRevenue[$key]['total'] += (float) $row['proposed_price'];
        }

        $monthlyRevenue = array_values($monthlyRevenue);


        /* 9️⃣ Vendor Success Rate (Manual Calculation – Stable) */
        $vendorRaw = $this->Applications->find()
            ->select([
                'vendor_id',
                'total' => $this->Applications->find()->func()->count('*')
            ])
            ->groupBy(['vendor_id'])
            ->enableHydration(false)
            ->toArray();

        $vendorSuccessRate = [];

        foreach ($vendorRaw as $row) {

            $approved = $this->Applications->find()
                ->where([
                    'vendor_id' => $row['vendor_id'],
                    'status' => 2
                ])
                ->count();

            $company = $this->Vendors->find()
                ->select(['company_name'])
                ->where(['vendor_id' => $row['vendor_id']])
                ->enableHydration(false)
                ->first();

            $successRate = $row['total'] > 0
                ? round(($approved / $row['total']) * 100, 2)
                : 0;

            $vendorSuccessRate[] = [
                'company_name' => $company['company_name'] ?? 'Unknown',
                'total' => $row['total'],
                'approved' => $approved,
                'success_rate' => $successRate
            ];
        }


        return compact(
            'tenderStatus',
            'monthlyApplications',
            'topVendors',
            'applicationStatus',
            'categoryPerformance',
            'approvalRate',
            'totalRevenue',
            'monthlyRevenue',
            'vendorSuccessRate'
        );
    }
     /* =========================================================
       STAFF ANALYTICS (5 Metrics)
    ========================================================= */

   public function getStaffAdvancedAnalytics($staffId): array
{
    if (!$staffId) {
        return [];
    }

    // 1️⃣ Total Reviews
    $totalReviews = $this->Transactions->find()
        ->where(['performed_by' => $staffId])
        ->count();

    // 2️⃣ Approved (action = 2)
    $approved = $this->Transactions->find()
        ->where([
            'performed_by' => $staffId,
            'action' => 2
        ])
        ->count();

    // 3️⃣ Rejected (action = 3)
    $rejected = $this->Transactions->find()
        ->where([
            'performed_by' => $staffId,
            'action' => 3
        ])
        ->count();

    // 4️⃣ Monthly Trend
    $monthlyReviews = $this->Transactions->find()
        ->select([
            'month' => 'MONTH(created_at)',
            'year'  => 'YEAR(created_at)',
            'count' => $this->Transactions->find()->func()->count('*')
        ])
        ->where(['performed_by' => $staffId])
        ->groupBy(['year','month'])
        ->orderBy(['year'=>'ASC','month'=>'ASC'])
        ->enableHydration(false)
        ->toArray();

    // 5️⃣ Performance Score
    $performanceScore = $totalReviews > 0
        ? round((($approved + $rejected) / $totalReviews) * 100, 2)
        : 0;

    return compact(
        'totalReviews',
        'approved',
        'rejected',
        'monthlyReviews',
        'performanceScore'
    );
}

    /* =========================================================
       VENDOR ANALYTICS (5 Metrics)
    ========================================================= */

    public function getVendorAdvancedAnalytics($vendorId): array
    {
        if (!$vendorId) {
            return [];
        }

        // 1️⃣ Total Applications
        $totalApplications = $this->Applications->find()
            ->where(['vendor_id' => $vendorId])
            ->count();

        // 2️⃣ Approved / Rejected
        $approved = $this->Applications->find()
            ->where(['vendor_id'=>$vendorId,'status'=>2])
            ->count();

        $rejected = $this->Applications->find()
            ->where(['vendor_id'=>$vendorId,'status'=>3])
            ->count();

        // 3️⃣ Approval Rate
        $approvalRate = $totalApplications > 0
            ? round(($approved / $totalApplications) * 100, 2)
            : 0;

        // 4️⃣ Revenue
        $revenueRow = $this->Applications->find()
            ->select([
                'total' => $this->Applications->find()->func()->sum('proposed_price')
            ])
            ->where([
                'vendor_id'=>$vendorId,
                'status'=>2
            ])
            ->first();

        $totalRevenue = $revenueRow->total ?? 0;

        // 5️⃣ Monthly Trend
        $monthlyApplications = $this->Applications->find()
            ->select([
                'month' => 'MONTH(applied_at)',
                'year'  => 'YEAR(applied_at)',
                'count' => $this->Applications->find()->func()->count('*')
            ])
            ->where(['vendor_id'=>$vendorId])
            ->groupBy(['year','month'])
            ->orderBy(['year'=>'ASC','month'=>'ASC'])
            ->enableHydration(false)
            ->toArray();

        return compact(
            'totalApplications',
            'approved',
            'rejected',
            'approvalRate',
            'totalRevenue',
            'monthlyApplications'
        );
    }
}

