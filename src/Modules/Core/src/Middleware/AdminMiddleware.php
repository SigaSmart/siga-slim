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
class AdminMiddleware extends \SIGA\Core\MiddlewareAbstract {

    //put your code here
    public function __invoke($request, $response, $next) {

        $auth = $this->container->auth;
        $router = $this->container->get('router');
        if ($auth->check()):
            $this->container->renderer->render($response, 'admin/partials/header.phtml', ['auth' => $auth, 'router' => $router]);
            $this->container->renderer->render($response, 'admin/partials/sidebar.phtml', ['auth' => $auth, 'router' => $router]);
        else:
            $this->container->renderer->render($response, 'admin/auth/header.phtml', ['auth' => $auth, 'router' => $router]);
        endif;

        $responses = $next($request, $response);

        if ($auth->check()):
            $this->container->renderer->render($response, 'admin/partials/footer.phtml', ['auth' => $auth, 'router' => $router]);
         else:
            $this->container->renderer->render($response, 'admin/auth/footer.phtml', ['auth' => $auth, 'router' => $router]);
        endif;


        return $responses;
    }

}
