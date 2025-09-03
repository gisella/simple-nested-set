<?php

namespace NestedSet\Domain\Model\Exception;

use Throwable;

class InvalidPageNumberException extends NestedSetException
{
    public function __construct($message = "Invalid page number requested", $code = 0, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}