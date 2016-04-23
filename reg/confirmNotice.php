<?php
/**
 * Created by PhpStorm.
 * User: summe_000
 * Date: 2016/4/23
 * Time: 15:29
 */

require_once "../dataBaseApi/dataBaseApis.php";

/*foreach ($_REQUEST as $key => $value ){
    echo "key: " . $key;
    echo "   value: " . $value;
}*/

$questionnaireID = $_REQUEST["questionnaireID"];
$parentID = $_REQUEST["parentID"];
//$optionID = $_REQUEST["optionID"];
//$questionID = $_REQUEST["questionID"];
$qList = getQuestion($questionnaireID);
//$qList = getQuestion(3);
if ($qList==false) {
    echo "Wrong questionnaireID!";
}
else {
    $question = $qList->fetch_assoc();
    //echo "<br>$question<br>";
    $questionID = $question["questionID"];
    //echo "<br>$questionID<br>";
    $option = getOption($questionnaireID, $questionID);
    //$option = getOption(3, 4);
    $optionID = $option->fetch_assoc()["optionID"];
    //echo "<br>$optionID<br>";
    insertAnswer($optionID, $questionID, $questionnaireID, $parentID, true);
}

