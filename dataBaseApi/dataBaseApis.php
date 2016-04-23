<?php
/**
 * 用于操作数据库的主要函数
 * Created by PhpStorm.
 * User: typemoon
 * Date: 2016/4/18
 * Time: 20:02
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
    $sql = "INSERT INTO teacherTable (teacherName, teacherOpenID, teacherID, teacherPassword, teacherNickName) 
      VALUES ('$name', '$openID', 0, '$tpassword', '$nickname')";

    if ($conn->query($sql) === TRUE) {
        //echo "New teacher record created successfully";
        $conn->close();
        return true;
    } else {
        //echo "Error: " . $sql . "<br>" . $conn->error;
        $conn->close();
        return false;
    }
}

//加入新学生数据
function insertStudent($name, $ID, $group, $teacherID)
{
    $dbname = "typemoon01";
    $servername = "localhost";
    $username = "typemoon";
    $password = "typemoonsql";
    $conn = new mysqli($servername, $username, $password, $dbname);
    $sql = "INSERT INTO studentTable (studentName, studentID, groupID, ownerteacherID)
    VALUES ('$name', '$ID', '$group', '$teacherID')";

    if ($conn->query($sql) === TRUE) {
        // "New student record created successfully";
        $conn->close();
        return true;
    } else {
        //echo "Error: " . $sql . "<br>" . $conn->error;
        $conn->close();
        return false;
    }
}

//加入新家长数据，同时建立家长-学生关系
function insertParent($name, $openID, $studentID, $tpassword, $nickname)
{
    $dbname = "typemoon01";
    $servername = "localhost";
    $username = "typemoon";
    $password = "typemoonsql";
    $conn = new mysqli($servername, $username, $password, $dbname);
    $sql1 = "INSERT INTO parentTable (parentName, parentOpenID, parentID, parentPassword, parentNickName)
    VALUES ('$name', '$openID', 0, '$tpassword', '$nickname')";

    if ($conn->query($sql1) === TRUE) {
        //echo "New parent record created successfully";
        $sql2 = "INSERT INTO parentStudentTable(parentID, studentID) 
       SELECT parentID, '$studentID' FROM parentTable
       WHERE parentOpenID='$openID'";
        if ($conn->query($sql2) === TRUE) {
            //echo "New parent-student record created successfully";
            $conn->close();
            return true;
        } else {
            //echo "Error: " . $sql . "<br>" . $conn->error;
            $conn->close();
            return false;
        }
    } else {
        //echo "Error: " . $sql . "<br>" . $conn->error;
        $conn->close();
        return false;
    }
}

//加入新问卷数据
function insertQuestionnaire($title, $description, $type, $teacherID)
{
    $dbname = "typemoon01";
    $servername = "localhost";
    $username = "typemoon";
    $password = "typemoonsql";
    $conn = new mysqli($servername, $username, $password, $dbname);
    $sql = "INSERT INTO questionnaireTable (questionnaireID, title, questionnaireDescription, questionnaireType, ownerTeacherID)
    VALUES (0, '$title','$description','$type','$teacherID')";

    if ($conn->query($sql) === TRUE) {
        //echo "New questionnaire record created successfully";
        //return true;
        $sql = "SELECT LAST_INSERT_ID()";
        $lastID = $conn->query($sql);
        $result = $lastID->fetch_assoc()["LAST_INSERT_ID()"];
        $conn->close();
        return $result;
    } else {
        //echo "Error: " . $sql . "<br>" . $conn->error;
        $conn->close();
        return false;
    }
}

//加入新问题数据
function insertQuestion($questionnaireID, $type, $description)
{
    $dbname = "typemoon01";
    $servername = "localhost";
    $username = "typemoon";
    $password = "typemoonsql";
    $conn = new mysqli($servername, $username, $password, $dbname);
    $sql = "INSERT INTO itemTable (questionID, questionnaireID, questionType, questionDescription)
    VALUES (0,'$questionnaireID','$type','$description')";

    if ($conn->query($sql) === TRUE) {
        //echo "New question record created successfully";
        $sql = "SELECT LAST_INSERT_ID()";
        $lastID = $conn->query($sql);
        $result = $lastID->fetch_assoc()["LAST_INSERT_ID()"];
        $conn->close();
        return $result;
        //return true;
    } else {
        //echo "Error: " . $sql . "<br>" . $conn->error;
        $conn->close();
        return false;
    }
}

//加入问题新选项数据
function insertOption($questionID, $questionnaireID, $description)
{
    $dbname = "typemoon01";
    $servername = "localhost";
    $username = "typemoon";
    $password = "typemoonsql";
    $conn = new mysqli($servername, $username, $password, $dbname);
    $sql = "INSERT INTO optionTable (optionID, questionID, questionnaireID, optionDescription)
    VALUES (0,'$questionID','$questionnaireID','$description')";

    if ($conn->query($sql) === TRUE) {
        //echo "New option record created successfully";
        $conn->close();
        return true;
    } else {
        //echo "Error: " . $sql . "<br>" . $conn->error;
        $conn->close();
        return false;
    }
}

//加入新回答数据
function insertAnswer($optionID, $questionID, $questionnaireID, $parentID, $select)
{
    $dbname = "typemoon01";
    $servername = "localhost";
    $username = "typemoon";
    $password = "typemoonsql";
    $conn = new mysqli($servername, $username, $password, $dbname);
    $sql = "INSERT INTO answerTable (optionID, questionID, questionnaireID, parentID, selected)
    VALUES ('$optionID','$questionID','$questionnaireID','$parentID','$select')";

    if ($conn->query($sql) === TRUE) {
        //echo "New answer record created successfully";
        $conn->close();
        return true;
    } else {
        //echo "Error: " . $sql . "<br>" . $conn->error;
        $conn->close();
        return false;
    }


}

function updateAccess($token, $time)
{
    $dbname = "typemoon01";
    $servername = "localhost";
    $username = "typemoon";
    $password = "typemoonsql";
    $conn = new mysqli($servername, $username, $password, $dbname);
    $sql = "UPDATE accessTable SET accessToken=$token, time=$time";

    if ($conn->query($sql) === TRUE) {
        //echo "Update Success.";
        $conn->close();
        return true;
    } else {
        //echo "Error: " . $sql . "<br>" . $conn->error;
        $conn->close();
        return false;
    }
}


//获得选择某个选项的人数
function getNumber($optionID, $questionID, $questionnaireID)
{
    $dbname = "typemoon01";
    $servername = "localhost";
    $username = "typemoon";
    $password = "typemoonsql";
    $conn = new mysqli($servername, $username, $password, $dbname);
    $sql = "SELECT COUNT(*) FROM answerTable
        WHERE optionID=$optionID AND questionID=$questionID
         AND questionnaireID=$questionnaireID AND selected=true";

    $number=$conn->query($sql);
    $result = $number->fetch_assoc()["COUNT(*)"];
    //echo "$result";
    $conn->close();
    return $result;
}

//获得回答过某个问郑的学生ID
function getPeopleSelected($questionnaireID)
{
    $dbname = "typemoon01";
    $servername = "localhost";
    $username = "typemoon";
    $password = "typemoonsql";
    $conn = new mysqli($servername, $username, $password, $dbname);
    $sql = "SELECT studentName FROM studentTable WHERE studentID IN
      (SELECT DISTINCT studentID FROM parentStudentTable
        WHERE parentID IN 
        (SELECT DISTINCT parentID FROM answerTable
        WHERE questionnaireID=$questionnaireID))";
    
    /*$sql = "SELECT DISTINCT studentID FROM parentStudentTable
        WHERE parentID IN 
        (SELECT DISTINCT parentID FROM answerTable
        WHERE questionnaireID=$questionnaireID)";*/
    $result=$conn->query($sql);
    //if ($result->num_rows > 0) {
    //    while ($row = $result->fetch_assoc()) {
    //        echo "<br> studentID: " . $row["studentID"];
    //    }
    //}
    //else{
    //    echo "0 people did this questionnaire.";
    //}
    $conn->close();
    return $result;
}

//获得没有回答某个问卷的人ID
function getPeopleNotSelected($questionnaireID)
{
    $dbname = "typemoon01";
    $servername = "localhost";
    $username = "typemoon";
    $password = "typemoonsql";
    $conn = new mysqli($servername, $username, $password, $dbname);
    $sql = "SELECT studentName FROM studentTable WHERE studentID IN
      (SELECT DISTINCT PS.studentID FROM parentStudentTable PS, studentTable S
       WHERE PS.studentID = S.studentID AND S.ownerTeacherID =
      (SELECT ownerTeacherID FROM questionnaireTable WHERE questionnaireID = $questionnaireID)
      AND PS.studentID NOT IN (
          SELECT DISTINCT PS.studentID
          FROM parentStudentTable PS
          WHERE parentID IN
                (SELECT DISTINCT parentID
                 FROM answerTable
                 WHERE questionnaireID = $questionnaireID)))";
    
    /*$sql = "SELECT DISTINCT PS.studentID FROM parentStudentTable PS, studentTable S
       WHERE PS.studentID = S.studentID AND S.ownerTeacherID =
      (SELECT ownerTeacherID FROM questionnaireTable WHERE questionnaireID = $questionnaireID)
      AND PS.studentID NOT IN (
          SELECT DISTINCT PS.studentID
          FROM parentStudentTable PS
          WHERE parentID IN
                (SELECT DISTINCT parentID
                 FROM answerTable
                 WHERE questionnaireID = $questionnaireID)
        )";*/

    $result = $conn->query($sql);
    //if ($result->num_rows > 0) {
    //    while ($row = $result->fetch_assoc()) {
    //        echo "<br> studentID: " . $row["studentID"];
    //    }
    //}
    //else {
    //    echo "0 people didn't do this questionnaire.";
    //}
    $conn->close();
    return $result;
}

function checkTeacher($teacherOpenID)
{
    $dbname = "typemoon01";
    $servername = "localhost";
    $username = "typemoon";
    $password = "typemoonsql";
    $conn = new mysqli($servername, $username, $password, $dbname);
    $sql = "SELECT teacherOpenID FROM teacherTable
        WHERE teacherOpenID='$teacherOpenID'";

    $result=$conn->query($sql);
    if ($result->num_rows > 0) {
        //echo "true";
        $conn->close();
        return true;
    }
    else {
        $conn->close();
        return false;
    }
}

function checkParent($parentOpenID)
{
    $dbname = "typemoon01";
    $servername = "localhost";
    $username = "typemoon";
    $password = "typemoonsql";
    $conn = new mysqli($servername, $username, $password, $dbname);
    $sql = "SELECT parentOpenID FROM parentTable
        WHERE parentOpenID='$parentOpenID'";

    $result=$conn->query($sql);
    if ($result->num_rows > 0) {
        //echo "true";
        $conn->close();
        return true;
    }
    else {
        //echo "false";
        $conn->close();
        return false;
    }
}

function checkStudent($studentID)
{
    $dbname = "typemoon01";
    $servername = "localhost";
    $username = "typemoon";
    $password = "typemoonsql";
    $conn = new mysqli($servername, $username, $password, $dbname);
    $sql = "SELECT studentID FROM studentTable
        WHERE studentID='$studentID'";

    $result=$conn->query($sql);
    if ($result->num_rows > 0) {
        //echo "true";
        $conn->close();
        return true;
    }
    else {
        //echo "false";
        $conn->close();
        return false;
    }
}

function getTeacherID($teacherOpenID)
{
    $dbname = "typemoon01";
    $servername = "localhost";
    $username = "typemoon";
    $password = "typemoonsql";
    $conn = new mysqli($servername, $username, $password, $dbname);
    $sql = "SELECT teacherID FROM teacherTable
        WHERE teacherOpenID='$teacherOpenID'";

    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        //echo "true";
        $ID = $result->fetch_assoc()["teacherID"];
        $conn->close();
        return $ID;
    }
    else {
        //echo "false";
        $conn->close();
        return false;
    }
}

//获得
//createTable();
//insertTeacher('teacher2', 't2openID','123456','ttttt');
//insertStudent('student1','000001','001',1);
//insertStudent('student2','000002','001',1);
//insertParent('p','p1openID','123456','pppppp','000001');
//insertQuestionnaire('questionnaire1','This is our first questionnaire.','N',1);
//insertQuestion(1,'S','This is the first question of our first questionnaire.');
//insertOption(1,1,'This is the first option of our first question.');
//insertAnswer(1,1,1,1,1);
//getPeopleSelected(1);
//getPeopleNotSelected(1);
//checkTeacher('t2openID');
//checkParent('p1OpenID');
//checkParent('p1openID');