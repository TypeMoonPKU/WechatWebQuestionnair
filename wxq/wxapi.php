<?php
/**
 * Created by PhpStorm.
 * User: Archimekai
 * Date: 4/18/2016
 * Time: 13:59
 */

require_once "../util/commonFuns.php";

foreach ($_REQUEST as $key => $value ){
    echo "key: " . $key;
    echo "   value: " . $value;
}


$url = "https://open.weixin.qq.com/connect/oauth2/authorize?appid=wx75de8782f8e4f99c&redirect_uri=121.201.14.58%2fpages%2ffirst_time_for_teacher.html&response_type=code&scope=snsapi_base#wechat_redirect";
echo $_REQUEST;

echo "<br> 请点击链接 <a href='$url' >" . $url . "</a>";

?>


