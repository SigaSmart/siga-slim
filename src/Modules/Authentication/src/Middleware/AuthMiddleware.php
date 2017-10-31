<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace SIGA\Authentication\Middleware;

use SIGA\Core\MiddlewareAbstract;
/**
 * Description of AuthMiddleware
 *
 * @author caltj
 */
class AuthMiddleware extends MiddlewareAbstract {

    //put your code here
    public function __invoke($request, $response, $next) {
        if (!$this->container->auth->check()):

            $this->container->flash->addMessage('error', "Please sign in defore doing that.");
            return $response->withRedirect($this->container->router->pathFor('login'));

        endif;
        return $next($request, $response);
    }

}
