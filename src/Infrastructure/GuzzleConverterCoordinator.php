<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace PRODesign\Converter\Client\PHP\Infrastructure;

use PRODesign\Converter\Client\PHP\Domain\ConverterConfiguration;
use PRODesign\Converter\Client\PHP\Domain\ConverterCoordinator;
use PRODesign\Converter\Client\PHP\Domain\LocalConvertionRequest;
use Psr\Http\Message\ResponseInterface;
use function GuzzleHttp\json_decode;

/**
 * Description of GuzzleConverterCoordinator
 *
 * @author José Nicodemos Maia Neto <jose at nicomaia.com.br>
 */
class GuzzleConverterCoordinator implements ConverterCoordinator {
    /**
     *
     * @var GuzzleFactory
     */
    private $guzzleFactory;
    
    public function __construct(GuzzleFactory $guzzleFactory) {
        $this->guzzleFactory = $guzzleFactory;
    }
    
    public function requestLocalConversion(
            LocalConvertionRequest $request, 
            ConverterConfiguration $configuration = null) {
        $client = $this->guzzleFactory->createClient($configuration);
        $options = $this->generateOptionsForLocalRequest($request);
        $promise = $client->requestAsync('POST', '/converter', $options);
        
        return $promise->then(function (ResponseInterface $value) {
            return json_decode($value->getBody(), true);
        });
    }
    
    /**
     * 
     * @param LocalConvertionRequest $request
     * @return array
     */
    private function generateOptionsForLocalRequest(LocalConvertionRequest $request) {
        return [
            'multipart' => [
                [
                    'name' => 'arquivo',
                    'contents' => fopen($request->filePath(), 'rb')
                ], [
                    'name' => 'resolucao',
                    'contents' => $request->resolution()
                ], [
                    'name' => 'qualidade',
                    'contents' => $request->quality()
                ], [
                    'name' => 'png8',
                    'contents' => ($request->png8())? 'true' : 'false'
                ]
            ]
        ];
    }
}
