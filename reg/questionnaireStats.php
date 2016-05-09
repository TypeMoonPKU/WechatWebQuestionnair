<?php
/**
 * Created by PhpStorm.
 * User: summe_000
 * Date: 2016/5/9
 * Time: 22:05
 */


//{questionnaireID, questionnaireTitle, questionnaireDescription, 
//optionNum, {{option1, description, number, {stu1, stu2,...}},{option2,...},...}
//{notselectedNum,{stu1, stu2, ...}}}
function questionnairStats($questionnaireID)
{
    require_once "../dataBaseApi/dataBaseApis.php";

    /*foreach ($_REQUEST as $key => $value ){
        echo "key: " . $key;
        echo "   value: " . $value;
    }*/

    //$questionnaireID = $_REQUEST["questionnaireID"];
    
    $questionnaire = getQuestionnaire($questionnaireID)->fetch_assoc();
    
    $optionArr = array();
    $question = getQuestion($questionnaireID)->fetch_assoc();
    $questionID = $question["questionID"];
    $options = getOption($questionnaireID,$questionID);
    $optionNum = 0;
    if($options->num_rows>0) {
        while ($row = $options->fetch_assoc()) {
            //echo "studentName: {$row["studentName"]}<br>";
            $optionID=$row["optionID"];
            $optionNum++;
            $peopleSelected = getPeopleSelectedOption($questionnaireID, $optionID);
            $students = array();
            $studentsNum = 0;
            if($peopleSelected->num_rows>0) {
                while($studentRow = $peopleSelected->fetch_assoc()) {
                    array_push($students,$studentRow["studentName"]);
                    $studentsNum++;
                }
            }
            array_push($optionArr, array("optionID"=>$optionID,
                'optionDescription'=>$row["optionDescription"],
                'selectedPeopleNum'=>$studentsNum,'selectedPeople'=>$students));
        }
    }

    $notSelected = getPeopleNotSelected($questionnaireID);
    $notSelectedNum = 0;
    $ns = array();

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

    $arr = array('questionnaireID' => $questionnaireID, 
        'questionnaireTitle' => $questionnaire["title"],
        'questioinnaireDescription' => $questionnaire["questionnaireDescription"],
        'questionID' => $questionID,
        'questionDescription' => $question["questionDescription"],
        'optionNum'=>$optionNum, 'optionArr'=>$optionArr,
        'notSelected'=>array("notSelectedNum"=>$notSelectedNum, "students"=>$ns));
    $jsonencode = json_encode($arr);
//echo "$jsonencode";
    return $jsonencode;
}
