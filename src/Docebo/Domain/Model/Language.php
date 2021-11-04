<?php

namespace Docebo\Domain\Model;

class Language
{
    const ITALIAN='italian';

    static public function from(string $language): string
    {
        $config = Config::getInstance();
        $languagesSupported = $config->get('supportedLanguages');
        if (in_array($language, $languagesSupported)) {
            return $language;
        }
        return $config->get('defaultLanguage');
    }
}