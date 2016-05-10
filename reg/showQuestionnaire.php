<?php
////此行代码用于避免iPhone上出现的乱码问题
//header("Content-type: text/html; charset=utf-8");
//?>
<?php
/**
 * Created by PhpStorm.
 * User: summe_000
 * Date: 2016/5/9
 * Time: 22:00
 */
function showQuestionnaire($questionnaireID)
{
    require_once "../dataBaseApi/dataBaseApis.php";

    /*foreach ($_REQUEST as $key => $value ){
        echo "key: " . $key;
        echo "   value: " . $value;
    }*/

    // $questionnaireID = $_REQUEST["questionnaireID"];
    $questionnaireR = getQuestionnaire($questionnaireID);
    if ($questionnaireR == false) {
        echo "Wrong QuestionnaireID";
        return "wrong!";
    }
    else {
        $questionnaire = $questionnaireR->fetch_assoc();
        $questionnaireArr = array('questionnaireTitle' => $questionnaire["title"],
            'questionnaireDescription' => $questionnaire["questionnaireDescription"],
            'type' => $questionnaire["questionnaireType"],
            'question' => "");
        $allQuestionArr = array();
        $question = getQuestion($questionnaireID);
        if ($question == false)
            echo "No question in this questionnaire";
        else {
            if ($question->num_rows > 0) {
                while ($row = $question->fetch_assoc()) {
                    //echo "studentName: {$row["studentName"]}<br>" ;
                    $questionArr = array('questionDescription' => "",
                        'questionID' => $row["questionID"], 'option' => '');
                    $questionArr["questionDescription"] = $row["questionDescription"];
                    $option = getOption($questionnaireID, $row["questionID"]);
                    if ($option == false) {
                    } else {
                        $optionArr = array();
                        while ($optionRow = $option->fetch_assoc()) {
                            array_push($optionArr, array('optionID'=>$optionRow["optionID"],
                                'description'=>$optionRow["optionDescription"]));
                        }
                        $questionArr["option"] = $optionArr;
                    }
                    array_push($allQuestionArr, $questionArr);
                }
            }
        }
        $questionnaireArr["question"] = $allQuestionArr;
    }
    $jsonencode = json_encode($questionnaireArr);
    //echo "$jsonencode";
    return $jsonencode;
}
