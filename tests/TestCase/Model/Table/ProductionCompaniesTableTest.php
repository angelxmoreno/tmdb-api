<?php

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ProductionCompaniesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ProductionCompaniesTable Test Case
 */
class ProductionCompaniesTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\ProductionCompaniesTable
     */
    public $ProductionCompanies;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.ProductionCompanies',
        'app.Movies',
        'app.Companies',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('ProductionCompanies') ? [] : ['className' => ProductionCompaniesTable::class];
        $this->ProductionCompanies = TableRegistry::getTableLocator()->get('ProductionCompanies', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->ProductionCompanies);

        parent::tearDown();
    }

    /**
     * Test initialize method
     *
     * @return void
     */
    public function testInitialize()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test validationDefault method
     *
     * @return void
     */
    public function testValidationDefault()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     */
    public function testBuildRules()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
