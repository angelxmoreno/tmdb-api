<?php

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ValidMoviesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ValidMoviesTable Test Case
 */
class ValidMoviesTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\ValidMoviesTable
     */
    public $ValidMovies;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.ValidMovies',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('ValidMovies') ? [] : ['className' => ValidMoviesTable::class];
        $this->ValidMovies = TableRegistry::getTableLocator()->get('ValidMovies', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->ValidMovies);

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
}
