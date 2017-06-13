<?php

namespace PRODesign\Converter\Client\PHP\Domain\Request;

interface ConversionRequest {
    /**
     * @return string
     */
    public function target();
    
    /**
     * @return Resolution
     */
    public function resolution();
    
    /**
     * @return Quality
     */
    public function quality();
    
    /**
     * @return bool
     */
    public function toPng8();
}
