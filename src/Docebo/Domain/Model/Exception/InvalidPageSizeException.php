<?php

namespace Docebo\Domain\Model\Exception;

use Throwable;

class InvalidPageSizeException extends DoceboException
{
    public function __construct($message = "Invalid page size requested", $code = 0, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}