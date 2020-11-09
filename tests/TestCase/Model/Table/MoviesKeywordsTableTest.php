<?php

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\MoviesKeywordsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\MoviesKeywordsTable Test Case
 */
class MoviesKeywordsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\MoviesKeywordsTable
     */
    public $MoviesKeywords;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.MoviesKeywords',
        'app.Movies',
        'app.Keywords',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('MoviesKeywords') ? [] : ['className' => MoviesKeywordsTable::class];
        $this->MoviesKeywords = TableRegistry::getTableLocator()->get('MoviesKeywords', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->MoviesKeywords);

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
