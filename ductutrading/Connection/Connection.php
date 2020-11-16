<?php
namespace  Connection;

class Connection
{
    public $serverName;
    public $userName;
    public $passWord;
    public $dbName;

    public function __construct()
    {
        $this -> serverName = "localhost";
        $this -> userName = "root";
        $this -> passWord = "mysql";
        $this -> dbName = "ductutrading";
    }

    public function connect()
    {
        $connection = new \mysqli($this->serverName, $this->userName, $this->passWord, $this->dbName);
        if ($connection->connect_error) {
            echo 'Connections failed';
        } else {
//            echo 'Connection successfully';
            return $connection;
        }
    }
}