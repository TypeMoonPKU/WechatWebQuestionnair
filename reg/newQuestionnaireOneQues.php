<?php
//此行代码用于避免iPhone上出现的乱码问题
header("Content-type: text/html; charset=utf-8");
?>

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

$group = $_REQUEST["group"];
$title = $_REQUEST["title"];
$description = $_REQUEST["description"];
$teacherOpenID = $_REQUEST["teacherOpenID"];
$teacherID = getTeacherID($teacherOpenID);
$question = $_REQUEST["question"];
$option1 = $_REQUEST["option1"];
$option2 = $_REQUEST["option2"];
$option3 = $_REQUEST["option3"];
$option4 = $_REQUEST["option4"];
if($option1 == "" or $option2 == "" or $option3=="" or $option4=="")
{
    throw new Exception("Empty Option!");
}
if($teacherID==false)
{
    throw new Exception("Teacher OpenID Error!");
}
$questionnaireID = insertQuestionnaire($title, "", "Q", $teacherID);
if ($questionnaireID == false) {
    echo "Unknown Error!<br>";
} else {
    $questionID = insertQuestion($questionnaireID, "S", $description);
    if ($questionID == false) {
        echo "通知发布失败<br>";
    } else {
        $rtnVal1=insertOption($questionID, $questionnaireID, $option1);
        $rtnVal2=insertOption($questionID, $questionnaireID, $option2);
        $rtnVal3=insertOption($questionID, $questionnaireID, $option3);
        $rtnVal4=insertOption($questionID, $questionnaireID, $option4);
        if ($rtnVal1 && $rtnVal2 && $rtnVal3 && $rtnVal4) {
            echo "通知发布成功<br>";
        } else {
            echo "通知发布失败<br>";
        }
    }
}

echo "<br>";
$userRegNewUrl="121.201.14.58/pages/notice_show.php?questionnaireID=" . $questionnaireID;
$userRegNewUrlOAuth = "https://open.weixin.qq.com/connect/oauth2/authorize?appid=wx75de8782f8e4f99c&redirect_uri=" . urlencode($userRegNewUrl) . "&response_type=code&scope=snsapi_base#wechat_redirect";


echo "<br> 请将此链接： <a href='$userRegNewUrlOAuth' >" . $userRegNewUrlOAuth . "</a>";