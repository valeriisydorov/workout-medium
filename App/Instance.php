<?php


namespace App;

/**
 * Class Instance
 * @package App
 */
class Instance
{
    private static $instances = [];
    public $data = [];

    /**
     * Instance constructor.
     */
    protected function __construct()
    {
        $this->data = (include_once __DIR__ . DIRECTORY_SEPARATOR . 'config.php');
    }

    protected function __clone()
    {
    }

    /**
     * @throws \Exception
     */
    public function __wakeup()
    {
        throw new \Exception("Cannot unserialize a singleton.");
    }

    /**
     * @return Instance
     */
    public static function getInstance(): Instance
    {
        $obj = static::class;
        if (!isset(self::$instances[$obj])) {
            self::$instances[$obj] = new static();
        }

        return self::$instances[$obj];
    }
}
