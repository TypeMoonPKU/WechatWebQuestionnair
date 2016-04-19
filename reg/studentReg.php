<?php
/**
 * 用于学生的注册工作
 * 、
 * 提供数据：post方式提供，csv文件，teacherID，班号 classNum
 * 文件中用两列，第一列是studentName, 第二列是studentID
 * Created by PhpStorm.
 * User: wenkaiW10
 * Date: 4/19/2016
 * Time: 22:51
 */

//读取csv文件
//对每一行，进行添加到数据库的操作
//返回操作的情况：表中有几个学生，排除重复后有几个学生，成功注册几个学生