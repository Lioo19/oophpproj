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
        $name = $request->getPost("name", null);
        $email = $request->getPost("email", null);

        $this->loginClass->addUserLogin($user, $password, $name, $email);

        $success = $this->loginClass->getUserFromLogin($user);
        $session->set("successNewUser", $success);

        return $response->redirect("login/register");
    }
}
