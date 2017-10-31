<?php

namespace SIGA\Core\Controllers;

use Slim\Container;
use Slim\Http\UploadedFile;
use Respect\Validation\Validator as v;
use Psr\Http\Message\RequestInterface as Resquest;
use Psr\Http\Message\ResponseInterface as Response;

abstract class ControllerAbstract {

    /**
     * @var Container
     */
    protected $c;
    protected $route;
    protected $template = 'site/layout';
    protected $templateCreate = 'site/layout';
    protected $templateEdit = 'site/layout';
    protected $fildsUnset = [''];

    /**
     *
     * @var Illuminate\Database\Eloquent\Model
     */
    protected $model;
    protected $args = [
        'type' => 'error',
        'title' => 'Cancelled!',
        'msg' => 'Your register is safe :)',
        'result' => 0,
        'refresh' => 1
    ];
    protected $data;
    protected $inputs = [];
    private $templateBusca = 'admin/notfound';

    /**
     * ControllerAbstract constructor.
     * @param Container $c
     */
    public function __construct(Container $c) {
        $this->c = $c;
    }

    public function index(Resquest $request, Response $response) {
        $data = [];
        $objModel = [];
        if ($this->model):
            $data = $this->model::all();
            $objModel = (new \ReflectionClass($this->model))->newInstance();
        endif;
        return $this->renderer->render($response, "{$this->template}.phtml", [
                    'route' => $this->route,
                    'model' => $objModel,
                    'data' => $data
        ]);
    }

    public function busca(Resquest $request, Response $response) {
        $data = [];
        if ($this->model):
            $data = $this->model::where('name', 'LIKE', "%{$request->getParam('busca')}%")->get();
        endif;

        return $this->renderer->render($response, "{$this->templateBusca}.phtml", [
                    'route' => $this->route,
                    'data' => $data
        ]);
    }

    public function create(Resquest $request, Response $response) {

        if (empty($this->model)):
            $this->flashMessage("info", "Uma model valida deve ser passado");
            return $response->withRedirect($this->router->pathFor($this->route));
        endif;
        $objModel = (new \ReflectionClass($this->model))->newInstance();
        $result = $objModel->create($this->data);
        return $response->withRedirect($this->router->pathFor(sprintf("%s.edit", $this->route), [
                            'id' => $result->id
        ]));
    }

    public function edit(Resquest $request, Response $response, $args) {
        $objModel = (new \ReflectionClass($this->model))->newInstance();
        $data = $objModel->find($args['id']);
        if (!$data):
            $this->flash->addMessage('info', 'register not found!');
            return $response->withRedirect($this->router->pathFor($this->route));
        endif;
        return $this->renderer->render($response, "{$this->templateEdit}.phtml", [
                    'data' => $data,
                    'model' => $objModel,
                    'route' => $this->route
        ]);
    }

    public function desativar(Resquest $request, Response $response, $args) {
        $objModel = (new \ReflectionClass($this->model))->newInstance();
        $this->args = array_merge($this->args, $args);
        $data = $objModel->find($this->args['id']);
        if ($data):
            $this->data['status'] = 0;
            $this->args['result'] = $objModel->where('id', $this->args['id'])->update($this->data);
        endif;
        return $response->withJson($this->args);
    }

    public function ativar(Resquest $request, Response $response, $args) {
        $objModel = (new \ReflectionClass($this->model))->newInstance();
        $this->args = array_merge($this->args, $args);
        $data = $objModel->find($this->args['id']);
        if ($data):
            $this->data['status'] = 1;
            $this->args['result'] = $objModel->where('id', $this->args['id'])->update($this->data);
        endif;
        return $response->withJson($this->args);
    }

    public function delete(Resquest $request, Response $response, $args) {
        $objModel = (new \ReflectionClass($this->model))->newInstance();
        $this->args = array_merge($this->args, $args);
        if ($this->args['id']):
            $this->args['result'] = $objModel->where('id', $this->args['id'])->delete();
            $this->args['type'] = 'success';
            $this->args['title'] = 'Deleted!';
            $this->args['msg'] = 'Your register has been deleted!';
            $this->args['refresh'] = $objModel->query()->count();
        endif;
        return $response->withJson($this->args);
    }

    public function store(Resquest $request, Response $response) {
        if ($request->isPost()):
            $objModel = (new \ReflectionClass($this->model))->newInstance();
            if (isset($this->args['id']) || (int) $this->args['id']):
                $this->args['type'] = 'success';
                $this->args['title'] = 'Success!';
                $this->args['msg'] = 'Resister as benn update at!';
                $objModel->where('id', $this->args['id'])->update($this->data);
                return $response->withJson($this->args);
            endif;

            return $this->args;
        endif;
    }

    public function upload(Resquest $request, Response $response) {
        $objModel = (new \ReflectionClass($this->model))->newInstance();
        $this->args = array_merge($this->args, $request->getParams());
        $uploadedFiles = $request->getUploadedFiles();
// handle single input with single file upload
        $uploadedFile = $uploadedFiles['attachment'];
        if ($uploadedFile->getError() === UPLOAD_ERR_OK) {
            $directory = filter_input(INPUT_SERVER, 'DOCUMENT_ROOT');
            $filename = $this->moveUploadedFile($directory, $uploadedFile);
            $this->args['success'] = 1;
            $this->args['error'] = 0;
            $this->args['path'] = $directory;
            $objModel->where('id', $this->args['id'])->update(['cover' => $filename]);
        }
        return $response->withJson($this->args);
    }

    /**
     * Moves the uploaded file to the upload directory and assigns it a unique name
     * to avoid overwriting an existing uploaded file.
     *
     * @param string $directory directory to which the file is moved
     * @param UploadedFile $uploaded file uploaded file to move
     * @return string filename of moved file
     */
    protected function moveUploadedFile($directory, UploadedFile $uploadedFile) {
        $extension = pathinfo($uploadedFile->getClientFilename(), PATHINFO_EXTENSION);
        $basename = bin2hex(random_bytes(8));
        $filename = sprintf('%s.%0.8s', $basename, $extension);
        $dirUpload = str_replace("/", DIRECTORY_SEPARATOR, sprintf("%s/uploads/images", $directory));
        if (!is_dir($dirUpload)):
            mkdir($dirUpload);
        endif;
        if (!is_dir(str_replace("/", DIRECTORY_SEPARATOR, sprintf("%s/%s", $dirUpload, date("Y"))))):
            mkdir(str_replace("/", DIRECTORY_SEPARATOR, sprintf("%s/%s", $dirUpload, date("Y"))));
        endif;
        $dirUpload = str_replace("/", DIRECTORY_SEPARATOR, sprintf("%s/%s", $dirUpload, date("Y")));
        if (!is_dir(str_replace("/", DIRECTORY_SEPARATOR, sprintf("%s/%s", $dirUpload, date("m"))))):
            mkdir(str_replace("/", DIRECTORY_SEPARATOR, sprintf("%s/%s", $dirUpload, date("m"))));
        endif;
        $dirUpload = str_replace("/", DIRECTORY_SEPARATOR, sprintf("%s/%s", $dirUpload, date("m")));
        $uploadedFile->moveTo(str_replace("/", DIRECTORY_SEPARATOR, sprintf("%s/%s", $dirUpload, $filename)));

        return sprintf("uploads/images/%s/%s/%s", date("Y"), date("m"), $filename);
    }

    public function vWs() {
        return v::noWhitespace()->notEmpty();
    }

    public function vNoEmpty() {
        return v::notEmpty();
    }

    public function vFloat() {
        return v::floatVal();
    }

    public function vWsPhone() {
        return v::phone();
    }

    public function vSlug() {
        return v::slug();
    }

    protected function flashMessage($type, $message) {
        $this->flash->addMessage($type, $message);
    }

    public function __get($name) {

        if ($this->c->{$name}) {

            return $this->c->{$name};
        }
    }

}
