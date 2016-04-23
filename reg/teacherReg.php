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
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>创建通知群</title>
    <meta http-equiv="Content-Type" name="viewport" content="width=device-width, initial-scale=1.0; charset=utf-8">
    <link href="../pages/reference/bootstrap.min.css" rel="stylesheet">
    <script src="../pages/reference/jquery.min.js"></script>
    <script src="../pages/reference/bootstrap.min.js"></script>
    <script src="../pages/reference/bootstrap-theme.min.css"></script>
    <script type="text/javascript" src="../pages/reference/ZeroClipboard.js"></script>
    <script type="text/javaScript">
        var clip = null;
        function $(id) { return document.getElementById(id); }
        function init() {
            clip = new ZeroClipboard.Client();
            clip.setHandCursor(true);
            clip.addEventListener('mouseOver', function (client) {
                // update the text on mouse over
                clip.setText( $('fe_text').value );
            });

            clip.addEventListener('complete', function (client, text) {
                //debugstr("Copied text to clipboard: " + text );
                alert("该地址已经复制，你可以使用Ctrl+V 粘贴。");
            });

            clip.glue('clip_button', 'clip_container' );
        }
    </script>
</head>
<body onLoad="init()">
<input id="fe_text" cols="50" rows="5" value="复制内容文本">
<span id="clip_container"><span id="clip_button"><strong>复制</strong></span></span>

<!--
<ul class="list-group">
    <li class="list-group-item" align="center"><strong>注册成功!</strong></li>
    <li class="list-group-item">
        <?php
        echo "请点击复制链接键将目标问卷分享到目标微信群，点击\"进入\"开始您的管理界面"."<br>";
        echo "<br>". $userRegNewUrlOAuth;
        echo "<button class=\"btn btn-large btn-block\" type=\"button\">复制链接</button>"."<br>";
        ?>
    </li>
    <li class="list-group-item">

    </li>
</ul>
-->
</body>
