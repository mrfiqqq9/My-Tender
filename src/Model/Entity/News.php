<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

class News extends Entity
{
    protected array $_accessible = [
        'title'       => true,
        'description' => true,
        'image'       => true,
        'tender_id'   => true,
        'status'      => true,
        'created_by'  => true,
        'created_at'  => true,

        'tender'      => true,
        'users'        => true,
    ];
}
