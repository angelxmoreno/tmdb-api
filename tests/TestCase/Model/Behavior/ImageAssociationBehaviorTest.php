<?php

namespace App\Test\TestCase\Model\Behavior;

use App\Model\Behavior\ImageAssociationBehavior;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Behavior\ImageAssociationBehavior Test Case
 */
class ImageAssociationBehaviorTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Behavior\ImageAssociationBehavior
     */
    public $ImageAssociation;

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $this->ImageAssociation = new ImageAssociationBehavior();
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->ImageAssociation);

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
