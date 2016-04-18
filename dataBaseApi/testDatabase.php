<?php
/**
 * Created by PhpStorm.
 * User: typemoon
 * Date: 2016/4/18
 * Time: 20:01
 */

//创建表单
function createTable()
{
    $servername = "localhost";
    $username = "typemoon";
    $password = "typemoonsql";

    $conn = new mysqli($servername, $username, $password);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    echo "Connected successfully";

    $sql = "CREATE DATABASE typemoon01";
    if ($conn->query($sql) === TRUE) {
        echo "Database created successfully";
    } else {
        echo "Error creating database: " . $conn->error;
    }

    $sql = "SELECT typemoon01";
    $conn->query($sql);

    $sql = file_get_contents('createTable.sql');
    $arr = explode(';', $sql);
    foreach ($arr as $value) {
        $conn->query($value.';');
    }
    $conn->close();
}

//加入新教师数据
function insertTeacher($name, $openID, $tpassword, $nickname)
{
    $dbname = "typemoon01";
    $servername = "localhost";
    $username = "typemoon";
    $password = "typemoonsql";
    $conn = new mysqli($servername, $username, $password, $dbname);
   // $conn = new mysqli($servername, $username, $password);
    $sql = "INSERT INTO teacherTable (teacherName, teacherOpenID, teacherID, teacherPassword, teacherNickName)
    VALUES ('$name', '$openID', 0, '$tpassword', '$nickname')";

    if ($conn->query($sql) === TRUE) {
        echo "New teacher record created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
    $conn->close();
}

//加入新学生数据
function insertStudent($name, $ID, $group, $teacherID)
{
    $dbname = "typemoon01";
    $servername = "localhost";
    $username = "typemoon";
    $password = "typemoonsql";
    $conn = new mysqli($servername, $username, $password, $dbname);
    // $conn = new mysqli($servername, $username, $password);
    $sql = "INSERT INTO studentTable (studentName, studentID, groupID, ownerteacherID)
    VALUES ('$name', '$ID', '$group', '$teacherID')";

    if ($conn->query($sql) === TRUE) {
        echo "New student record created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
    $conn->close();
}

//加入新家长数据，同时建立家长-学生关系
function insertParent($name, $openID, $tpassword, $nickname, $studentID)
{
    $dbname = "typemoon01";
    $servername = "localhost";
    $username = "typemoon";
    $password = "typemoonsql";
    $conn = new mysqli($servername, $username, $password, $dbname);
    // $conn = new mysqli($servername, $username, $password);
    $sql = "INSERT INTO parentTable (parentName, parentOpenID, parentID, parentPassword, parentNickName)
    VALUES ('$name', '$openID', 0, '$tpassword', '$nickname')";

    if ($conn->query($sql) === TRUE) {
        echo "New parent record created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $sql = "INSERT INTO parentStudentTable(parentID, studentID) 
      SELECT parentID, '$studentID' FROM parentTable
      WHERE parentOpenID='$openID'";
    if ($conn->query($sql) === TRUE) {
        echo "New parent-student record created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}

//加入新问卷数据
function insertQuestionnaire($title, $description, $type, $teacherID)
{
    $dbname = "typemoon01";
    $servername = "localhost";
    $username = "typemoon";
    $password = "typemoonsql";
    $conn = new mysqli($servername, $username, $password, $dbname);
    // $conn = new mysqli($servername, $username, $password);
    $sql = "INSERT INTO questionnaireTable (questionnaireID, title, questionnaireDescription, questionnaireType, ownerTeacherID)
    VALUES (0, '$title','$description','$type','$teacherID')";

    if ($conn->query($sql) === TRUE) {
        echo "New questionnaire record created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}

//createTable();
//insertTeacher('teacher2', 't2openID','123456','ttttt');
//insertStudent('student1','000001','001',1);
//insertStudent('student2','000002','001',1);
//insertParent('parent1','p1openID','123456','pppppp','000001');
insertQuestionnaire('questionnaire1','This is our first questionnaire.','N',1);