<?php

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\MoviesCompaniesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\MoviesCompaniesTable Test Case
 */
class MoviesCompaniesTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\MoviesCompaniesTable
     */
    public $MoviesCompanies;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.MoviesCompanies',
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
        $config = TableRegistry::getTableLocator()->exists('MoviesCompanies') ? [] : ['className' => MoviesCompaniesTable::class];
        $this->MoviesCompanies = TableRegistry::getTableLocator()->get('MoviesCompanies', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->MoviesCompanies);

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
