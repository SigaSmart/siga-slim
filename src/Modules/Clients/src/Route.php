<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace SIGA\Clients;

/**
 * Description of Route
 *
 * @author caltj
 */
class Route extends \SIGA\Core\RouteAbstract {

    //put your code here
    public function create() {
        //rotas admin products protegidas
        $this->app->group('/admin', function () {
            $this->get('/clients', Controllers\ClientsController::class . ':index')->setName('clients');
            $this->get('/clients/create', Controllers\ClientsController::class . ':create')->setName('clients.create');
            $this->get('/clients/{id}/edit', Controllers\ClientsController::class . ':edit')->setName('clients.edit');
            $this->get('/clients/{id}/ativar', Controllers\ClientsController::class . ':ativar')->setName('clients.ativar');
            $this->get('/clients/{id}/desativar', Controllers\ClientsController::class . ':desativar')->setName('clients.desativar');
            $this->get('/clients/{id}/delete', Controllers\ClientsController::class . ':delete')->setName('clients.delete');
            $this->post('/clients/upload', Controllers\ClientsController::class . ':upload')->setName('clients.upload');
            $this->post('/clients/store', Controllers\ClientsController::class . ':store')->setName('clients.store');
        })->add($this->app->getContainer()->get('AdminMiddleware'))->add($this->app->getContainer()->get('AuthMiddleware'));

        //rotas da api protegidas
        $this->app->group('/api', function () {
            // Due to the behaviour of browsers when sending PUT or DELETE request, you must add the OPTIONS method. Read about preflight.
            $this->get('/clients', sprintf("%s:listar", Api\V1\Controllers\ClientsController::class));
        })->add($this->app->getContainer()->get('AuthMiddleware'));
    }

}
