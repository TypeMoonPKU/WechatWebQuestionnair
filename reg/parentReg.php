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
$parentOpenID = $_REQUEST["parentOpenID"];
$studentID = $_REQUEST["studentID"];
if ($parentName==""){
    echo "ParentName can't be empty!<br>";
}
elseif ($parentOpenID==""){
    echo "ParentOpenID can't be empty!<br>";
}
else {
    if (checkParent($parentOpenID)==true)
        //echo "注册失败，用户已注册<br>";
        echo "用户已注册<br>";
    else {
        $rtnVal = insertParent($parentName, $parentOpenID, $studentID, "null", "null");
        //$rtnVal = insertParent('p','p1openID','123456','pppppp','000001');
        if ($rtnVal == true) {
            echo "注册成功<br>";
        } else {
            echo "注册失败<br>";
        }
    }
}