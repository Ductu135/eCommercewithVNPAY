<?php
namespace Model;

use Model\AbstractModel;

class Category extends AbstractModel
{
    protected $tableName = "category";
    protected $abstractModel;

    public function __construct()
    {
        $this->abstractModel = new AbstractModel($this->tableName);
        $this->tableName;
    }

    public function fetchAllCategory()
    {
       return $this -> abstractModel -> fetchAll();
    }


}