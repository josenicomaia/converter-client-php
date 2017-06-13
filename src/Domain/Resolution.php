<?php

namespace PRODesign\Converter\Client\PHP\Domain;

use Assert\Assertion;

class Resolution {
    private $value;
    
    public function __construct($value) {
        Assertion::integerish($value);
        
        $this->value = (int) $value;
    }
    
    public function __toString() {
        return $this->value;
    }
}
