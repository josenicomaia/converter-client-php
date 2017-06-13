<?php

namespace PRODesign\Converter\Client\PHP\Infrastructure;

use GuzzleHttp\RequestOptions;
use Psr\Http\Message\StreamInterface;

class GuzzleOptionsBuilder {
    /**
     *
     * @var bool
     */
    private $isMultipart;
    
    /**
     *
     * @var string[StreamInterface|resource|string]
     */
    private $files;
    
    /**
     *
     * @var string[string]
     */
    private $parameters;
    
    private function __construct(
            $isMultipart = false, 
            $files = [], 
            $parametros = []) {
        $this->isMultipart = $isMultipart;
        $this->files = $files;
        $this->parameters = $parametros;
    }

    
    /**
     * 
     * @return GuzzleOptionsBuilder
     */
    public static function builder() {
        return new self();
    }
    
    /**
     * 
     * @return array
     */
    public function build() {
        $options = [];
        
        if($this->isMultipart) {
            $bodyType = RequestOptions::MULTIPART;
        } else {
            $bodyType = RequestOptions::BODY;
        }
        
        foreach($this->files as $parameterName => $file) {
            $fileHandler = $this->getFileHandler($file);
            
            $options[$bodyType][] = [
                'name' => $parameterName,
                'contents' => $fileHandler
            ];
        }
        
        foreach($this->parameters as $parameterName => $contents) {
            $options[$bodyType][] = [
                'name' => $parameterName,
                'contents' => $contents
            ];
        }
        
        return $options;
    }
    
    /**
     * 
     * @param StreamInterface|resource|string $file
     * @return StreamInterface|resource
     */
    private function getFileHandler($file) {
        return (!$this->isOpen($file))? 
            fopen($file, 'rb') 
        : 
            $file;
    }
    
    /**
     * 
     * @param StreamInterface|resource|string $file
     * @return bool
     */
    private function isOpen($file) {
        return ($file instanceof StreamInterface || is_resource($file));
    }
    
    /**
     * 
     * @param string $parameter
     * @param StreamInterface|resource|string $file
     * @return GuzzleOptionsBuilder
     */
    public function attachFile($parameter, $file) {
        $this->files[$parameter] = $file;
        
        return $this;
    }
    
    /**
     * 
     * @param string $parameter
     * @param mixed $contents
     * @return GuzzleOptionsBuilder
     */
    public function attachParameter($parameter, $contents) {
        if(is_bool($contents)) {
            $contents = ($contents)? 'true' : 'false';
        }
        
        $this->parameters[$parameter] = $contents;
        
        return $this;
    }
}
