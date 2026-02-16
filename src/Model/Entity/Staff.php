<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

class Staff extends Entity
{
    protected array $_accessible = [
        'user_id' => true,
        'staff_name' => true,
        'department' => true,
        'position' => true,
        'phone' => true,
        'created_at' => true,
    ];
}
