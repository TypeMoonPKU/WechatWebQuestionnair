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
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/html">
<head>
    <title>问卷统计</title>
    <!--<meta http-equiv="refresh" content="1;url=./pageUnderConstruction.php">-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
    <!-- 用于在页面中保存questionID-->
    <div class="form-group" style="display: none" >
        <label for="questionID" class="col-sm-2 control-label">questionID</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="questionID" name="questionID"
                   value='待设定'>
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
            <p id="optionsCheckboxASelectedParents">正在加载</p>
            <input type="checkbox"  name="optionsCheckboxB" id="optionsCheckboxB" value="optionB"><label for="optionsCheckboxB" id="optionsCheckboxBLabel">B.正在加载</label><br>
            <p id="optionsCheckboxBSelectedParents">正在加载</p>
            <input type="checkbox"  name="optionsCheckboxC" id="optionsCheckboxC" value="optionC"><label for="optionsCheckboxC" id="optionsCheckboxCLabel">C.正在加载</label><br>
            <p id="optionsCheckboxCSelectedParents">正在加载</p>
            <input type="checkbox"  name="optionsCheckboxD" id="optionsCheckboxD" value="optionD"><label for="optionsCheckboxD" id="optionsCheckboxDLabel">D.正在加载</label><br>
            <p id="optionsCheckboxDSelectedParents">正在加载</p>
        </div>
        <button type="submit" class="btn btn-large btn-block" style="display: none">确认提交</button>

    </div>
    <div class="form-group" style="margin-left: 2px">
        <label for="students_not_answered" class="col-sm-2 control-label">还未回答的学生</label>
        <div class="col-sm-10">
            <p class="form-control-static" id="students_not_answered">正在加载</p>
        </div>
    </div>
    <div class="form-group">
        <label for="question_desc" class="col-sm-2 control-label">回答统计</label>
        <div id="highChartContainer"  class="col-sm-10" style="width:400px;height:300px;margin: 5px">
        </div>

    </div>
</form>
</body>
<?php require "include_js_set_questionnaire.php"?>
<!-- TODO 为了保持数据一致性，这个页面中应该全部使用下面的JavaScript来设置-->
<script>
    // 用于修改未回答家长的信息
    jsonStatsData = '<?php
        require_once "../reg/questionnaireStats.php";
        $jsonStatsData = questionnaireNotNoticeStats($questionnaireID);
        echo $jsonStatsData;
    ?>';
    jsonStatsDataParsed = $.parseJSON(jsonStatsData);
    // TODO 最好能同时显示学生和家长
    //设置未回答的家长
    if(jsonStatsDataParsed.notSelected.students.length == 0){
        document.getElementById('students_not_answered').innerHTML = '所有学生都已回答';
    }else{
        var notSelectedStudentNamesString = '';
        for(x in jsonStatsDataParsed.notSelected.students){
            notSelectedStudentNamesString += (jsonStatsDataParsed.notSelected.students[x] + ' ');
        }
        document.getElementById('students_not_answered').innerHTML = notSelectedStudentNamesString;
    }

    // 用于设置页面中显示的回答家长项
    function setDocumentAnsweredParents(optionSelectedParentFieldDOMid, optionSelectedParentsArray){
        var DOMElement = document.getElementById(optionSelectedParentFieldDOMid);
        if(optionSelectedParentsArray.length == 0){
            DOMElement.innerHTML = '没有家长选择此选项';
        }else{
            var SelectedParentNamesString = '选择家长：';
            for(x in optionSelectedParentsArray){
                SelectedParentNamesString += (optionSelectedParentsArray[x] + ' ');
            }
            DOMElement.innerHTML = SelectedParentNamesString;
        }
    }

    setDocumentAnsweredParents('optionsCheckboxASelectedParents',jsonStatsDataParsed.optionArr[0].selectedPeople);
    setDocumentAnsweredParents('optionsCheckboxBSelectedParents',jsonStatsDataParsed.optionArr[1].selectedPeople);
    setDocumentAnsweredParents('optionsCheckboxCSelectedParents',jsonStatsDataParsed.optionArr[2].selectedPeople);
    setDocumentAnsweredParents('optionsCheckboxDSelectedParents',jsonStatsDataParsed.optionArr[3].selectedPeople);

    // 用于修改图表信息
    var chartCategories = [jsonStatsDataParsed.optionArr[0].optionDescription,
        jsonStatsDataParsed.optionArr[1].optionDescription,
        jsonStatsDataParsed.optionArr[2].optionDescription,
        jsonStatsDataParsed.optionArr[3].optionDescription
    ];
    var chartSelectedPeopleCount = [jsonStatsDataParsed.optionArr[0].selectedPeople.length,
        jsonStatsDataParsed.optionArr[1].selectedPeople.length,
        jsonStatsDataParsed.optionArr[2].selectedPeople.length,
        jsonStatsDataParsed.optionArr[3].selectedPeople.length
    ]

</script>
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
        xAxis.categories = chartCategories;
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
        series[0].data = chartSelectedPeopleCount;

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