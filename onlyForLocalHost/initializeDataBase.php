<?php
/**
 * Created by PhpStorm.
 * User: Archimekai
 * Date: 4/18/2016
 * Time: 01:24
 */
require_once 'connectFunctions.php';

echo 'Run this file to create database for this system.</br>';
echo 'If there is any previous data, they will be removed.</br>';

$conn = create_and_open_database_connection();

echo 'Now creating database typemoon01</br>';
$sqlIsExist=""; //查询该数据库是否存在的语句
$sql="CREATE DATABASE " + DATABASE_NAME;
if($conn->query($sql) === true){
    echo "database created successfully";
}else{
    die("Error creating database" . $conn->error);
}
echo 'Now creating necessary tables</br>';
// TODO 需要一张ER图
$sql="CREATE TABLE studentInfo (studentID CHAR(15) PRIMARY KEY, studentName CHAR(10))";
if($conn->query($sql) === true){
    echo "table created successfully";
}else{
    die("Error creating table" . $conn->error);
}

$sql="CREATE TABLE studentInfo (studentID CHAR(15) PRIMARY KEY, studentName CHAR(10))";
if($conn->query($sql) === true){
    echo "table created successfully";
}else{
    die("Error creating table" . $conn->error);
}

$sql="CREATE TABLE parentInfo (parentID int PRIMARY KEY AUTO_INCREMENT, parentName CHAR(10), parentWxID )";
if($conn->query($sql) === true){
    echo "table created successfully";
}else{
    die("Error creating table" . $conn->error);
}
close_database_connection($conn); // 数据库使用完毕后记得关闭连接。

?>