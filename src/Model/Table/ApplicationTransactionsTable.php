<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\Validation\Validator;

class ApplicationTransactionsTable extends Table
{
    public function initialize(array $config): void
    {
        parent::initialize($config);

        $this->setTable('application_transactions');
        $this->setPrimaryKey('transaction_id');

        // 🔗 siapa buat action (admin / staff)
        $this->belongsTo('Users', [
            'foreignKey' => 'performed_by',
            'joinType' => 'LEFT',
        ]);

        // 🔗 vendor yang terlibat
        $this->belongsTo('Vendors', [
            'foreignKey' => 'vendor_id',
            'joinType' => 'INNER',
        ]);

        // 🔗 tender
        $this->belongsTo('Tenders', [
            'foreignKey' => 'tender_id',
            'joinType' => 'INNER',
        ]);

        // 🔗 application
        $this->belongsTo('TenderApplications', [
            'foreignKey' => 'application_id',
            'joinType' => 'INNER',
        ]);
    }

    public function validationDefault(Validator $validator): Validator
    {
        $validator
            ->scalar('action')
            ->maxLength('action', 50)
            ->notEmptyString('action');

        $validator
            ->integer('performed_by')
            ->allowEmptyString('performed_by');

        $validator
            ->integer('performed_role')
            ->notEmptyString('performed_role');

        $validator
            ->scalar('remarks')
            ->allowEmptyString('remarks');

        return $validator;
    }
}
