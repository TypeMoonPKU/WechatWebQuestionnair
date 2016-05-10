<?php
//此行代码用于避免iPhone上出现的乱码问题
header("Content-type: text/html; charset=utf-8");
?>

<!--必须提供code或teacherOpenID  但如果提供了parentOpenID
<?php
// 测试链接 https://open.weixin.qq.com/connect/oauth2/authorize?appid=wx75de8782f8e4f99c&redirect_uri=121.201.14.58%2fpages%2ffirst_time_for_teacher.php&response_type=code&scope=snsapi_base#wechat_redirect

require_once "../util/commonFuns.php";
//$teacherOpenID=getOpenIDFromREQUEST($_REQUEST);
$teacherOpenID='empty'
?>
-->
<!DOCTYPE html>
<html>
<head>
    <title>老师注册页</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, charset=utf-8">
    <link href="./reference/bootstrap.min.css" rel="stylesheet">
    <script src="./reference/jquery.min.js"></script>
    <script src="./reference/bootstrap.min.js"></script>
    <!-- <script src="./reference/bootstrap-theme.min.css"></script> -->
</head>
<body>
<?php require_once "share/navigation.php"?>
<br>
<br>
<h3>
    <strong>请老师完成注册</strong>
</h3>
<!-- TODO 需要美化这个提醒-->
<p>注意：此页面仅供老师使用，家长只能使用老师的邀请链接注册。</p>
<form class="form-horizontal" role="form" action="../reg/teacherReg.php" method="get">
    <div class="form-group">
        <label for="teacherName" class="col-sm-2 control-label">用户名</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="teacherName" name="teacherName"
                   placeholder="请输入用户名">
        </div>
    </div>
    <!-- 用于在页面中保存teacherOpenID-->
    <div class="form-group" style="display: none" >
        <label for="teacherOpenID" class="col-sm-2 control-label">OpenID</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="teacherOpenID" name="teacherOpenID"
                    value=<?php echo $teacherOpenID?>>
        </div>
    </div>
    <div class="form-group">
        <label for="email_adress" class="col-sm-2 control-label">邮件地址</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="email_adress"
                   placeholder="请输入邮件地址">
        </div>
    </div>

    <div class="form-group">
        <label for="password" class="col-sm-2 control-label">设置密码</label>
        <div class="col-sm-10">
            <input type="password" class="form-control" id="password"
            placeholder="请设置密码">
            <span class="help-block">请包括至少字母和数字</span>
        </div>
    </div>
    <div class="form-group">
        <label for="password_again" class="col-sm-2 control-label">确认密码</label>
        <div class="col-sm-10">
            <input type="password" class="form-control" id="password_again"
            placeholder="请再输入密码">
        </div>
    </div>

    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
            <button type="submit" class="btn btn-large btn-block">注册</button>
        </div>
    </div>
</form>

</body>
</html>