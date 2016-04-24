<?php
//此行代码用于避免iPhone上出现的乱码问题
header("Content-type: text/html; charset=utf-8");
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


<form class="form-horizontal" role="form" method="get" action="../reg/parentRegWithStudent.php">
    <div class="form-group">
        <div class="col-sm-12" align="center">
            <pre><h1>
                    <!-- 通用提示页面代码 part1 结束-->

<?php
/**
 * 用于完成家长的注册工作
 * 需要提供：parentName, parentOpenID, studentID
 * 采用post方法
 * Created by PhpStorm.
 * User: wenkaiW10
 * Date: 4/19/2016
 * Time: 22:51
 */
require_once "../dataBaseApi/dataBaseApis.php";
/*foreach ($_REQUEST as $key => $value ){
    echo "key: " . $key;
    echo "   value: " . $value;
}*/
$parentName = $_REQUEST["parentName"];
$parentOpenID = $_REQUEST["parentOpenID"];
$studentID = $_REQUEST["studentID"];
if ($parentName==""){
    echo "ParentName can't be empty!<br>";
}
elseif ($parentOpenID==""){
    echo "ParentOpenID can't be empty!<br>";
}
else {
    if (checkParent($parentOpenID)==true)
        //echo "注册失败，用户已注册<br>";
        echo "用户已注册<br>";
    else {
        $rtnVal = insertParent($parentName, $parentOpenID, $studentID, "null", "null");
        //$rtnVal = insertParent('p','p1openID','123456','pppppp','000001');
        if ($rtnVal == true) {
            echo "注册成功<br>";
        } else {
            echo "注册失败<br>";
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
