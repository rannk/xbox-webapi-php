<?php
/**
 * 用户成就信息
 */
namespace Rannk\XboxWebapiPhp\UserApi;

class Achievements extends HttpClient
{
    private $url = 'https://achievements.xboxlive.com';
    public function getContent($xuid)
    {
        $url = $this->url . "/users/xuid({$xuid})/achievements";
        $response = $this->xGet($url);
        return $response->getBody()->getContents();
    }

    public function getHistory($xuid)
    {
        $url = $this->url . "/users/xuid({$xuid})/history/titles";
        $response = $this->xGet($url);
        return $response->getBody()->getContents();
    }
}