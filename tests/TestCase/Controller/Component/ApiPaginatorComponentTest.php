<?php

namespace App\Test\TestCase\Controller\Component;

use App\Controller\Component\ApiPaginatorComponent;
use Cake\Controller\ComponentRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Controller\Component\ApiPaginatorComponent Test Case
 */
class ApiPaginatorComponentTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Controller\Component\ApiPaginatorComponent
     */
    public $ApiPaginator;

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $registry = new ComponentRegistry();
        $this->ApiPaginator = new ApiPaginatorComponent($registry);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->ApiPaginator);

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
