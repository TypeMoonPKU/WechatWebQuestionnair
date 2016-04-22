<?php
/**
 * 用于完成老师注册的逻辑
 *
 * 在注册界面上，老师点击注册后，将会跳转到这个界面
 * 信息以get的方式提供两个字段：老师名称 teacherName   老师的openID
 * 用这两个字段完成注册工作。
 * Created by PhpStorm.
 * User: wenkaiW10
 * Date: 4/19/2016
 * Time: 22:45
 */

require_once "../dataBaseApi/dataBaseApis.php";

/*foreach ($_REQUEST as $key => $value ){
    echo "key: " . $key;
    echo "   value: " . $value;
}*/

$teacherName = $_REQUEST["teacherName"];
$teacherOpenID = $_REQUEST["teacherOpenID"];

if ($teacherName==""){
    echo "TeacherName can't be empty!<br>";
}
elseif ($teacherOpenID==""){
    echo "TeacherOpenID can't be empty!<br>";
}
else {
    if (checkTeacher($teacherOpenID)==true)
        echo "注册失败，用户已注册<br>";
    else {
        $rtnVal = insertTeacher($teacherName, $teacherOpenID, "null", "null");
        if ($rtnVal == true) {
            echo "注册成功<br>";
        } else {
            echo "注册失败<br>";
        }
    }
}

