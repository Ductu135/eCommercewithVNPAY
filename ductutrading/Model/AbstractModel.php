<?php
namespace Model;

use Database\Database;

class AbstractModel
{
    protected $abstractDB;
    protected $tableName;

    public function __construct($tableName)
    {
        $this->abstractDB = new Database();
        $this->tableName = $tableName;
    }

    /**
     * @return mixed
     */
    public function getTableName()
    {
        return $this->tableName;
    }

    /**
     * @param mixed $tableName
     */
    public function setTableName($tableName)
    {
        $this->tableName = $tableName;
    }

    public function fetchAll()
    {
        return $this->abstractDB->fetchAll($this->tableName, 1);
    }

    public function load($value)
    {
        $condition = "ProductID = $value";
        return $this->abstractDB->fetchWCondition($this->tableName, $condition);
    }


}