<!--
测试链接：http://121.201.14.58/pages/questionnaire_statistics.php
TODO 可以把选项和统计放在一起
-->
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/html">
<head>
    <title>问卷统计</title>
    <!--<meta http-equiv="refresh" content="1;url=./pageUnderConstruction.php">-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0, charset=utf-8">
    <link href="./reference/bootstrap.min.css" rel="stylesheet">
    <script src="./reference/jquery.min.js"></script>
    <script src="./reference/bootstrap.min.js"></script>
    <script src="./reference/bootstrap-theme.min.css"></script>
    <script src="./reference/highcharts.js"></script>
</head>
<body>
<nav class="navbar navbar-default navbar-fixed-top" role="navigation">
    <div class="navbar-header">

        <button type="button" class="navbar-toggle" data-toggle="collapse"
                data-target="#example-navbar-collapse">
            <span class="sr-only">切换导航</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="homepage.php">首页</a>
    </div>

    <div class="collapse navbar-collapse" id="example-navbar-collapse">
        <ul class="nav navbar-nav">
            <li class="dropdown">
                <a href="./question_home.html" class="dropdown-toggle" data-toggle="dropdown">
                    问卷 <b class="caret"></b>
                </a>
                <ul class="dropdown-menu">
                    <li><a href="questionnaire_create.php">创建问卷</a></li>
                    <li><a href="./question_history.html">历史问卷</a></li>
                    <li class="divider"></li>
                    <li><a href="./question_draft.html">问卷草稿</a></li>
                </ul>
            </li>
            <li class="dropdown">
                <a href="./notice_home.html" class="dropdown-toggle" data-toggle="dropdown">
                    通知 <b class="caret"></b>
                </a>
                <ul class="dropdown-menu">
                    <li><a href="notice_create.php">创建通知</a></li>
                    <li><a href="./notice_history.html">历史通知</a></li>
                    <li class="divider"></li>
                    <li><a href="./notice_draft.html">通知草稿</a></li>
                </ul>
            </li>
            <li class="dropdown">
                <a href="./group_home.html" class="dropdown-toggle" data-toggle="dropdown">
                    群 <b class="caret"></b>
                </a>
                <ul class="dropdown-menu">
                    <li><a href="./group_create.html">创建群</a></li>
                    <li><a href="./group_manage.html">管理群</a></li>
                    <li><a href="./group_join.html">加入群</a></li>
                    <li class="divider"></li>
                    <li><a href="./group_search.html">查找群</a></li>
                </ul>
            </li>
        </ul>
    </div>
</nav>

<br><br><br>
<form class="form-horizontal" role="form" action="./upload_question_answers.php" method="get" enctype="multipart/form-data" style="margin-left: 5px">
    <div class="form-group" style="display: none">
        <label for="question_group_name" class="col-sm-2 control-label">群&nbsp名</label>
        <div class="col-sm-10">
            <p class="form-control-static" id="question_group_name" name="question_group_name">这是来自您孩子所在班级的家长群</p>
        </div>
    </div>

    <div class="form-group">
        <label for="question_question_name" class="col-sm-2 control-label">问卷名</label>
        <div class="col-sm-10">
            <p class="form-control-static" id ="question_question_name">本学期第二次家长会时间协调调查表</p>
        </div>
    </div>
    <div class="form-group">
        <label for="question_desc" class="col-sm-2 control-label">描&nbsp述</label>
        <div class="col-sm-10">
            <p class="form-control-static"id="question_desc" name="question_desc">本学期第二次家长会将于下周召开</p>
        </div>
    </div>

    <div class="form-group">
        <label for="question_desc" class="col-sm-2 control-label">题目</label>
    <div class="col-sm-10">
        <p class="form-control-static">您可以来参加家长会的时间</p>
        <input type="checkbox"  name="ANSWER[]" id="optionsCheckboxA" value="optionA">A.周一下午<br>
        <input type="checkbox"  name="ANSWER[]" id="optionsCheckboxB" value="optionB">B.周二下午<br>
        <input type="checkbox"  name="ANSWER[]" id="optionsCheckboxC" value="optionC">C.周三下午<br>
        <input type="checkbox"  name="ANSWER[]" id="optionsCheckboxD" value="optionD">D.周四下午<br>
    </div>
    <div class="form-group" style="margin-left: 2px">
        <label for="question_desc" class="col-sm-2 control-label">未回答</label>
        <div class="col-sm-10">
            <p class="form-control-static"id="question_desc" name="question_desc">全部家长都已回答</p>
        </div>
    </div>
    <div class="form-group">
        <label for="question_desc" class="col-sm-2 control-label">&nbsp&nbsp&nbsp统计</label>
        <div id="highChartContainer"  class="col-sm-10" style="width:400px;height:300px;margin: 5px">
        </div>

    </div>
</div>
</form>
</body>
<script>
    // 用于画图的JavaScript
    $(document).ready(function () {
        var chart = {
            type: 'bar'
        };
        var title = {
            text: null
        };
//        var subtitle = {
//            text: 'Source: Wikipedia.org'
//        };
        var xAxis = {
            categories: ['周一下午', '周二下午', '周三下午', '周四下午'],
            title: {
                text: null
            }
        };
        var yAxis = {
            min: 0,
            title: {
                text: '人数',
                align: 'high'
            },
            labels: {
                overflow: 'justify'
            }
        };
//        var tooltip = {
//            valueSuffix: ' millions'
//        };
        var plotOptions = {
            bar: {
                dataLabels: {
                    enabled: true
                }
            }
        };
        var legend = {
            enabled: false
        };
//        var legend = {
//            layout: 'vertical',
//            align: 'right',
//            verticalAlign: 'top',
//            x: -40,
//            y: 100,
//            floating: true,
//            borderWidth: 1,
//            backgroundColor: ((Highcharts.theme && Highcharts.theme.legendBackgroundColor) || '#FFFFFF'),
//            shadow: true
//        };
        var credits = {
            enabled: false
        };

        var series= [{
            name: ' ',
            data: [45, 31, 23, 35]
        }
        ];

        var json = {};
        json.chart = chart;
        json.title = title;
//        json.subtitle = subtitle;
//        json.tooltip = tooltip;
        json.xAxis = xAxis;
        json.yAxis = yAxis;
        json.series = series;
        json.plotOptions = plotOptions;
        json.legend = legend;
        json.credits = credits;
        $('#highChartContainer').highcharts(json);
    })


</script>
</html>