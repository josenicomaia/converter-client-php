<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace PRODesign\Converter\Client\PHP\Infrastructure;

use GuzzleHttp\Promise\Promise;
use PRODesign\Converter\Client\PHP\Domain\ConverterCoordinator;
use PRODesign\Converter\Client\PHP\Domain\LocalConvertionRequest;
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
    
    public function requestLocalConversion(LocalConvertionRequest $request) {
        $client = $this->guzzleFactory->createClient();
        $options = $this->generateOptionsForLocalRequest($request);
        $requestPromise = $client->requestAsync('POST', '/converter', $options);
        $formatedRequestPromise = new Promise();
        
        $requestPromise->then(function ($value) use ($formatedRequestPromise) {
            $formatedRequestPromise->resolve(json_decode($value, true));
        }, function ($reason) use ($formatedRequestPromise) {
            $formatedRequestPromise->reject($reason);
        });
        
        return $formatedRequestPromise;
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
