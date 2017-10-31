<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace SIGA\Admin\Api\Controllers;

use Psr\Http\Message\RequestInterface,
    Psr\Http\Message\ResponseInterface;

/**
 * Description of DemoController
 *
 * @author caltj
 */
class DemoController extends \SIGA\Core\Controllers\ControllerAbstract {

    public function demo(RequestInterface $resquest, ResponseInterface $response) {
        $demo = (new \SIGA\Admin\Api\Models\Demo())->jQueryDataTable($resquest);
         return $response->withJson($demo);
    }

}
