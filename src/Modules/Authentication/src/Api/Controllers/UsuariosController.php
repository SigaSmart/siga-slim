<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace SIGA\Authentication\Api\Controllers;
use Psr\Http\Message\RequestInterface as Resquest;
use Psr\Http\Message\ResponseInterface as Response;
/**
 * Description of UsuariosController
 *
 * @author caltj
 */
class UsuariosController extends \SIGA\Core\Controllers\ControllerAbstract {

    public function index(Resquest $request, Response $response) {
        $users = \SIGA\Authentication\Models\User::query();
        return \Gealtec\Datatables\Datatables::response($users, $request);
    }

    public function busca(Resquest $request, Response $response) {
        $results = [];
        $row = [];
        if (!empty($request->getParam('query'))):
            $results = \SIGA\Authentication\Models\User::where('first_name', 'LIKE', "%{$request->getParam('query')}%")->get();

            foreach ($results as $Result):
                $Sarch[] = [
                    'data' => [
                        'id' => $Result['id'],
                        'name' => $Result['first_name'],
                        'lastname' => $Result['last_name'],
                    ],
                    'value' => sprintf("%s %s", utf8_decode(utf8_encode($Result['first_name'])), utf8_decode(utf8_encode($Result['last_name'])))
                ];
            endforeach;
            $row['suggestions'] = $Sarch;
        endif;
        return $response->withJson($row);
    }

}
