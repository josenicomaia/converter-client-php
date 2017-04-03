<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace PRODesign\Converter\Client\PHP\Domain;

use GuzzleHttp\Promise\PromiseInterface;
use PRODesign\Converter\Client\PHP\Infrastructure\GuzzleConverterCoordinator;

/**
 * Description of Converter
 *
 * @author José Nicodemos Maia Neto <jose at nicomaia.com.br>
 */
class Converter {
    /**
     *
     * @var ConverterCoordinator
     */
    private $converterCoordinator;
    
    /**
     * 
     * @param ConverterConfiguration $configuration
     */
    private $configuration;

    public function __construct(
            GuzzleConverterCoordinator $converterCoordinator,
            ConverterConfiguration $configuration = null) {
        $this->converterCoordinator = $converterCoordinator;
        $this->configuration = $configuration;
    }
    
    /**
     * 
     * @param LocalConvertionRequest $request
     * @return PromiseInterface
     */
    public function requestLocalConversion(LocalConvertionRequest $request) {
        $promise = $this->converterCoordinator->requestLocalConversion(
                $request, 
                $this->configuration);
        
        return $promise->then(function (array $value) {
            return new ConversionRequestResult(
                    $value['hashArquivo'], 
                    $value['pathResultadoArquivo'], 
                    $value['urlResultadoArquivo']);
        });
    }
}
