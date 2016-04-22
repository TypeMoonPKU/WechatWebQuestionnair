<?php
/**
 * Created by PhpStorm.
 * User: Archimkai
 * Date: 4/22/2016
 * Time: 10:56
 */

require_once "commonFuns.php";

$userid = "wenkai";

$token = getAccessToken();

$id = getOpenIdFromUserId($userid);