<?php
namespace Rannk\XboxWebapiPhp\UserApi;


class People extends HttpClient
{
    const DOMAIN = "https://social.xboxlive.com";

    /**
     * 获取好友列表
     * @param $xuid
     * @return string
     */
    public function getPeople($xuid)
    {
        $url = self::DOMAIN . "/users/xuid({$xuid})/people";
        $response = $this->xGet($url);
        return $response->getBody()->getContents();
    }
}