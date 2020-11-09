<?php

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\EnvelopesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\EnvelopesTable Test Case
 */
class EnvelopesTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\EnvelopesTable
     */
    public $Envelopes;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.Envelopes',
        'app.Users',
        'app.EnvelopeCategoryLinks',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('Envelopes') ? [] : ['className' => EnvelopesTable::class];
        $this->Envelopes = TableRegistry::getTableLocator()->get('Envelopes', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Envelopes);

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
