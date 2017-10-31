<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace SIGA\Core\Middleware;

/**
 * Description of CsrfViewMiddleware
 *
 * @author caltj
 */
class CsrfViewMiddleware extends \SIGA\Core\MiddlewareAbstract {

    public function __invoke($request, $response, $next) {

        $this->container->renderer->addAttribute('csrf', 
                sprintf('<input type="hidden" name="%s" value="%s">'
                        . '<input type="hidden" name="%s" value="%s">', 
                $this->container->csrf->getTokenNameKey(),
                $this->container->csrf->getTokenName(),
                $this->container->csrf->getTokenValueKey(),
                $this->container->csrf->getTokenValue()
                )
        );
        return $next($request, $response);
    }

}
