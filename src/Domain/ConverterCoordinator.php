<?php

namespace PRODesign\Converter\Client\PHP\Domain;

use GuzzleHttp\Promise\PromiseInterface;
use PRODesign\Converter\Client\PHP\Domain\Request\ConversionRequest;
use PRODesign\Converter\Client\PHP\Domain\Request\InvalidConversionRequest;

interface ConverterCoordinator {
    /**
     * 
     * @param ConversionRequest $request
     * @param ConverterConfiguration|null $configuration
     * @return PromiseInterface
     * @throws InvalidConversionRequest
     */
    public function requestConversion(
            ConversionRequest $request, 
            ConverterConfiguration $configuration = null);
}
