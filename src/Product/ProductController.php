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
            "res" => $res,
            "check" => null
        ];

        $page->add("product/header");
        $page->add("product/index", $data);

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

        $page->add("product/header");
        $page->add("product/show-all", $data);

        return $page->render([
            "title" => $title,
        ]);
    }

    /**
     * Searching for products by year-interval
     *
     * @return object
     */
    public function searchYearAction() : object
    {
        $title = "Sök på årtal ";
        $request = $this->app->request;
        $response = $this->app->response;
        $page = $this->app->page;
        $db = $this->app->db;

        $this->connection();

        $sql = "SELECT * FROM product;";
        $year1 = $request->getGet("year1");
        $year2 = $request->getGet("year2");
        $params = null;

        if ($year1 && $year2) {
            $sql = "SELECT * FROM product WHERE year >= ? AND year <= ?;";
            $params = [$year1, $year2];
        } elseif ($year1) {
            $sql = "SELECT * FROM product WHERE year >= ?;";
            $params = [$year1];
        } elseif ($year2) {
            $sql = "SELECT * FROM product WHERE year <= ?;";
            $params = [$year2];
        }

        $res = null;
        if ($params) {
            $res = $db->executeFetchAll($sql, $params);
        } else {
            $res = $db->executeFetchAll($sql);
        }

        $data = [
            "name" => $name,
            "check" => "check",
            "year1" => $year1,
            "year2" => $year2,
            "res"   => $res
        ];

        $page->add("product/header", $data);
        $page->add("product/search-year", $data);
        $page->add("product/index", $data);

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

        $page->add("product/header", $data);
        $page->add("product/search-name", $data);
        $page->add("product/show-all", $data);

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

        $page->add("product/header");
        $page->add("product/select", $data);

        return $page->render([
            "title" => $title
        ]);
    }

    /**
     * POST product selection, redirecting to CRUD
     *
     * @return void
     */
    public function selectActionPost() : object
    {
        $request = $this->app->request;
        $response = $this->app->response;
        $db = $this->app->db;

        $id = $request->getPost("id", null);
        $edit = $request->getPost("edit", null);
        $delete = $request->getPost("delete", null);
        $add = $request->getPost("add", null);

        if ((!$id && $edit) || (!$id && $delete)) {
            return $response->redirect("product/select");
        }

        if ($delete && is_numeric($id)) {
            $this->deleteActionPost($id);
            return $response->redirect("product/select");
        } elseif ($add) {
            $this->addActionPost();
            //fetching last inserted ID
            $id = $db->lastInsertId();
            return $response->redirect("product/edit?id=$id");
        } elseif ($edit && is_numeric($id)) {
            return $response->redirect("product/edit?id=$id");
        }
    }

    /**
     * Post action to delete product
     * Doesnt need a landningpage, just reproduct?
     *DONE?
     *
     * @return object
     */
    public function deleteActionPost($id) : object
    {
        $db = $this->app->db;
        $response = $this->app->response;
        $this->connection();

        $deleteSql = "DELETE FROM product WHERE id = ?;";
        //vill man få en return med alla här? kanske är nice?
        $db->execute($deleteSql, [$id]);

        return $response->redirect("product/select");
    }

    /**
     * Post action to add product
     * DONE?
     *
     * @return object
     */
    public function addActionPost() : object
    {
        $db = $this->app->db;
        $response = $this->app->response;
        $request = $this->app->request;
        $this->connection();

        $name = $request->getPost("name", "Namn");
        $year = $request->getPost("price");
        $image = $request->getPost("stock");
        $image = $request->getPost("image", "img/default.jpg");
        $image = $request->getPost("image", "img/default.jpg");
        $image = $request->getPost("image", "img/default.jpg");
        $image = $request->getPost("image", "img/default.jpg");

        // "name",
        // "price",
        // "stock",
        // "brand",
        // "time",
        // "players",
        // "year",
        // "language",
        // "description",
        // "type",
        // "rating",
        // "image",
        $addSql = "INSERT INTO product (name, year, image) VALUES (?, ?, ?);";
        $db->execute($addSql, [$name, $year, $image]);

        return $response->redirect("product/select");
    }

    /**
     * Post action to edit product
     *
     * @return object
     */
    public function editActionPost() : object
    {
        $db = $this->app->db;
        $response = $this->app->response;
        $request = $this->app->request;
        $this->connection();

        $id = $request->getPost("id") ?: $request->getGet("id");
        // var_dump($id);
        $name = $request->getPost("name", "Namn");
        $year = $request->getPost("year", 9999);
        $image = $request->getPost("image", "img/default.jpg");

        $editSql = "UPDATE product SET name = ?, year = ?, image = ? WHERE id = ?;";
        $db->execute($editSql, [$name, $year, $image, $id]);

        return $response->redirect("product/select");
    }

    /**
     * Get action to edit product
     *
     * @return object
     */
    public function editAction() : object
    {
        $title = " Edit product ";
        $db = $this->app->db;
        $page = $this->app->page;
        $request = $this->app->request;

        $this->connection();

        $id = $request->getGet("id");

        $sql = "SELECT * FROM product WHERE id = ?;";
        $chosenProduct = $db->executeFetchAll($sql, [$id]);
        // var_dump($chosenProduct);
        $chosenProduct = $chosenProduct[0];

        $data = [
          "product" => $chosenProduct ?? null,
        ];

        $page->add("product/header");
        $page->add("product/edit", $data);

        return $page->render([
          "title" => $title
        ]);
    }
}
