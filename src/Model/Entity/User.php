<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

class User extends Entity
{
    // 🎭 ROLE CONSTANTS
    public const ROLE_ADMIN  = 1;
    public const ROLE_STAFF  = 2;
    public const ROLE_VENDOR = 3;

    protected array $_accessible = [
        'name'   => true,
        'email' => true,
        'password' => true,
        'role' => true,
        'created_at' => true,
    ];

    protected array $_hidden = [
        'password',
    ];
}
