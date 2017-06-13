<?php

namespace PRODesign\Converter\Client\PHP\Infrastructure;

use GuzzleHttp\Promise\PromiseInterface;
use PRODesign\Converter\Client\PHP\Domain\ConverterConfiguration;
use PRODesign\Converter\Client\PHP\Domain\ConverterCoordinator;
use PRODesign\Converter\Client\PHP\Domain\Request\ConversionRequest;
use PRODesign\Converter\Client\PHP\Domain\Request\InvalidConversionRequest;
use PRODesign\Converter\Client\PHP\Domain\Request\LocalConversionRequest;
use Psr\Http\Message\ResponseInterface;

class GuzzleConverterCoordinator implements ConverterCoordinator {
    /**
     *
     * @var GuzzleFactory
     */
    private $guzzleFactory;
    
    /**
     * 
     * @param GuzzleFactory $guzzleFactory
     */
    public function __construct(GuzzleFactory $guzzleFactory) {
        $this->guzzleFactory = $guzzleFactory;
    }
    
    /**
     * 
     * @param ConversionRequest $request
     * @param ConverterConfiguration|null $configuration
     * @return PromiseInterface
     * @throws InvalidConversionRequest
     */
    public function requestConversion(
            ConversionRequest $request, 
            ConverterConfiguration $configuration = null) {
        $client = $this->guzzleFactory->createClient($configuration);
        $options = $this->generateOptions($request);
        $promise = $client->requestAsync('POST', '/converter', $options);
        
        return $promise->then(function (ResponseInterface $value) {
            return \GuzzleHttp\json_decode($value->getBody(), true);
        });
    }
    
    /**
     * 
     * @param ConversionRequest $request
     * @return array
     * @throws InvalidConversionRequest
     */
    public function generateOptions(ConversionRequest $request) {
        if($request instanceof LocalConversionRequest) {
            return $this->generateOptionsForLocalRequest($request);
        }
        
        throw new InvalidConversionRequest();
    }
    
    /**
     * 
     * @param LocalConversionRequest $request
     * @return array
     */
    public function generateOptionsForLocalRequest(LocalConversionRequest $request) {
        return GuzzleOptionsBuilder::builder()
                ->attachFile('target', $request->target())
                ->attachParameter('resolution', $request->resolution()->__toString())
                ->attachParameter('quality', $request->quality()->__toString())
                ->attachParameter('png8', $request->toPng8())
                ->build();
    }
}
