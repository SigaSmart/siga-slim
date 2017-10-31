<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace SIGA\Core\Utils;

/**
 * Description of RuoterActive
 *
 * @author caltj
 */
class RuoterActive {

    /**
     * @var \Psr\Http\Message\RequestInterface
     */
    private $request;

    public function __construct(\Psr\Http\Message\RequestInterface $request) {
        
        $this->request = $request;
    }
    
    public function active($route) {
        if($this->request->getUri()->getPath()==$route):
            return "active";
        endif;
        
         if(strstr($this->request->getUri()->getPath(), $route)):
            return "active";
        endif;
        return "";
    }

}
