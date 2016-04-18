<?php
/**
 * Created by PhpStorm.
 * User: Archimekai
 * Date: 4/18/2016
 * Time: 01:27
 */
// 非常缺乏系统的php SQL编程知识
define("DATABASE_SERVER_NAME","localhost");
define("DATABASE_USER_NAME","typemoon");
define("DATABASE_PASSWORD","typemoonsql");
define("DATABASE_ACCESS_PORT",3306);
define("DATABASE_NAME","typemoon01");

function create_and_open_database_connection(){
    $conn = new mysqli(DATABASE_SERVER_NAME,DATABASE_USER_NAME,DATABASE_PASSWORD);
    if($conn->connect_error){
        die("Connection failed: " . $conn->connect_error);
    }
    return $conn;
}

function close_database_connection($conn){
    $conn->close();
}



?>