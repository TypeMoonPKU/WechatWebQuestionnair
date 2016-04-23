<!--
<?php
/**
 * Created by PhpStorm.
 * 新建通知
 * 需要title, description, teacherID
 * User: summe_000
 * Date: 2016/4/22
 * Time: 11:41
 */

require_once "../dataBaseApi/dataBaseApis.php";

/*foreach ($_REQUEST as $key => $value ){
    echo "key: " . $key;
    echo "   value: " . $value;
}*/
var_dump($_REQUEST);

$title = $_REQUEST["title"];
$description = $_REQUEST["description"];
$teacherOpenID = $_REQUEST["teacherOpenID"];
$teacherID = getTeacherID($teacherOpenID);
if($teacherID==false)
{
    throw new Exception("Teacher OpenID Error!");
}
if($description == "")
    echo "Error: 通知没有内容！<br> ";
else {
    $questionnaireID = insertQuestionnaire($title, "", "N", $teacherID);
    if ($questionnaireID == false) {
        echo "Unknown Error!";
    } else {
        $questionID = insertQuestion($questionnaireID, "S", $description);
        if ($questionID == false) {
            echo "通知发布失败<br>";
        } else {
            $rtnVal = insertOption($questionID, $questionnaireID, "确认");
            if ($rtnVal == true) {
                echo "通知发布成功<br>";
            } else {
                echo "通知发布失败<br>";
            }
        }
    }
}

echo "<br>";
$userRegNewUrl="121.201.14.58/pages/notice_show.php?questionnaireID=" . $questionnaireID;
$userRegNewUrlOAuth = "https://open.weixin.qq.com/connect/oauth2/authorize?appid=wx75de8782f8e4f99c&redirect_uri=" . urlencode($userRegNewUrl) . "&response_type=code&scope=snsapi_base#wechat_redirect";

echo "<br> 请将此链接： <a href='$userRegNewUrlOAuth' >" . $userRegNewUrlOAuth . "</a>";
?>
-->
<!DOCTYPE html >
<html >
<head>
    <title>问卷成功</title>
    <meta http-equiv="Content-Type" name="viewport" content="width=device-width, initial-scale=1.0; charset=utf-8">
    <link href="../pages/reference/bootstrap.min.css" rel="stylesheet">
    <script src="../pages/reference/jquery.min.js"></script>
    <script src="../pages/reference/bootstrap.min.js"></script>
    <script src="../pages/reference/bootstrap-theme.min.css"></script>
</head>
<body >


<form class="form-horizontal" role="form" method="get" action="../reg/parentRegWithStudent.php">
    <div class="form-group">
        <div class="col-sm-12" align="center">
            <br><pre><h1>问卷创建成功</h1></pre>
            <br><br><h3>劳烦手动复制链接<br>将您的问卷链接分享到班级群</h3>

        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-12">

<?php echo "<pre>";print_r($userRegNewUrlOAuth)  ;?>
</div>
    </div>


    <div class="form-group" align="center">
        <br>点击"回首页"回到您的管理界面<br>
        <button class="btn btn-large btn-block" type="button" onclick="window.location.href='../pages/homepage.php'">回首页</button>

    </div>
</form>
</body>
