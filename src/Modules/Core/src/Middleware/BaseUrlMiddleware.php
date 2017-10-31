<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace SIGA\Core\Middleware;

/**
 * Description of ThemaMiddleware
 *
 * @author caltj
 */
class BaseUrlMiddleware extends \SIGA\Core\MiddlewareAbstract {

    //put your code here
    public function __invoke($request, $response, $next) {
        $this->container->renderer->addAttribute('baseUrl', $request->getUri()->getBaseUrl());
        $this->container->renderer->addAttribute('router', $this->container->get('router'));
        define("BASE_URL", $request->getUri()->getBaseUrl());
        $responses = $next($request, $response);
        return $responses;
    }

}
