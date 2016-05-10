<?php
//此行代码用于避免iPhone上出现的乱码问题
header("Content-type: text/html; charset=utf-8");
?>
<?PHP
// 此段代码用于引导误点首页的用户
require_once "../util/commonFuns.php";
if(empty($_REQUEST['teacherOpenID']) && empty($_REQUEST['code'])){
    $goalURL=REMOTE_SERVER_IP . "/wxq/getCodeToRedirect.php";
    $redirectURL=genOAuthURL($goalURL);
    echo '<head> <meta http-equiv="refresh" content="0;url=' . $redirectURL . '"/></head>'; //重定向
    exit();
}
?>
<!--必须提供code或teacherOpenID
<?php
// 但如果提供了parentOpenID也能通过 TODO 这是一个bug
// 测试链接：http://121.201.14.58/pages/homepage.php?teacherOpenID=oG_07xPR4JEibyjiSzTjfphx6EWM&nsukey=XJh5yt7ka2L9rlCka2RJa0LxCHtacT4ZHsub%2Ftf31md%2FCUX1lNoTH6VIoiobhmEY2XbPEj%2BMUG5AxiJkvoGSlg%3D%3D
//var_dump($_REQUEST);
$teacherOpenID=getOpenIDFromREQUEST($_REQUEST);
// 此段代码用于拒绝家长查看页面
require_once "../dataBaseApi/dataBaseApis.php";
if(!checkTeacher($teacherOpenID)){
    require_once "../util/httpRedirect.php";
    http_redirect(0, 'parent_access_denied.php');
}
?>
-->

<!DOCTYPE html>
<html>
<head>
    <title>首页</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="./reference/bootstrap.min.css" rel="stylesheet">
    <script src="./reference/jquery.min.js"></script>
    <script src="./reference/bootstrap.min.js"></script>
    
</head>
<body>
<?php require_once "share/navigation.php"?>
<h3>
    <strong>历史通知</strong>
</h3>

<ul class="list-group" id="listNotice">
    <!--<li class="list-group-item" style="display: none" id="listNoticeBase">  </li> -->
    <li class="list-group-item"><strong>我的通知</a></strong><small>&nbsp&nbsp<a href="./notice_create.php?teacherOpenID=<?PHP  echo $teacherOpenID?>">新建通知</a></small></li>

</ul>

<!-- 群管理功能正在开发中-->
<ul class="list-group" style="display: none">
    <li class="list-group-item"><strong>我的群</a></strong><small>&nbsp&nbsp<a href="./group_create.html">新建群</a></small></li>
    <li class="list-group-item"><a href="./group_show_results.html">我是最新的活动群</a></li>
    <li class="list-group-item"><a href="./question_show_results.html">我是第二新的活动群</a></li>
    <li class="list-group-item">我是第三新的活动群</li>
</ul>

<ul class="list-group" id="listGroup">
    <li class="list-group-item"><strong>我的问卷</a></strong><small>&nbsp&nbsp<a href="questionnaire_create.php">新建问卷</a></small></li>

</ul>

</body>
<script>
    var $jsondata=$.parseJSON('<?PHP
        require_once "../reg/showAllQuestionnaire.php";
        $questionnaireJSON=showAllQuestionnaire($teacherOpenID);
        echo $questionnaireJSON;
        ?>');

    // 生成通知列表
    var notices=$jsondata.Notice;
    var noticeDOM=document.getElementById("listNotice"); // TODO　问题:innertext 有没有append？
    if(notices.length == 0){
        var newNode = document.createElement("li");
        newNode.innerHTML = "您还没有已创建的通知";
        newNode.setAttribute("class", "list-group-item");
        noticeDOM.appendChild(newNode);
    }else {
        for (x in notices) {
            //var htmlstr='<li class="list-group-item"><a href="notice_show.php">' + x + '</a></li>';
            var newNode = document.createElement("li");
            newNode.innerHTML = '<a href="notice_show_redirect.php?questionnaireID=' + notices[x].questionnaireID + '&teacherOpenID=<?php echo $teacherOpenID?> ">' + notices[x].title + '</a>' + '&nbsp&nbsp' + '<a href="notice_read_status.php?questionnaireID=' + notices[x].questionnaireID + '">' + '统计信息' + '</a>';
            // TODO 将统计信息和问卷合二为一
            // newNode.innerHTML = '<a href="notice_show_teacher.php?questionnaireID=' + notices[x].questionnaireID + '">' + notices[x].title + '</a>';
            newNode.setAttribute("class", "list-group-item");
            noticeDOM.appendChild(newNode);
        }
    }

    // 生成问卷列表
    var questionnaires=$jsondata.Questionnaire;
    var questionnairesDOM=document.getElementById("listGroup"); // TODO　问题:innertext 有没有append？
    if(questionnaires.length == 0){
        var newNode = document.createElement("li");
        newNode.innerHTML = "您还没有已创建的问卷";
        newNode.setAttribute("class", "list-group-item");
        questionnairesDOM.appendChild(newNode);

    }else {
        for (x in questionnaires) {
            //var htmlstr='<li class="list-group-item"><a href="notice_show.php">' + x + '</a></li>';
            var newNode = document.createElement("li");
            newNode.innerHTML = '<a href="questionnaire_show.php?questionnaireID=' + questionnaires[x].questionnaireID + '&teacherOpenID=<?php echo $teacherOpenID?>">' + questionnaires[x].title + '</a>' + '&nbsp&nbsp' + '<a href="questionnaire_statistics.php?questionnaireID=' + questionnaires[x].questionnaireID + '&teacherOpenID=<?php echo $teacherOpenID?>">' + '统计信息' + '</a>' + 
          ' ' + '<a href="../reg/showQuestionnaireSharePage.php?questionnaireID=' + questionnaires[x].questionnaireID + '">' + '分享问卷' + '</a>';
            newNode.setAttribute("class", "list-group-item");
            questionnairesDOM.appendChild(newNode);
        }
    }

</script>
</html>