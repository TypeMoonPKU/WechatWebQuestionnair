<?php
//此行代码用于避免iPhone上出现的乱码问题
header("Content-type: text/html; charset=utf-8");
?>
<?php
// 此页面用于提交问卷
// 引导questionnaireID不存在的情况
if(empty($_REQUEST['questionnaireID'])){
    require_once "../util/httpRedirect.php";
    http_redirect(0,"./error/invalid_url.php");
    exit(0);
}
$questionnaireID = $_REQUEST['questionnaireID'];
?>
<!-- 通用提示页面代码 part1 开始-->
<!DOCTYPE html >
<html >
<head>
    <title>问卷提交成功</title>
    <meta http-equiv="Content-Type" name="viewport" content="width=device-width, initial-scale=1.0, charset=utf-8">
    <link href="../pages/reference/bootstrap.min.css" rel="stylesheet">
    <script src="../pages/reference/jquery.min.js"></script>
    <script src="../pages/reference/bootstrap.min.js"></script>
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
                    $questionID = $_REQUEST["questionID"];
//                    $optionArr = $_REQUEST["questionAnswer"];
                    //下面构建optionArr
                    $optionArr=array();
                    if(!empty($_REQUEST['optionsCheckboxA'])){
                        $optionArr[]=$_REQUEST['optionsCheckboxA'];
                    }
                    if(!empty($_REQUEST['optionsCheckboxB'])){
                        $optionArr[]=$_REQUEST['optionsCheckboxB'];
                    }
                    if(!empty($_REQUEST['optionsCheckboxC'])){
                        $optionArr[]=$_REQUEST['optionsCheckboxC'];
                    }
                    if(!empty($_REQUEST['optionsCheckboxD'])){
                        $optionArr[]=$_REQUEST['optionsCheckboxD'];
                    }
                    
                    $parentOpenID = $_REQUEST["parentOpenID"];
                    $parentID = getParentID($parentOpenID);


                    if ($parentID == false)
                    {
                        echo "Wrong Parent OpenID<br>";
                    }
                    else {
                        //$optionID = $_REQUEST["optionID"];
                        //$questionID = $_REQUEST["questionID"];
                        //$qList = getQuestion($questionnaireID);
                        //var_dump($qList);
                        //var_dump($questionnaireID);
                        //$qList = getQuestion(3);
                        //if ($qList == false) {
                        //    echo "确认失败<br>请重新确认";
                        //} else {
                            //$question = $qList->fetch_assoc();
                            //echo "<br>$question<br>";
                            //$questionID = $question["questionID"];
                            //echo "<br>$questionID<br>";
                            //$option = getOption($questionnaireID, $questionID);
                            //$option = getOption(3, 4);
                        $checkSubmit = checkNoticeAnswer($parentID,$questionnaireID);
                        if ($checkSubmit == true)
                        {
                            echo "已经提交过，答案已更新";
                        }
                        else
                        {
                            echo "提交答案";
                        }
                        $optionNum =  count($optionArr);
                        for($x=0; $x<$optionNum; $x++)
                        {
                            $optionID = $optionArr[$x];
                            //echo "<br>$optionID<br>";
                            $check = checkQuestionnaireAnswer($parentID,$questionnaireID,$questionID,$optionID);
                            //$check = checkNoticeAnswer(17,1);
                            if ($check==true)
                            {}
                            else {
                                $judge = insertAnswer($optionID, $questionID, $questionnaireID, $parentID, true);
                                if ($judge == false) {
                                    echo "提交失败<br>请重新提交";
                                    break;
                                }
                            }
                        }
                        //}
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