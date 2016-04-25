<?php
header("Content-type: text/html; charset=utf-8");
?>
<!--
<?php
/**
 * Created by PhpStorm.
 * User: Archimekai
 * Date: 4/18/2016
 * Time: 13:59
 */

require_once "../util/commonFuns.php";
$goalURL=REMOTE_SERVER_IP . "/wxq/getCodeToRedirect.php";
$redirectURL=genOAuthURL($goalURL);
?>
-->
<!--
<head>
    <meta http-equiv="refresh" content="1;url=<?PHP echo $redirectURL?>">
</head>
-->

<!--
<?php


foreach ($_REQUEST as $key => $value ){
    echo "key: " . $key;
    echo "   value: " . $value;
}


$url = "https://open.weixin.qq.com/connect/oauth2/authorize?appid=wx75de8782f8e4f99c&redirect_uri=121.201.14.58%2fpages%2ffirst_time_for_teacher.php&response_type=code&scope=snsapi_base#wechat_redirect";
echo $_REQUEST;

echo "<br> 第一次使用？请点击链接注册 <a href='$url' >" . $url . "</a>";


$ManageUrl=REMOTE_SERVER_IP . "/pages/homepage.php";
$oauthMUrl=genOAuthURL($ManageUrl);
echo "<br> 点击下列链接以进入管理页  <a href='$oauthMUrl'>" . $oauthMUrl . "</a>";

?>
<br>
<br>
-->

<!-- 通用提示页面代码 part1 开始-->
<!DOCTYPE html >
<html>
<head>
    <title>欢迎使用微通</title>
    <meta http-equiv="Content-Type" name="viewport" content="width=device-width, initial-scale=1.0, charset=utf-8">
    <meta http-equiv="refresh" content="0;url=<?PHP echo $redirectURL?>">
    <link href="../pages/reference/bootstrap.min.css" rel="stylesheet">
    <script src="../pages/reference/jquery.min.js"></script>
    <script src="../pages/reference/bootstrap.min.js"></script>
    <script src="../pages/reference/bootstrap-theme.min.css"></script>
</head>
<body>
<form class="form-horizontal" role="form" method="get" action="../reg/parentRegWithStudent.php">
    <div class="form-group">
        <div class="col-sm-12" align="center">
            <br><pre><h1>正在跳转中，请稍候
                    <!-- 通用提示页面代码 part1 结束-->
<!-- 通用提示页面代码 part2 开始-->
</h1></pre>
</div>
</div>

</form>
</body>
<!-- 通用提示页面代码 part2 结束-->