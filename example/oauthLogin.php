<?php
/**
 * 授权登录例子
 */
require_once "../vendor/autoload.php";
use Rannk\XboxWebapiPhp\Client as xboxClient;

$client_id = ""; //Azure AD上创建的应用id
$client_secret = ""; //Azure AD上应用密钥
$callback_url = ""; // Azure AD上应用设置的回调地址

$xboxClient = new xboxClient($client_id, $client_secret, $callback_url);
header("Location:" . $xboxClient->getOauth2LoginUrl()); // 跳转到微软授权登录