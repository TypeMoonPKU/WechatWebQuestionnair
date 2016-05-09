<!--
测试链接： http://121.201.14.58/pages/questionnaire_show.php
-->
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
<form class="form-horizontal" role="form" action="./upload_question_answers.php" method="get" enctype="multipart/form-data">
    <div class="form-group" style="display: none">
        <label for="question_group_name" class="col-sm-2 control-label">群&nbsp名</label>
        <div class="col-sm-10">
            <p class="form-control-static" id="question_group_name"name="question_group_name">这是来自您孩子所在班级的家长群</p>
        </div>
    </div>

    <div class="form-group">
        <label for="question_question_name" class="col-sm-2 control-label">问卷名</label>
        <div class="col-sm-10">
            <p class="form-control-static" id ="questionnaireTitle">本学期第二次家长会时间协调调查表</p>
        </div>
    </div>
    <div class="form-group">
        <label for="question_desc" class="col-sm-2 control-label">描&nbsp述</label>
        <div class="col-sm-10">
            <p class="form-control-static" id="questionnaireDescription">第二次家长会将于下周召开，请选出您有空的时间：</p>
        </div>
    </div>

    <div class="form-group">
        <label for="question_desc" class="col-sm-2 control-label">题目</label>
    <div class="col-sm-10">
        <p class="form-control-static"3>您可以来参加家长会的时间</p>
        <input type="checkbox"  name="ANSWER[]" id="optionsCheckboxA" value="optionA"><label for="optionsCheckboxA" id="optionsCheckboxALabel">A.周一下午</label><br>
        <input type="checkbox"  name="ANSWER[]" id="optionsCheckboxB" value="optionB"><label for="optionsCheckboxB" id="optionsCheckboxBLabel">B.周二下午</label><br>
        <input type="checkbox"  name="ANSWER[]" id="optionsCheckboxC" value="optionC"><label for="optionsCheckboxC" id="optionsCheckboxCLabel">C.周三下午</label><br>
        <input type="checkbox"  name="ANSWER[]" id="optionsCheckboxD" value="optionD"><label for="optionsCheckboxD" id="optionsCheckboxDLabel">D.周四下午</label><br>
    </div>
            <button type="submit" class="btn btn-large btn-block">确认提交</button>

</div>
</form>
</body>
<script>
    //此代码用于在网页中显示通知内容
    // TODO 确认jsondata里面是否有questionDescription
    // TODO 确认选项的排序是ABCD
//    var $jsondata=$.parseJSON('<?PHP
//        require_once "../reg/showNotice.php";
//        $noticeJson=showNotice($questionnaireID);
//        echo $noticeJson;
//        ?>//');
    var jsondata = $.parseJSON('{"questionnaireID":5,"optionNum":4,"questionnaireTitle":"时间统计","questionnaireDescription":"请大家选出有空的时间","optionArr":[{"optionID":"4","optionDescription":"o1","selectedPeopleNum":0,"selectedPeople":[]},{"optionID":"5","optionDescription":"o2","selectedPeopleNum":0,"selectedPeople":[]},{"optionID":"6","optionDescription":"o3","selectedPeopleNum":0,"selectedPeople":[]},{"optionID":"7","optionDescription":"o4","selectedPeopleNum":0,"selectedPeople":[]}],"notSelected":{"notSelectedNum":1,"students":["cyy"]}}');
    document.getElementById("questionnaireTitle").innerHTML=jsondata.questionnaireTitle;
    document.getElementById("questionnaireDescription").innerHTML=jsondata.questionnaireDescription;
    document.getElementById("optionsCheckboxALabel").innerHTML=jsondata.optionArr[0].optionDescription;
    document.getElementById("optionsCheckboxBLabel").innerHTML=jsondata.optionArr[1].optionDescription;
    document.getElementById("optionsCheckboxCLabel").innerHTML=jsondata.optionArr[2].optionDescription;
    document.getElementById("optionsCheckboxDLabel").innerHTML=jsondata.optionArr[3].optionDescription;
</script>

</html>