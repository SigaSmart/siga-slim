<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace SIGA\Admin;

/**
 * Description of Route
 *
 * @author caltj
 */
class Route extends \SIGA\Core\RouteAbstract {

    //put your code here
    public function create() {
        //rotas admin protegidas
        $this->app->group('', function () {
            $this->get('/admin', Controllers\AdminController::class . ':index')->setName('admin');
            $this->get('/admin/demo', Controllers\AdminController::class . ':demo');
            $this->get('/admin/cidades', Controllers\AdminController::class . ':cidades');
            $this->get('/admin/logout', sprintf("%s:logout", \SIGA\Authentication\Controllers\AuthenticationController::class))->setName('logout');
        })->add($this->app->getContainer()->get('AdminMiddleware'))->add($this->app->getContainer()->get('AuthMiddleware'));


        //rotas admin products protegidas
        $this->app->group('/admin', function () {
            $this->get('/products', Controllers\ProductsController::class . ':index')->setName('products');
            $this->get('/products/create', Controllers\ProductsController::class . ':create')->setName('products.create');
            $this->get('/products/{id}/edit', Controllers\ProductsController::class . ':edit')->setName('products.edit');
            $this->get('/products/{id}/ativar', Controllers\ProductsController::class . ':ativar')->setName('products.ativar');
            $this->get('/products/{id}/desativar', Controllers\ProductsController::class . ':desativar')->setName('products.desativar');
            $this->get('/products/{id}/delete', Controllers\ProductsController::class . ':delete')->setName('products.delete');
            $this->post('/products/upload', Controllers\ProductsController::class . ':upload')->setName('products.upload');
            $this->post('/products/store', Controllers\ProductsController::class . ':store')->setName('products.store');
        })->add($this->app->getContainer()->get('AdminMiddleware'))->add($this->app->getContainer()->get('AuthMiddleware'));

        //rotas admin categorias protegidas
        $this->app->group('/admin', function () {
            $this->get('/categories', Controllers\CategoriesController::class . ':index')->setName('categories');
            $this->get('/categories/create', Controllers\CategoriesController::class . ':create')->setName('categories.create');
            $this->get('/categories/{id}/edit', Controllers\CategoriesController::class . ':edit')->setName('categories.edit');
            $this->get('/categories/{id}/ativar', Controllers\CategoriesController::class . ':ativar')->setName('categories.ativar');
            $this->get('/categories/{id}/desativar', Controllers\CategoriesController::class . ':desativar')->setName('categories.desativar');
            $this->get('/categories/{id}/delete', Controllers\CategoriesController::class . ':delete')->setName('categories.delete');
            $this->post('/categories/upload', Controllers\CategoriesController::class . ':upload')->setName('categories.upload');
            $this->post('/categories/store', Controllers\CategoriesController::class . ':store')->setName('categories.store');
        })->add($this->app->getContainer()->get('AdminMiddleware'))->add($this->app->getContainer()->get('AuthMiddleware'));


        //rotas admin brands protegidas
        $this->app->group('/admin', function () {
            $this->get('/brands', Controllers\BrandsController::class . ':index')->setName('brands');
            $this->get('/brands/create', Controllers\BrandsController::class . ':create')->setName('brands.create');
            $this->get('/brands/{id}/edit', Controllers\BrandsController::class . ':edit')->setName('brands.edit');
            $this->get('/brands/{id}/ativar', Controllers\BrandsController::class . ':ativar')->setName('brands.ativar');
            $this->get('/brands/{id}/desativar', Controllers\BrandsController::class . ':desativar')->setName('brands.desativar');
            $this->get('/brands/{id}/delete', Controllers\BrandsController::class . ':delete')->setName('brands.delete');
            $this->post('/brands/upload', Controllers\BrandsController::class . ':upload')->setName('brands.upload');
            $this->post('/brands/store', Controllers\BrandsController::class . ':store')->setName('brands.store');
        })->add($this->app->getContainer()->get('AdminMiddleware'))->add($this->app->getContainer()->get('AuthMiddleware'));

          //rotas admin companys protegidas
        $this->app->group('/admin', function () {
            $this->get('/companys', Controllers\CompanysController::class . ':index')->setName('companys');
            $this->get('/companys/create', Controllers\CompanysController::class . ':create')->setName('companys.create');
            $this->get('/companys/{id}/edit', Controllers\CompanysController::class . ':edit')->setName('companys.edit');
            $this->get('/companys/{id}/ativar', Controllers\CompanysController::class . ':ativar')->setName('companys.ativar');
            $this->get('/companys/{id}/desativar', Controllers\CompanysController::class . ':desativar')->setName('companys.desativar');
            $this->get('/companys/{id}/delete', Controllers\CompanysController::class . ':delete')->setName('companys.delete');
            $this->post('/companys/upload', Controllers\CompanysController::class . ':upload')->setName('companys.upload');
            $this->post('/companys/store', Controllers\CompanysController::class . ':store')->setName('companys.store');
        })->add($this->app->getContainer()->get('AdminMiddleware'))->add($this->app->getContainer()->get('AuthMiddleware'));


        //rotas sem layout
        $this->app->group('/admin', function () {
            $this->get('/products/busca[/{busca}]', Controllers\ProductsController::class . ':busca')->setName('products.busca');
        })->add($this->app->getContainer()->get('AuthMiddleware'));



        //rotas da api protegidas
        $this->app->group('/api', function () {
            // Due to the behaviour of browsers when sending PUT or DELETE request, you must add the OPTIONS method. Read about preflight.
            $this->get('/demo', sprintf("%s:demo", Api\Controllers\DemoController::class));
            $this->get('/cidade', sprintf("%s:cidade", Api\Controllers\CidadeController::class));
            $this->get('/categories', sprintf("%s:listar", Api\Controllers\CategoriesController::class));
            $this->get('/brands', sprintf("%s:listar", Api\Controllers\BrandsController::class));
            $this->get('/products', sprintf("%s:listar", Api\Controllers\ProductsController::class));
            $this->get('/companys', sprintf("%s:listar", Api\Controllers\CompanysController ::class));
            $this->get('/busca', sprintf("%s:busca", Api\Controllers\ProductsController::class));
        })->add($this->app->getContainer()->get('AuthMiddleware'));
    }

}
