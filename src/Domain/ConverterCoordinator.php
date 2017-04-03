<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace PRODesign\Converter\Client\PHP\Domain;

use GuzzleHttp\Promise\PromiseInterface;

/**
 *
 * @author José Nicodemos Maia Neto <jose at nicomaia.com.br>
 */
interface ConverterCoordinator {
    /**
     * 
     * @param LocalConvertionRequest $request
     * @return PromiseInterface
     */
    public function requestLocalConversion(LocalConvertionRequest $request);
}
