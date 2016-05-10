<!--
测试链接：http://121.201.14.58/pages/questionnaire_statistics.php
TODO 可以把选项和统计放在一起
-->
<?php
if(empty($_REQUEST['questionnaireID'])){
    require_once "../util/httpRedirect.php";
    http_redirect(0,"invalid_url.php");
}
$questionnaireID=$_REQUEST['questionnaireID'];
?>
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/html">
<head>
    <title>问卷统计</title>
    <!--<meta http-equiv="refresh" content="1;url=./pageUnderConstruction.php">-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0, charset=utf-8">
    <link href="./reference/bootstrap.min.css" rel="stylesheet">
    <script src="./reference/jquery.min.js"></script>
    <script src="./reference/bootstrap.min.js"></script>
    
    <script src="./reference/highcharts.js"></script>
</head>
<body>
<?php require_once "share/navigation.php"?>
<br><br><br>
<form role="form" action="./upload_question_answers.php" method="get" enctype="multipart/form-data">
    <div class="form-group" style="display: none">
        <label for="question_group_name" class="col-sm-2 control-label">群&nbsp名</label>
        <div class="col-sm-10">
            <p class="form-control-static" id="question_group_name">这是来自您孩子所在班级的家长群</p>
        </div>
    </div>

    <div class="form-group">
        <label for="question_question_name" class="col-sm-2 control-label">问卷名</label>
        <div class="col-sm-10">
            <p class="form-control-static" id ="questionnaireTitle">正在加载问卷名</p>
        </div>
    </div>
    <div class="form-group">
        <label for="question_desc" class="col-sm-2 control-label">描&nbsp述</label>
        <div class="col-sm-10">
            <p class="form-control-static" id="questionnaireDescription">正在加载问卷描述</p>
        </div>
    </div>

    <div class="form-group">
        <label for="question_desc" class="col-sm-2 control-label">题目</label>
        <div class="col-sm-10">
            <p class="form-control-static" id="questionDescription">您可以来参加家长会的时间</p>
            <input type="checkbox"  name="optionsCheckboxA" id="optionsCheckboxA" value="optionA"><label for="optionsCheckboxA" id="optionsCheckboxALabel">A.正在加载</label><br>
            <input type="checkbox"  name="optionsCheckboxB" id="optionsCheckboxB" value="optionB"><label for="optionsCheckboxB" id="optionsCheckboxBLabel">B.正在加载</label><br>
            <input type="checkbox"  name="optionsCheckboxC" id="optionsCheckboxC" value="optionC"><label for="optionsCheckboxC" id="optionsCheckboxCLabel">C.正在加载</label><br>
            <input type="checkbox"  name="optionsCheckboxD" id="optionsCheckboxD" value="optionD"><label for="optionsCheckboxD" id="optionsCheckboxDLabel">D.正在加载</label><br>
        </div>
        <button type="submit" class="btn btn-large btn-block" style="display: none">确认提交</button>

    </div>
    <div class="form-group" style="margin-left: 2px">
        <label for="question_desc" class="col-sm-2 control-label">还未回答的家长</label>
        <div class="col-sm-10">
            <p class="form-control-static" id="question_desc">全部家长都已回答</p>
        </div>
    </div>
    <div class="form-group">
        <label for="question_desc" class="col-sm-2 control-label">回答统计</label>
        <div id="highChartContainer"  class="col-sm-10" style="width:400px;height:300px;margin: 5px">
        </div>

    </div>
</form>
</body>
<?php require_once "include_js_set_questionnaire.php"?>
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