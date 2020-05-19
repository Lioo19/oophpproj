<?php

namespace Lioo19\Blog;

use Anax\DI\DIMagic;
use Anax\Response\ResponseUtility;
use PHPUnit\Framework\TestCase;

/**
 * Test the controller like it would be used from the router,
 * simulating the actual router paths and calling it directly.
 * @SuppressWarnings(PHPMD.TooManyPublicMethods)
 */
class BlogControllerTest extends TestCase
{
    private $controller;
    private $app;

    /**
     * Setup the controller, before each testcase, just like the router
     * would set it up.
     */
    protected function setUp(): void
    {
        global $di;
        global $page;

        // Init service container $di to contain $app as a service
        $di = new DIMagic();
        $di->loadServices(ANAX_INSTALL_PATH . "/config/di");
        $app = $di;
        $this->app = $app;
        $di->set("app", $app);

        // Create and initiate the controller
        $this->controller = new BlogController();
        $this->controller->setApp($app);
        $this->controller->initialize();
    }

    /**
     * Call the controller startblog action.
     * Get
     */
    public function testIndexAction()
    {
        $res = $this->controller->indexAction();
        $this->assertInstanceOf(ResponseUtility::class, $res);
    }

    /**
     * Call the controller startblog action.
     * Get
     */
    public function testblogActionPost()
    {
        $res = $this->controller->blogActionPost();
        $this->assertInstanceOf(ResponseUtility::class, $res);
    }

    // /**
    //  * Call the controller startblog action.
    //  * Get
    //  */
    // public function testblogpostAction()
    // {
    //     $this->app->request->setGet("slug", "sagrada");
    //     $res = $this->controller->blogpostAction();
    //     $this->assertInstanceOf(ResponseUtility::class, $res);
    // }
}
