<?php

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\MoviesGenresTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\MoviesGenresTable Test Case
 */
class MoviesGenresTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\MoviesGenresTable
     */
    public $MoviesGenres;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.MoviesGenres',
        'app.Movies',
        'app.Genres',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('MoviesGenres') ? [] : ['className' => MoviesGenresTable::class];
        $this->MoviesGenres = TableRegistry::getTableLocator()->get('MoviesGenres', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->MoviesGenres);

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
