<?php

namespace Docebo\Domain\Model\Exception;

use Throwable;

class DoceboException extends \Exception
{
    public function __construct($message = "", $code = 0, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}