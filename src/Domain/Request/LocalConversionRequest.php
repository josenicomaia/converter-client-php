<?php

namespace PRODesign\Converter\Client\PHP\Domain\Request;

use Assert\Assertion;
use PRODesign\Converter\Client\PHP\Domain\Quality;
use PRODesign\Converter\Client\PHP\Domain\Resolution;

class LocalConversionRequest implements ConversionRequest {
    /**
     *
     * @var string
     */
    private $target;
    
    /**
     *
     * @var Resolution
     */
    private $resolution;
    
    /**
     *
     * @var Quality
     */
    private $quality;
    
    /**
     *
     * @var bool
     */
    private $toPng8;
    
    public function __construct(
            $target, 
            Resolution $resolution, 
            Quality $quality, 
            $toPng8) {
        Assertion::string($target);
        Assertion::file($target);
        Assertion::boolean($toPng8);
        
        $this->target = $target;
        $this->resolution = $resolution;
        $this->quality = $quality;
        $this->toPng8 = $toPng8;
    }

    /**
     * 
     * @return string
     */
    public function target() {
        return $this->target;
    }
    
    /**
     * 
     * @return Resolution
     */
    public function resolution() {
        return $this->resolution;
    }
    
    /**
     * 
     * @return Quality
     */
    public function quality() {
        return $this->quality;
    }
    
    /**
     * 
     * @return bool
     */
    public function toPng8() {
        return $this->toPng8;
    }
}
