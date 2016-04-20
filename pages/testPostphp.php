<?php
/**
 * Created by PhpStorm.
 * User: sunwt
 * Date: 2016/4/20
 * Time: 0:55
 */
echo "called";
foreach ($_REQUEST as $key => $value ){
    echo "key: " . $key;
    echo "   value: " . $value;
}
echo "aftercalled";