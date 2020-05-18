<?php

namespace Lioo19\Blog;

use Anax\Commons\AppInjectableInterface;
use Anax\Commons\AppInjectableTrait;

/**
* Class for blog
*
*/
class Blog
{

    /**
    * Constructor which takes database path as param
    *@param object database
    *
    * @return void
    */
    public function __construct($db)
    {
        $this->db = $db;
        $this->db->connect();
    }

    /**
    * Method that returns everything from blog table
    *
    * @return object
    */
    public function getAllFromBlog()
    {
        $sql = "SELECT * FROM blog;";
        $res = $this->db->executeFetchAll($sql);

        return $res;
    }

    /**
    * Method that returns specific entry with slug
    *
    * @return object
    */
    public function getSlugBlog($slug)
    {
        $sql = "SELECT * FROM blog WHERE slug = ?;";
        $res = $this->db->executeFetch($sql, [$slug]);

        return $res;
    }

    /**
    * Method that returns specific entry with id
    *
    * @return object
    */
    public function getIdBlog($id)
    {
        $sql = "SELECT * FROM blog WHERE id = ?;";
        $res = $this->db->executeFetch($sql, [$id]);

        return $res;
    }

    /**
    * Get blog id by title
    *
    * @return object
    */
    public function getIdBlogByTitle($title)
    {
        $sql = "SELECT id FROM blog WHERE title = ?;";
        $res = $this->db->executeFetchAll($sql, [$title]);

        return $res;
    }

    /**
    * method for creating support
    *
    * @param $data
    * @param $filters
    *
    * @return object
    */
    public function createSupport()
    {
        $support = new \Lioo19\Support\Support();

        return $support;
    }
}
