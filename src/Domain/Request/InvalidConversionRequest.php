<?php

namespace PRODesign\Converter\Client\PHP\Domain\Request;

use Exception;
use Throwable;

class InvalidConversionRequest extends Exception {
    public function __construct(string $message = "", int $code = 0, Throwable $previous = null) {
        parent::__construct($message, $code, $previous);
    }
}
