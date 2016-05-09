<?php
/**
 * Created by PhpStorm.
 * User: Archimekai
 * Date: 5/8/2016
 * Time: 16:31
 *
 */
// 注意：必须提供teacherOpenID
// 问题在于，这个页面必须确保所有的页面都有teacherOpenID

// updated by Archimekai 2016年5月9日22:58:40，删去了很多没有实现的功能，简化了菜单栏

if(empty($teacherOpenID)){
    $teacherOpenID = '';
}
?>
<nav class="navbar navbar-default navbar-fixed-top" role="navigation">
    <div class="navbar-header">

        <button type="button" class="navbar-toggle" data-toggle="collapse"
                data-target="#example-navbar-collapse">
            <span class="sr-only">切换导航</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="homepage.php?teacherOpenID=<?PHP echo $teacherOpenID ?>">首页</a>
    </div>

    <div class="collapse navbar-collapse" id="example-navbar-collapse">
        <ul class="nav navbar-nav">
            <li><a href="notice_create.php?teacherOpenID=<?PHP echo $teacherOpenID ?>">创建通知</a></li>
            <li><a href="questionnaire_create.php?teacherOpenID=<?PHP echo $teacherOpenID ?>">创建问卷</a></li>
        </ul>
    </div>
</nav>