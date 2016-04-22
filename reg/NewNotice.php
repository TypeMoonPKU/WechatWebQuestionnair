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

$title = $_REQUEST["title"];
$description = $_REQUEST["description"];
$teacherID = $_REQUEST["teacherID"];

$questionnaireID = insertQuestionnaire($title,"","N","$teacherID");
if ($questionnaireID==false) {
    echo "Unknown Errror!";
}
else {
    if ($description == "") {
        echo "Warning: 通知没有内容！<br> ";
    } 
    else {
        $questionID = insertQuestion($questionnaireID, "S", $description);
        if ($questionID == false) {
            echo "通知发布失败<br>";
        }
        else{
            $rtnVal=insertOption($questionID,$questionnaireID,"确认");
            if($rtnVal==true) {
                echo "通知发布成功<br>";
            }
            else {
                echo "通知发布失败<br>";
            }
        }
    }
}