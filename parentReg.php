<?php
/**
 * 用于新家长的注册
 * Created by PhpStorm.
 * User: Archimekai
 * Date: 4/18/2016
 * Time: 23:37
 */

$parentName = $_REQUEST['parentName'];
$studentID = $_REQUEST['studentID'];
$parentOpenID = $_REQUEST['parentOpenID'];

// 首先检查学生是否存在
// TODO 最好能让家长确认下学生姓名
if(isValidStudentID()){
    insertParent($parentName,$parentOpenID,"null","null",$studentID);
    echo "数据录入成功";
}else{
    echo "数据库中未找到您提供的学号，请检查学号。";
}

