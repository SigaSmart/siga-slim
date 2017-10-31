<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace SIGA\Authentication\Controllers;

use SIGA\Core\Controllers\ControllerAbstract;
use Psr\Http\Message\RequestInterface as Resquest;
use Psr\Http\Message\ResponseInterface as Response;

/**
 * Description of UsuariosController
 *
 * @author caltj
 */
class UsuariosController extends ControllerAbstract {

    protected $route = 'usuarios';
    protected $template = "admin/views/usuarios/index";
    protected $templateEdit = "admin/views/usuarios/edit";
    protected $templateCreate = "admin/views/usuarios/create";
    protected $templateBusca = "admin/views/usuarios/busca";
    protected $model = \SIGA\Authentication\Models\User::class;

    public function store(Resquest $request, Response $response) {
        if ($request->isPost()):
            $this->data = $request->getParams();
            $this->args = array_merge($this->args, $request->getParams());
            $validation = $this->validator->validate($this->data, [
                'first_name' => $this->vWs(),
                'last_name' => $this->vNoEmpty()
            ]);
            if ($validation->failed()):
                $this->args['msg'] = sprintf("%s %s", $this->validator->getErrorMsg('first_name'), $this->validator->getErrorMsg('last_name'));
                return $response->withJson($this->args);
            endif;
            unset($this->data['csrf_name'], $this->data['csrf_value']);
            return parent::store($request, $response);
        endif;
        return $response->withJson($this->args);
    }

    public function busca(Resquest $request, Response $response) {
        $data = [];
        if ($this->model):
            $data = $this->model::whereRaw("CONCAT(users.first_name,' ',users.last_name) LIKE ?", ["%{$request->getParam('busca')}%"])->get();
        endif;
        return $this->renderer->render($response, "{$this->templateBusca}.phtml", [
                    'route' => $this->route,
                    'data' => $data
        ]);
    }

    public function password(Resquest $request, Response $response) {
        if ($request->isPost()):
            $objModel = (new \ReflectionClass($this->model))->newInstance();
            $this->data = $request->getParams();
            $this->args = array_merge($this->args, $request->getParams());
            $user = $objModel->find($this->args['id']);
            $validation = $this->validator->validate($this->data, [
                'password_old' => $this->vWs()->ChangePassword($user->password),
                'password' => $this->vWs()
            ]);
            if ($validation->failed()) {
                $this->args['msg'] = sprintf("%s %s", $this->validator->getErrorMsg('password_old'), $this->validator->getErrorMsg('password'));
                return $response->withJson($this->args);
            }
            if ($this->args['id']):
                $this->args['result'] = $objModel->where('id', $this->args['id'])->update([
                    'password' => password_hash($request->getParam('password'), PASSWORD_DEFAULT, [
                        'cost' => 10
                    ])
                ]);
                $this->args['type'] = 'success';
                $this->args['title'] = 'Success!';
                $this->args['msg'] = 'Yuo password has been update at!';
            endif;
        endif;
        return $response->withJson($this->args);
    }

}
