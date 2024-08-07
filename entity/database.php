<?php
// database.php
class database{

    private $jdbcurl = "localhost";
    private $jdbcname = "root";
    private $jdbcpass = "12345678";
    private $dbname = "csci314";

    public function getURL(){
        return $this->jdbcurl;
    }

    public function getName(){
        return $this->jdbcname;
    }

    public function getPass(){
        return $this->jdbcpass;
    }

    public function getDbname(){
        return $this->dbname;
    }
    
}
?>