<?php

// DIC configuration

$container = $app->getContainer();

$app->add(new SIGA\Core\Middleware\SessionMiddleware([
    'name' => 'authenticate',
    'autorefresh' => true,
    'lifetime' => '1 hour'
]));

use Respect\Validation\Validator as v;
use Cocur\Slugify\Slugify;

// Register globally to app
$container['session'] = function () {
    return new SIGA\Core\Helper\SessionHelper;
};

$container['slug'] = function () {
    $slugify = new Slugify();
    $slugify->activateRuleSet('portuguese-brazil');
    return $slugify;
};
$container['csrf'] = function () {
    return new Slim\Csrf\Guard;
};

// Register provider
$container['flash'] = function () {
    return new \Slim\Flash\Messages();
};

// view renderer
$container['AdminMiddleware'] = function ($c) {
    return new SIGA\Core\Middleware\AdminMiddleware($c);
};

$container['HomeMiddleware'] = function ($c) {
    return new SIGA\Core\Middleware\HomeMiddleware($c);
};

$container['AuthMiddleware'] = function ($c) {
    return new SIGA\Authentication\Middleware\AuthMiddleware($c);
};
$container['GuestMiddleware'] = function ($c) {
    return new SIGA\Authentication\Middleware\GuestMiddleware($c);
};


$container['CsrfViewMiddleware'] = function ($c) {
    return new SIGA\Core\Middleware\CsrfViewMiddleware($c);
};

$container['alert'] = function ($c) {
    return new SIGA\Core\Utils\Alert($c);
};

$container['active'] = function ($c) {
    return new SIGA\Core\Utils\RuoterActive($c->get('request'));
};


// view renderer
$container['auth'] = function ($c) {
    return new \SIGA\Authentication\Auth\Auth($c);
};

// view renderer
$container['util'] = function ($c) {
   return new SIGA\Core\Utils\Util($c);
};

// view renderer
$container['renderer'] = function ($c) {
    $settings = $c->get('settings')['renderer'];
    $view = new \SIGA\Core\Views\Views($settings['template_path'], [
        'router' => $c->router,
        'csrf' => $c->CsrfViewMiddleware,
        'flash' => $c->flash,
        'alert' => $c->alert,
        'auth' => $c->auth,
        'active' => $c->active,
        'util' => $c->util
    ]);
    return $view;
};

$app->add(function ($req, $res, $next) {
    $response = $next($req, $res);
    return $response
                    ->withHeader('Access-Control-Allow-Origin', 'http://localhost:8080')
                    ->withHeader('Access-Control-Allow-Headers', 'X-Requested-With, Content-Type, Accept, Origin, Authorization')
                    ->withHeader('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS');
});

$container['validator'] = function ($c) {
    return new SIGA\Core\Validation\Validator();
};

// monolog
$container['logger'] = function ($c) {
    $settings = $c->get('settings')['logger'];
    $logger = new Monolog\Logger($settings['name']);
    $logger->pushProcessor(new Monolog\Processor\UidProcessor());
    $logger->pushHandler(new Monolog\Handler\StreamHandler($settings['path'], $settings['level']));
    return $logger;
};


// eloquent
$container['db'] = function ($c) {
    $capsule = new \Illuminate\Database\Capsule\Manager;
    $capsule->addConnection($c['settings']['db']);

    $capsule->setAsGlobal();
    $capsule->bootEloquent();

    return $capsule;
};

$container['db'];

v::with('SIGA\\Core\\Validation\\Rules\\');
