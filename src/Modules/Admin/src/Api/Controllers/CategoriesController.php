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
class CategoriesController extends \SIGA\Core\Controllers\ControllerAbstract {

    public function listar(RequestInterface $resquest, ResponseInterface $response) {
        $Category = (new \SIGA\Admin\Api\Models\Category())->jQueryDataTable($resquest);
        return $response->withJson($Category);
    }

    public function busca(RequestInterface $request, ResponseInterface $response) {
        $results = [];
        $row = [];
        if (!empty($request->getParam('query'))):
            $results = \SIGA\Admin\Api\Models\Category::where('name', 'LIKE', "%{$request->getParam('query')}%")->get();

            foreach ($results as $Result):
                $Sarch[] = [
                    'data' => [
                        'id' => $Result['id'],
                        'name' => $Result['name'],
                        'lastname' => $Result['preview'],
                    ],
                    'value' => utf8_decode(utf8_encode($Result['name']))
                ];
            endforeach;
            $row['suggestions'] = $Sarch;
        endif;
        return $response->withJson($row);
    }

}
