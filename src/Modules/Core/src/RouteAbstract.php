<?php


namespace SIGA\Core;

use Slim\App;

abstract class RouteAbstract
{
    /**
     * @var App
     */
    protected $app;

    /**
     * Route constructor.
     * @param App $app
     */
    public function __construct(App $app)
    {
        $this->app = $app;
    }

    abstract public function create();
}