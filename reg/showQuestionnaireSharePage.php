<?php
/**
 * // TODO 标题应该是问卷的标题
 * 测试链接：http://121.201.14.58/reg/showQuestionnaireSharePage.php?questionnaireID=1
 * 可以用作单页提示信息的模板
 * 老师问卷创建成功后分享给家长，使家长答题的页面
 * 必须提供questionnaireID
 *
 * Created by PhpStorm.
 * User: Archimekai
 * Date: 5/9/2016
 * Time: 02:03
 */
require_once "../util/httpRedirect.php";
require_once "../util/commonFuns.php";
if(empty($_REQUEST['questionnaireID'])){
    http_redirect(0,"../pages/error/invalid_url.php");
    exit(0);
}
$questionnaireID=$_REQUEST['questionnaireID'];
//$questionnaireID=1;
$questionnaireShowURL="http://121.201.14.58/pages/questionnaire_show.php?questionnaireID=" . $questionnaireID;
$OAuthURL = "https://open.weixin.qq.com/connect/oauth2/authorize?appid=wx75de8782f8e4f99c&redirect_uri=" . urlencode($questionnaireShowURL) . "&response_type=code&scope=snsapi_base#wechat_redirect";
?>

<!DOCTYPE html >
<html>
<head>
    <title>问卷</title>
    <meta http-equiv="Content-Type" name="viewport" content="width=device-width, initial-scale=1.0,charset=utf-8">
    <link href="../pages/reference/bootstrap.min.css" rel="stylesheet">
    <script src="../pages/reference/jquery.min.js"></script>
    <script src="../pages/reference/bootstrap.min.js"></script>
    <script src="../pages/reference/bootstrap-theme.min.css"></script>
</head>
<body >


<form class="form-horizontal" role="form" method="get" action="../reg/parentRegWithStudent.php">
    <div class="form-group">
        <div class="col-sm-12" align="center">
            <br><pre><h1>欢迎回答问题</h1></pre>
            <p>请老师将此页面分享至微信群以供家长回答。</p>
            <div class="form-group" align="center">
                <!--<br>点击"进入"开始您的管理界面<br> -->
                <button class="btn btn-large btn-block" type="button" onclick="window.location.href='<?php echo $OAuthURL?>'">进入问题</button>

            </div>
</form>
</body>
</html>
