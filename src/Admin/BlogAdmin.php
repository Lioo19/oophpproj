<?php

namespace Lioo19\Admin;

use Anax\Commons\AppInjectableInterface;
use Anax\Commons\AppInjectableTrait;

/**
* Class for admin
*
* @SuppressWarnings(PHPMD.ExcessiveParameterList)
*/
class BlogAdmin
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
    * Returns all blog-items
    *
    * @return object
    */
    public function getAllBlog()
    {
        $sql = "SELECT * FROM blog;";
        $res = $this->db->executeFetchAll($sql);

        return $res;
    }

    /**
    * Method that returns specific entry with id from blog
    *
    * @return object
    */
    public function getBlogById($id)
    {
        $sql = "SELECT * FROM blog WHERE id = ?;";
        $res = $this->db->executeFetch($sql, [$id]);

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
    * Method that returns specific entry with path
    *
    * @return object
    */
    public function getPathBlog($path)
    {
        $sql = "SELECT * FROM blog WHERE path = ?;";
        $res = $this->db->executeFetch($sql, [$path]);

        return $res;
    }

    /**
    * Method for editing
    *
    * @return void
    */
    public function editBlog($title, $path, $slug, $data, $filter, $publish, $id)
    {
        $sql = "UPDATE blog SET title=?, path=?, slug=?, data=?, filter=?, published=? WHERE id = ?;";
        $this->db->execute($sql, [$title, $path, $slug, $data, $filter, $publish, $id]);
    }

    /**
    * Method for creating blog
    *
    * @return void
    */
    public function createBlog($title)
    {
        $sql = "INSERT INTO blog (title) VALUES (?);";
        $this->db->execute($sql, [$title]);
    }

    /**
    * Method for deleting
    *
    * @return void
    */
    public function deleteBlog($id)
    {
        $sql = "DELETE FROM blog WHERE id = ?;";
        $this->db->execute($sql, [$id]);
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
}
