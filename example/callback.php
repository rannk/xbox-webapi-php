<?php
/**
 * 微软授权登录后回调的例子
 * 这里设置的应用ID，密钥，回调地址应该和oauthLogin中设置的一样
 * 如果成功，页面会打印 xuid, uhs, token数据
 */
require_once "../vendor/autoload.php";
use Rannk\XboxWebapiPhp\Client as xboxClient;
use Rannk\XboxWebapiPhp\XboxUser;

$client_id = ""; //Azure AD上创建的应用id
$client_secret = ""; //Azure AD上应用密钥
$callback_url = ""; // Azure AD上应用设置的回调地址

$code = $_GET['code'];
$xboxClient = new xboxClient($client_id, $client_secret, $callback_url);
$xBoxUser = $xboxClient->callbackLogin($code);

$ret['xuid'] = $xBoxUser->getXuid();
$ret['token'] = $xBoxUser->getToken();
$ret['refresh_token'] = $xboxClient->getRefreshToken();

print_r($ret);