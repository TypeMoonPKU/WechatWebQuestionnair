<?php
//此行代码用于避免iPhone上出现的乱码问题
header("Content-type: text/html; charset=utf-8");
?>

<!--必须提供teacherOpenID
<?php
//测试链接：
$teacherOpenID=$_REQUEST['teacherOpenID'];
?>
-->

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
<nav class="navbar navbar-default navbar-fixed-top" role="navigation">
    <div class="navbar-header">

        <button type="button" class="navbar-toggle" data-toggle="collapse"
                data-target="#example-navbar-collapse">
            <span class="sr-only">切换导航</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="homepage.php">首页</a>
    </div>

    <div class="collapse navbar-collapse" id="example-navbar-collapse">
        <ul class="nav navbar-nav">
            <li class="dropdown">
                <a href="./question_home.html" class="dropdown-toggle" data-toggle="dropdown">
                    问卷 <b class="caret"></b>
                </a>
                <ul class="dropdown-menu">
                    <li><a href="questionnaire_create.php">创建问卷</a></li>
                    <li><a href="question_history.html">历史问卷</a></li>
                    <li class="divider"></li>
                    <li><a href="./question_draft.html">问卷草稿</a></li>
                </ul>
            </li>
            <li class="dropdown">
                <a href="./notice_home.html" class="dropdown-toggle" data-toggle="dropdown">
                    通知 <b class="caret"></b>
                </a>
                <ul class="dropdown-menu">
                    <li><a href="notice_create.php">创建通知</a></li>
                    <li><a href="notice_history.html">历史通知</a></li>
                    <li class="divider"></li>
                    <li><a href="./notice_draft.html">通知草稿</a></li>
                </ul>
            </li>
            <li class="dropdown">
                <a href="./group_home.html" class="dropdown-toggle" data-toggle="dropdown">
                    群 <b class="caret"></b>
                </a>
                <ul class="dropdown-menu">
                    <li><a href="group_create.html">创建群</a></li>
                    <li><a href="group_manage.html">管理群</a></li>
                    <li><a href="group_join.html">加入群</a></li>
                    <li class="divider"></li>
                    <li><a href="group_search.html">查找群</a></li>
                </ul>
            </li>
        </ul>
    </div>
</nav>

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