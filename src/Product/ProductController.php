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

        $page->add("products/header");
        $page->add("products/show-all", $data);

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

        $page->add("products/header", $data);
        $page->add("products/search-year", $data);
        $page->add("products/index", $data);

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
            return $response->redirect("products/select");
        }

        if ($delete && is_numeric($id)) {
            $this->deleteActionPost($id);
            return $response->redirect("products/select");
        } elseif ($add) {
            $this->addActionPost();
            //fetching last inserted ID
            $id = $db->lastInsertId();
            return $response->redirect("products/edit?id=$id");
        } elseif ($edit && is_numeric($id)) {
            return $response->redirect("products/edit?id=$id");
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
        $db->execute($deleteSql, [$id]);

        return $response->redirect("products/select");
    }

    /**
     * Post action to add product
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
        $year = $request->getPost("year", 9999);
        $image = $request->getPost("image", "img/default.jpg");

        $addSql = "INSERT INTO product (name, year, image) VALUES (?, ?, ?);";
        $db->execute($addSql, [$name, $year, $image]);

        return $response->redirect("products/select");
    }

    /**
     * Post action to edit product
     * CHECK FOR FAULTS WHEN NOT GIVING ALL PARAMS
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
        $price = $request->getPost("price", 9999);
        $stock = $request->getPost("stock", 9999);
        $brand = $request->getPost("brand");
        $time = $request->getPost("time");
        $players = $request->getPost("players");
        $language = $request->getPost("language");
        $description = $request->getPost("description");
        $type = $request->getPost("type");
        $rating = $request->getPost("rating");

        $editSql = "UPDATE product SET
        name = ?,
        price = ?,
        stock = ?,
        brand = ?,
        time = ?,
        players = ?,
        language = ?,
        type = ?,
        rating = ?,
        year = ?,
        image = ?
        WHERE id = ?;";
        $db->execute($editSql, [
            $name,
            $price,
            $stock,
            $brand,
            $time,
            $players,
            $language,
            $type,
            $rating,
            $year,
            $image,
            $id
        ]);

        return $response->redirect("products/select");
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

        $page->add("products/header");
        $page->add("products/edit", $data);

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
