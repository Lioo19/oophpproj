<?php

namespace Lioo19\Admin;

use Anax\Commons\AppInjectableInterface;
use Anax\Commons\AppInjectableTrait;

// use Anax\Route\Exception\ForbiddenException;
// use Anax\Route\Exception\NotFoundException;
// use Anax\Route\Exception\InternalErrorException;

/**
 * A  controller for the admin page
 *
 *
 * @SuppressWarnings(PHPMD.TooManyPublicMethods)
 * @SuppressWarnings(PHPMD.UnusedLocalVariable)
 * @SuppressWarnings(PHPMD.CyclomaticComplexity)
 *
 */
class AdminController implements AppInjectableInterface
{
    use AppInjectableTrait;
    private $adminClass;

    /**
     * Setup to database and create new adminClass
     *
     * @return object
     */
    public function initialize()
    {
        $session = $this->app->session;
        $response = $this->app->response;

        if ($session->get("login") === "admin") {
            $this->app->db->connect();
            $this->adminClass = new Admin($this->app->db);
        } else {
            return $response->redirect("login/noaccess");
        }

    }

    /**
     * This is the index method action
     *
     *
     * @return object
     */
    public function indexAction()
    {
        $title = "admin";
        $page = $this->app->page;

        $data = [
            "title" => $title,
        ];

        $page->add("admin/header", $data);
        $page->add("admin/index", $data);

        return $page->render([
            "title" => $title,
        ]);
    }

    /**
     * Showing the blog-view
     *
     * @return object
     */
    public function blogAction() : object
    {
        $title = "Blogg | Admin";
        $page = $this->app->page;

        $res = $this->adminClass->getAllBlog();

        $data = [
            "res" => $res,
            "check" => null
        ];

        $page->add("admin/header");
        $page->add("admin/blog", $data);

        return $page->render([
            "title" => $title,
        ]);
    }

    /**
     * Showing the blog-view
     *
     * @return object
     */
    public function productAction() : object
    {
        $title = "Produkter | Admin";
        $page = $this->app->page;

        $products = $this->adminClass->getAllProducts();

        $data = [
            "products" => $products,
            "check" => null
        ];

        $page->add("admin/header");
        $page->add("admin/product", $data);

        return $page->render([
            "title" => $title,
        ]);
    }

    /**
     * Showing the blog-view
     *
     * @return object
     */
    public function productadminAction() : object
    {
        $title = "CRUD produkter | Admin";
        $page = $this->app->page;

        $products = $this->adminClass->getAllProducts();

        $data = [
            "products" => $products,
            "check" => null
        ];

        $page->add("admin/header");
        $page->add("admin/productadmin", $data);

        return $page->render([
            "title" => $title,
        ]);
    }



    /**
     * Showing the users-view
     *
     * @return object
     */
    public function userAction() : object
    {
        $title = "Användare | Admin";
        $page = $this->app->page;

        $res = $this->adminClass->getAllUsers();

        $data = [
            "res" => $res,
            "check" => null
        ];

        $page->add("admin/header");
        $page->add("admin/user", $data);

        return $page->render([
            "title" => $title,
        ]);
    }

    /**
     * POST product selection, redirecting to CRUD
     *
     * @return void
     */
    public function productActionPost() : object
    {
        $request = $this->app->request;
        $response = $this->app->response;
        $db = $this->app->db;

        $id = $request->getPost("id", null);
        $edit = $request->getPost("edit", null);
        $delete = $request->getPost("delete", null);
        $add = $request->getPost("add", null);

        if ((!$id && $edit) || (!$id && $delete)) {
            return $response->redirect("admin/product");
        }
        if ($delete && is_numeric($id)) {
            $this->adminClass->productDelete($id);
            return $response->redirect("admin/product");
        } elseif ($add) {
            return $response->redirect("admin/productcreate");
        } elseif ($edit && is_numeric($id)) {
            return $response->redirect("admin/productedit?id=$id");
        }
    }

    /**
     * Create a new product, get-route
     *
     * @return object
     */
    public function productcreateAction() : object
    {
        $title = "Ny produkt";
        $page = $this->app->page;

        $page->add("admin/header");
        $page->add("admin/productcreate");

        return $page->render([
            "title" => $title
        ]);
    }

    /**
     * Post action to blogcreate post
     *
     * @return object
     */
    public function productcreateActionPost() : object
    {
        $response = $this->app->response;
        $request = $this->app->request;

        $productName = $request->getPost("productName") ?: $request->getGet("name");

        $this->adminClass->createProduct($productName);

        $productId = $this->adminClass->getIdProductByName($productName);
        $productId = json_encode($productId[0]);
        $productId = substr($productId, 6, -1);

        return $response->redirect("admin/productedit?id=$productId");
    }

    /**
     * Get action to edit product
     *
     * @return object
     */
    public function producteditAction() : object
    {
        $title = " Edit product ";
        $page = $this->app->page;
        $request = $this->app->request;

        $id = $request->getGet("id");

        $chosenProduct = $this->adminClass->getProductsById($id);

        $data = [
          "product" => $chosenProduct ?? null,
        ];

        $page->add("admin/header");
        $page->add("admin/productedit", $data);

        return $page->render([
          "title" => $title
        ]);
    }


    /**
     * Post action to edit product
     * CHECK FOR FAULTS WHEN NOT GIVING ALL PARAMS
     * COULD REWORK INTO ARRAY
     *
     * @return object
     */
    public function producteditActionPost() : object
    {
        $response = $this->app->response;
        $request = $this->app->request;

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

        $this->adminClass->editProductsById(
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
        );

        return $response->redirect("admin/product");
    }

    /**
     * Get for blogedit-view
     *
     * @return object
     */
    public function blogeditAction() : object
    {
        $title = "Edit";
        $page = $this->app->page;
        $request = $this->app->request;
        $id = $request->getGet("id", null);

        $blog = $this->adminClass->getBlogById($id);

        $data = [
            "title"         => $title,
            "blog"       => $blog
        ];

        $page->add("admin/header", $data);
        $page->add("admin/blogedit", $data);

        return $page->render($data);
    }

    /**
     * POST for blogedit-option
     *
     * @return object
     */
    public function blogeditActionPost() : object
    {
        $response = $this->app->response;
        $request = $this->app->request;

        $blogId = $request->getPost("blogId") ?: $request->getGet("id");

        $blogTitle = $request->getPost("blogTitle", null);
        $blogPath = $request->getPost("blogPath", null);
        $blogSlug = $request->getPost("blogSlug", null);
        $blogData = $request->getPost("blogData", null);
        $blogType = $request->getPost("blogType", null);
        $blogFilter = $request->getPost("blogFilter", null);
        $blogPublish = $request->getPost("blogPublish", null);
        $blogId = $request->getPost("blogId", null);

        $supportObject = $this->adminClass->createSupport();

        if (!$blogSlug) {
            $blogSlug = $supportObject->slugify($blogTitle);
        }

        if ($blogSlug) {
            $res = $this->adminClass->getSlugBlog($blogSlug);
            if (!$res) {
                $blogSlug = $blogSlug . $blogId;
            }
        }

        if ($blogPath) {
            $resPath = $this->AdminClass->getPathBlog($blogPath);
            if ($resPath) {
                $blogPath = $blogPath . $blogId;
            }
        } else {
            $blogPath = null;
        }

        $this->adminClass->editBlog(
            $blogTitle,
            $blogPath,
            $blogSlug,
            $blogData,
            $blogType,
            $blogFilter,
            $blogPublish,
            $blogId
        );

        return $response->redirect("admin/blog");
    }

    /**
     * Create a new post, get-route
     *
     * @return object
     */
    public function blogcreateAction() : object
    {
        $title = "Nytt inlägg";
        $page = $this->app->page;

        $page->add("admin/header");
        $page->add("admin/blogcreate");

        return $page->render([
            "title" => $title
        ]);
    }

    /**
     * Post action to blogcreate post
     *
     * @return object
     */
    public function blogcreateActionPost() : object
    {
        $response = $this->app->response;
        $request = $this->app->request;

        $blogTitle = $request->getPost("blogTitle") ?: $request->getGet("title");

        $this->adminClass->createBlog($blogTitle);

        $blogId = $this->adminClass->getIdBlogByTitle($blogTitle);
        $blogId = json_encode($blogId[0]);
        $blogId = substr($blogId, 6, -1);

        return $response->redirect("admin/blogedit?id=$blogId");
    }

    /**
     * Get for blogdelete
     *
     * @return object
     */
    public function blogdeleteAction() : object
    {
        $title = "delete blogpost";
        $page = $this->app->page;
        $request = $this->app->request;
        $id = $request->getGet("id", null);

        $blog = $this->adminClass->getBlogById($id);

        $data = [
            "title"         => $title,
            "blog"       => $blog
        ];

        $page->add("admin/header", $data);
        $page->add("admin/blogdelete", $data);

        return $page->render($data);
    }

    /**
     * Post action to delete blog
     *
     *
     * @return object
     */
    public function blogdeleteActionPost() : object
    {
        $response = $this->app->response;
        $request = $this->app->request;
        $id = $request->getPost("id") ?: $request->getGet("id");

        $this->adminClass->deleteBlog($id);

        return $response->redirect("admin/blog");
    }
}
