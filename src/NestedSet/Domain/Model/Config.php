<?php

namespace NestedSet\Domain\Model;

class Config
{
    private static $instance = null;
    private array $config;

    private function __construct()
    {
        $this->config = require_once (__DIR__ . '/../../Infrastructure/config/config.php');
    }

    static public function getInstance()
    {
        if (!isset(self::$instance)) {
            self::$instance = new Config();
        }
        return self::$instance;
    }

    /**
     * @param $paramName
     * @return mixed
     */
    public function get($paramName)
    {
        if (array_key_exists($paramName, $this->config))
            return $this->config[$paramName];
    }
}