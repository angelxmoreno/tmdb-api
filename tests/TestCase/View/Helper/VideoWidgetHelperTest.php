<?php
namespace App\Test\TestCase\View\Helper;

use App\View\Helper\VideoWidgetHelper;
use Cake\TestSuite\TestCase;
use Cake\View\View;

/**
 * App\View\Helper\VideoWidgetHelper Test Case
 */
class VideoWidgetHelperTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\View\Helper\VideoWidgetHelper
     */
    public $VideoWidget;

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $view = new View();
        $this->VideoWidget = new VideoWidgetHelper($view);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->VideoWidget);

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
