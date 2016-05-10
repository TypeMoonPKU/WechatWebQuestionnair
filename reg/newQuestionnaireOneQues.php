<?php
//此行代码用于避免iPhone上出现的乱码问题
header("Content-type: text/html; charset=utf-8");
?>
<!--
<?php
/**
 * Created by PhpStorm.
 * User: summe_000
 * Date: 2016/4/23
 * Time: 16:55
 */

require_once "../dataBaseApi/dataBaseApis.php";

/*foreach ($_REQUEST as $key => $value ){
    echo "key: " . $key;
    echo "   value: " . $value;
}*/
// 这里体现出的很大的问题是接口设计的时候没有约定好名字
// 应该写出对接口要求的文档
// 现在group还是没用的。。
$group = $_REQUEST["question_group_name"];
$title = $_REQUEST["questionnaire_title"];
$description = $_REQUEST["questionnaire_desc"];
$teacherOpenID = $_REQUEST["teacherOpenID"];
$teacherID = getTeacherID($teacherOpenID);
$question = $_REQUEST["question_one"];
$option1 = $_REQUEST["question_one_A"];
$option2 = $_REQUEST["question_one_B"];
$option3 = $_REQUEST["question_one_C"];
$option4 = $_REQUEST["question_one_D"];
if($option1 == "" or $option2 == "" or $option3=="" or $option4=="")
{
    throw new Exception("Empty Option!");
}
if($teacherID==false)
{
    throw new Exception("Teacher OpenID Error!");
}
$check = checkNotice($title,$description);
if($check == true)
{
    $questionnaireID = getQuestionnaireID($title,$description,$question)->fetch_assoc()["questionnaireID"];
    echo "问卷发布成功<br>";
}
else {
    $questionnaireID = insertQuestionnaire($title, "", "Q", $teacherID);
    if ($questionnaireID == false) {
        echo "Unknown Error!<br>";
    } else {
        $questionID = insertQuestion($questionnaireID, "M", $description);
        if ($questionID == false) {
            echo "问卷发布失败<br>";
        } else {
            $rtnVal1 = insertOption($questionID, $questionnaireID, $option1);
            $rtnVal2 = insertOption($questionID, $questionnaireID, $option2);
            $rtnVal3 = insertOption($questionID, $questionnaireID, $option3);
            $rtnVal4 = insertOption($questionID, $questionnaireID, $option4);
            if ($rtnVal1 && $rtnVal2 && $rtnVal3 && $rtnVal4) {
                echo "问卷发布成功<br>";
            } else {
                echo "问卷发布失败<br>";
            }
        }
    }
}

//echo "<br> 请将此链接： <a href='$userRegNewUrlOAuth' >" . $userRegNewUrlOAuth . "</a>";
?>
-->
<?php
//用于完成跳转的逻辑，跳转到分享页面
require_once "../util/httpRedirect.php";
$goalURL = "./showQuestionnaireSharePage.php?questionnaireID=". $questionnaireID;
http_redirect(0,$goalURL);
?>
<!DOCTYPE html >
<html>
<head>
    <title>问卷创建成功</title>
    <meta http-equiv="Content-Type" name="viewport" content="width=device-width, initial-scale=1.0,charset=utf-8">
    <link href="../pages/reference/bootstrap.min.css" rel="stylesheet">
    <script src="../pages/reference/jquery.min.js"></script>
    <script src="../pages/reference/bootstrap.min.js"></script>
    <script src="../pages/reference/bootstrap-theme.min.css"></script>
</head>
<body >


<form class="form-horizontal" role="form" method="get" action="../reg/parentRegWithStudent.php">
    <div class="form-group">
        <div class="col-sm-12" align="center">
            <br><pre><h1>问卷创建成功，正在跳转...</h1></pre>
            </div>

</form>
</body>
</html>
