<?php
/**
 * 用于设置页面中questionnaire的信息
 * 需要提供的参数：$questionnaireID
 * Created by PhpStorm.
 * User: Archimekai
 * Date: 5/10/2016
 * Time: 19:41
 */
?>
<script>
//此代码用于在网页中显示通知内容
// TODO 确认jsondata里面是否有questionDescription
// TODO 确认选项的排序是ABCD
var jsondata=$.parseJSON('<?PHP
require_once "../reg/showQuestionnaire.php";
$noticeJson=showQuestionnaire($questionnaireID);
echo $noticeJson;
?>');
//    var jsondata = $.parseJSON('{"questionnaireID":5,"optionNum":4,"questionnaireTitle":"时间统计","questionnaireDescription":"请大家选出有空的时间","optionArr":[{"optionID":"4","optionDescription":"o1","selectedPeopleNum":0,"selectedPeople":[]},{"optionID":"5","optionDescription":"o2","selectedPeopleNum":0,"selectedPeople":[]},{"optionID":"6","optionDescription":"o3","selectedPeopleNum":0,"selectedPeople":[]},{"optionID":"7","optionDescription":"o4","selectedPeopleNum":0,"selectedPeople":[]}],"notSelected":{"notSelectedNum":1,"students":["cyy"]}}');
document.getElementById("questionnaireTitle").innerHTML=jsondata.questionnaireTitle;
document.getElementById("questionnaireDescription").innerHTML=jsondata.questionnaireDescription;
document.getElementById("questionDescription").innerHTML=jsondata.question[0].questionDescription;
document.getElementById("optionsCheckboxALabel").innerHTML=jsondata.question[0].option[0].description;
document.getElementById("optionsCheckboxBLabel").innerHTML=jsondata.question[0].option[1].description;
document.getElementById("optionsCheckboxCLabel").innerHTML=jsondata.question[0].option[2].description;
document.getElementById("optionsCheckboxDLabel").innerHTML=jsondata.question[0].option[3].description;
</script>