<?php

namespace PRODesign\Converter\Client\PHP\Domain;

class ConverterConfiguration {
    /**
     * URL for the converter endpoint
     * 
     * @var string
     */
    private $serviceUrl;
    
    /**
     * Time in miliseconds for connect timeout
     * 
     * @var int
     */
    private $connectTimeout;
    
    /**
     * Time in miliseconds for read timeout
     * 
     * @var int
     */
    private $readTimeout;
    
    public function __construct(
            $serviceUrl = 'http://localhost', 
            $connectTimeout = 1000, 
            $readTimeout = 240000) {
        $this->serviceUrl = $serviceUrl;
        $this->connectTimeout = $connectTimeout;
        $this->readTimeout = $readTimeout;
    }
    
    public function merge(ConverterConfiguration $configuration) {
        $newConfiguration = new ConverterConfiguration();
        
        if($configuration->serviceUrl() != null) {
            $newConfiguration->serviceUrl = $configuration->serviceUrl();
        }
        
        if($configuration->connectTimeout() != null) {
            $newConfiguration->connectTimeout = $configuration->connectTimeout();
        }
        
        if($configuration->readTimeout() != null) {
            $newConfiguration->readTimeout = $configuration->readTimeout();
        }
        
        return $newConfiguration;
    }
    
    public function serviceUrl() {
        return $this->serviceUrl;
    }
    
    public function connectTimeout() {
        return $this->connectTimeout;
    }
    
    public function readTimeout() {
        return $this->readTimeout;
    }
}
