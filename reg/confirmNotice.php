<?php
//此行代码用于避免iPhone上出现的乱码问题
header("Content-type: text/html; charset=utf-8");
?>
<?php
// 根据情况进行跳转
// 如果不含有parentOpenID或者OpenID或者code，则强制进行跳转
// 最后的状态是获得parentOpenID
// 如果parentOpenID非法的话，则提示需要注册
require_once "../util/commonFuns.php";
require_once "../util/httpRedirect.php";
if(!empty($_REQUEST['parentOpenID'])){
    $parentOpenID = $_REQUEST["parentOpenID"];
}elseif(!empty($_REQUEST['OpenID'])){
    $parentOpenID = $_REQUEST['OpenID']; //事实上应该判断是不是家长
    require_once "../dataBaseApi/dataBaseApis.php";
    if(!checkParent($parentOpenID)){
        
        }
}elseif(!empty($_REQUEST['code'])){
    //var_dump($_REQUEST);
    //$parentOpenID = getOpenIdFromUserId($_REQUEST['code']);
    $parentOpenID = getOpenID($_REQUEST['code']);
}else{
    $goalURL = "http://" . REMOTE_SERVER_IP ."/reg/confirmNotice.php?questionnaireID=" . $_REQUEST['questionnaireID'];
    http_OAuth_redirect(0,$goalURL);
    exit(0);
}
?>
<!-- 通用提示页面代码 part1 开始-->
<!DOCTYPE html >
<html >
<head>
    <title>通知确认</title>
    <meta http-equiv="Content-Type" name="viewport" content="width=device-width, initial-scale=1.0, charset=utf-8">
    <link href="../pages/reference/bootstrap.min.css" rel="stylesheet">
    <script src="../pages/reference/jquery.min.js"></script>
    <script src="../pages/reference/bootstrap.min.js"></script>
    <script src="../pages/reference/bootstrap-theme.min.css"></script>
</head>
<body >


<form role="form" method="get" action="../reg/parentRegWithStudent.php">
    <div class="form-group">
        <div class="col-sm-12" align="center">
            <br><pre><h1>
                    <!-- 通用提示页面代码 part1 结束-->
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
//                    $parentOpenID = $_REQUEST["parentOpenID"];
                    $parentID = getParentID($parentOpenID);


                    if ($parentID == false)
                    {
                        echo "Wrong Parent OpenID<br>";
                    }
                    else {
                        //$optionID = $_REQUEST["optionID"];
                        //$questionID = $_REQUEST["questionID"];
                        $qList = getQuestion($questionnaireID);
                        //var_dump($qList);
                        //var_dump($questionnaireID);
                        //$qList = getQuestion(3);
                        if ($qList == false) {
                            echo "确认失败<br>请重新确认";
                        } else {
                            $question = $qList->fetch_assoc();
                            //echo "<br>$question<br>";
                            $questionID = $question["questionID"];
                            //echo "<br>$questionID<br>";
                            $option = getOption($questionnaireID, $questionID);
                            //$option = getOption(3, 4);
                            $optionID = $option->fetch_assoc()["optionID"];
                            //echo "<br>$optionID<br>";
                            $check = checkNoticeAnswer($parentID,$questionnaireID);
                            //$check = checkNoticeAnswer(17,1);
                            if ($check==true)
                                echo "已经确认<br>";
                            else {
                                $judge = insertAnswer($optionID, $questionID, $questionnaireID, $parentID, true);
                                if ($judge == false) {
                                    echo "确认失败<br>请重新确认";
                                } else {
                                    echo "确认成功";
                                }

                            }
                        }
                    }
                    ?>
                    <!-- 通用提示页面代码 part2 开始-->
                </h1>
            </pre>
        </div>
    </div>

</form>
</body>
<!-- 通用提示页面代码 part2 结束-->