<?php

use Docebo\Domain\Model\Language;
use PHPUnit\Framework\TestCase;

final class LanguageTest extends TestCase
{

    public function testGetNodeRequestInvalidParams()
    {
        self::assertEquals(Language::from('english'),'english');
        self::assertEquals(Language::from('italian'),'italian');
        self::assertEquals(Language::from('spanish'),'english');
    }

}
