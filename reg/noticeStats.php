<?php
/**
 * 统计与考勤
 * 需要questionnaireID
 * Created by PhpStorm.
 * User: summe_000
 * Date: 2016/4/22
 * Time: 21:13
 */

function stat()
{
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
    $s = array();
    $ns = array();
    if ($selected->num_rows > 0) {
        while ($row = $selected->fetch_assoc()) {
            //echo "studentName: {$row["studentName"]}<br>";
            array_push($s, $row["studentName"]);
            $selectedNum++;
        }
        //echo "{$selectedNum} students have read this notice.<br>";
    } else {
        //echo "No student has read this notice.<br>";
    }

    if ($notSelected->num_rows > 0) {
        while ($row = $notSelected->fetch_assoc()) {
            //echo "studentName: {$row["studentName"]}<br>" ;
            array_push($ns, $row["studentName"]);
            $notSelectedNum++;
        }
        //echo "{$notSelectedNum} students haven't read this notice.<br>";
    } else {
        //echo "No student hasn't read this questionnaire<br>.";
    }

    $arr = array('s' => $s, 'ns' => $ns);
    $jsonencode = json_encode($arr);
//echo "$jsonencode";
    return $jsonencode;
}