<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace SIGA\Core\Middleware;

/**
 * Description of MethodsMiddleware
 *
 * @author caltj
 */
class MethodsMiddleware extends \SIGA\Core\MiddlewareAbstract {

    //put your code here
    public function __invoke($request, $response, $next) {
        $route = $request->getAttribute("route");

        $methods = [];

        if (!empty($route)) {
            $pattern = $route->getPattern();

            foreach ($this->container->router->getRoutes() as $route) {
                if ($pattern === $route->getPattern()) {
                    $methods = array_merge_recursive($methods, $route->getMethods());
                }
            }
            //Methods holds all of the HTTP Verbs that a particular route handles.
        } else {
            $methods[] = $request->getMethod();
        }

        $response = $next($request, $response);


        return $response->withHeader("Access-Control-Allow-Methods", implode(",", $methods));
    }

}
