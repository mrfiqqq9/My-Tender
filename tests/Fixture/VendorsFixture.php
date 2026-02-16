<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * VendorsFixture
 */
class VendorsFixture extends TestFixture
{
    /**
     * Init method
     *
     * @return void
     */
    public function init(): void
    {
        $this->records = [
            [
                'vendor_id' => 1,
                'user_id' => 1,
                'company_name' => 'Lorem ipsum dolor sit amet',
                'years_experience' => 1,
                'created_at' => 1769923846,
                'Address' => 'Lorem ipsum dolor sit amet',
            ],
        ];
        parent::init();
    }
}
