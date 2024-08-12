<?php namespace Services; ?>
<?php

require_once SRC . "Services/BaseService.php";
abstract class SingletonBaseService extends BaseService {

    protected static array $instances = array();

    protected abstract function __construct();

    public static function getInstance() {
        $calledClass = get_called_class();
        if (! isset($instances[$calledClass])) {
            self::$instances[$calledClass] = new $calledClass();
        }
        return self::$instances[$calledClass];
    }
}

