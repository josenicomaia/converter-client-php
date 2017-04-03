<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace PRODesign\Converter\Client\PHP\Infrastructure;

use GuzzleHttp\Client;
use PRODesign\Converter\Client\PHP\Domain\ConverterConfiguration;

/**
 * Description of GuzzleFactory
 *
 * @author José Nicodemos Maia Neto <jose at nicomaia.com.br>
 */
class GuzzleFactory {
    /**
     *
     * @var ConverterConfiguration
     */
    private $converterConfiguration;
    
    public function __construct() {
        $this->converterConfiguration = new ConverterConfiguration();
    }
    
    /**
     * 
     * @param ConverterConfiguration $configuration
     * @return Client
     */
    public function createClient(ConverterConfiguration $configuration = null) {
        $mergedConfiguration = $this->mergeConfiguration($configuration);
        
        return new Client([
            'base_uri' => $mergedConfiguration->serviceUrl(),
            'connect_timeout' => $mergedConfiguration->connectTimeout() / 1000,
            'read_timeout' => $mergedConfiguration->readTimeout() / 1000
        ]);
    }
    
    /**
     * 
     * @param ConverterConfiguration $configuration
     * @return ConverterConfiguration
     */
    private function mergeConfiguration(ConverterConfiguration $configuration = null) {
        return ($configuration)? 
                $this->converterConfiguration->merge($configuration) 
        : 
                $this->converterConfiguration;
    }
}
