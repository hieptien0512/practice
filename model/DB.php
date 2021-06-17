<?php

/*
Create a database model by Singleton pattern
*/

class DB
{
    private $con;
    private static $instance;                            //this class has only one instance (Singleton pattern)

    //define database info
    public $servername;
    public $username;
    public $password;
    public $dbname;

    //1. default constructor
    private function __construct()
    {
        $this->servername = "localhost";
        $this->username = "root";
        $this->password = "admin";
        $this->dbname = "practice";

        //Initial a database connection
        $this->con = new mysqli($this->servername, $this->username, $this->password, $this->dbname);
        mysqli_set_charset($this->con, 'UTF8');
        if ($this->con->connect_error) {
            die("Connection failed: " . $this->con->connect_error);
        }
    }

    //2. Create a instance (by Singleton pattern)
    public static function getInstance()
    {
        if (!isset(self::$instance)) {
            self::$instance = new DB();
        }
        return self::$instance;
    }

    //3.1 The query "select" and "delete" and "update"
    public function query($query)
    {
        return $this->con->query($query);
    }

    //3.2 The query "Insert auto increase"
    public function query_insert_autoincrease($query)
    {
        $result = $this->con->query($query);
        $id_return = $this->con->insert_id;
        return $id_return;
    }


    public function closeCon()
    {
        $this->con->close();
    }

    public function openCon()
    {
        //Initial a database connection
        if ($this->con == null) {
            $this->con = new mysqli($this->servername, $this->username, $this->password, $this->dbname);
            if ($this->con->connect_error) {
                die("Connection failed: " . $this->con->connect_error);
            }
        }
    }

    public function getCon()
    {
        return $this->con;
    }
}