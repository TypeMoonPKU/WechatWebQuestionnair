<?php
/**
 * Created by PhpStorm.
 * User: wenkaiW10
 * Date: 4/18/2016
 * Time: 11:39
 */
include_once "../onlyForLocalHost/connectFunctions.php";

echo "Now getting data....";

$conn = create_and_open_database_connection();
$conn->select_db(DATABASE_NAME);
$sql = "SELECT * from parentInfo";
$result = $conn->query($sql);
if($result){
    echo $result;
}else{
    die("error: no data or connection error");
}
