<?php

namespace Lioo19\Blog;

use Anax\Commons\AppInjectableInterface;
use Anax\Commons\AppInjectableTrait;

// use Anax\Route\Exception\ForbiddenException;
// use Anax\Route\Exception\NotFoundException;
// use Anax\Route\Exception\InternalErrorException;

/**
 * A  controller for the blog page
 *
 *
 * @SuppressWarnings(PHPMD.TooManyPublicMethods)
 * @SuppressWarnings(PHPMD.UnusedLocalVariable)
 * @SuppressWarnings(PHPMD.CyclomaticComplexity)
 *
 */
class BlogController implements AppInjectableInterface
{
    use AppInjectableTrait;
    private $blogClass;

    /**
     * Setup to database and create new blogClass
     *
     * @return object
     */
    public function initialize()
    {
        $this->app->db->connect();
        $this->blogClass = new Blog($this->app->db);
    }

    /**
     * This is the index method action
     *
     *
     * @return object
     */
    public function indexAction()
    {
        $title = "Blog";
        $page = $this->app->page;

        $res = $this->blogClass->getAllFromBlog();

        foreach ($res as $key => $value) {
            $supportObject = $this->blogClass->createSupport();
            $value->data = $supportObject->textFilter($value->data, $value->filter);
        }

        $data = [
            "title" => $title,
            "res"   => $res
        ];

        $page->add("blog/index", $data);

        return $page->render([
            "title" => $title,
        ]);
    }

    /**
     * Post-route for blog-page
     *
     * @return object
     */
    public function blogActionPost() : object
    {
        $request = $this->app->request;
        $response = $this->app->response;

        $slug = $request->getGet("slug", null);

        if ($slug) {
            return $response->redirect("blog/blogpost?slug=$slug");
        } else {
            return $response->redirect("blog");
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
            $blog = $this->blogClass->getSlugBlog($title);
        } else {
            $blog = $this->blogClass->getIdBlog(1);
        }

        $supportObject = $this->blogClass->createSupport();
        $blog->data = $supportObject->textFilter($blog->data, $blog->filter);

        $data = [
            "blog"   => $blog
        ];

        $page->add("blog/blogpost", $data);

        return $page->render([
            "title" => $title,
        ]);
    }
}
