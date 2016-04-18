<?php
/**
 * 此文件中存放常用代码
 * Created by PhpStorm.
 * User: Archimekai
 * Date: 4/18/2016
 * Time: 14:09
 */
define("CORPID_GOLBAL","wx75de8782f8e4f99c");
define("CORP_SECERT","87t2MTe-rPYpxi5yzR1wb0M-FNp2dYljRirXZmMgyZJrHRr8ZmKR28bJD0IW50K0");
//$URL = "https://qyapi.weixin.qq.com/cgi-bin/gettoken?corpid=" . CORPID_GOLBAL . "&corpsecret=" . CORP_SECERT;
//echo $URL;
function getAccessToken(){
    // TODO 需要缓存access_token以防止访问次数过多
    $URL = "https://qyapi.weixin.qq.com/cgi-bin/gettoken?corpid=" . CORPID_GOLBAL . "&corpsecret=" . CORP_SECERT;
    $result = file_get_contents($URL);
//    echo $URL;
//    echo $result;
    return $result;
}

function getOpenId(){

}