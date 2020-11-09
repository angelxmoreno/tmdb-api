<?php

namespace App\Test\TestCase\Controller\Component;

use App\Controller\Component\PlaidComponent;
use Cake\Controller\ComponentRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Controller\Component\PlaidComponent Test Case
 */
class PlaidComponentTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Controller\Component\PlaidComponent
     */
    public $Plaid;

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $registry = new ComponentRegistry();
        $this->Plaid = new PlaidComponent($registry);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Plaid);

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
