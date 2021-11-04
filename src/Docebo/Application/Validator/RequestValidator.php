<?php

namespace Docebo\Application\Validator;

class RequestValidator
{
    function __construct(array $params)
    {
        $this->params = $params;
    }

    /**
     * @param string $paramName
     * @return bool
     */
    function paramExists(string $paramName): bool
    {
        return (array_key_exists($paramName, $this->params) && !empty($this->getParam($paramName)));
    }

    /**
     * @param string $paramName
     * @return mixed
     */
    function getParam(string $paramName)
    {
        return $this->params[$paramName];
    }

    /**
     * @param array $mandatoryList
     * @return bool
     */
    function checkMandatoryParams(array $mandatoryList): bool
    {
        foreach ($mandatoryList as $paramName) {
            if (!$this->paramExists($paramName)) {
                return false;
            }
        }
        return true;
    }
}