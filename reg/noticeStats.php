<?php
/**
 * 统计与考勤
 * 需要questionnaireID
 * Created by PhpStorm.
 * User: summe_000
 * Date: 2016/4/22
 * Time: 21:13
 */

require_once "../dataBaseApi/dataBaseApis.php";

/*foreach ($_REQUEST as $key => $value ){
    echo "key: " . $key;
    echo "   value: " . $value;
}*/

$questionnaireID = $_REQUEST["questionnaireID"];

$selected = getPeopleSelected($questionnaireID);
$selectedNum = 0;
$notSelected = getPeopleNotSelected($questionnaireID);
$notSelectedNum = 0;
if ($selected->num_rows > 0) {
    while ($row = $selected->fetch_assoc()) {
        echo "studentID: {$row["studentID"]}<br>";
        $selectedNum++;
    }
    echo "{$selectedNum} students have read this notice.<br>";
}
else {
    echo "No student has read this notice.<br>";
}

if ($notSelected->num_rows > 0) {
    while ($row = $notSelected->fetch_assoc()) {
        echo "studentID: {$row["studentID"]}<br>" ;
        $notSelectedNum++;
    }
    echo "{$notSelectedNum} students haven't read this notice.<br>";
}
else {
    echo "No student hasn't read this questionnaire<br>.";
}