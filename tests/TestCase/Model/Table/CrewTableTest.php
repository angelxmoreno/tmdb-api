<?php

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\CrewTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\CrewTable Test Case
 */
class CrewTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\CrewTable
     */
    public $Crew;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.Crew',
        'app.Credits',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('Crew') ? [] : ['className' => CrewTable::class];
        $this->Crew = TableRegistry::getTableLocator()->get('Crew', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Crew);

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
