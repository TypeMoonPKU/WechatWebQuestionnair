<?php
/**
 * 用于完成老师注册的逻辑
 *
 * 在注册界面上，老师点击注册后，将会跳转到这个界面
 * 信息以get的方式提供两个字段：老师名称 teacherName   老师的openId
 * 用这两个字段完成注册工作。
 * Created by PhpStorm.
 * User: wenkaiW10
 * Date: 4/19/2016
 * Time: 22:45
 */

$teacherName = $_REQUEST["teacherName"];
$teacherOpenId = $_REQUEST["teacherOpenId"];

insertTeacher($teacherName,$teacherOpenId,"null","null");

// 判断操作是否成功
echo "注册成功";
echo "注册失败";