<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace SIGA\Clients\Controllers;

use Psr\Http\Message\RequestInterface as Resquest;
use Psr\Http\Message\ResponseInterface as Response;
use SIGA\Core\Controllers\ControllerAbstract;

/**
 * Description of ClientsController
 *
 * @author caltj
 */
class ClientsController extends ControllerAbstract {

    protected $route = 'clients';
    protected $template = "admin/views/clients/index";
    protected $templateEdit = "admin/views/clients/edit";
    protected $templateCreate = "admin/views/clients/create";
    protected $model = \SIGA\Clients\Models\Client::class;

    public function create(Resquest $request, Response $response) {
        $this->data = [
            'first_name' => 'New',
            'last_name' => 'Clients',
            'status' => '0'
        ];
        return parent::create($request, $response);
    }

    public function store(Resquest $request, Response $response) {
        $result = [];
        if ($request->isPost()):
            $this->data = $request->getParams();
            $this->args = array_merge($this->args, $this->data);
            $validation = $this->validator->validate($this->data, [
                'first_name' => $this->vNoEmpty(),
                'last_name' => $this->vNoEmpty(),
                'email' => $this->vWs()->email()->fieldAvaliable($this->model,'email',$this->data['id']),
                'phone' => $this->vWsPhone()->Phone()
            ]);
            if ($validation->failed()):
                $this->args['msg'] = sprintf("%s %s %s %s", $this->validator->getErrorMsg('first_name'),
                         $this->validator->getErrorMsg('last_name'),
                        $this->validator->getErrorMsg('email'),
                        $this->validator->getErrorMsg('phone'));
                return $response->withJson($this->args);
            endif;
            unset($this->data['csrf_name'], $this->data['csrf_value']);

            $result = parent::store($request, $response);
            
            return $response->withJson(array_merge($this->args, $this->inputs));
        endif;
        return $response->withJson($result);
    }

}
