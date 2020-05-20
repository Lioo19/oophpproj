<?php

namespace Lioo19\Admin;

use Anax\DI\DIMagic;
use Anax\Response\ResponseUtility;
use PHPUnit\Framework\TestCase;

/**
 * Test the controller like it would be used from the router,
 * simulating the actual router paths and calling it directly.
 * @SuppressWarnings(PHPMD.TooManyPublicMethods)
 */
class AdminControllerTest extends TestCase
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
        // Use a different cache dir for unit test
        $di->get("cache")->setPath(ANAX_INSTALL_PATH . "/test/cache");

        $app = $di;
        $this->app = $app;
        $di->set("app", $app);

        // Create and initiate the controller
        $this->controller = new AdminController();
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

        $this->app->session->set("login", "admin");

        $res = $this->controller->indexAction();
        $this->assertInstanceOf(ResponseUtility::class, $res);
    }


    /**
     * Call the controller startadmin action.
     * Get
     */
    public function testUserAction()
    {
        $res = $this->controller->userAction();
        $this->assertInstanceOf(ResponseUtility::class, $res);
    }

    /**
     * Call the controller startadmin action.
     * Get
     */
    public function testBlogAction()
    {
        $res = $this->controller->blogAction();
        $this->assertInstanceOf(ResponseUtility::class, $res);
    }

    /**
     * Call the controller startadmin action.
     * Get
     */
    public function testProductAction()
    {
        $res = $this->controller->productAction();
        $this->assertInstanceOf(ResponseUtility::class, $res);
    }

    /**
     * Call the controller startadmin action.
     * Get
     */
    public function testProductAdminAction()
    {
        $res = $this->controller->productadminAction();
        $this->assertInstanceOf(ResponseUtility::class, $res);
    }

    /**
     * Call the controller startadmin action.
     * Get
     */
    public function testProductActionPostEdit()
    {
        $this->app->request->setPost("id", 15);
        $this->app->request->setPost("add", "add");
        $res = $this->controller->productActionPost();
        $this->assertInstanceOf(ResponseUtility::class, $res);
        $this->app->request->setPost("id", 15);
        $this->app->request->setPost("edit", "edit");
        $res = $this->controller->productActionPost();
        $this->assertInstanceOf(ResponseUtility::class, $res);
    }

    /**
     * Call the controller startadmin action.
     * Get
     */
    public function testProductActionPostDelete()
    {
        $this->app->request->setPost("id", 15);
        $this->app->request->setPost("add", "add");
        $res = $this->controller->productActionPost();
        $this->assertInstanceOf(ResponseUtility::class, $res);
        $this->app->request->setPost("id", 15);
        $this->app->request->setPost("delete", "delete");
        $res = $this->controller->productActionPost();
        $this->assertInstanceOf(ResponseUtility::class, $res);
    }

    // /**
    //  * Call the controller startadmin action.
    //  * Get
    //  */
    // public function testProductCreateActionPost()
    // {
    //     $this->app->request->setPost("productName", "edit");
    //
    //     $res = $this->controller->productcreateActionPost();
    //     $this->assertInstanceOf(ResponseUtility::class, $res);
    // }

    /**
     * Call the controller startadmin action.
     * Get
     */
    public function testProductDeleteAction()
    {
        $this->app->request->setGet("id", 15);

        $res = $this->controller->productdeleteAction();
        $this->assertInstanceOf(ResponseUtility::class, $res);
    }

    /**
     * Call the controller startadmin action.
     * Get
     */
    public function testBlogCreateAction()
    {
        $res = $this->controller->blogcreateAction();
        $this->assertInstanceOf(ResponseUtility::class, $res);
    }

    // /**
    //  * Call the controller startadmin action.
    //  * Get
    //  */
    // public function testBlogCreateActionPost()
    // {
    //     $this->app->request->setPost("blogTitle", "edit");
    //
    //     $res = $this->controller->blogcreateActionPost();
    //     $this->assertInstanceOf(ResponseUtility::class, $res);
    // }

    /**
     * Call the controller startadmin action.
     * Get
     */
    public function testBlogDeleteActionPost()
    {
        $this->app->request->setPost("id", 15);

        $res = $this->controller->blogdeleteActionPost();
        $this->assertInstanceOf(ResponseUtility::class, $res);
    }
}
