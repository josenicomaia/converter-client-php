<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace PRODesign\Converter\Client\PHP\Domain;

/**
 * Description of ConverterConfiguration
 *
 * @author José Nicodemos Maia Neto <jose at nicomaia.com.br>
 */
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
            $serviceUrl = null, 
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
