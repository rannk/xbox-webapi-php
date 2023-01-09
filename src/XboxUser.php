<?php
namespace Rannk\XboxWebapiPhp;

use Rannk\XboxWebapiPhp\UserApi\Achievements;
use Rannk\XboxWebapiPhp\UserApi\People;
use Rannk\XboxWebapiPhp\UserApi\Profile;

class XboxUser
{
    private $xuid, $uhs, $token;

    public function __construct($xuid, $uhs, $access_token)
    {
        $this->xuid = $xuid;
        $this->uhs = $uhs;
        $this->token = $access_token;
    }

    public function getXuid()
    {
        return $this->xuid;
    }

    public function getUhs()
    {
        return $this->uhs;
    }

    public function getToken()
    {
        return $this->token;
    }

    /**
     * 获取用户成就信息
     * @param string $xuid
     * @return string
     */
    public function achievements($xuid = "")
    {
        $xuid = empty($xuid)?$this->xuid:$xuid;
        $ache = new Achievements($this->uhs, $this->token);
        return $ache->getContent($xuid);
    }

    /**
     * 获取用户基本资料
     * @param string $xuid
     * @return string
     */
    public function profile($xuids = [])
    {
        $xuids = empty($xuids)?[$this->xuid]:$xuids;
        $profile = new Profile($this->uhs, $this->token);
        return $profile->getContent($xuids);
    }

    /**
     * 获取用户好友列表
     * @param string $xuid
     * @return mixed
     */
    public function people($xuid = "")
    {
        $xuid = empty($xuid)?$this->xuid:$xuid;
        $ache = new People($this->uhs, $this->token);
        return $ache->getPeople($xuid);
    }
}