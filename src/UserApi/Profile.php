<?php
/**
 * 用户基本资料
 */
namespace Rannk\XboxWebapiPhp\UserApi;


class Profile extends HttpClient
{
    private $url = 'https://profile.xboxlive.com/users/batch/profile/settings';
    public function getContent($xuids = [])
    {
        $inputs = [
            'userIds' => $xuids,
            "settings" => [
                "GameDisplayName",
                "GameDisplayPicRaw",
                "Gamerscore",
                "Gamertag",
                "TenureLevel"
            ]
        ];

        $headers = [
            'Content-Type' => 'application/json',
            'x-xbl-contract-version' => 2
        ];
        $response = $this->xPostJson($this->url, $inputs, $headers);
        return $response->getBody()->getContents();
    }
}