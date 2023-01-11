<?php
namespace Rannk\XboxWebapiPhp;
use Rannk\XboxWebapiPhp\UserApi\LoadApi;

class XboxUser
{
    private $xuid, $token;

    protected $_prop;

    public function __construct($xuid, $access_token)
    {
        $this->xuid = $xuid;
        $this->token = $access_token;
        $loadApi = new LoadApi();
        $this->_prop = $loadApi->setProp($this->token);
    }

    public function __get($name)
    {
        if(isset($this->_prop[$name])){
            return $this->_prop[$name];
        }
    }

    public function getXuid()
    {
        return $this->xuid;
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
        return $this->Achievements->getContent($xuid);
    }

    /**
     * 用户成就相关的游戏历史记录
     * @param string $xuid
     * @return string
     */
    public function achievementsHistory($xuid = "")
    {
        $xuid = empty($xuid)?$this->xuid:$xuid;
        return $this->Achievements->getHistory($xuid);
    }

    /**
     * 获取用户基本资料
     * @param string $xuid
     * @return string
     */
    public function profile($xuids = [])
    {
        $xuids = empty($xuids)?[$this->xuid]:$xuids;
        return $this->Profile->getContent($xuids);
    }

    /**
     * 获取用户好友列表
     * @param string $xuid
     * @return mixed
     */
    public function people($xuid = "")
    {
        $xuid = empty($xuid)?$this->xuid:$xuid;
        return $this->People->getPeople($xuid);
    }
}