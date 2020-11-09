<?php

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\EnvelopeCategoryLinksTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\EnvelopeCategoryLinksTable Test Case
 */
class EnvelopeCategoryLinksTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\EnvelopeCategoryLinksTable
     */
    public $EnvelopeCategoryLinks;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.EnvelopeCategoryLinks',
        'app.Users',
        'app.Envelopes',
        'app.Categories',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('EnvelopeCategoryLinks') ? [] : ['className' => EnvelopeCategoryLinksTable::class];
        $this->EnvelopeCategoryLinks = TableRegistry::getTableLocator()->get('EnvelopeCategoryLinks', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->EnvelopeCategoryLinks);

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
