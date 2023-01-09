<?php
/**
 * 用户成就信息
 */
namespace Rannk\XboxWebapiPhp\UserApi;

class Achievements extends HttpClient
{
    private $url = 'https://achievements.xboxlive.com/users/xuid({xuid})/achievements';
    public function getContent($xuid)
    {
        $url = str_replace('{xuid}', $xuid, $this->url);
        $response = $this->xGet($url);
        return $response->getBody()->getContents();
    }
}