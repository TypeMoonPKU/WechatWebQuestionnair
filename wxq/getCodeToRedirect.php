<?php
/**
 *
 * 用于新进入页面的跳转，不同的是现在拿到了code
 * Created by PhpStorm.
 * User: Archimekai
 * Date: 4/23/2016
 * Time: 15:43
 */

require_once "../util/commonFuns.php";
require_once "../dataBaseApi/dataBaseApis.php";

$openID=getOpenId($_REQUEST['code']);
$redirectWaitTime=1;

$isRegedTeacher=checkTeacher($openID);
$regedTeacherRedirectStr= "<head>
    <meta http-equiv=\"refresh\" content=\"$redirectWaitTime;url=http://121.201.14.58/pages/homepage.php?teacherOpenID=$openID\">
</head>";
$isRegedParent=checkParent($openID);
$regedParentRedirectStr="<head>
    <meta http-equiv=\"refresh\" content=\"$redirectWaitTime;url=http://121.201.14.58/pages/parent_access_denied.php\">
</head>";

$regPageRedirectForNewUser= "<head>
    <meta http-equiv=\"refresh\" content=\"$redirectWaitTime;url=http://121.201.14.58/pages/first_time_for_teacher.php?teacherOpenID=$openID\">
</head>";

if($isRegedTeacher){
    echo $regedTeacherRedirectStr;
    exit();
}elseif($isRegedParent){
    echo $regedParentRedirectStr;
    exit();
}else{
    echo $$regPageRedirectForNewUser;
    exit();
}

