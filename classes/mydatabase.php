<?php


class myDatabase
{
    private $host = 'localhost';
    private $user = 'hsdbadmin';
    private $password = 'mT1m9ZFO';
    private $dbname = 'hsdb';

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