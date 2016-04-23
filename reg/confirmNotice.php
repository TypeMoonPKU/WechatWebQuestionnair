
<!DOCTYPE html >
<html >
<head>
    <title>问卷成功</title>
    <meta http-equiv="Content-Type" name="viewport" content="width=device-width, initial-scale=1.0, charset=utf-8">
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
                    $parentOpenID = $_REQUEST["parentOpenID"];
                    $parentId = getParentID($parentOpenID);
                    if ($parentID == false)
                    {
                        echo "Wrong Parent OpenID<br>";
                    }
                    else {
                        //$optionID = $_REQUEST["optionID"];
                        //$questionID = $_REQUEST["questionID"];
                        $qList = getQuestion($questionnaireID);
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
                            $judge = insertAnswer($optionID, $questionID, $questionnaireID, $parentID, true);
                            if ($judge == false) {
                                echo "确认失败<br>请重新确认";
                            } else {
                                echo "确认成功";
                            }
                        }
                    }
                    ?>





                </h1></pre>


        </div>
    </div>

</form>
</body>
