<?php
/**
 * 显示用户没有注册的情况下的提示信息
 * Created by PhpStorm.
 * User: Archimekai
 * Date: 5/10/2016
 * Time: 21:39
 */
?>


<!DOCTYPE html >
<html>
<head>
    <title>用户未注册</title>
    <meta http-equiv="Content-Type" name="viewport" content="width=device-width, initial-scale=1.0,charset=utf-8">
    <link href="../pages/reference/bootstrap.min.css" rel="stylesheet">
    <script src="../pages/reference/jquery.min.js"></script>
    <script src="../pages/reference/bootstrap.min.js"></script>
</head>
<body>


<form role="form" method="get" action="../reg/parentRegWithStudent.php">
    <div class="form-group">
        <div class="col-sm-12" align="center">
            <br><pre><h1>用户未注册</h1></pre>
            <p>对不起，您在此微信群中的身份还未在 微通 中注册，请向分享问卷的老师请求“邀请家长”页面，该页面在导航栏菜单中。</p>
        </div>
    </div>
</form>
</body>
</html>

