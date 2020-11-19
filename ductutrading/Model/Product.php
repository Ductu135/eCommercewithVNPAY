<?php


namespace Model;

use Model\AbstractModel;
class Product extends AbstractModel
{
    protected $tableName = "Product";
    protected $abstractModel;

    public function __construct()
    {
        $this->abstractModel = new AbstractModel($this->tableName);
        $this->abstractModel;
    }

    public function fetchProduct()
    {
        return $this->abstractModel->fetchAll();
    }

    public function fetchFilterByCategory($categoryID)
    {
        return $this->abstractModel->load($categoryID);
    }

}