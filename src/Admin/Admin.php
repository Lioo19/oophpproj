<?php

namespace Lioo19\Admin;

use Anax\Commons\AppInjectableInterface;
use Anax\Commons\AppInjectableTrait;

/**
* Class for admin
*
*/
class Admin
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
    * Method that returns everything from admin table
    *
    * @return object
    */
    public function getAllFromAdmin()
    {
        $sql = "SELECT * FROM admin;";
        $res = $this->db->executeFetchAll($sql);

        return $res;
    }

    /**
    * Method that returns specific entry with slug
    *
    * @return object
    */
    public function getSlugAdmin($slug)
    {
        $sql = "SELECT * FROM admin WHERE slug = ?;";
        $res = $this->db->executeFetch($sql, [$slug]);

        return $res;
    }

    /**
    * Method that returns specific entry with id
    *
    * @return object
    */
    public function getIdAdmin($id)
    {
        $sql = "SELECT * FROM admin WHERE id = ?;";
        $res = $this->db->executeFetch($sql, [$id]);

        return $res;
    }

    /**
    * Method that returns specific entry with path
    *
    * @return object
    */
    public function getPathAdmin($path)
    {
        $sql = "SELECT * FROM admin WHERE path = ?;";
        $res = $this->db->executeFetch($sql, [$path]);

        return $res;
    }

    /**
    * Get admin id by title
    *
    * @return object
    */
    public function getIdAdminByTitle($title)
    {
        $sql = "SELECT id FROM admin WHERE title = ?;";
        $res = $this->db->executeFetchAll($sql, [$title]);

        return $res;
    }

    /**
    * Method for editing
    *
    * @return void
    */
    public function editAdmin($title, $path, $slug, $data, $type, $filter, $publish, $id)
    {
        $sql = "UPDATE admin SET title=?, path=?, slug=?, data=?, type=?, filter=?, published=? WHERE id = ?;";
        $this->db->execute($sql, [$title, $path, $slug, $data, $type, $filter, $publish, $id]);
    }

    /**
    * Method for creating
    *
    * @return void
    */
    public function createAdmin($title)
    {
        $sql = "INSERT INTO admin (title) VALUES (?);";
        $this->db->execute($sql, [$title]);
    }

    /**
    * Method for deleting
    *
    * @return void
    */
    public function deleteAdmin($id)
    {
        $sql = "DELETE FROM admin WHERE id = ?;";
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
FROM admin
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
        $support = new \Lioo19\Admin\Support();

        return $support;
    }
}
