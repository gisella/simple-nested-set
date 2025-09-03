<?php

namespace NestedSet\Domain\Model\Exception;

use Throwable;

class DatabaseConnectionException extends NestedSetException
{
    public function __construct($message = "", $code = 0, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}