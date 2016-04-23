<!DOCTYPE html>
<html>
<head>
    <title>创建通知群</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="./reference/json.js"></script>
    <link href="./reference/bootstrap.min.css" rel="stylesheet">
    <script src="./reference/jquery.min.js"></script>
    <script src="./reference/bootstrap.min.js"></script>
    <script src="./reference/bootstrap-theme.min.css"></script>
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
        <a class="navbar-brand" href="./homepage.html">首页</a>
    </div>

    <div class="collapse navbar-collapse" id="example-navbar-collapse">
        <ul class="nav navbar-nav">
            <li class="dropdown">
                <a href="./question_home.html" class="dropdown-toggle" data-toggle="dropdown">
                    问卷 <b class="caret"></b>
                </a>
                <ul class="dropdown-menu">
                    <li><a href="./question_create.html">创建问卷</a></li>
                    <li><a href="./question_history.html">历史问卷</a></li>
                    <li class="divider"></li>
                    <li><a href="./question_draft.html">问卷草稿</a></li>
                </ul>
            </li>
            <li class="dropdown">
                <a href="./notice_home.html" class="dropdown-toggle" data-toggle="dropdown">
                    通知 <b class="caret"></b>
                </a>
                <ul class="dropdown-menu">
                    <li><a href="./notice_create.html">创建通知</a></li>
                    <li><a href="./notice_history.html">历史通知</a></li>
                    <li class="divider"></li>
                    <li><a href="./notice_draft.html">通知草稿</a></li>
                </ul>
            </li>
            <li class="dropdown">
                <a href="./group_home.html" class="dropdown-toggle" data-toggle="dropdown">
                    群 <b class="caret"></b>
                </a>
                <ul class="dropdown-menu">
                    <li><a href="./group_create.html">创建群</a></li>
                    <li><a href="./group_manage.html">管理群</a></li>
                    <li><a href="./group_join.html">加入群</a></li>
                    <li class="divider"></li>
                    <li><a href="./group_search.html">查找群</a></li>
                </ul>
            </li>
        </ul>
    </div>
</nav>

<script script type="text/javascript">
    function creategroup()
    {
        var reader = new FileReader();
        reader.onload = function()
        {
            alert(this.result)
        }
        var f = document.getElementById("filePicker").files[0];
        reader.readAsText(f);
    }
</script>
<h3>
    <strong>通知展示</strong>
</h3>

<form class="form-horizontal" role="form" action="./upload_question_answers.php" method="get" enctype="multipart/form-data">
    <div class="form-group">
        <label for="question_group_name" class="col-sm-2 control-label">群&nbsp&nbsp&nbsp名</label>
        <div class="col-sm-10">
            <p class="form-control-static"id="question_group_name"name="question_group_name">这是来自您孩子所在班级的家长群</p>
        </div>
    </div>

    <div class="form-group">
        <label for="question_question_name" class="col-sm-2 control-label">通知名</label>
        <div class="col-sm-10">
            <p class="form-control-static"id ="question_question_name" name="question_question_name">本学期第二次家长会时间通知</p>
        </div>
    </div>

</form>

$json_string='{"id":1,"name":"jb51","email":"admin@jb51.net","interest":["wordpress","php"]} ';
$obj=json_decode($json_string);
echo $obj->name; //prints foo
echo $obj->interest[1]; //prints php


<ul class="list-group">
    <li class="list-group-item"> <strong>未阅读成员列表</strong> </li>
    <li class="list-group-item">成员名1</li>
    <li class="list-group-item">成员名2</li>
    <li class="list-group-item">成员名3</li>
</ul>
</body>
</html>