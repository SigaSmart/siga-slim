<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace SIGA\Core\Validation\Rules;

use Respect\Validation\Rules\AbstractRule;

/**
 * Description of EmailAvaliable
 *
 * @author caltj
 */
class EmailAvaliable extends AbstractRule {
    //put your code here
   
     private $model;

    public function __construct($model) {

        $this->model = $model;
    }
    public function validate($input) {
        return !$this->model::where('email',$input)->count();
    }

}
