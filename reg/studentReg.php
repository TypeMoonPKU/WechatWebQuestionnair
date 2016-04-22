<?php
/**
 * 用于学生的注册工作
 * 、
 * 提供数据：post方式提供，csv文件，teacherID，班号 classNum
 * 文件中用两列，第一列是studentName, 第二列是studentID
 *
 * Created by PhpStorm.
 * User: wenkaiW10
 * Date: 4/19/2016
 * Time: 22:51
 */

//读取csv文件
//对每一行，进行添加到数据库的操作
//返回操作的情况：表中有几个学生，排除重复后有几个学生，成功注册几个学生

require_once "../dataBaseApi/dataBaseApis.php";

//$file = $_REQUEST["**.csv"];
//$teacherID = $_REQUEST["teacherID"];

//$file = $_POST["**.csv"];
$file = fopen('../pages/files/StudentRegTest.csv','r');
//$teacherID = $_POST["teacherID"];
$teacherID = 1;
$total = 0;
$alreadyExists = 0;
$newStudent = 0;
$addFailed = 0;

while ($data = fgetcsv($file)) { //每次读取CSV里面的一行内容
    $total++;
    $studentName = $data[0];
    $studentID = $data[1];
    if ($studentName==""){
        echo "StudentName can't be empty!<br>";
        $addFailed++;
        continue;
    }
    elseif ($studentID==""){
        echo "StudentID can't be empty!<br>";
        $addFailed++;
        continue;
    }
    else {
        if (checkStudent($studentID)==true)
            $alreadyExists++;
        else {
            //$rtnVal = insertStudent($studentName, $studentID, "null", "teacherID"); //group暂时设置为null
            $rtnVal = insertStudent($studentName, $studentID, "null", $teacherID); //group暂时设置为null
            if ($rtnVal == true) {
                $newStudent++;
            } else {
                $addFailed++;
            }
        }
    }
}
//fclose($file);

//$classNum = $_POST["classNum"];

echo "共提交{$total}名学生信息<br>";
echo "{$alreadyExists}名学生已注册<br>";
echo "{$newStudent}名学生注册成功<br>";
echo "{$addFailed}名学生注册失败<br>";
