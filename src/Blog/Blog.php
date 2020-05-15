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
    * Method for editing
    *
    * @return void
    */
    public function editBlog($title, $path, $slug, $data, $type, $filter, $publish, $id)
    {
        $sql = "UPDATE blog SET title=?, path=?, slug=?, data=?, type=?, filter=?, published=? WHERE id = ?;";
        $this->db->execute($sql, [$title, $path, $slug, $data, $type, $filter, $publish, $id]);
    }

    /**
    * Method for creating
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
    * Get for pages
    *
    * @return object
    */
    public function getPages()
    {
        $sql = <<<EOD
SELECT
    *,
    CASE
        WHEN (deleted <= NOW()) THEN "isDeleted"
        WHEN (published <= NOW()) THEN "isPublished"
        ELSE "notPublished"
    END AS status
FROM blog
WHERE type=?
;
EOD;
        $res = $this->db->executeFetchAll($sql, ["page"]);

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
        $support = new \Lioo19\Blog\Support();

        return $support;
    }
}
