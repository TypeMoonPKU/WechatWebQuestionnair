<!--
测试链接： http://121.201.14.58/pages/questionnaire_show.php?questionnaireID=1
-->
<?php
// 引导questionnaireID不存在的情况
// 这个页面也是老师家长都能看？
if(empty($_REQUEST['questionnaireID'])){
    require_once "../util/httpRedirect.php";
    http_redirect(0,"./error/invalid_url.php");
    exit(0);
}
$questionnaireID = $_REQUEST['questionnaireID'];

// 提交给服务器用于回答问题的数据：
/*
Me:
parentOpenID: 该问卷的回答者  questionnaireID问卷号
Me:
questionID
Me:
问题号
Me:
还有一个回答数组questionAnswer，里面存有被家长选中的答案的optionID
*/
?>
<!DOCTYPE html>
<html>
<head>
    <title>问卷</title>
    <!--<meta http-equiv="refresh" content="1;url=./pageUnderConstruction.php">-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0, charset=utf-8">
    <link href="./reference/bootstrap.min.css" rel="stylesheet">
    <script src="./reference/jquery.min.js"></script>
    <script src="./reference/bootstrap.min.js"></script>
    <script src="./reference/bootstrap-theme.min.css"></script>
</head>
<body>
<?php require_once "share/navigation.php"?>
<br><br><br>
<form role="form" action="./upload_question_answers.php" method="get" enctype="multipart/form-data">
    <div class="form-group" style="display: none">
        <label for="question_group_name" class="col-sm-2 control-label">群&nbsp名</label>
        <div class="col-sm-10">
            <p class="form-control-static" id="question_group_name">这是来自您孩子所在班级的家长群</p>
        </div>
    </div>

    <div class="form-group">
        <label for="question_question_name" class="col-sm-2 control-label">问卷名</label>
        <div class="col-sm-10">
            <p class="form-control-static" id ="questionnaireTitle">正在加载问卷名</p>
        </div>
    </div>
    <div class="form-group">
        <label for="question_desc" class="col-sm-2 control-label">描&nbsp述</label>
        <div class="col-sm-10">
            <p class="form-control-static" id="questionnaireDescription">正在加载问卷描述</p>
        </div>
    </div>

    <div class="form-group">
        <label for="question_desc" class="col-sm-2 control-label">题目</label>
    <div class="col-sm-10">
        <p class="form-control-static" id="questionDescription">您可以来参加家长会的时间</p>
        <input type="checkbox"  name="questionAnswer" id="optionsCheckboxA" value="optionA"><label for="optionsCheckboxA" id="optionsCheckboxALabel">A.正在加载</label><br>
        <input type="checkbox"  name="questionAnswer" id="optionsCheckboxB" value="optionB"><label for="optionsCheckboxB" id="optionsCheckboxBLabel">B.正在加载</label><br>
        <input type="checkbox"  name="questionAnswer" id="optionsCheckboxC" value="optionC"><label for="optionsCheckboxC" id="optionsCheckboxCLabel">C.正在加载</label><br>
        <input type="checkbox"  name="questionAnswer" id="optionsCheckboxD" value="optionD"><label for="optionsCheckboxD" id="optionsCheckboxDLabel">D.正在加载</label><br>
    </div>
            <button type="submit" class="btn btn-large btn-block">确认提交</button>

</div>
</form>
</body>
<!-- 动态修改页面内容的代码-->
<?php require_once "include_js_set_questionnaire.php"?>
</html>