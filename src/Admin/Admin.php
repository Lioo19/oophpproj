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
    * Returns all users
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
    * Returns all product-items
    *
    * @return object
    */
    public function getAllProducts()
    {
        $sql = "SELECT * FROM product;";
        $res = $this->db->executeFetchAll($sql);

        return $res;
    }

    /**
    * Return product by ID
    *
    * @return object
    */
    public function getProductsById($id)
    {
        $sql = "SELECT * FROM product WHERE id = ?;";
        $res = $this->db->executeFetch($sql, [$id]);

        return $res;
    }

    /**
    * Edit products
    *
    * @return object
    */
    public function editProductsById(
        $name,
        $price,
        $stock,
        $brand,
        $time,
        $players,
        $language,
        $type,
        $rating,
        $year,
        $image,
        $id)
    {
        $editSql = "UPDATE product SET
        name = ?,
        price = ?,
        stock = ?,
        brand = ?,
        time = ?,
        players = ?,
        language = ?,
        type = ?,
        rating = ?,
        year = ?,
        image = ?
        WHERE id = ?;";
        $this->db->execute($editSql, [
            $name,
            $price,
            $stock,
            $brand,
            $time,
            $players,
            $language,
            $type,
            $rating,
            $year,
            $image,
            $id
        ]);
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
    public function editBlog($title, $path, $slug, $data, $type, $filter, $publish, $id)
    {
        $sql = "UPDATE blog SET title=?, path=?, slug=?, data=?, type=?, filter=?, published=? WHERE id = ?;";
        $this->db->execute($sql, [$title, $path, $slug, $data, $type, $filter, $publish, $id]);
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
    * Method for creating blog
    *
    * @return void
    */
    public function createProduct($name)
    {
        $sql = "INSERT INTO product (name) VALUES (?);";
        $this->db->execute($sql, [$name]);
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

    /**
    * Get admin id by title
    *
    * @return object
    */
    public function getIdProductByName($name)
    {
        $sql = "SELECT id FROM product WHERE name = ?;";
        $res = $this->db->executeFetchAll($sql, [$name]);

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

    /**
     * Post action to delete product
     * Doesnt need a landningpage, just reproduct?
     *DONE?
     *
     * @return object
     */
    public function productDelete($id) : object
    {
        $deleteSql = "DELETE FROM product WHERE id = ?;";
        $this->db->execute($deleteSql, [$id]);
    }

    /**
     * action to create product
     *
     * @return object
     */
    public function productCreate($id) : object
    {
        $addSql = "INSERT INTO product (name, year, image) VALUES (?, ?, ?);";
        $this->db->execute($addSql, [$name, $year, $image]);
    }
}
