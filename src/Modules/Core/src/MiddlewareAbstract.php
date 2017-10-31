<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace SIGA\Core;

/**
 * Description of MiddlewareAbstract
 *
 * @author caltj
 */
abstract class MiddlewareAbstract {

    protected $container;

    public function __construct($container) {

        $this->container = $container;
    }

    abstract function __invoke($request, $response, $next);
}
