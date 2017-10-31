<?php

namespace SIGA\Authentication;

use SIGA\Authentication\Controllers\AuthenticationController;

class Route extends \SIGA\Core\RouteAbstract {

    public function create() {
        $this->app->group('/admin', function () {

            $this->map(['GET', 'POST'], '/login', AuthenticationController::class . ':login')->setName('login');

            $this->map(['GET', 'POST'], '/register', AuthenticationController::class . ':register')->setName('register');

            $this->map(['GET', 'POST'], '/forgot', AuthenticationController::class . ':forgot')->setName('forgot');
        })->add($this->app->getContainer()->get('AdminMiddleware'))->add($this->app->getContainer()->get('GuestMiddleware'));

        $this->app->group('/admin', function () {

            $this->get('/usuarios', Controllers\UsuariosController::class . ':index')->setName('usuarios');

            $this->map(['GET', 'POST'], '/usuarios/{id}/edit', Controllers\UsuariosController::class . ':edit')->setName('usuarios.edit');

            $this->get('/usuarios/{id}/delete', Controllers\UsuariosController::class . ':delete')->setName('usuarios.delete');

            $this->post('/usuarios/store', Controllers\UsuariosController::class . ':store')->setName('usuarios.store');

            $this->post('/usuarios/password', Controllers\UsuariosController::class . ':password')->setName('usuarios.reset.password');

            $this->post('/usuarios/upload', Controllers\UsuariosController::class . ':upload')->setName('usuarios.upload');
        })->add($this->app->getContainer()->get('AdminMiddleware'))->add($this->app->getContainer()->get('AuthMiddleware'));

         //rotas sem layout
        $this->app->group('/admin', function () {
            $this->get('/usuarios/busca[/{busca}]', Controllers\UsuariosController::class . ':busca')->setName('usuarios.busca');
        })->add($this->app->getContainer()->get('AuthMiddleware'));

        
        // Pay attention to this when you are using some javascript front-end framework and you are using groups in slim php
        $this->app->group('/api', function () {
            // Due to the behaviour of browsers when sending PUT or DELETE request, you must add the OPTIONS method. Read about preflight.
            $this->get('/usuarios/busca', sprintf("%s:busca", Api\Controllers\UsuariosController::class));
            $this->get('/usuarios/lista', sprintf("%s:lista", Api\Controllers\UsuariosController::class));
        })->add($this->app->getContainer()->get('AuthMiddleware'));
        //rotas da api protegidas
    }

}
