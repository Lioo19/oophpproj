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
        $this->app->db->connect();
        $this->adminClass = new Admin($this->app->db);
    }

    /**
     * This is the index method action
     *
     *
     * @return object
     */
    public function indexAction()
    {
        $title = "blog";
        $page = $this->app->page;

        $res = $this->adminClass->getAllFromAdmin();

        foreach ($res as $key => $value) {
            $supportObject = $this->adminClass->createSupport();
            $value->data = $supportObject->textFilter($value->data, $value->filter);
        }

        $data = [
            "title" => $title,
            "res"   => $res
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
        $title = "Blogg";
        $page = $this->app->page;

        $res = $this->adminClass->getAllFromAdmin();

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
     * Post-route for blog-page
     *
     * @return object
     */
    public function adminActionPost() : object
    {
        $request = $this->app->request;
        $response = $this->app->response;

        $slug = $request->getGet("slug", null);

        if ($slug) {
            return $response->redirect("admin/blogpost?slug=$slug");
        } else {
            return $response->redirect("admin");
        }
    }

    /**
     * Showing the blogpost-view
     *
     * @return object
     */
    public function blogpostAction() : object
    {
        $request = $this->app->request;
        $page = $this->app->page;
        $title = $request->getGet("slug", null);

        if ($title) {
            $admin = $this->adminClass->getSlugAdmin($title);
        } else {
            $admin = $this->adminClass->getIdAdmin(1);
        }

        $supportObject = $this->adminClass->createSupport();
        $admin->data = $supportObject->textFilter($admin->data, $admin->filter);

        $data = [
            "admin"   => $admin
        ];

        $page->add("admin/header");
        $page->add("admin/blogpost", $data);

        return $page->render([
            "title" => $title,
        ]);
    }

    /**
     * Get for admin-view
     *
     * @return object
     */
    public function adminAction() : object
    {
        $title = "ADMIN";
        $page = $this->app->page;
        $request = $this->app->request;

        $res = $this->adminClass->getAllFromAdmin();

        $data = [
            "title"         => $title,
            "res"           => $res
        ];

        $page->add("admin/header", $data);
        $page->add("admin/admin", $data);

        return $page->render($data);
    }

    /**
     * Get for edit-view
     *
     * @return object
     */
    public function editAction() : object
    {
        $title = "Edit";
        $page = $this->app->page;
        $request = $this->app->request;
        $id = $request->getGet("id", null);

        $admin = $this->adminClass->getIdAdmin($id);

        $data = [
            "title"         => $title,
            "admin"       => $admin
        ];

        $page->add("admin/header", $data);
        $page->add("admin/edit", $data);

        return $page->render($data);
    }

    /**
     * POST for edit-option, edits in database
     *
     * @return object
     */
    public function editActionPost() : object
    {
        $response = $this->app->response;
        $request = $this->app->request;

        $adminId = $request->getPost("adminId") ?: $request->getGet("id");

        $adminTitle = $request->getPost("adminTitle", null);
        $adminPath = $request->getPost("adminPath", null);
        $adminSlug = $request->getPost("adminSlug", null);
        $adminData = $request->getPost("adminData", null);
        $adminType = $request->getPost("adminType", null);
        $adminFilter = $request->getPost("adminFilter", null);
        $adminPublish = $request->getPost("adminPublish", null);
        $adminId = $request->getPost("adminId", null);

        $supportObject = $this->adminClass->createSupport();

        if (!$adminSlug) {
            $adminSlug = $supportObject->slugify($adminTitle);
        }

        if ($adminSlug) {
            $res = $this->adminClass->getSlugAdmin($adminSlug);
            if (!$res) {
                $adminSlug = $adminSlug . $adminId;
            }
        }

        if ($adminPath) {
            $resPath = $this->adminClass->getPathAdmin($adminPath);
            if ($resPath) {
                $adminPath = $adminPath . $adminId;
            }
        } else {
            $adminPath = null;
        }

        $this->adminClass->editAdmin(
            $adminTitle,
            $adminPath,
            $adminSlug,
            $adminData,
            $adminType,
            $adminFilter,
            $adminPublish,
            $adminId
        );

        return $response->redirect("admin/admin");
    }

    /**
     * Create a new post, get-route
     *
     * @return object
     */
    public function createAction() : object
    {
        $title = "Nytt inlägg";
        $page = $this->app->page;

        $page->add("admin/header");
        $page->add("admin/create");

        return $page->render([
            "title" => $title
        ]);
    }

    /**
     * Post action to create post
     *
     * @return object
     */
    public function createActionPost() : object
    {
        $response = $this->app->response;
        $request = $this->app->request;

        $adminTitle = $request->getPost("adminTitle") ?: $request->getGet("title");

        $this->adminClass->createAdmin($adminTitle);

        $adminId = $this->adminClass->getIdAdminByTitle($adminTitle);
        $adminId = json_encode($adminId[0]);
        $adminId = substr($adminId, 6, -1);

        return $response->redirect("admin/edit?id=$adminId");
    }

    /**
     * Get for delete
     *
     * @return object
     */
    public function deleteAction() : object
    {
        $title = "delete";
        $page = $this->app->page;
        $request = $this->app->request;
        $id = $request->getGet("id", null);

        $admin = $this->adminClass->getIdAdmin($id);

        $data = [
            "title"         => $title,
            "admin"       => $admin
        ];

        $page->add("admin/header", $data);
        $page->add("admin/delete", $data);

        return $page->render($data);
    }

    /**
     * Post action to delete movie
     *
     *
     * @return object
     */
    public function deleteActionPost() : object
    {
        $response = $this->app->response;
        $request = $this->app->request;
        $id = $request->getPost("id") ?: $request->getGet("id");

        $this->adminClass->deleteAdmin($id);

        return $response->redirect("admin/admin");
    }


    /**
     * Get for pages-view
     *
     * @return object
     */
    public function pagesAction() : object
    {
        $title = "Visa sidor";
        $page = $this->app->page;
        $request = $this->app->request;

        $res = $this->adminClass->getPages();

        $data = [
            "title"         => $title,
            "res"           => $res
        ];

        $page->add("admin/header", $data);
        $page->add("admin/pages", $data);

        return $page->render($data);
    }

    /**
     * Showing the page-view
     *
     * @return object
     */
    public function pageAction() : object
    {
        $request = $this->app->request;
        $page = $this->app->page;
        $title = $request->getGet("slug", null);

        if ($title) {
            $admin = $this->adminClass->getSlugAdmin($title);
        } else {
            $admin = $this->adminClass->getIdAdmin(1);
        }

        $supportObject = $this->adminClass->createSupport();
        $admin->data = $supportObject->textFilter($admin->data, $admin->filter);

        $data = [
            "admin"   => $admin
        ];

        $page->add("admin/header");
        $page->add("admin/blogpost", $data);

        return $page->render([
            "title" => $title,
        ]);
    }
}
