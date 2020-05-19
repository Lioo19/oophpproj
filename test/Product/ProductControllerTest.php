<?php

namespace Lioo19\Product;

use Anax\DI\DIMagic;
use Anax\Response\ResponseUtility;
use PHPUnit\Framework\TestCase;

/**
 * Test the controller like it would be used from the router,
 * simulating the actual router paths and calling it directly.
 * @SuppressWarnings(PHPMD.TooManyPublicMethods)
 */
class ProductControllerTest extends TestCase
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
        $this->controller = new ProductController();
        $this->controller->setApp($app);
        // $this->controller->conntection();
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
    public function testshowAllAction()
    {
        $res = $this->controller->showAllAction();
        $this->assertInstanceOf(ResponseUtility::class, $res);
    }

    /**
     * Call the controller index action.
     */
    public function testsearchNameAction()
    {
        $res = $this->controller->searchNameAction();
        $this->assertInstanceOf(ResponseUtility::class, $res);
    }

    /**
     * Call the controller index action.
     */
    public function testsearchNameActionWithSearch()
    {
        $this->app->request->setGet("searchName", "Wingspan");

        $res = $this->controller->searchNameAction();
        $this->assertInstanceOf(ResponseUtility::class, $res);
    }

    /**
     * Call the controller index action.
     */
    public function testproductsActionPostWithId()
    {
        $this->app->request->setGet("id", 5);

        $res = $this->controller->productsActionPost();
        $this->assertInstanceOf(ResponseUtility::class, $res);
    }

    /**
     * Call the controller index action.
     */
    public function testproductsActionPost()
    {
        $res = $this->controller->productsActionPost();
        $this->assertInstanceOf(ResponseUtility::class, $res);
    }

    /**
     * Call the controller index action.
     */
    public function testSelectAction()
    {
        $res = $this->controller->selectAction();
        $this->assertInstanceOf(ResponseUtility::class, $res);
    }
}
