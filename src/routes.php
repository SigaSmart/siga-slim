<?php
// Routes

(new \SIGA\Authentication\Route($app))->create();
(new \SIGA\Home\Route($app))->create();
(new \SIGA\Admin\Route($app))->create();
(new \SIGA\Clients\Route($app))->create();