<?php
/**
 * 此文件中存放常用代码,包括与微信API交互的接口
 * Created by PhpStorm.
 * User: Archimekai
 * Date: 4/18/2016
 * Time: 14:09
 */
define("CORPID_GOLBAL","wx75de8782f8e4f99c");
define("CORP_SECERT","87t2MTe-rPYpxi5yzR1wb0M-FNp2dYljRirXZmMgyZJrHRr8ZmKR28bJD0IW50K0");
//$URL = "https://qyapi.weixin.qq.com/cgi-bin/gettoken?corpid=" . CORPID_GOLBAL . "&corpsecret=" . CORP_SECERT;
//echo $URL;
$last_get_access_token_time = 0;
$last_access_token = null;

function getAccessToken(){
    // TODO 需要缓存access_token以防止访问次数过多,但是如何实现呢？
    $nowtime = time();
    if(($nowtime - $GLOBALS["last_get_access_token_time"] >= 7100) || ($GLOBALS["last_access_token"] == null) ){
        $URL = "https://qyapi.weixin.qq.com/cgi-bin/gettoken?corpid=" . CORPID_GOLBAL . "&corpsecret=" . CORP_SECERT;
        $result = file_get_contents($URL);
        $obj = json_decode($result);
        $access_token = $obj->{'access_token'};
        $expireTime = $obj->{'expires_in'};
        $GLOBALS["last_get_access_token_time"] = time() ;
        $GLOBALS["last_access_token"] =$access_token;
        return $access_token;
    }else{
        echo "cached  ";
        return $GLOBALS["last_access_token"];
    }


//    echo $URL;
//    echo $result;
    return $result;
}


/**
 * @param $code
 * @return  json string 可能返回userid（对于企业成员），也可能返回openid（对于其他用户）
 */
function getOpenIdOrUserID($code){
    $token = getAccessToken();
    $url = "https://qyapi.weixin.qq.com/cgi-bin/user/getuserinfo?access_token=". $token . "&code=" . $code;
    $result = file_get_contents($url);
    return $result;
}