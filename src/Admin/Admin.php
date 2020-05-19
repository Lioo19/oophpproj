<?php

namespace Lioo19\Admin;

use Anax\Commons\AppInjectableInterface;
use Anax\Commons\AppInjectableTrait;

/**
* Class for admin
*
* @SuppressWarnings(PHPMD.ExcessiveParameterList)
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
    * Returns all users
    * DOES NOT return password or ID
    *
    * @return object
    */
    public function getAllUsers()
    {
        $sql = "SELECT username, name, email, admin, created, deleted FROM login;";
        $res = $this->db->executeFetchAll($sql);

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
