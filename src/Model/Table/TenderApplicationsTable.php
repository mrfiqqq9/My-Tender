<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query\SelectQuery;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * TenderApplications Model
 *
 * @property \App\Model\Table\TendersTable&\Cake\ORM\Association\BelongsTo $Tenders
 * @property \App\Model\Table\VendorsTable&\Cake\ORM\Association\BelongsTo $Vendors
 *
 * @method \App\Model\Entity\TenderApplication newEmptyEntity()
 * @method \App\Model\Entity\TenderApplication newEntity(array $data, array $options = [])
 * @method array<\App\Model\Entity\TenderApplication> newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\TenderApplication get(mixed $primaryKey, array|string $finder = 'all', \Psr\SimpleCache\CacheInterface|string|null $cache = null, \Closure|string|null $cacheKey = null, mixed ...$args)
 * @method \App\Model\Entity\TenderApplication findOrCreate($search, ?callable $callback = null, array $options = [])
 * @method \App\Model\Entity\TenderApplication patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method array<\App\Model\Entity\TenderApplication> patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\TenderApplication|false save(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method \App\Model\Entity\TenderApplication saveOrFail(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method iterable<\App\Model\Entity\TenderApplication>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\TenderApplication>|false saveMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\TenderApplication>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\TenderApplication> saveManyOrFail(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\TenderApplication>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\TenderApplication>|false deleteMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\TenderApplication>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\TenderApplication> deleteManyOrFail(iterable $entities, array $options = [])
 */
class TenderApplicationsTable extends Table
{
    /**
     * Initialize method
     *
     * @param array<string, mixed> $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config): void
    {
        parent::initialize($config);

        $this->setTable('tender_applications');
        $this->setDisplayField('application_id');
        $this->setPrimaryKey('application_id');

        $this->belongsTo('Tenders', [
            'foreignKey' => 'tender_id',
            'joinType' => 'INNER',
        ]);
        $this->belongsTo('Vendors', [
            'foreignKey' => 'vendor_id',
            'joinType' => 'INNER',
        ]);

        
        $this->addBehavior('Timestamp', [
    'events' => [
        'Model.beforeSave' => [
            'applied_at' => 'new',
        ],
    ],
]);

    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator): Validator
    {
        $validator
            ->integer('tender_id')
            ->notEmptyString('tender_id');

        $validator
            ->integer('vendor_id')
            ->notEmptyString('vendor_id');

        $validator
            ->integer('proposed_price')
            ->requirePresence('proposed_price', 'create')
            ->notEmptyString('proposed_price');

        $validator
            ->scalar('proposal_description')
            ->allowEmptyString('proposal_description');

        $validator
               ->scalar('quotation_file')
                ->maxLength('quotation_file', 255)
                ->allowEmptyString('quotation_file');

        $validator
            ->integer('status')
            ->requirePresence('status', 'create')
            ->notEmptyString('status');


        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules): RulesChecker
{
    $rules->add(
        $rules->existsIn(['tender_id'], 'Tenders'),
        ['errorField' => 'tender_id']
    );

    $rules->add(
        $rules->existsIn(['vendor_id'], 'Vendors'),
        ['errorField' => 'vendor_id']
    );

    // Vendor tak boleh apply tender yang sama dua kali
    $rules->add(
        $rules->isUnique(
            ['tender_id', 'vendor_id'],
            'You already applied for this tender.'
        ),
        ['errorField' => 'vendor_id']
    );

    return $rules;
}

}
