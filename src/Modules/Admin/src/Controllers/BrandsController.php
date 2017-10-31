<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace SIGA\Admin\Controllers;
use Psr\Http\Message\RequestInterface as Resquest;
use Psr\Http\Message\ResponseInterface as Response;
/**
 * Description of BrandsController
 *
 * @author caltj
 */
class BrandsController extends \SIGA\Core\Controllers\ControllerAbstract {

    protected $route = 'brands';
    protected $template = "admin/views/brands/index";
    protected $templateEdit = "admin/views/brands/edit";
    protected $templateCreate = "admin/views/brands/create";
    protected $model = \SIGA\Admin\Models\Brand::class;

    public function create(Resquest $request, Response $response) {
        $this->data = [
            'name' => 'New Brands',
            'status' => '0',
            'alias' => sprintf('new-brands-%s', date("Y-m-d-H-i-s"))
        ];
        return parent::create($request, $response);
    }

    public function store(Resquest $request, Response $response) {
        $result = [];
        if ($request->isPost()):
            $this->data = $request->getParams();
            $this->data['alias'] = $this->slug->slugify($this->data['name']);
            $this->args = array_merge($this->args, $this->data);
            $validation = $this->validator->validate($this->data, [
                'name' => $this->vNoEmpty()
            ]);
            if ($validation->failed()):
                $this->args['msg'] = sprintf("%s", $this->validator->getErrorMsg('name'));
                return $response->withJson($this->args);
            endif;
            unset($this->data['csrf_name'], $this->data['csrf_value']);

            $result = parent::store($request, $response);
            $this->inputs['inputs'] = [
                'alias' => $this->data['alias']
            ];
            return $response->withJson(array_merge($this->args, $this->inputs));
        endif;
        return $response->withJson($result);
    }

}
