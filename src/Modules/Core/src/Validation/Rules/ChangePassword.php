<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace SIGA\Core\Validation\Rules;

use Respect\Validation\Rules\AbstractRule;

/**
 * Description of MatchesPassword
 *
 * @author caltj
 */
class ChangePassword extends AbstractRule {

    private $password;

    public function __construct($password) {

        $this->password = $password;
    }

    public function validate($input) {
        return password_verify($input, $this->password);
    }

}
