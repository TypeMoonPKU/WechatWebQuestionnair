<?php
/**
 * 用于完成家长的注册工作
 * 需要提供：parentName, parentOpenID, studentID
 * 采用post方法
 * Created by PhpStorm.
 * User: wenkaiW10
 * Date: 4/19/2016
 * Time: 22:51
 */

require_once "../dataBaseApi/dataBaseApis.php";

/*foreach ($_REQUEST as $key => $value ){
    echo "key: " . $key;
    echo "   value: " . $value;
}*/

$parentName = $_REQUEST["parentName"];
$studentName = $_REQUEST["studentName"];
$parentOpenID = $_REQUEST["parentOpenID"];
$studentID = $_REQUEST["studentID"];
$teacherOpenID = $_REQUEST["teacherOpenID"];

$teacherID = getTeacherID($teacherOpenID);
if($teacherID==false) {
    echo "No such teacher!";
}
else {
    if ($parentName == "") {
        echo "ParentName can't be empty!<br>";
    } elseif ($parentOpenID == "") {
        echo "ParentOpenID can't be empty!<br>";
    } elseif ($studentName == "") {
        echo "StudentName can't be empty!<br>";
    } elseif ($studentID == "") {
        echo "StudentID can't be empty!<br>";
    } else {
        if (checkStudent($studentID) == false) {
            $rtnVal = insertStudent($studentName, $studentID, "null", $teacherID); //group暂时设置为null
            if ($rtnVal == true) {
                echo "学生信息添加成功<br>";
            } else {
                echo "学生信息添加失败<br>";
            }
        }
        if (checkParent($parentOpenID) == true)
            echo "注册失败，用户已注册<br>";
        else {
            $rtnVal = insertParent($parentName, $parentOpenID, $studentID, "null", "null");
            //$rtnVal = insertParent('p','p1openID','123456','pppppp','000001');
            if ($rtnVal == true) {
                echo "注册成功<br>";
            } else {
                echo "注册失败2<br>";
            }
        }
    }
}