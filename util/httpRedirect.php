<?php
/**
 * Created by PhpStorm.
 * User: Archimekai
 * Date: 5/8/2016
 * Time: 19:40
 *
 * 负责页面的重定向，但不负责对页面进行OAuth验证
 * 会输出整个head部分
 * 
 * TODO 难道没有这种包专门负责重定向吗？
 */
require_once "../util/commonFuns.php";
function http_redirect($time, $goalURL){
    echo '<head> <meta http-equiv="refresh" content="' . $time . ';url=' . $goalURL . '"/></head>'; //重定向
}

function http_OAuth_redirect($time, $FULLGoalURL){
    $goalURL = genOAuthURL($FULLGoalURL);
    http_redirect($time, $goalURL);
}

