<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace PRODesign\Converter\Client\PHP\Domain;

use GuzzleHttp\Promise\Promise;
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
    
    public function __construct(GuzzleConverterCoordinator $converterCoordinator) {
        $this->converterCoordinator = $converterCoordinator;
    }
    
    /**
     * 
     * @param LocalConvertionRequest $request
     * @return PromiseInterface
     */
    public function requestLocalConversion(LocalConvertionRequest $request) {
        $promise = new Promise();
        
        $this->converterCoordinator->requestLocalConversion($request)->then(function ($value) use ($promise) {
            $requestResult = new ConversionRequestResult(
                    $value['hashArquivo'], 
                    $value['pathResultadoArquivo'], 
                    $value['urlResultadoArquivo']);
            
            $promise->resolve($requestResult);
        }, function ($reason) use ($promise) {
            $promise->reject($reason);
        });
        
        return $promise;
    }
}
