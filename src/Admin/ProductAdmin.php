<?php

namespace Lioo19\Admin;

use Anax\Commons\AppInjectableInterface;
use Anax\Commons\AppInjectableTrait;

/**
* Class for admin
*
* @SuppressWarnings(PHPMD.ExcessiveParameterList)
*/
class ProductAdmin
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
        $id
    ) {
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
    * Method for creating product
    *
    * @return void
    */
    public function createProduct($name)
    {
        $sql = "INSERT INTO product (name) VALUES (?);";
        $this->db->execute($sql, [$name]);
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
     * Post action to delete product
     * Doesnt need a landningpage, just reproduct?
     *DONE?
     *
     * @return object
     */
    public function productDelete($id)
    {
        $deleteSql = "DELETE FROM product WHERE id = ?;";
        $this->db->execute($deleteSql, [$id]);
    }

    /**
     * action to create product
     *
     * @return object
     */
    public function productCreate($name, $year, $image) : object
    {
        $addSql = "INSERT INTO product (name, year, image) VALUES (?, ?, ?);";
        $this->db->execute($addSql, [$name, $year, $image]);
    }
}
