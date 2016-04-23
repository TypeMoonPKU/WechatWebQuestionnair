<?php
/**
 * Created by PhpStorm.
 * User: summe_000
 * Date: 2016/4/23
 * Time: 23:17
 */

require_once "../dataBaseApi/dataBaseApis.php";

/*foreach ($_REQUEST as $key => $value ){
    echo "key: " . $key;
    echo "   value: " . $value;
}*/

$questionnaireID = $_REQUEST["questionnaireID"];
$parentOpenID = $_REQUEST["parentOpenID"];
$optionID = $_REQUEST["optionID"];
$questionID = $_REQUEST["questionID"];
$parentID = getParentID($parentOpenID);
if ($parentID == false)
    echo "Wrong Parent OpenID<br>";
else
    insertAnswer($optionID, $questionID, $questionnaireID, $parentID, true);