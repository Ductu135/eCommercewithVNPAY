<?php
namespace Database;

use Connection\Connection;

class Database 
{
    protected $connection;

    public function __construct()
    {
        $this -> connection = new Connection();
    }

    // Các hàm tương tác với cơ sở dữ liệu
    // Hàm fetchAll
    public function fetchAll($tablename, $condition = 1)
    {
        $sql = "SELECT * FROM `$tablename` WHERE $condition";
        $result = $this -> connection -> connect() -> query($sql);
        $arr = array();
        $i = 0;
        if($result -> num_rows > 0)
        {
            while($row = $result -> fetch_assoc())
            {
                $arr[$i] = $row;
                $i++;
            }
            return $arr;
        }
        else
        {
            return false;
        }
    }

    public function fetchWCondition($tablename1, $tablename2, $condition = 1)
    {
        $sql = "SELECT * FROM `$tablename1` INNER JOIN `$tablename2` ON $condition ";
        $result = $this -> connection -> connect() -> query($sql);
        $arr = array();
        $i = 0;
        if($result -> num_rows > 0)
        {
            while($row = $result -> fetch_assoc())
            {
                $arr[$i] = $row;
                $i++;
            }
            //echo $sql;
            return $arr;
        }
        else
        {
            return false;
        }
    }
}

