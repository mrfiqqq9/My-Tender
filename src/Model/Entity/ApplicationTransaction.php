<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

class ApplicationTransaction extends Entity
{
    protected array $_accessible = [
        'application_id'  => true,
        'tender_id'       => true,
        'vendor_id'       => true,
        'action'          => true,
        'performed_by'    => true,
        'performed_role'  => true,
        'remarks'         => true,
        'created_at'      => true,

        'users'            => true,
        'vendor'          => true,
        'tender'          => true,
        'tender_application' => true,
    ];
}
