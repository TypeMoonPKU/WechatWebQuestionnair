<?php
/**
 * 测试链接
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
var_dump($_REQUEST);
//var_dump($_POST);
$teacherName = $_REQUEST["teacherName"];
//var_dump($_COOKIE);
//$teacherOpenID = $_COOKIE["OpenID"];

//echo $teacherOpenID;
$teacherOpenID = $_REQUEST["teacherOpenID"];

if ($teacherName==""){
    echo "teacherName can't be empty!<br>";
}
elseif ($teacherOpenID==""){
    echo "teacherOpenID can't be empty!<br>";
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
//echo "<br>";
//$userRegUrl = "121.201.14.58/pages/redirectParentFromOAuth.php?teacherOpenID=" . $teacherOpenID;
//$userRegUrlOAuth = "https://open.weixin.qq.com/connect/oauth2/authorize?appid=wx75de8782f8e4f99c&redirect_uri=" . urlencode($userRegUrl) . "&response_type=code&scope=snsapi_base#wechat_redirect";
//echo "<br> 家长注册链接： <a href='$userRegUrlOAuth' >" . $userRegUrlOAuth . "</a>";


echo "<br>";
$userRegNewUrl="121.201.14.58/pages/first_time_for_students.php?teacherOpenID=" . $teacherOpenID;
$userRegNewUrlOAuth = "https://open.weixin.qq.com/connect/oauth2/authorize?appid=wx75de8782f8e4f99c&redirect_uri=" . urlencode($userRegNewUrl) . "&response_type=code&scope=snsapi_base#wechat_redirect";
echo "<br> 家长注册链接2： <a href='$userRegNewUrlOAuth' >" . $userRegNewUrlOAuth . "</a>";
