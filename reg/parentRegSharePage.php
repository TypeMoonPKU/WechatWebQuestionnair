<?php
/**
 * 可以用作单页提示信息的模板
 * 老师注册成功后分享给家长，引导家长进行注册的页面
 * 必须提供teacherOpenID
 * 测试链接：http://121.201.14.58/reg/parentRegSharePage.php
 * Created by PhpStorm.
 * User: Archimekai
 * Date: 5/9/2016
 * Time: 02:03
 */
require_once "../util/httpRedirect.php";
//一劳永逸地解决teacher登陆的问题
require_once "../util/commonFuns.php";
$FULLthisPageURL="http://" . REMOTE_SERVER_IP . "/reg/parentRegSharePage.php";
$teacherOpenID = teacher_sign_in($_REQUEST,$FULLthisPageURL);
//$teacherOpenID="";
$parentRegFULLurl="http://121.201.14.58/pages/first_time_for_students.php?teacherOpenID=" . $teacherOpenID;
$OAuthURL = genOAuthURL($parentRegFULLurl);
?>

<!DOCTYPE html >
<html>
<head>
    <title>家长注册</title>
    <meta http-equiv="Content-Type" name="viewport" content="width=device-width, initial-scale=1.0,charset=utf-8">
    <link href="../pages/reference/bootstrap.min.css" rel="stylesheet">
    <script src="../pages/reference/jquery.min.js"></script>
    <script src="../pages/reference/bootstrap.min.js"></script>
</head>
<body>


<form class="form-horizontal" role="form" method="get" action="../reg/parentRegWithStudent.php">
    <div class="form-group">
        <div class="col-sm-12" align="center">
            <br><pre><h1>欢迎家长注册</h1></pre>
            <p>请老师将此页面分享至微信群以供家长注册。</p>
            <div class="form-group" align="center">
                <!--<br>点击"进入"开始您的管理界面<br> -->
                <button class="btn btn-large btn-block" type="button" onclick="window.location.href='<?php echo $OAuthURL?>'">家长注册</button>

            </div>
</form>
</body>
</html>
