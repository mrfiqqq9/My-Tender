<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\Validation\Validator;
use Cake\ORM\RulesChecker;

class TenderRequirementsTable extends Table
{
    public function initialize(array $config): void
    {
        parent::initialize($config);

        $this->setTable('tender_requirements');
        $this->setPrimaryKey('requirement_id');

        // 🔗 Requirement → Tender
        $this->belongsTo('Tenders', [
            'foreignKey' => 'tender_id',
            
        ]);
    }

    public function validationDefault(Validator $validator): Validator
    {
        $validator
            ->integer('tender_id')
            ->notEmptyString('tender_id');

        $validator
            ->integer('requirement_type')
            ->notEmptyString('requirement_type');

        $validator
            ->decimal('requirement_value')
            ->allowEmptyString('requirement_value');

        $validator
            ->scalar('description')
            ->allowEmptyString('description');

        return $validator;
    }

    public function buildRules(RulesChecker $rules): RulesChecker
    {
        $rules->add(
            $rules->existsIn(['tender_id'], 'Tenders'),
            ['errorField' => 'tender_id']
        );

        return $rules;
    }
}
