<?php

namespace PRODesign\Converter\Client\PHP\Infrastructure;

use GuzzleHttp\Client;
use PRODesign\Converter\Client\PHP\Domain\ConverterConfiguration;

class GuzzleFactory {
    /**
     *
     * @var ConverterConfiguration
     */
    private $baseConfiguration;
    
    public function __construct() {
        $this->baseConfiguration = new ConverterConfiguration();
    }
    
    /**
     * 
     * @param ConverterConfiguration|null $configuration
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
     * @param ConverterConfiguration|null $configuration
     * @return ConverterConfiguration
     */
    private function mergeConfiguration(ConverterConfiguration $configuration = null) {
        return ($configuration)? 
                $this->baseConfiguration->merge($configuration) 
        : 
                $this->baseConfiguration;
    }
}
