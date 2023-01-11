<?php
namespace Rannk\XboxWebapiPhp\UserApi;

class LoadApi
{
    public function setProp($token)
    {
        $_prop = [];
        if ($dh = opendir(__DIR__)) {
            while (($file = readdir($dh)) !== false) {
                if($file == "HttpClient.php" || $file == "LoadApi.php" || strlen($file)<5){
                    continue;
                }

                $classKey = substr($file, 0, strlen($file)-4);
                $className = 'Rannk\XboxWebapiPhp\UserApi\\' . $classKey;
                if(class_exists($className)){
                    $_prop[$classKey] = new $className($token);
                }
            }
            closedir($dh);
        }

        return $_prop;
    }
}