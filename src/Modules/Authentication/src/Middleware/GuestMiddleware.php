<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace SIGA\Authentication\Middleware;

use SIGA\Core\MiddlewareAbstract;

/**
 * Description of GuestMiddleware
 *
 * @author caltj
 */
class GuestMiddleware extends MiddlewareAbstract {

    //put your code here
    public function __invoke($request, $response, $next) {

        if ($this->container->auth->check()):
            return $response->withRedirect($this->container->router->pathFor('admin'));
        endif;
        return $next($request, $response);
    }

}
