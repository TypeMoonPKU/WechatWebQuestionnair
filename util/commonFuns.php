<?php
/**
 * 此文件中存放常用代码,包括与微信API交互的接口
 * Created by PhpStorm.
 * User: Archimekai
 * Date: 4/18/2016
 * Time: 14:09
 */

require_once "do_post_request.php";

define("CORPID_GOLBAL","wx75de8782f8e4f99c");
define("CORP_SECERT","87t2MTe-rPYpxi5yzR1wb0M-FNp2dYljRirXZmMgyZJrHRr8ZmKR28bJD0IW50K0");
define("REMOTE_SERVER_IP","121.201.14.58");


//$URL = "https://qyapi.weixin.qq.com/cgi-bin/gettoken?corpid=" . CORPID_GOLBAL . "&corpsecret=" . CORP_SECERT;
//echo $URL;
$last_get_access_token_time = 0;
$last_access_token = null;

function getAccessToken(){
    // TODO 需要缓存access_token以防止访问次数过多,但是如何实现呢？ 目前考虑先不缓存了，反正也不会超过访问次数限制
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

}
/**
 * @param $code
 * @return  string 可能返回userid（对于企业成员），也可能返回openid（对于其他用户）
 */
function getOpenIdOrUserID($code){
    $token = getAccessToken();
    $url = "https://qyapi.weixin.qq.com/cgi-bin/user/getuserinfo?access_token=". $token . "&code=" . $code;
    $result = file_get_contents($url);
    return $result;
}


/**
 * 永远只返回openID
 * @param $code
 */
function getOpenId($code){
    if(empty($code)){
        throw new Exception("No content in variable code");
    }
    $result = getOpenIdOrUserID($code);
    $obj = json_decode($result);
    if(property_exists($obj,"UserId")){ // 返回了企业号中的成员
        $openID = getOpenIdFromUserId($obj->{'UserId'});

    }elseif(property_exists($obj,"OpenId")){ //这里的openid大小写不要更改
        $openID = $obj->{'OpenId'};
    }else{
        $error = "getOpenId error";
        throw new Exception($error);
    }

    return $openID;
}

function getOpenIdFromUserId($userId){
    $access_token = getAccessToken();
    $URL = "https://qyapi.weixin.qq.com/cgi-bin/user/convert_to_openid?access_token=" . $access_token;
    $arraydata = array(
        "userid"=>$userId
    );
    $jsondata  = json_encode( $arraydata);
//    echo $jsondata;
    $result = do_post_request($URL, $jsondata);
    $obj = json_decode($result);
    $openID = $obj->{"openid"};
    return $openID;
}


/**
 * 产生微信OAuth认证所需url，该url会以get形式提供一个参数 code。通过code可以获取微信OpenID
 * @param $url  不带http的主机地址
 */
function genOAuthURL($url){
    $oauthurl = "https://open.weixin.qq.com/connect/oauth2/authorize?appid=" . CORPID_GOLBAL . "&redirect_uri=" . urlencode($url) . "&response_type=code&scope=snsapi_base#wechat_redirect";
    return $oauthurl;
}
