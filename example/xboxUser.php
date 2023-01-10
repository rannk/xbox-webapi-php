<?php
/**
 * 获取xbox用户相关信息的例子
 * 这里会调用已写好的一些接口
 */
require_once "../vendor/autoload.php";
use Rannk\XboxWebapiPhp\XboxUser as XboxUser;

// 这些参数信息可以通过 callback回调例子获取到
$xuid = "";
$token = "";

$xboxUser = new XboxUser($xuid, $token);

// 用户成就
if($_GET['m'] == "ache"){
    print_r($xboxUser->achievements());
}

// 用户资料
if($_GET['m'] == "profile"){
    print_r($xboxUser->profile([]));
}

// 用户好友
if($_GET['m'] == "people"){
    print_r($xboxUser->people());
}
