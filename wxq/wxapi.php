<?php
/**
 * Created by PhpStorm.
 * User: Archimekai
 * Date: 4/18/2016
 * Time: 13:59
 */

require_once "../util/commonFuns.php";
$goalURL=REMOTE_SERVER_IP . "/wxq/getCodeToRedirect.php";
$redirectURL=genOAuthURL($goalURL);
?>


<head>
    <meta http-equiv="refresh" content="3;url=<?PHP echo $redirectURL?>">
</head>

<?php


foreach ($_REQUEST as $key => $value ){
    echo "key: " . $key;
    echo "   value: " . $value;
}


$url = "https://open.weixin.qq.com/connect/oauth2/authorize?appid=wx75de8782f8e4f99c&redirect_uri=121.201.14.58%2fpages%2ffirst_time_for_teacher.php&response_type=code&scope=snsapi_base#wechat_redirect";
echo $_REQUEST;

echo "<br> 第一次使用？请点击链接注册 <a href='$url' >" . $url . "</a>";


$ManageUrl=REMOTE_SERVER_IP . "/pages/homepage.php";
$oauthMUrl=genOAuthURL($ManageUrl);
echo "<br> 点击下列链接以进入管理页  <a href='$oauthMUrl'>" . $oauthMUrl . "</a>";

?>


