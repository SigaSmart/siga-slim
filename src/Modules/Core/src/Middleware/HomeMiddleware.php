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
class HomeMiddleware extends \SIGA\Core\MiddlewareAbstract {

    //put your code here
    public function __invoke($request, $response, $next) {

        $auth = $this->container->auth;

        $this->container->renderer->render($response, 'site/partials/header.phtml', ['auth' => $auth]);

        $responses = $next($request, $response);

        $this->container->renderer->render($response, 'site/partials/footer.phtml', ['auth' => $auth]);
        return $responses;
    }

}
