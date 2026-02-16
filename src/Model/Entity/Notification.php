<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

class Notification extends Entity
{
    protected array $_accessible = [
        'user_id' => true,
        'role' => true,
        'type' => true,
        'message' => true,
        'reference_type' => true,
        'reference_id' => true,
        'is_read' => true,
        'created_at' => true,
    ];
}
