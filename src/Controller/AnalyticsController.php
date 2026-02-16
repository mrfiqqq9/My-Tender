<?php
declare(strict_types=1);

namespace App\Controller;

use App\Service\AnalyticsService;
use Cake\Http\Exception\ForbiddenException;

class AnalyticsController extends AppController
{
    private AnalyticsService $analyticsService;

    public function initialize(): void
    {
        parent::initialize();
        $this->analyticsService = new AnalyticsService();
    }

public function admin()
{
    if ((int)$this->currentUser['role'] !== 1) {
        throw new ForbiddenException('Access denied');
    }

    $advanced = $this->analyticsService->getAdminAdvancedAnalytics();

    
   

    $this->set(compact('advanced'));
}


public function staff()
{
    $staffId = $this->request->getSession()->read('Auth.staff_id');

    $service = new \App\Service\AnalyticsService();
    $data = $service->getStaffAdvancedAnalytics($staffId);

    $this->set(compact('data'));
}

public function vendor()
{
    $vendorId = $this->request->getSession()->read('Auth.vendor_id');

    $service = new \App\Service\AnalyticsService();
    $data = $service->getVendorAdvancedAnalytics($vendorId);

    $this->set(compact('data'));
}
}
