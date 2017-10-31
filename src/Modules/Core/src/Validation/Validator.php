<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace SIGA\Core\Validation;

use Respect\Validation\Exceptions\NestedValidationException;

/**
 * Description of Validator
 *
 * @author caltj
 */
class Validator {

    protected $errors;

    public function validate($request, $rules = []) {

        foreach ($rules as $field => $rule) {
            try {
                $rule->setName(ucfirst($field))->assert($request[$field]);
            } catch (NestedValidationException $exc) {
                $this->errors[$field] = $exc->getMessages();
            }
        }
        return $this;
    }

    public function failed() {

        return !empty($this->errors);
    }

    public function getErrors() {
        return $this->errors;
    }

    public function getError($input,$class='has-error') {
       if($this->failed()):
           return isset($this->errors[$input]) ? $class : '';
       endif;
       return '';
    }
    public function getErrorMsg($input) {
       if($this->failed()):
           return isset($this->errors[$input]) ? array_pop( $this->errors[$input]) : '';
       endif;
       return '';
    }

}
