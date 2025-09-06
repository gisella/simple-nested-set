<?php

namespace NestedSet\Domain\Model;

class Config
{
    private static $instance = null;
    private array $config;

    private function __construct()
    {
        // Determina quale configurazione usare in base all'ambiente
        $environment = $this->getEnvironment();
        $configFile = $this->getConfigFile($environment);

        $this->config = require_once($configFile);
    }

    static public function getInstance()
    {
        if (!isset(self::$instance)) {
            self::$instance = new Config();
        }
        return self::$instance;
    }

    /**
     * Resetta l'istanza singleton (utile per i test)
     */
    static public function resetInstance()
    {
        self::$instance = null;
    }

    /**
     * @param $paramName
     * @return mixed
     */
    public function get($paramName)
    {
        if (array_key_exists($paramName, $this->config)) {
            return $this->config[$paramName];
        }
        return null;
    }

    /**
     * Determina l'ambiente attuale
     * @return string
     */
    private function getEnvironment(): string
    {
        // Controlla se siamo in ambiente di test
        if (getenv('APP_ENV') === 'testing' ){
            return 'testing';
        }

        return 'production';
    }

    /**
     * Ottieni il percorso del file di configurazione in base all'ambiente
     * @param string $environment
     * @return string
     */
    private function getConfigFile(string $environment): string
    {
        $configDir = __DIR__ . '/../../Infrastructure/config/';

        switch ($environment) {
            case 'testing':
                return $configDir . 'test-config.php';
            default:
                return $configDir . 'config.php';
        }
    }
}