<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace PRODesign\Converter\Client\PHP\Domain;

use Assert\Assertion;

/**
 * Description of LocalConvertionRequest
 *
 * @author José Nicodemos Maia Neto <jose at nicomaia.com.br>
 */
class LocalConvertionRequest {
    /**
     *
     * @var string
     */
    private $filePath;
    
    /**
     *
     * @var int
     */
    private $resolution;
    
    /**
     *
     * @var int
     */
    private $quality;
    
    /**
     *
     * @var bool
     */
    private $png8;
    
    public function __construct($filePath, $resolution, $quality, $png8) {
        Assertion::string($filePath);
        Assertion::file($filePath);
        Assertion::integerish($resolution);
        Assertion::integerish($quality);
        Assertion::boolean($png8);
        
        $this->filePath = $filePath;
        $this->resolution = $resolution;
        $this->quality = $quality;
        $this->png8 = $png8;
    }

    public function filePath() {
        return $this->filePath;
    }
    
    public function resolution() {
        return $this->resolution;
    }
    
    public function quality() {
        return $this->quality;
    }
    
    public function png8() {
        return $this->png8;
    }
}
