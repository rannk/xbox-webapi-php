<?php
namespace Rannk\XboxWebapiPhp\UserApi;

use GuzzleHttp\Client;

class HttpClient extends Client
{
    protected $xboxHeaders;

    public function __construct($uhs, $token, array $config = [])
    {
        $this->xboxHeaders = [
            "Authorization" => "XBL3.0 x=" . $uhs . ";" . $token
        ];
        parent::__construct($config);
    }

    public function xGet($uri, $params = [], $headers = [])
    {
        $headers = array_merge($this->xboxHeaders, $headers);
        return parent::get($uri, [
            "query_params" => $params,
            "headers" => $headers
        ]);
    }

    public function xPostJson($uri, $json = [], $headers = [])
    {
        $headers = array_merge($this->xboxHeaders, $headers);
        return parent::post($uri, [
            "json" => $json,
            "headers" => $headers
        ]);
    }
}