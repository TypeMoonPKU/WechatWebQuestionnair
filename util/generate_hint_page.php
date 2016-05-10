<?php
/**
 * 此页面用于产生标题 + 描述格式的用户友好提示页面
 * 使用get方式提供两个参数：title , description
 * Created by PhpStorm.
 * User: wenkaiW10
 * Date: 5/10/2016
 * Time: 22:33
 */
if(empty($_REQUEST['title'])){
    $title = '';
}
$title = $_REQUEST['title'];
if(empty($_REQUEST['description'])){
    $description = '';
}
$description = $_REQUEST['description'];
?>
<!DOCTYPE html >
<html>
<head>
    <title><?php echo $title ?></title>
    <meta http-equiv="Content-Type" name="viewport" content="width=device-width, initial-scale=1.0,charset=utf-8">
    <link href="../pages/reference/bootstrap.min.css" rel="stylesheet">
    <script src="../pages/reference/jquery.min.js"></script>
    <script src="../pages/reference/bootstrap.min.js"></script>
</head>
<body >


<form role="form" method="get" action="../reg/parentRegWithStudent.php">
    <div class="form-group">
        <div class="col-sm-12" align="center">
            <br><pre><h1><?php echo $title ?></h1></pre>
            <p><?php echo $description ?>。</p>
        </div>
    </div>
</form>
</body>
</html>
