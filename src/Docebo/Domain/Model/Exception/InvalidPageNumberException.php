<?php

namespace Docebo\Domain\Model\Exception;

use Throwable;

class InvalidPageNumberException extends DoceboException
{
    public function __construct($message = "Invalid page number requested", $code = 0, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}