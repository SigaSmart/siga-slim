<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace SIGA\Admin\Controllers;

use Psr\Http\Message\RequestInterface,
    Psr\Http\Message\ResponseInterface;

/**
 * Description of AdminController
 *
 * @author caltj
 */
class AdminController extends \SIGA\Core\Controllers\ControllerAbstract {

    protected $template = "admin/layout";

    public function demo(RequestInterface $request, ResponseInterface $response) {

        return $this->renderer->render($response, "admin/demo/demo.phtml", [
                    'data' => []
        ]);
    }

    public function cidades(RequestInterface $request, ResponseInterface $response) {

        return $this->renderer->render($response, "admin/views/cidades.phtml", [
                    'data' => []
        ]);
    }

}
