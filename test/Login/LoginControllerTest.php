<?php

namespace Lioo19\Login;

use Anax\DI\DIMagic;
use Anax\Response\ResponseUtility;
use PHPUnit\Framework\TestCase;

/**
 * Test the controller like it would be used from the router,
 * simulating the actual router paths and calling it directly.
 * @SuppressWarnings(PHPMD.TooManyPublicMethods)
 */
class LoginControllerTest extends TestCase
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

        // Init service container $di to contain $app as a service
        $di = new DIMagic();
        $di->loadServices(ANAX_INSTALL_PATH . "/config/di");
        $app = $di;
        $this->app = $app;
        $di->set("app", $app);

        // Create and initiate the controller
        $this->controller = new LoginController();
        $this->controller->setApp($app);
        $this->controller->initialize();
    }

    /**
     * Call the controller index action.
     */
    public function testIndexAction()
    {
        $res = $this->controller->indexAction();
        $this->assertInstanceOf(ResponseUtility::class, $res);
    }

    /**
     * Call the controller index action.
     */
    public function testIndexActionPost()
    {
        $this->app->request->setPost("user", "test");
        $this->app->request->setPost("password", "test");

        $res = $this->controller->indexActionPost();
        $this->assertInstanceOf(ResponseUtility::class, $res);
    }

    /**
     * Test for register action
     */
    public function testregisterAction()
    {
        $res = $this->controller->registerAction();
        $this->assertInstanceOf(ResponseUtility::class, $res);
    }

    /**
     * Test for register action
     */
    public function testlogoutAction()
    {
        $res = $this->controller->logoutAction();
        $this->assertInstanceOf(ResponseUtility::class, $res);
    }

    /**
     * Test for register action
     */
    public function testnoaccessAction()
    {
        $res = $this->controller->noaccessAction();
        $this->assertInstanceOf(ResponseUtility::class, $res);
    }

    // /**
    //  * Test for register action
    //  */
    // public function testregisterActionPost()
    // {
    //     $this->app->request->setPost("user", "test1");
    //     $this->app->request->setPost("password", "test1");
    //     // $this->app->request->setPost("name", "test1");
    //     // $this->app->request->setPost("email", "test1");
    //
    //     $res = $this->controller->registerActionPost();
    //     $this->assertInstanceOf(ResponseUtility::class, $res);
    // }
}
