<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace SIGA\Authentication\Auth;

/**
 * Description of Auth
 *
 * @author caltj
 */
class Auth {

    private $container;
    private $session;

    public function __construct($container) {

        $this->container = $container;
        $this->session = $this->container->session;
    }

    public function user() {

        if (!$this->check()):
            return [];
        endif;
        return \SIGA\Authentication\Models\User::find($this->session->get('user','default'));
    }

    public function check() {

        return $this->session->exists('user');
    }

    public function attempt($email, $password) {

        $user = \SIGA\Authentication\Models\User::where('email', $email)->first();
        
        if (!$user):

            return FALSE;

        endif;

        if (password_verify($password, $user->password)):

            $this->session->set('user', $user->id);

            return TRUE;
            
        endif;

        return FALSE;
    }

    public function logout() {

        // Destroy session
        $this->session::destroy();
    }

}
