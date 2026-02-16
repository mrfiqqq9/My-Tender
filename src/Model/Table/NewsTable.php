<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\Validation\Validator;

class NewsTable extends Table
{
    public function initialize(array $config): void
    {
        parent::initialize($config);

        $this->setTable('news');
        $this->setPrimaryKey('news_id');

        $this->addBehavior('Timestamp', [
            'created' => 'created_at',
            'modified' => false,
        ]);

        $this->belongsTo('Users', [
            'foreignKey' => 'created_by',
            'joinType' => 'LEFT',
        ]);

        $this->belongsTo('Tenders', [
            'foreignKey' => 'tender_id',
            'joinType' => 'LEFT',
        ]);
    }

    public function validationDefault(Validator $validator): Validator
    {
        $validator
            ->scalar('title')
            ->maxLength('title', 150)
            ->notEmptyString('title');

        $validator
            ->scalar('description')
            ->notEmptyString('description');

        $validator
            ->allowEmptyString('image');

        return $validator;
    }
}
