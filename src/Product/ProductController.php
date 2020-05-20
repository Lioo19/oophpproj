<?php

namespace Lioo19\Product;

use Anax\Commons\AppInjectableInterface;
use Anax\Commons\AppInjectableTrait;

// use Anax\Route\Exception\ForbiddenException;
// use Anax\Route\Exception\NotFoundException;
// use Anax\Route\Exception\InternalErrorException;

/**
 * A  controller for the product function
 *
 *
 * @SuppressWarnings(PHPMD.TooManyPublicMethods)
 * @SuppressWarnings(PHPMD.UnusedLocalVariable)
 * @SuppressWarnings(PHPMD.CyclomaticComplexity)
 *
 */
class ProductController implements AppInjectableInterface
{
    use AppInjectableTrait;

    /**
     * This is the action for connecting to the database
     *
     * @return void
     */
    public function connection()
    {
        $this->app->db->connect();
    }

    /**
     * This is the index method action
     * redirecting instantly to init
     * and booting up the page
     *
     * @return object
     */
    public function indexAction()
    {
        $title = "Product database ";
        $page = $this->app->page;
        $db = $this->app->db;

        $this->connection();
        $sql = "SELECT * FROM product;";
        $res = $db->executeFetchAll($sql);

        $data = [
            "title" => $title,
            "res" => $res,
            "check" => null
        ];

        $page->add("flash", [], "flash");
        $page->add("products/header");
        $page->add("products/index", $data);

        return $page->render([
            "title" => $title,
        ]);
    }

    /**
     * This is the show all get
     *
     * @return object
     */
    public function showAllAction()
    {
        $title = "Product overview";
        $page = $this->app->page;
        $db = $this->app->db;

        $this->connection();
        $sql = "SELECT * FROM product;";
        $res = $db->executeFetchAll($sql);

        $data = [
            "res" => $res,
            "check" => "check"
        ];

        // $page->add("flash", [], "hej");
        $page->add("products/header");
        $page->add("products/show-all", $data);

        return $page->render([
            "title" => $title,
        ]);
    }

    /**
     * Get for startplay, renders the page and deletes session-scores
     *
     * @return object
     */
    public function searchNameAction() : object
    {
        $title = "Sök på titel ";
        $db = $this->app->db;
        $page = $this->app->page;
        $request = $this->app->request;

        $this->connection();
        $searchName = $request->getGet("searchName");

        $res = null;
        if ($searchName) {
            $sql = "SELECT * FROM product WHERE name LIKE ?;";
            $res = $db->executeFetchAll($sql, [$searchName]);
        } else {
            //set to show all products if search not done
            $sql = "SELECT * FROM product;";
            $res = $db->executeFetchAll($sql);
        }

        $data = [
            "title"         => $title,
            "check"         => "check",
            "searchName"   => $searchName,
            "res"           => $res
        ];

        $page->add("products/header", $data);
        $page->add("products/search-name", $data);
        $page->add("products/show-all", $data);

        return $page->render($data);
    }

    /**
     * Selection of single product, with links for CRUD
     *
     * @return object
     */
    public function selectAction() : object
    {
        $title = "Select Product ";
        $page = $this->app->page;
        $db = $this->app->db;

        $this->connection();
        $sql = "SELECT id, name FROM product;";
        $products = $db->executeFetchAll($sql);

        $data = [
            "products" => $products ?? null
        ];

        $page->add("products/header");
        $page->add("products/select", $data);

        return $page->render([
            "title" => $title
        ]);
    }

    //INDIVIDUAL PAGE
    /**
     * Post-route for blog-page
     *
     * @return object
     */
    public function productsActionPost() : object
    {
        $request = $this->app->request;
        $response = $this->app->response;

        $id = $request->getGet("id", null);

        if ($id) {
            return $response->redirect("products/product?id=$id");
        } else {
            return $response->redirect("products");
        }
    }

    /**
     * Showing the product-view
     *
     * @return object
     */
    public function productAction() : object
    {
        $title = "Product";
        $request = $this->app->request;
        $page = $this->app->page;
        $db = $this->app->db;
        $id = $request->getGet("id", 1);
        $this->connection();

        $sql = "SELECT * FROM product WHERE id = ?;";
        $product = $db->executeFetch($sql, [$id]);

        $data = [
            "product"   => $product
        ];

        $page->add("products/header");
        $page->add("products/product", $data);

        return $page->render([
            "title" => $title,
        ]);
    }
}
