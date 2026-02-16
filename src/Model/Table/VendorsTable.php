<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\Validation\Validator;
use Cake\ORM\RulesChecker;

class VendorsTable extends Table
{
   public function initialize(array $config): void
{
    parent::initialize($config);

    $this->setTable('vendors');
    $this->setPrimaryKey('vendor_id');

    $this->belongsTo('Users', [
        'foreignKey' => 'user_id',
        'joinType' => 'INNER',
    ]);

    $this->belongsTo('Categories', [
        'foreignKey' => 'category_id',
        'joinType' => 'INNER',
    ]);

    // 🔥 WAJIB ADA NI
    $this->hasMany('TenderApplications', [
        'foreignKey' => 'vendor_id',
        'dependent' => true,
    ]);

    $this->addBehavior('Timestamp', [
        'created' => 'created_at',
        'modified' => false,
    ]);
}


    public function validationDefault(Validator $validator): Validator
    {
        $validator
            ->requirePresence('company_name')
            ->notEmptyString('company_name');

        $validator
            ->requirePresence('ssm_number')
            ->notEmptyString('ssm_number');

        $validator
            ->requirePresence('years_experience')
            ->integer('years_experience');

        $validator
            ->requirePresence('address_line1')
            ->notEmptyString('address_line1');

        $validator
            ->requirePresence('postcode')
            ->notEmptyString('postcode');

        $validator
            ->requirePresence('city')
            ->notEmptyString('city');

        $validator
            ->requirePresence('state')
            ->notEmptyString('state');

        $validator
            ->requirePresence('country')
            ->notEmptyString('country');

        return $validator;
    }

    public function buildRules(RulesChecker $rules): RulesChecker
    {
        $rules->add($rules->existsIn(['user_id'], 'Users'));
        return $rules;
    }
}
