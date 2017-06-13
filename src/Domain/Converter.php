<?php

namespace PRODesign\Converter\Client\PHP\Domain;

use GuzzleHttp\Promise\PromiseInterface;
use PRODesign\Converter\Client\PHP\Domain\Request\ConversionRequest;
use PRODesign\Converter\Client\PHP\Domain\Request\InvalidConversionRequest;
use PRODesign\Converter\Client\PHP\Infrastructure\GuzzleConverterCoordinator;

class Converter {
    /**
     *
     * @var ConverterCoordinator
     */
    private $converterCoordinator;
    
    /**
     * 
     * @param ConverterConfiguration|null $configuration
     */
    private $configuration;

    /**
     * 
     * @param GuzzleConverterCoordinator $converterCoordinator
     * @param ConverterConfiguration|null $configuration
     */
    public function __construct(
            GuzzleConverterCoordinator $converterCoordinator,
            ConverterConfiguration $configuration = null) {
        $this->converterCoordinator = $converterCoordinator;
        $this->configuration = $configuration;
    }
    
    /**
     * 
     * @param ConversionRequest $request
     * @return PromiseInterface
     * @throws InvalidConversionRequest
     */
    public function requestConversion(ConversionRequest $request) {
        $promise = $this->converterCoordinator->requestConversion(
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
