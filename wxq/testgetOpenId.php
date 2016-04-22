<?php
/**
 * 测试通过：getOpenId函数成功返回
 * 测试链接：121.201.14.58/wxq/getOpenId.php
 * 测试链接：https://open.weixin.qq.com/connect/oauth2/authorize?appid=wx75de8782f8e4f99c&redirect_uri=121.201.14.58%2fwxq%2ftestgetOpenId.php&response_type=code&scope=snsapi_base#wechat_redirect
 * Created by PhpStorm.
 * User: wenkaiW10
 * Date: 4/18/2016
 * Time: 16:57
 */
require_once "../util/commonFuns.php";

foreach ($_REQUEST as $key => $value ){
    echo "key: " . $key;
    echo "   value: " . $value;
}

$code = $_REQUEST['code'];
echo $code;
$result = getOpenId($code);
echo "<br> Openid:";
echo $result;

?>

============测试信息结束  <br>

<a href="../pages/first_time_for_teacher.html">老师注册</a>
<br>
<a href="../pages/first_time_for_students.html">家长注册</a>
