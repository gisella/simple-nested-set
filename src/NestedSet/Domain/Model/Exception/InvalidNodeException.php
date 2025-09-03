<?php

namespace NestedSet\Domain\Model\Exception;

use Throwable;

class InvalidNodeException extends NestedSetException
{
    public function __construct($message = "Invalid node id", $code = 0, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}