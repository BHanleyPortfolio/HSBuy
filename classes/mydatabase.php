<?php
include '../config/private-config.php';

class myDatabase
{
    private $host = DB_HOST;
    private $user = DB_USER;
    private $password = DB_PASS;
    private $dbname = DB_NAME;

    function retrieveData($query){
        $mysqli = mysqli_connect($this->host,$this->user,$this->password,$this->dbname);
        return mysqli_query($mysqli,$query);
        mysqli_close();
    }

    function executeQuery($query){
        $mysqli = mysqli_connect($this->host,$this->user,$this->password,$this->dbname);
        mysqli_query($mysqli,$query);
        mysqli_close();
    }

}