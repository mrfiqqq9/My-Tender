<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * TenderApplication Entity
 *
 * @property int $application_id
 * @property int $tender_id
 * @property int $vendor_id
 * @property int $proposed_price
 * @property string|null $proposal_description
 * @property string|null $quotation_file
 * @property int $status
 * @property \Cake\I18n\DateTime $applied_at
 *
 * @property \App\Model\Entity\Tender $tender
 * @property \App\Model\Entity\Vendor $vendor
 */
class TenderApplication extends Entity
{
    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array<string, bool>
     */
    protected array $_accessible = [
        'tender_id' => true,
        'vendor_id' => true,
        'proposed_price' => true,
        'proposal_description' => true,
        'quotation_file' => true,
        'status' => true,
        'applied_at' => true,
        'tender' => true,
        'vendor' => true,
    ];
}
