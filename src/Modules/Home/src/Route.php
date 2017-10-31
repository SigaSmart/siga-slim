<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace SIGA\Home;

/**
 * Description of Rouet
 *
 * @author caltj
 */
class Route extends \SIGA\Core\RouteAbstract {
   
    
    public function create() {
        $this->app->get('[/]', sprintf("%s:index", Controllers\HomeController::class));
    }

}
