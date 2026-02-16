<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\Validation\Validator;

class CategoriesTable extends Table
{
    public function initialize(array $config): void
    {
        parent::initialize($config);

        $this->setTable('categories');
        $this->setDisplayField('category_name');
        $this->setPrimaryKey('category_id');

        // 🔥 AUTO HANDLE created_at
        $this->addBehavior('Timestamp', [
            'created'  => 'created_at',
            'modified' => false
        ]);
    }

    public function validationDefault(Validator $validator): Validator
    {
        $validator
            ->scalar('category_name')
            ->maxLength('category_name', 100)
            ->requirePresence('category_name', 'create')
            ->notEmptyString('category_name');

        // ❌ JANGAN validate created_at (auto)
        return $validator;
    }
}
