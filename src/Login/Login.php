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
    public function editUserLogin($id, $user, $name, $email, $password, $admin)
    {
        $sql = "UPDATE login SET username=?, password=?, name=?, email=?, admin=? WHERE id = ?;";
        $this->db->execute($sql, [$user, $password, $name, $email, $admin, $id]);
    }

    /**
    * Method for creating new user, always admin = "n"
    *
    * @return void
    */
    public function addUserLogin($user, $password, $name, $email)
    {
        $sql = "INSERT INTO login (
            username,
            password,
            name,
            email,
            admin
        )
        VALUES (?, ?, ?, ?, ?);";
        $this->db->execute($sql, [$user, $password, $name, $email, "N"]);
    }
}
