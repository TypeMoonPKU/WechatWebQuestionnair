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