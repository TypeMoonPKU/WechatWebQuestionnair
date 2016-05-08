<?php
//需要提供teacherOpenID才能工作
require_once "../util/setHeaderToUTF8.php"; // 通过使用这个程序避免乱码的问题
//一劳永逸地解决teacher登陆的问题
require_once "../util/commonFuns.php";
$FULLthisPageURL="http://" . REMOTE_SERVER_IP . "/pages/questionnaire_create.php";
$teacherOpenID = teacher_sign_in($_REQUEST,$FULLthisPageURL);

?>

<!DOCTYPE html>
<html>
<head>
    <title>创建问卷</title>
    <!--<meta http-equiv="refresh" content="1;url=./pageUnderConstruction.php"> -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0, charset=utf-8">
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
                    <li><a href="notice_create.php">创建通知</a></li>
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

<br><br><br>
<form class="form-horizontal" role="form" action="../reg/newQuestionnaireOneQues.php" method="post" enctype="multipart/form-data">
    <!-- 群功能尚在开发中-->
    <div class="form-group" style="display: none">
        <label for="question_group_name" class="col-sm-2 control-label">群名</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="question_group_name" name="question_group_name" placeholder="请输入群名">
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
        <label for="questionnaire_title" class="col-sm-2 control-label">问卷名</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="questionnaire_title" name="questionnaire_title" placeholder="请输入问卷名">
        </div>
    </div>
    <div class="form-group">
        <label for="questionnaire_desc" class="col-sm-2 control-label">描述</label>
        <div class="col-sm-10">
            <textarea class="form-control" rows="3" id="questionnaire_desc" name="questionnaire_desc" placeholder="请输入对问卷的描述（可选）"></textarea>
        </div>
    </div>

    <div class="form-group">
        <label for="question_one" class="col-sm-2 control-label">题目</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="question_one" name="question_one" placeholder="请输入题目名">
            <input type="text" class="form-control" id="question_one_A" name="group_desc_A" placeholder="选项A">
            <input type="text" class="form-control" id="question_one_B" name="group_desc_B" placeholder="选项B">
            <input type="text" class="form-control" id="question_one_C" name="group_desc_C" placeholder="选项C">
            <input type="text" class="form-control" id="question_one_D" name="group_desc_D" placeholder="选项D">
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
            <button type="submit" class="btn btn-large btn-block">发布</button>
        </div>
    </div>
</form>

</body>
</html>