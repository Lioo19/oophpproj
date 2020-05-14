<?php

namespace Lioo19\Login;

use Anax\Commons\AppInjectableInterface;
use Anax\Commons\AppInjectableTrait;

/**
* Class for login
*
*/
class Login
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
    * Method that returns everything but password from login table
    *
    * @return object
    */
    public function getAllFromLogin()
    {
        $sql = "SELECT * FROM login;";
        $res = $this->db->executeFetchAll($sql);

        return $res;
    }

    /**
    * Method that returns everything but password from login table
    *
    * @return object
    */
    public function getUserFromLogin($user)
    {
        $sql = "SELECT username, id FROM login WHERE username = ?;";
        $res = $this->db->executeFetch($sql, [$user]);

        return $res;
    }

    /**
    * Method that checks if user and password exists
    *
    * @return object
    */
    public function checkUserLogin($user, $password)
    {
        $sql = "SELECT password FROM login WHERE username = ?;";
        $res = $this->db->executeFetch($sql, [$user]);
        $admin = $this->adminLogin($user);


        if ($res->password === $password && $admin->admin === "N") {
            $success = "yes";
        } elseif ($res->password === $password) {
            $success = "admin";
        } else {
            $success = "no";
        }
        return $success;
    }

    /**
    * Method that checks if the logged in user is admin
    *
    * @return object
    */
    public function adminLogin($user)
    {
        $sql = "SELECT admin FROM login WHERE username = ?;";
        $res = $this->db->executeFetch($sql, [$user]);
        return $res;
    }

    /**
    * Method that returns specific entry with id
    *
    * @return object
    */
    public function getIdLogin($id)
    {
        $sql = "SELECT * FROM login WHERE id = ?;";
        $res = $this->db->executeFetch($sql, [$id]);

        return $res;
    }

    /**
    * Method that returns specific entry with path
    *
    * @return object
    */
    public function getPathLogin($path)
    {
        $sql = "SELECT * FROM login WHERE path = ?;";
        $res = $this->db->executeFetch($sql, [$path]);

        return $res;
    }

    /**
    * Get userID (NÖDVÄNDIG??)
    *
    * @return object
    */
    public function getIdByUser($user)
    {
        $sql = "SELECT id FROM login WHERE username = ?;";
        $res = $this->db->executeFetch($sql, [$user]);

        return $res;
    }

    /**
    * Method for editing user
    *
    * @return void
    */
    public function editUserLogin($id, $user, $password, $admin)
    {
        $sql = "UPDATE login SET username=?, password=?, admin=? WHERE id = ?;";
        $this->db->execute($sql, [$user, $password, $admin, $id]);
    }

    /**
    * Method for creating new user, always admin = "n"
    *
    * @return void
    */
    public function addUserLogin($user, $password)
    {
        $sql = "INSERT INTO login (username, password, admin) VALUES (?, ?, ?);";
        $this->db->execute($sql, [$user, $password, "N"]);
    }

    /**
    * Method for deleting
    *
    * @return void
    */
    public function deleteLogin($id)
    {
        $sql = "DELETE FROM login WHERE id = ?;";
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
FROM login
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
        $support = new \Lioo19\Login\Support();

        return $support;
    }
}
