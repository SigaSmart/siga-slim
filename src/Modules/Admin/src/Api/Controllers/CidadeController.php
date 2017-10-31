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
 * Description of CidadeController
 *
 * @author caltj
 */
class CidadeController extends \SIGA\Core\Controllers\ControllerAbstract {

    public function cidade(RequestInterface $resquest, ResponseInterface $response) {
        $cidade = (new \SIGA\Admin\Api\Models\Cidade())->jQueryDataTable($resquest);
        return $response->withJson($cidade);
    }

}
