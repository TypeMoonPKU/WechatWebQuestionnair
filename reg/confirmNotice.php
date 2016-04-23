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
$optionID = $_REQUEST["optionID"];
$questionID = $_REQUEST["questionID"];
insertAnswer($optionID, $questionID, $questionnaireID, $parentID, true);