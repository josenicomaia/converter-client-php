<?php

namespace PRODesign\Converter\Client\PHP\Domain;

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
