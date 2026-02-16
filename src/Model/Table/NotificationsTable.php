<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\Validation\Validator;

class NotificationsTable extends Table
{
    public function initialize(array $config): void
    {
        parent::initialize($config);

        $this->setTable('notifications');
        $this->setPrimaryKey('notification_id');

        $this->addBehavior('Timestamp', [
            'created' => 'created_at',
            'modified' => false
        ]);
    }

    public function validationDefault(Validator $validator): Validator
    {
        $validator
            ->integer('role')
            ->notEmptyString('role');

        $validator
            ->scalar('message')
            ->maxLength('message', 255)
            ->notEmptyString('message');

        return $validator;
    }
}
