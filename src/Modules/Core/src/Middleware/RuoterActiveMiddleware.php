<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace SIGA\Core\Middleware;

/**
 * Description of RuoterActiveMiddleware
 *
 * @author caltj
 */
class RuoterActiveMiddleware extends \SIGA\Core\MiddlewareAbstract
{
    //put your code here
    public function __invoke($request, $response, $next) {
        
        var_dump($request->getUri()->getBasePath());

        return $responses;
    }

}
