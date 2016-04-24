<?php
//此行代码用于避免iPhone上出现的乱码问题
header("Content-type: text/html; charset=utf-8");
?>

<!--
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


$userRegNewUrl="121.201.14.58/pages/first_time_for_students.php?teacherOpenID=" . $teacherOpenID;
$userRegNewUrlOAuth = "https://open.weixin.qq.com/connect/oauth2/authorize?appid=wx75de8782f8e4f99c&redirect_uri=" . urlencode($userRegNewUrl) . "&response_type=code&scope=snsapi_base#wechat_redirect";
//echo "<br> 家长注册链接2： <a href='$userRegNewUrlOAuth' >" . $userRegNewUrlOAuth . "</a>";

//echo "请点击复制链接键将目标问卷分享到目标微信群，点击\"进入\"开始您的管理界面"."<br>";
//echo "<br>". $userRegNewUrlOAuth;
//echo "<button class=\"btn btn-large btn-block\" type=\"button\">复制链接</button>"."<br>";
?>
-->
<!DOCTYPE html >
<html >
<head>
    <title>教师注册</title>
    <meta http-equiv="Content-Type" name="viewport" content="width=device-width, initial-scale=1.0,charset=utf-8">
    <link href="../pages/reference/bootstrap.min.css" rel="stylesheet">
    <script src="../pages/reference/jquery.min.js"></script>
    <script src="../pages/reference/bootstrap.min.js"></script>
    <script src="../pages/reference/bootstrap-theme.min.css"></script>
</head>
<body >


<form class="form-horizontal" role="form" method="get" action="../reg/parentRegWithStudent.php">
    <div class="form-group">
        <div class="col-sm-12" align="center">
            <br><pre><h1>注册成功</h1></pre>
            <br><br><h3>劳烦手动复制链接<br>将其分享到班级微信群<br>以邀请家长加入</h3>

        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-12">
            <?php echo "<pre>";print_r($userRegNewUrlOAuth)  ; ?>
        </div>
    </div>


    <div class="form-group" align="center">
        <!--<br>点击"进入"开始您的管理界面<br> -->
            <button class="btn btn-large btn-block" type="button" onclick="window.location.href='../pages/homepage.php?teacherOpenID=<?PHP echo $teacherOpenID ?>'">进入管理界面</button>

    </div>
</form>
</body>
