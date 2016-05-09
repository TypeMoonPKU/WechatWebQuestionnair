<?php
//此行代码用于避免iPhone上出现的乱码问题
header("Content-type: text/html; charset=utf-8");
?>
<!DOCTYPE html>
<html>
<head>
    <title>通知阅读情况</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, charset=utf-8">
    <script src="./reference/json.js"></script>
    <link href="./reference/bootstrap.min.css" rel="stylesheet">
    <script src="./reference/jquery.min.js"></script>
    <script src="./reference/bootstrap.min.js"></script>
    <script src="./reference/bootstrap-theme.min.css"></script>
</head>
<body>
<?php require_once "share/navigation.php"?>
<h3>
    <strong>学生状态展示</strong>
</h3>

<form class="form-horizontal" role="form" action="./upload_question_answers.php" method="get" enctype="multipart/form-data">
    <div class="form-group" style="display: none">
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
    <div class="form-group">
        <label for="question_desc" class="col-sm-2 control-label">内&nbsp&nbsp&nbsp容</label>
        <div class="col-sm-10">
            <p class="form-control-static" id="question_desc" name="question_desc">我们周六晚来开家长会，请携带小本本来</p>
        </div>
    </div>

</form>
<?php
require_once "../reg/noticeStats.php";
$questionnaireID=$_REQUEST['questionnaireID'];
$Unnoticed_json = questionnairStats($questionnaireID);
//$Unnoticed_json = '{"s":["wordpress","php"],"ns":["wordpress","php","php1","php2","php3","php4"]} ';
//echo $Unnoticed_json;
$student_list =json_decode($Unnoticed_json);
//var_dump($student_list);
$unnoticed_students = $student_list->ns;
//echo $unnoticed_students[1]."<br>";

echo "<ul class=\"list-group\">";
echo "<li class=\"list-group-item\"> <strong>未阅读成员列表</strong> </li>";
$number_of_unnoticed=count($unnoticed_students);
if ($number_of_unnoticed == 0){
    echo "    <li class=\"list-group-item\">" . '全部成员都已阅读。' . "</li>";
}else {
    for ($x = 0; $x < $number_of_unnoticed; $x++) {
        echo "    <li class=\"list-group-item\">" . $unnoticed_students[$x] . "</li>";
    }
}
echo "</ul>";

?>


</body>

<script >
    //此代码用于在网页中显示通知内容
    var $jsondata=$.parseJSON('<?PHP
        require_once "../reg/showNotice.php";
        $noticeJson=showNotice($questionnaireID);
        echo $noticeJson;
        ?>');
    document.getElementById("question_desc").innerHTML=$jsondata.question[0].questionDescription;
    document.getElementById("question_question_name").innerHTML=$jsondata.title;
    //alert($jsondata.questionnaireDescription);
    //alert($jsondata.title);

</script>
</html>