<?php
//此行代码用于避免iPhone上出现的乱码问题
header("Content-type: text/html; charset=utf-8");
?>
<!--
测试链接： http://121.201.14.58/pages/questionnaire_show.php?questionnaireID=1
-->
<?php
// 提供给家长回答问题：必须提供parentOpenID或者code
// 引导questionnaireID不存在的情况
require_once "../util/commonFuns.php";
if(empty($_REQUEST['questionnaireID'])){
    http_redirect_cf(0,"./error/invalid_url.php");
    exit(0);
}
$questionnaireID = $_REQUEST['questionnaireID'];

// 解决家长登陆问题
$FULLThisURL = 'http://' . REMOTE_SERVER_IP . '/pages/questionnaire_show_parents.php?questionnaireID=' . $questionnaireID;
$parentOpenID = parent_sign_in($_REQUEST,$FULLThisURL);

// 提交给服务器用于回答问题的数据：
/*

parentOpenID: 该问卷的回答者  questionnaireID问卷号

questionID:问题号

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
</head>
<body>
<?php require_once "share/navigation_safe.php"?>
<br><br><br>
<form role="form" action="../reg/submitQuestionnaire.php" method="get" enctype="multipart/form-data">
    <div class="form-group" style="display: none">
        <label for="question_group_name" class="col-sm-2 control-label">群名</label>
        <div class="col-sm-10">
            <p class="form-control-static" id="question_group_name">这是来自您孩子所在班级的家长群</p>
        </div>
    </div>
    <!-- 用于在页面中保存parentOpenID-->
    <div class="form-group" style="display: none" >
        <label for="parentOpenID" class="col-sm-2 control-label">parentOpenID</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="parentOpenID" name="parentOpenID"
                   value=<?php echo $parentOpenID?>>
        </div>
    </div>
    <!-- 用于在页面中保存questionnaireID-->
    <div class="form-group" style="display: none" >
        <label for="questionnaireID" class="col-sm-2 control-label">questionnaireID</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="questionnaireID" name="questionnaireID"
                   value=<?php echo $questionnaireID?>>
        </div>
    </div>
    <!-- 用于在页面中保存questionID-->
    <div class="form-group" style="display: none" >
        <label for="questionID" class="col-sm-2 control-label">questionID</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="questionID" name="questionID"
                   value='待设定'>
        </div>
    </div>
    <div class="form-group">
        <label for="question_question_name" class="col-sm-2 control-label">问卷名</label>
        <div class="col-sm-10">
            <p class="form-control-static" id ="questionnaireTitle">正在加载问卷名</p>
        </div>
    </div>
    <div class="form-group">
        <label for="question_desc" class="col-sm-2 control-label">描述</label>
        <div class="col-sm-10">
            <p class="form-control-static" id="questionnaireDescription">正在加载问卷描述</p>
        </div>
    </div>

    <div class="form-group">
        <label for="question_desc" class="col-sm-2 control-label">题目</label>
        <div class="col-sm-10">
            <p class="form-control-static" id="questionDescription">正在加载题目描述</p>
            <input type="checkbox"  name="optionsCheckboxA" id="optionsCheckboxA" value="optionA"><label for="optionsCheckboxA" id="optionsCheckboxALabel">A.正在加载</label><br>
            <input type="checkbox"  name="optionsCheckboxB" id="optionsCheckboxB" value="optionB"><label for="optionsCheckboxB" id="optionsCheckboxBLabel">B.正在加载</label><br>
            <input type="checkbox"  name="optionsCheckboxC" id="optionsCheckboxC" value="optionC"><label for="optionsCheckboxC" id="optionsCheckboxCLabel">C.正在加载</label><br>
            <input type="checkbox"  name="optionsCheckboxD" id="optionsCheckboxD" value="optionD"><label for="optionsCheckboxD" id="optionsCheckboxDLabel">D.正在加载</label><br>
        </div>
    </div>
    <div class="form-group">
            <button type="submit" class="btn btn-large btn-block">确认提交</button>
    </div>
</form>
</body>
<!-- 动态修改页面内容的代码-->
<?php require_once "include_js_set_questionnaire.php"?>
</html>