<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\TenderRequirementsTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\TenderRequirementsTable Test Case
 */
class TenderRequirementsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\TenderRequirementsTable
     */
    protected $TenderRequirements;

    /**
     * Fixtures
     *
     * @var array<string>
     */
    protected array $fixtures = [
        'app.TenderRequirements',
        'app.Tenders',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('TenderRequirements') ? [] : ['className' => TenderRequirementsTable::class];
        $this->TenderRequirements = $this->getTableLocator()->get('TenderRequirements', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->TenderRequirements);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @link \App\Model\Table\TenderRequirementsTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     * @link \App\Model\Table\TenderRequirementsTable::buildRules()
     */
    public function testBuildRules(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
