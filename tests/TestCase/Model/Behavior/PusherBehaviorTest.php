<?php

namespace App\Test\TestCase\Model\Behavior;

use App\Model\Behavior\PusherBehavior;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Behavior\PusherBehavior Test Case
 */
class PusherBehaviorTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Behavior\PusherBehavior
     */
    public $Pusher;

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $this->Pusher = new PusherBehavior();
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Pusher);

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
