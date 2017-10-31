<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace SIGA\Core\Views;

/**
 * Description of Views
 *
 * @author caltj
 */
class Views extends \Slim\Views\PhpRenderer{
   
    public function __construct($templatePath = "", $attributes = array()) {
        parent::__construct($templatePath, $attributes);
         if($this->attributes):
             foreach ($this->attributes as $key => $value) {
                 $this->{$key} = $value;
             }
        endif;
    }
    public function partials($template, $data=[])
    {
        return parent::fetch(sprintf("admin/partials/%s.phtml",$template), $data);
    }

    public function __get($name) {
        return $this->{$name};
    }
}
