<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace SIGA\Admin\Controllers;

use Psr\Http\Message\RequestInterface,
    Psr\Http\Message\ResponseInterface;

/**
 * Description of AdminController
 *
 * @author caltj
 */
class ProductsController extends \SIGA\Core\Controllers\ControllerAbstract {

    protected $route = 'products';
    protected $template = "admin/views/products/index";
    protected $templateEdit = "admin/views/products/edit";
    protected $templateCreate = "admin/views/products/create";
    protected $model = \SIGA\Admin\Models\Product::class;

    public function create(RequestInterface $request, ResponseInterface $response) {
        $this->data = [
            'name' => 'New Product',
            'preview' => '',
            'price' => '0',
            'marge' => '0',
            'costs' => '0',
            'status' => '0',
            'alias' => sprintf('new-product-%s', date("Y-m-d-H-i-s"))
        ];
        return parent::create($request, $response);
    }

    public function store(RequestInterface $request, ResponseInterface $response) {
        if ($request->isPost()):
            $this->data = $request->getParams();
            $this->data['price'] = $this->util->Calcular($this->data['costs'], $this->data['marge'], "%");
            $this->data['price'] = $this->util->form_w($this->data['price']);
            $this->data['costs'] = $this->util->form_w($this->data['costs']);
            $this->data['marge'] = $this->util->form_w($this->data['marge']);
             $this->data['alias'] = $this->slug->slugify($this->data['name']);
            $this->args = array_merge($this->args, $this->data);
            $validation = $this->validator->validate($this->data, [
                'name' => $this->vNoEmpty(),
                'alias' => $this->vSlug(),
                'costs' => $this->vFloat(),
                'marge' => $this->vFloat(),
                'price' => $this->vFloat()
            ]);
            if ($validation->failed()):
                $this->args['msg'] = sprintf("%s %s", $this->validator->getErrorMsg('name'), $this->validator->getErrorMsg('costs'));
                return $response->withJson($this->args);
            endif;
            unset($this->data['csrf_name'], $this->data['csrf_value']);

            $result = parent::store($request, $response);
            $this->inputs['inputs'] = [
                'price' => $this->data['price'],
                'alias' => $this->data['alias'],
            ];
            return $response->withJson(array_merge($this->args, $this->inputs));
        endif;
        return $response->withJson($result);
    }

    public function busca(RequestInterface $request, ResponseInterface $response) {
        $data = [];
        if (!empty($request->getParam('busca'))):
            $data = \SIGA\Admin\Api\Models\Product::where('name', 'LIKE', "%{$request->getParam('busca')}%")->orWhere('preview', 'LIKE', "%{$request->getParam('busca')}%")->get();
        endif;

        return $this->renderer->render($response, "admin/views/products/busca.phtml", [
                    'data' => $data,
                    'route' => $this->c->get('router')
        ]);
    }

}
