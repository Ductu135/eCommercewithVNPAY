<?php


namespace Model;

use Database\Database;
class CartItem
{
    protected $tablename1 = "Product";
    protected $tablename2 = "Category";
    protected $abstracDB;
    public function __construct()
    {
        $this->abstracDB = new Database();
        $this->tablename1;
        $this->tablename2;
        $this->abstracDB;
    }

    public function getTableName1()
    {
        return $this->tablename1;
    }

    /**
     * @return string
     */
    public function getTablename2(): string
    {
        return $this->tablename2;
    }

    public function load_items($ProductID)
    {
        $condition = "ProductID = $ProductID AND product.CategoryID = category.CategoryID";
        return $this->abstracDB->fetchWCondition($this->tablename1, $this->tablename2, $condition);
    }

}