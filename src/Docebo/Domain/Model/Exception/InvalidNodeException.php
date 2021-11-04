<?php

namespace Docebo\Domain\Model\Exception;

use Throwable;

class InvalidNodeException extends DoceboException
{
    public function __construct($message = "Invalid node id", $code = 0, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}