<?php
/**
 * Created by PhpStorm.
 * User: Archimekai
 * Date: 4/22/2016
 * Time: 23:36
 */
require_once "../util/commonFuns.php";

var_dump($_REQUEST);
echo "<br>";

$parentOpenID=getOpenId($_REQUEST['code']);
$parentRegUrl="http://121.201.14.58/pages/first_time_for_students.php?teacherOpenID=" . $_REQUEST['teacherOpenID'] . "&parentOpenID=" . $parentOpenID;

echo "请点击下列链接：" . $parentRegUrl;
