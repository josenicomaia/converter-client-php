<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace PRODesign\Converter\Client\PHP\Domain;

/**
 * Description of ConversionRequestResult
 *
 * @author José Nicodemos Maia Neto <jose at nicomaia.com.br>
 */
class ConversionRequestResult {
    /**
     *
     * @var string
     */
    private $requestedFileHash;
    
    /**
     *
     * @var string
     */
    private $resultFilePath;
    
    /**
     *
     * @var string
     */
    private $resultUrl;
    
    public function __construct($requestedFileHash, $resultFilePath, $resultUrl) {
        $this->requestedFileHash = $requestedFileHash;
        $this->resultFilePath = $resultFilePath;
        $this->resultUrl = $resultUrl;
    }
    
    public function requestedFileHash() {
        return $this->requestedFileHash;
    }
    
    public function resultFilePath() {
        return $this->resultFilePath;
    }
    
    public function resultUrl() {
        return $this->resultUrl;
    }
}
