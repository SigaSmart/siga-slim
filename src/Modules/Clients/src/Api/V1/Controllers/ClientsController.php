<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace SIGA\Clients\Api\V1\Controllers;

use Psr\Http\Message\RequestInterface,
    Psr\Http\Message\ResponseInterface;

/**
 * Description of ClientsController
 *
 * @author caltj
 */
class ClientsController extends \SIGA\Core\Controllers\ControllerAbstract {

    public function listar(RequestInterface $resquest, ResponseInterface $response) {
        $Client = (new \SIGA\Clients\Api\V1\Models\Client())->jQueryDataTable($resquest);
        return $response->withJson($Client);
    }

    

}
