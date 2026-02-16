<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

class TenderRequirement extends Entity
{
    protected array $_accessible = [
        'tender_id' => true,
        'requirement_type' => true,
        'requirement_value' => true,
        'description' => true,
        'tender' => true,
    ];

    public const TYPES = [
        1  => 'Minimum Years of Experience',
        2  => 'Minimum Paid-up Capital',
        3  => 'Maximum Budget',
        4  => 'Minimum Annual Turnover',
        5  => 'Relevant Project Experience',
        6  => 'ISO Certification',
        7  => 'Company Registration (SSM)',
        8  => 'CIDB Registration',
        9  => 'MOF Registration',
        10 => 'Bumiputera Status',
        11 => 'Local Company',
        12 => 'Number of Technical Staff',
        13 => 'Audited Financial Statement',
        14 => 'Bank Statement',
        15 => 'Performance Bond',
        16 => 'Insurance Coverage',
    ];

    public const TYPES_REQUIRING_VALUE = [
    1,  // Minimum Years of Experience
    2,  // Minimum Paid-up Capital
    3,  // Maximum Budget
    4,  // Minimum Annual Turnover
    12, // Number of Technical Staff
];

    public const INPUT_TYPE = [
        1  => 'number',
        2  => 'money',
        3  => 'money',
        4  => 'money',
        5  => 'text',
        6  => 'boolean',
        7  => 'boolean',
        8  => 'boolean',
        9  => 'boolean',
        10 => 'boolean',
        11 => 'boolean',
        12 => 'number',
        13 => 'boolean',
        14 => 'boolean',
        15 => 'boolean',
        16 => 'boolean',
    ];
    
 public const MONEY_TYPES = [2, 3, 4]; // duit
public const INTEGER_TYPES = [1, 12, 5]; // tahun, staff, project
    protected function _getRequirementLabel(): string
    {
        return self::TYPES[$this->requirement_type] ?? 'Unknown';
    }
}
