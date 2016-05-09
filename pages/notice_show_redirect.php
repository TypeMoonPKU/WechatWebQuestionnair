<?php
require_once "../util/setHeaderToUTF8.php" // 通过使用这个程序避免乱码的问题
?>

<?php
// 测试链接：http://localhost:63342/WechatWebQuestionnair/pages/notice_show_redirect.php?questionnaireID=1
// 测试链接：http://localhost:63342/WechatWebQuestionnair/pages/notice_show_redirect.php?questionnaireID=1&parentOpenID=2
/**
 * Created by PhpStorm.
 * User: Archimekai
 * Date: 5/8/2016
 * Time: 15:58
 */
//此页面可以分享到微信群供家长点击
// 用于协助跳转，主要用来提供给老师看，当然，最优的交互逻辑是同一个页面，区分老师和家长显示，但是
// 现在的技术有限
// 必须提供的参数：questionnaireID
// 可选的参数：parentOpenID,openID
// 如果parentOpenID或者openID不存在，将会重定向至OAuth以获取openID
// 用途：此链接是老师分享到朋友圈或者微信群的链接，区分老师和家长，如果没有openid的话应该跳转
// 需要从来访的链接来分辨
require_once "../util/httpRedirect.php";
if(empty($_REQUEST['questionnaireID'])){
    http_redirect(0,"./error/invalid_url.php");
    exit(0);
}else{
    $questionnaireID=$_REQUEST['questionnaireID'];
}
if(!empty($_REQUEST['parentOpenID'])){
    $parentOpenID = $_REQUEST['parentOpenID'];
}elseif(!empty($_REQUEST['OpenID'])){
    //var_dump($_REQUEST);
    // TODO 需要判定到底是老师访问还是家长访问
    $parentOpenID = $_REQUEST['OpenID'];
}elseif(!empty($_REQUEST['teacherOpenID'])){
    $parentOpenID = null;
}else{
    // 需要引导用户进行跳转:引导的条件是：parentOpenID, OpenID, teacherOpenID都不存在
    // 目前这个链接只是用来测试
    $redirect_url = 'http://' . REMOTE_SERVER_IP . '/pages/notice_show_redirect.php?questionnaireID=' . $_REQUEST['questionnaireID'];
//    http_OAuth_redirect(0,"http://" . REMOTE_SERVER_IP . "/test/dumpREQUEST.php?questionnaireID=" . $_REQUEST['questionnaireID']);
    http_OAuth_redirect(0,$redirect_url);
}
// 确定button的显示属性，但是因为始终会带有teacherOpenID,所以这个判断目前没用
//if(!empty($_REQUEST['teacherOpenID'])){
//    $readButtonDisplay='none';
//}else{
//    $readButtonDisplay='inline';
//}
$readButtonDisplay = 'inline'; //一直显示已阅，但是在阅读button那里做跳转
// 根据parentOpenID来判断
if(!empty($parentOpenID)){
    $shareHintDisplay='none';
}else{
    $shareHintDisplay='inline';
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>通知</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, charset=utf-8">
    <link href="./reference/bootstrap.min.css" rel="stylesheet">
    <link href="./reference/bootstrap-theme.min.css" rel="stylesheet"/>
    <script src="./reference/jquery.min.js"></script>
    <script src="./reference/bootstrap.min.js"></script>
</head>
<body>
<?php require "./share/navigation.php"?>
<form class="form-horizontal" role="form" action="../reg/confirmNotice.php" method="get" enctype="multipart/form-data">
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

    <!-- 暂时不显示群名-->
    <div class="form-group" style="display:none;">
        <label for="question_group_name" class="col-sm-2 control-label">群&nbsp&nbsp&nbsp名</label>
        <div class="col-sm-10">
            <p class="form-control-static" id="question_group_name" >这是来自您孩子所在班级的家长群</p>
        </div>
    </div>
    <br>
    <br>
    <br>
    <div class="form-group">
        <label for="question_question_name" class="col-sm-2 control-label">通知名</label>
        <div class="col-sm-10">
            <p class="form-control-static" id ="question_question_name" >本学期第二次家长会时间通知</p>
        </div>
    </div>
    <div class="form-group">
        <label for="question_desc" class="col-sm-2 control-label">内&nbsp&nbsp&nbsp容</label>
        <div class="col-sm-10">
            <p class="form-control-static" id="question_desc" >我们周六晚来开家长会，请携带小本本来</p>
        </div>
    </div>
    <div style="display: <?PHP echo $readButtonDisplay?>">
        <button type="submit" class="btn btn-large btn-block">已阅</button>
    </div>
    <div style="display: <?PHP echo $shareHintDisplay?>">
        <p>请点击右上角按钮，将本页面分享至需要通知的微信群。</p>
    </div>
</form>

</body>
<script >
    //此代码用于在网页中显示通知内容
    var $jsondata=$.parseJSON('<?PHP
        require_once "../reg/showNotice.php";
        $noticeJson=showNotice($questionnaireID);
        echo $noticeJson;
        ?>');
    document.getElementById("question_desc").innerHTML=$jsondata.question[0].questionDescription;
    document.getElementById("question_question_name").innerHTML=$jsondata.title;
    document.title= "通知：" + $jsondata.title;
    //alert($jsondata.questionnaireDescription);
    //alert($jsondata.title);
</script>
</html>






