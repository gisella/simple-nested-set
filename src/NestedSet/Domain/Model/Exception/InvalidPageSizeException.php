<?php

namespace NestedSet\Domain\Model\Exception;

use Throwable;

class InvalidPageSizeException extends NestedSetException
{
    public function __construct($message = "Invalid page size requested", $code = 0, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}