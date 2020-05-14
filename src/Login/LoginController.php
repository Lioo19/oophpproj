<?php

namespace Lioo19\Login;

use Anax\Commons\AppInjectableInterface;
use Anax\Commons\AppInjectableTrait;

// use Anax\Route\Exception\ForbiddenException;
// use Anax\Route\Exception\NotFoundException;
// use Anax\Route\Exception\InternalErrorException;

/**
 * A  controller for the login page
 *
 *
 * @SuppressWarnings(PHPMD.TooManyPublicMethods)
 * @SuppressWarnings(PHPMD.UnusedLocalVariable)
 * @SuppressWarnings(PHPMD.CyclomaticComplexity)
 *
 */
class LoginController implements AppInjectableInterface
{
    use AppInjectableTrait;
    private $loginClass;

    /**
     * Setup to database and create new loginClass
     *
     * @return object
     */
    public function initialize()
    {
        $this->app->db->connect();
        $this->loginClass = new Login($this->app->db);
    }

    /**
     * This is the index method action
     *
     *
     * @return object
     */
    public function indexAction()
    {
        $title = "login";
        $page = $this->app->page;
        $session = $this->app->session;

        $login = $session->get("login", null);

        $data = [
            "title" => $title,
            "login" => $login
        ];

        // $page->add("login/header", $data);
        $page->add("login/index", $data);

        return $page->render([
            "title" => $title,
        ]);
    }

    /**
     * Post-route for login
     *
     * @return object
     */
    public function indexActionPost() : object
    {
        $request = $this->app->request;
        $response = $this->app->response;
        $session = $this->app->session;

        $session->delete("login");

        $user = $request->getPost("user", null);
        $password = $request->getPost("password", null);

        $res = $this->loginClass->checkUserLogin($user, $password);

        //login can either be yes, no or admin
        $session->set("login", $res);

        return $response->redirect("login");
    }

    /**
     * Showing the blog-view
     *
     * @return object
     */
    public function registerAction() : object
    {
        $title = "Ny användare";
        $page = $this->app->page;
        $session = $this->app->session;

        $success = $session->get("successNewUser", null);

        $data= [
            "title" => $title,
            "success" => $success
        ];

        $page->add("login/register", $data);

        return $page->render([
            "title" => $title,
        ]);
    }

    /**
     * Post-route for blog-page
     *
     * @return object
     */
    public function registerActionPost() : object
    {
        $request = $this->app->request;
        $response = $this->app->response;
        $session = $this->app->session;

        $session->delete("successNewUser");

        $user = $request->getPost("user", null);
        $password = $request->getPost("password", null);

        $this->loginClass->addUserLogin($user, $password);

        $success = $this->loginClass->getUserFromLogin($user);
        $session->set("successNewUser", $success);

        return $response->redirect("login/register");
    }

    // /**
    //  * Showing the blogpost-view
    //  *
    //  * @return object
    //  */
    // public function blogpostAction() : object
    // {
    //     $request = $this->app->request;
    //     $page = $this->app->page;
    //     $title = $request->getGet("slug", null);
    //
    //     if ($title) {
    //         $login = $this->loginClass->getSlugLogin($title);
    //     } else {
    //         $login = $this->loginClass->getIdLogin(1);
    //     }
    //
    //     $supportObject = $this->loginClass->createSupport();
    //     $login->data = $supportObject->textFilter($login->data, $login->filter);
    //
    //     $data = [
    //         "login"   => $login
    //     ];
    //
    //     $page->add("login/header");
    //     $page->add("login/blogpost", $data);
    //
    //     return $page->render([
    //         "title" => $title,
    //     ]);
    // }
    //
    // /**
    //  * Get for admin-view
    //  *
    //  * @return object
    //  */
    // public function adminAction() : object
    // {
    //     $title = "ADMIN";
    //     $page = $this->app->page;
    //     $request = $this->app->request;
    //
    //     $res = $this->loginClass->getAllFromLogin();
    //
    //     $data = [
    //         "title"         => $title,
    //         "res"           => $res
    //     ];
    //
    //     $page->add("login/header", $data);
    //     $page->add("login/admin", $data);
    //
    //     return $page->render($data);
    // }
    //
    // /**
    //  * Get for edit-view
    //  *
    //  * @return object
    //  */
    // public function editAction() : object
    // {
    //     $title = "Edit";
    //     $page = $this->app->page;
    //     $request = $this->app->request;
    //     $id = $request->getGet("id", null);
    //
    //     $login = $this->loginClass->getIdLogin($id);
    //
    //     $data = [
    //         "title"         => $title,
    //         "login"       => $login
    //     ];
    //
    //     $page->add("login/header", $data);
    //     $page->add("login/edit", $data);
    //
    //     return $page->render($data);
    // }
    //
    // /**
    //  * POST for edit-option, edits in database
    //  *
    //  * @return object
    //  */
    // public function editActionPost() : object
    // {
    //     $response = $this->app->response;
    //     $request = $this->app->request;
    //
    //     $loginId = $request->getPost("loginId") ?: $request->getGet("id");
    //
    //     $loginTitle = $request->getPost("loginTitle", null);
    //     $loginPath = $request->getPost("loginPath", null);
    //     $loginSlug = $request->getPost("loginSlug", null);
    //     $loginData = $request->getPost("loginData", null);
    //     $loginType = $request->getPost("loginType", null);
    //     $loginFilter = $request->getPost("loginFilter", null);
    //     $loginPublish = $request->getPost("loginPublish", null);
    //     $loginId = $request->getPost("loginId", null);
    //
    //     $supportObject = $this->loginClass->createSupport();
    //
    //     if (!$loginSlug) {
    //         $loginSlug = $supportObject->slugify($loginTitle);
    //     }
    //
    //     if ($loginSlug) {
    //         $res = $this->loginClass->getSlugLogin($loginSlug);
    //         if (!$res) {
    //             $loginSlug = $loginSlug . $loginId;
    //         }
    //     }
    //
    //     if ($loginPath) {
    //         $resPath = $this->loginClass->getPathLogin($loginPath);
    //         if ($resPath) {
    //             $loginPath = $loginPath . $loginId;
    //         }
    //     } else {
    //         $loginPath = null;
    //     }
    //
    //     $this->loginClass->editLogin(
    //         $loginTitle,
    //         $loginPath,
    //         $loginSlug,
    //         $loginData,
    //         $loginType,
    //         $loginFilter,
    //         $loginPublish,
    //         $loginId
    //     );
    //
    //     return $response->redirect("login/admin");
    // }
    //
    // /**
    //  * Create a new post, get-route
    //  *
    //  * @return object
    //  */
    // public function createAction() : object
    // {
    //     $title = "Nytt inlägg";
    //     $page = $this->app->page;
    //
    //     $page->add("login/header");
    //     $page->add("login/create");
    //
    //     return $page->render([
    //         "title" => $title
    //     ]);
    // }
    //
    // /**
    //  * Post action to create post
    //  *
    //  * @return object
    //  */
    // public function createActionPost() : object
    // {
    //     $response = $this->app->response;
    //     $request = $this->app->request;
    //
    //     $loginTitle = $request->getPost("loginTitle") ?: $request->getGet("title");
    //
    //     $this->loginClass->createLogin($loginTitle);
    //
    //     $loginId = $this->loginClass->getIdLoginByTitle($loginTitle);
    //     $loginId = json_encode($loginId[0]);
    //     $loginId = substr($loginId, 6, -1);
    //
    //     return $response->redirect("login/edit?id=$loginId");
    // }
    //
    // /**
    //  * Get for delete
    //  *
    //  * @return object
    //  */
    // public function deleteAction() : object
    // {
    //     $title = "delete";
    //     $page = $this->app->page;
    //     $request = $this->app->request;
    //     $id = $request->getGet("id", null);
    //
    //     $login = $this->loginClass->getIdLogin($id);
    //
    //     $data = [
    //         "title"         => $title,
    //         "login"       => $login
    //     ];
    //
    //     $page->add("login/header", $data);
    //     $page->add("login/delete", $data);
    //
    //     return $page->render($data);
    // }
    //
    // /**
    //  * Post action to delete movie
    //  *
    //  *
    //  * @return object
    //  */
    // public function deleteActionPost() : object
    // {
    //     $response = $this->app->response;
    //     $request = $this->app->request;
    //     $id = $request->getPost("id") ?: $request->getGet("id");
    //
    //     $this->loginClass->deleteLogin($id);
    //
    //     return $response->redirect("login/admin");
    // }
    //
    //
    // /**
    //  * Get for pages-view
    //  *
    //  * @return object
    //  */
    // public function pagesAction() : object
    // {
    //     $title = "Visa sidor";
    //     $page = $this->app->page;
    //     $request = $this->app->request;
//
    //     $res = $this->loginClass->getPages();
    //
    //     $data = [
    //         "title"         => $title,
    //         "res"           => $res
    //     ];
    //
    //     $page->add("login/header", $data);
    //     $page->add("login/pages", $data);
    //
    //     return $page->render($data);
    // }
    //
    // /**
    //  * Showing the page-view
    //  *
    //  * @return object
    //  */
    // public function pageAction() : object
    // {
    //     $request = $this->app->request;
    //     $page = $this->app->page;
    //     $title = $request->getGet("slug", null);
    //
    //     if ($title) {
    //         $login = $this->loginClass->getSlugLogin($title);
    //     } else {
    //         $login = $this->loginClass->getIdLogin(1);
    //     }
    //
    //     $supportObject = $this->loginClass->createSupport();
    //     $login->data = $supportObject->textFilter($login->data, $login->filter);
    //
    //     $data = [
    //         "login"   => $login
    //     ];
    //
    //     $page->add("login/header");
    //     $page->add("login/blogpost", $data);
    //
    //     return $page->render([
    //         "title" => $title,
    //     ]);
    // }
}
