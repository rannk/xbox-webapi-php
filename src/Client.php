<?php
namespace Rannk\XboxWebapiPhp;

use GuzzleHttp\Client as GuzzleClient;

class Client
{
    const DEFAULT_SCOPES = ["Xboxlive.signin", "Xboxlive.offline_access"];
    const MS_LOGIN_URL = "https://login.live.com/oauth20_authorize.srf";

    private $client_id, $client_secret, $callback_url, $refresh_token;

    public function __construct($client_id, $client_secret, $callback_url)
    {
        $this->client_id = $client_id;
        $this->client_secret = $client_secret;
        $this->callback_url = $callback_url;
    }

    public function getRefreshToken()
    {
        return $this->refresh_token;
    }

    public function getOauth2LoginUrl()
    {
        $query_params = [
            'client_id' => $this->client_id,
            'response_type' => 'code',
            'approval_prompt' => 'auto',
            'scope' => implode(" ", self::DEFAULT_SCOPES),
            'redirect_uri' => $this->callback_url
        ];

        return self::MS_LOGIN_URL . "?" . http_build_query($query_params);
    }

    public function callbackLogin($code) : XboxUser
    {
        $content = json_decode($this->oauth2TokenRequest($code), true);
        $this->refresh_token = $content['refresh_token'];
        $content = json_decode($this->requestUserToken($content['access_token']), true);
        $content = json_decode($this->requestXstsToken($content['Token']), true);
        $xboxUser = new XboxUser($content['DisplayClaims']['xui'][0]['xid'], $content['DisplayClaims']['xui'][0]['uhs'] . ";" .$content['Token']);
        return $xboxUser;
    }

    public function oauth2TokenRequest($code)
    {
        $data['client_id'] = $this->client_id;
        $data['client_secret'] = $this->client_secret;
        $data['grant_type'] = 'authorization_code';
        $data['code'] = $code;
        $data['scope'] = implode(" ", self::DEFAULT_SCOPES);
        $data['redirect_uri'] = $this->callback_url;

        $guzzleClient = new GuzzleClient();
        $response = $guzzleClient->post("https://login.live.com/oauth20_token.srf",[
            'form_params' => $data
        ]);

        return $response->getBody()->getContents();
    }

    public function refreshOauth2TokenRequest($refresh_token)
    {
        $data['client_id'] = $this->client_id;
        $data['client_secret'] = $this->client_secret;
        $data['grant_type'] = 'refresh_token';
        $data['scope'] = implode(" ", self::DEFAULT_SCOPES);
        $data['refresh_token'] = $refresh_token;

        $guzzleClient = new GuzzleClient();
        $response = $guzzleClient->post("https://login.live.com/oauth20_token.srf",[
            'form_params' => $data
        ]);

        return $response->getBody()->getContents();
    }

    public function requestUserToken($access_token)
    {
        $data['RelyingParty'] = "http://auth.xboxlive.com";
        $data['TokenType'] = "JWT";
        $data['Properties'] = [
            "AuthMethod" => 'RPS',
            "SiteName" => 'user.auth.xboxlive.com',
            "RpsTicket" => 'd=' . $access_token
        ];

        $guzzleClient = new GuzzleClient();
        $response = $guzzleClient->post("https://user.auth.xboxlive.com/user/authenticate",[
            'json' => $data,
            'headers' => [
                'x-xbl-contract-version' => 1
            ]
        ]);

        return $response->getBody()->getContents();
    }

    public function requestXstsToken($token)
    {
        $data['RelyingParty'] = "http://xboxlive.com";
        $data['TokenType'] = "JWT";
        $data['Properties'] = [
            "SandboxId" => 'RETAIL',
            "UserTokens" => [
                $token
            ]
        ];

        $guzzleClient = new GuzzleClient();
        $response = $guzzleClient->post("https://xsts.auth.xboxlive.com/xsts/authorize",[
            'json' => $data,
            'headers' => [
                'x-xbl-contract-version' => 1
            ]
        ]);

        return $response->getBody()->getContents();
    }
}