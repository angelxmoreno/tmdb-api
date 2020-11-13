<?php

namespace App\Test\TestCase\Model\Behavior;

use App\Model\Behavior\MarshalMapperBehavior;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Behavior\MarshalMapperBehavior Test Case
 */
class MarshalMapperBehaviorTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Behavior\MarshalMapperBehavior
     */
    public $MarshalMapper;

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $this->MarshalMapper = new MarshalMapperBehavior();
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->MarshalMapper);

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
