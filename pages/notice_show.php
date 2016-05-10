<?php
//此行代码用于避免iPhone上出现的乱码问题
header("Content-type: text/html; charset=utf-8");
?>
<!--需要由Oauth跳转过来，会自动带上code
// TODO  需要添加拉取信息的代码
<?php
// updated by Archimekai 2016年5月10日20:34:23 如果数据库中查不到这个家长，则引导他到  没有老师的家长注册界面
header("Content-type: text/html; charset=utf-8");
require_once "../util/commonFuns.php";
$questionnaireID=$_REQUEST['questionnaireID'];
$parentOpenID=getOpenIDFromREQUEST($_REQUEST);
?>
-->
<!DOCTYPE html>
<html>
<head>
    <title>通知</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, charset=utf-8">
    <link href="./reference/bootstrap.min.css" rel="stylesheet">
    <script src="./reference/jquery.min.js"></script>
    <script src="./reference/bootstrap.min.js"></script>
    
</head>
<body>
<?php require_once "share/navigation.php"?>

<script type="text/javascript">
    function creategroup()
    {
        var reader = new FileReader();
        reader.onload = function()
        {
            alert(this.result)
        };
        var f = document.getElementById("filePicker").files[0];
        reader.readAsText(f);
    }
</script>
<h3>
    <strong>通知展示</strong>
</h3>

<form role="form" action="../reg/confirmNotice.php" method="get" enctype="multipart/form-data">
    <!-- 用于在页面中保存questionnaireID-->
    <div class="form-group" style="display: none" >
        <label for="questionnaireID" class="col-sm-2 control-label">OpenID</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="questionnaireID" name="questionnaireID"
                   value=<?php echo $questionnaireID?>>
        </div>
    </div>

    <!-- 用于在页面中保存parentOpenID-->
    <div class="form-group" style="display: none" >
        <label for="parentOpenID" class="col-sm-2 control-label">OpenID</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="parentOpenID" name="parentOpenID"
                   value=<?php echo $parentOpenID?>>
        </div>
    </div>

    <div class="form-group" style="display:none;">
        <label for="question_group_name" class="col-sm-2 control-label">群&nbsp&nbsp&nbsp名</label>
        <div class="col-sm-10">
            <p class="form-control-static" id="question_group_name" name="question_group_name">这是来自您孩子所在班级的家长群</p>
        </div>
    </div>

    <div class="form-group">
        <label for="question_question_name" class="col-sm-2 control-label">通知名</label>
        <div class="col-sm-10">
            <p class="form-control-static" id ="question_question_name">本学期第二次家长会时间通知</p>
        </div>
    </div>
    <div class="form-group">
        <label for="question_desc" class="col-sm-2 control-label">内&nbsp&nbsp&nbsp容</label>
        <div class="col-sm-10">
            <p class="form-control-static" id="question_desc">我们周六晚来开家长会，请携带小本本来</p>
        </div>
    </div>
    <div>
        <button type="submit" class="btn btn-large btn-block">已阅</button>
    </div>

</form>

</body>
<script>
    //此代码用于在网页中显示通知内容
    var $jsondata=$.parseJSON('<?PHP
        require_once "../reg/showNotice.php";
        $noticeJson=showNotice($questionnaireID);
        echo $noticeJson;
    ?>');
    document.getElementById("question_desc").innerHTML=$jsondata.question[0].questionDescription;
    document.getElementById("question_question_name").innerHTML=$jsondata.title;
</script>
</html>