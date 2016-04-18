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
$sql="CREATE TABLE studentInfo (studentID VARCHAR(15) PRIMARY KEY, studentName CHAR(20))";
if($conn->query($sql) === true){
    echo "table created successfully";
}else{
    die("Error creating table" . $conn->error);
}

$sql="INSERT INTO studentInfo VALUES('studentExp01','student01')";
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

$sql= "CREATE TABLE parentInfo (parentID int PRIMARY KEY AUTO_INCREMENT, parentName VARCHAR(20), parentWxOpenID VARCHAR(30), parentPassword VARCHAR(16))";
if($conn->query($sql) === true){
    echo "table created successfully";
}else{
    die("Error creating table" . $conn->error);
}
$sql = "INSERT INTO parentInfo VALUES(1,'parenteg1','parentwxid01','pass01');";
if($conn->query($sql) === true){
    echo "table created successfully";
}else{
    die("Error creating table" . $conn->error);
}
//$sql = "CREATE TABLE parent"s


close_database_connection($conn); // 数据库使用完毕后记得关闭连接。

?>