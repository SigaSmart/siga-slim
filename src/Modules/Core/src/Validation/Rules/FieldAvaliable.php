<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace SIGA\Core\Validation\Rules;

use Respect\Validation\Rules\AbstractRule;

/**
 * Description of FieldAvaliable
 *
 * @author caltj
 */
class FieldAvaliable extends AbstractRule {

    private $id;
    private $filed;
    //put your code here

    private $model;

    public function __construct($model, $filed, $id) {

        $this->model = $model;
        $this->filed = $filed;
        $this->id = $id;
    }

    public function validate($input) {
        $Register = $this->model::where($this->filed, $input)->first();
        if ($Register):
            if ((int) $Register->id == (int) $this->id):
                return TRUE;
            endif;
            return FALSE;
        endif;
        return TRUE;
    }

}
