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

//最后，把这些信息存储成cookie
// TODO 如果 设置为cookie，需要考虑过期时间，以及如果用户没有cookie的话引导用户设置cookie
setcookie("OpenIDCookie", $result, time()+60*60*24*30 );

?>

============测试信息结束  <br>

<h3><a href=<?php $url = "../pages/first_time_for_teacher.php?teacherOpenID=" . $result;
    echo $url;
    ?>>老师注册</a></h3>
<br>
<h3><a href=<?php $url = "../pages/first_time_for_students.php?teacherOpenID=" . $result . "&parentOpenID=" ;
    echo $url;
    ?>>家长注册。必须先有老师注册之后才能用，这里的链接是无法使用的。</a></h3>
<br>
<h3><a href="../pages/showCookie.html">显示cookie</a></h3>
