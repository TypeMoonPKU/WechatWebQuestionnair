<?php
/**
 * Created by PhpStorm.
 * User: Archimekai
 * Date: 4/18/2016
 * Time: 13:59
 */

foreach ($_REQUEST as $key => $value ){
    echo "key: " . $key;
    echo "   value: " . $value;
}
echo $_REQUEST;