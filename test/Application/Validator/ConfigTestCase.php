<?php

use NestedSet\Domain\Model\Config;
use PHPUnit\Framework\TestCase;

final class ConfigTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        Config::resetInstance();
    }

    protected function tearDown(): void
    {
        parent::tearDown();
        Config::resetInstance();
    }

    public function testConfigUsesTestConfiguration()
    {
        $config = Config::getInstance();
        
        // Verifica che stia usando la configurazione di test
        $this->assertEquals("sqlite::memory:", $config->get('dbUrl'));
        $this->assertEquals("", $config->get('dbUsername'));
        $this->assertEquals("test", $config->get('dbName'));
    }
}
