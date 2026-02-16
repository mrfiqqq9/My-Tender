<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\Validation\Validator;
use Cake\ORM\RulesChecker;

class TendersTable extends Table
{
    public function initialize(array $config): void
    {
        parent::initialize($config);

        // ✅ Table config
        $this->setTable('tenders');
        $this->setPrimaryKey('tender_id');

        // ===============================
        // RELATIONSHIPS
        // ===============================

        // Category
        $this->belongsTo('Categories', [
            'foreignKey' => 'category_id',
            'joinType' => 'INNER',
        ]);

        // Tender Requirements
        $this->hasMany('TenderRequirements', [
            'foreignKey' => 'tender_id',
            'dependent' => true,
            'cascadeCallbacks' => true,
        ]);

        // Tender Applications
        $this->hasMany('TenderApplications', [
            'foreignKey' => 'tender_id',
            'dependent' => true,
            'cascadeCallbacks' => true,
        ]);

        // Optional (for audit)
        $this->hasMany('ApplicationTransactions', [
            'foreignKey' => 'tender_id',
        ]);

        $this->addBehavior('Timestamp', [
            'created' => 'created_at',
            'modified' => false,
        ]);
    }

    // ===============================
    // VALIDATION
    // ===============================

    public function validationDefault(Validator $validator): Validator
    {
        $validator
            ->integer('category_id')
            ->requirePresence('category_id', 'create')
            ->notEmptyString('category_id');

        $validator
            ->scalar('title')
            ->maxLength('title', 150)
            ->requirePresence('title', 'create')
            ->notEmptyString('title');

        $validator
            ->scalar('description')
            ->requirePresence('description', 'create')
            ->notEmptyString('description');

        $validator
            ->decimal('budget')
            ->requirePresence('budget', 'create')
            ->notEmptyString('budget');

        $validator
            ->date('closing_date')
            ->requirePresence('closing_date', 'create')
            ->notEmptyDate('closing_date');

        $validator
            ->integer('status')
            ->allowEmptyString('status');

        return $validator;
    }

    // ===============================
    // RULES
    // ===============================

    public function buildRules(RulesChecker $rules): RulesChecker
    {
        $rules->add(
            $rules->existsIn(['category_id'], 'Categories'),
            ['errorField' => 'category_id']
        );

        return $rules;
    }
}
