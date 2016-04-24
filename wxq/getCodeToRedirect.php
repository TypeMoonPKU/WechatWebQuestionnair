<?php
header("Content-type: text/html; charset=utf-8");
?>
<!-- 通用提示页面代码 part1 开始-->
<!DOCTYPE html >
<html >
<head>
    <title>欢迎使用微通</title>
    <meta http-equiv="Content-Type" name="viewport" content="width=device-width, initial-scale=1.0, charset=utf-8">



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
$regedTeacherRedirectStr= "
    <meta http-equiv=\"refresh\" content=\"$redirectWaitTime;url=http://121.201.14.58/pages/homepage.php?teacherOpenID=$openID\">
";
$isRegedParent=checkParent($openID);
$regedParentRedirectStr="
    <meta http-equiv=\"refresh\" content=\"$redirectWaitTime;url=http://121.201.14.58/pages/parent_access_denied.php\">
";

$regPageRedirectForNewUser= "
    <meta http-equiv=\"refresh\" content=\"$redirectWaitTime;url=http://121.201.14.58/pages/first_time_for_teacher.php?teacherOpenID=$openID\">
";

if($isRegedTeacher){
    echo $regedTeacherRedirectStr;
    exit();
}elseif($isRegedParent){
    echo $regedParentRedirectStr;
    exit();
}else{
    echo $regPageRedirectForNewUser;
    exit();
}

?>




    <link href="../pages/reference/bootstrap.min.css" rel="stylesheet">
    <script src="../pages/reference/jquery.min.js"></script>
    <script src="../pages/reference/bootstrap.min.js"></script>
    <script src="../pages/reference/bootstrap-theme.min.css"></script>
</head>
<body >


<form class="form-horizontal" role="form" method="get" action="../reg/parentRegWithStudent.php">
    <div class="form-group">
        <div class="col-sm-12" align="center">
            <br><pre><h1>
                    <!-- 通用提示页面代码 part1 结束-->
                    正在跳转中，请稍候

                    <!-- 通用提示页面代码 part2 开始-->
                </h1></pre>
        </div>
    </div>

</form>
</body>
<!-- 通用提示页面代码 part2 结束-->
