<?php

namespace Docebo\Domain\Model\Exception;

use Throwable;

class MissingParamsException extends DoceboException
{
    public function __construct($message = "Missing mandatory params", $code = 0, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}