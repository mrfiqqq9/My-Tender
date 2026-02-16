<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

class Vendor extends Entity
{
    protected array $_accessible = [
        'user_id'           => true,
        'company_name'      => true,
        'description'       => true,
        'ssm_number'        => true,
        'ssm_file'          => true,
        'tcc_file'          => true,
        'years_experience'  => true,
        'category_id'       => true,
        'address_line1'     => true,
        'address_line2'     => true,
        'postcode'          => true,
        'city'              => true,
        'state'             => true,
        'country'           => true,
        'paid_up_capital'   => true,
        'vendor_status'     => true,
        'created_at'        => true,
        'user'              => true,
    ];
}
