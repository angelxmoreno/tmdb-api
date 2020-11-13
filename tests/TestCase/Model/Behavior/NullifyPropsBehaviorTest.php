<?php

namespace App\Test\TestCase\Model\Behavior;

use App\Model\Behavior\NullifyPropsBehavior;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Behavior\NullifyPropsBehavior Test Case
 */
class NullifyPropsBehaviorTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Behavior\NullifyPropsBehavior
     */
    public $NullifyProps;

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $this->NullifyProps = new NullifyPropsBehavior();
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->NullifyProps);

        parent::tearDown();
    }

    /**
     * Test initial setup
     *
     * @return void
     */
    public function testInitialization()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
