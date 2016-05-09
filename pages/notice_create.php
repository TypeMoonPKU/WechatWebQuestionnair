<?php
require_once "../util/setHeaderToUTF8.php"; // 通过使用这个程序避免乱码的问题
?>

<?php
// 测试链接：
//$teacherOpenID=$_REQUEST['teacherOpenID'];

//一劳永逸地解决teacher登陆的问题
require_once "../util/commonFuns.php";
$FULLthisPageURL="http://" . REMOTE_SERVER_IP . "/pages/notice_create.php";
$teacherOpenID = teacher_sign_in($_REQUEST,$FULLthisPageURL);
?>


<!DOCTYPE html>
<html>
<head>
    <title>创建通知</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, charset=utf-8">
    <link href="reference/bootstrap.min.css" rel="stylesheet">
    <script src="reference/jquery.min.js"></script>
    <script src="reference/bootstrap.min.js"></script>
    <script src="reference/bootstrap-theme.min.css"></script>
</head>
<body>
<?php require_once "share/navigation.php"?>

<script type="text/javascript">
    function creategroup()
    {
        var reader = new FileReader();
        reader.onload = function()
        {
            alert(this.result);
        };
        var f = document.getElementById("filePicker").files[0];
        reader.readAsText(f);
    }
</script>
<h3>
    <strong>新通知创建</strong>
</h3>
<form class="form-horizontal" role="form" method="get" action="../reg/NewNotice.php">
    <div class="form-group" style="display: none">
        <label for="target_group" class="col-sm-2 control-label">群名</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="target_group"
                   placeholder="通知目标群名">
        </div>
    </div>
    <div class="form-group">
        <label for="title" class="col-sm-2 control-label">通知主题</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="title" name="title"
                   placeholder="通知主题">
        </div>
    </div>
    <!-- 用于在页面中保存teacherOpenID-->
    <div class="form-group" style="display: none" >
        <label for="teacherOpenID" class="col-sm-2 control-label">teacherOpenID</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="teacherOpenID" name="teacherOpenID"
                   value=<?php echo $teacherOpenID?>>
        </div>
    </div>
    <div class="form-group">
        <label for="description" class="col-sm-2 control-label">通知内容</label>
        <div class="col-sm-10">
            <textarea class="form-control" rows="3" id="description" name="description"
                      placeholder="请输入要通知的消息"></textarea>
        </div>
    </div>

    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
            <button type="submit" class="btn btn-default">发送</button>
        </div>
    </div>
</form>


</body>
</html>