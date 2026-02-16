<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Tender Entity
 *
 * @property int $tender_id
 * @property int $category_id
 * @property string $title
 * @property string $description
 * @property string $budget
 * @property \Cake\I18n\Date $closing_date
 * @property int $status
 * @property \Cake\I18n\DateTime $created_at
 *
 * @property \App\Model\Entity\Category $category
 */
class Tender extends Entity
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
        'category_id' => true,
        'title' => true,
        'description' => true,
        'budget' => true,
        'closing_date' => true,
        'status' => true,
        'created_at' => true,
        'category' => true,
    ];
}
