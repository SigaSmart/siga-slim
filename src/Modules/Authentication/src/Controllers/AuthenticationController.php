<?php

namespace SIGA\Authentication\Controllers;

use SIGA\Core\Controllers\ControllerAbstract;
use Psr\Http\Message\RequestInterface,
    Psr\Http\Message\ResponseInterface;
use SIGA\Authentication\Models\User;

class AuthenticationController extends ControllerAbstract {

    protected $template = "admin/auth/login";

    public function login(RequestInterface $request, ResponseInterface $response) {

        if ($request->isPost()):
            $auth = $this->auth->attempt($request->getParam('email'), $request->getParam('password'));

            if (!$auth):
                $this->flash->addMessage('error', "Could not sign in with those details.");
                return $response->withRedirect($this->router->pathFor('login'));

            endif;
            $this->flash->addMessage('success', "You have been signed in!");
            return $response->withRedirect($this->router->pathFor('admin'));
        endif;
        // $this->flash->addMessage('info', "Sign in to start your session.");
        return $this->renderer->render($response, "{$this->template}.phtml", ['defaultMsg' => 'Sign in to start your session.']);
    }

    public function register(RequestInterface $request, ResponseInterface $response) {
        $validation = $this->validator->validate($this->data, []);
        if ($request->isPost()):
            $this->data = $request->getParams();
            $validation = $this->validator->validate($this->data, [
                'email' => $this->vWs()->email()->EmailAvaliable(User::class),
                'first_name' => $this->vNoEmpty()->alpha(),
                'last_name' => $this->vNoEmpty()->alpha(),
                'password' => $this->vWs()->matchesPassword(password_hash($this->data['retype_password'], PASSWORD_DEFAULT, [
                    'cost' => 10
                ]))
            ]);

            if (!$validation->failed()) {
                $user = User::create([
                            'first_name' => $this->data['first_name'],
                            'last_name' => $this->data['last_name'],
                            'email' => $this->data['email'],
                            'cover' => '/assets/img/user2-160x160.jpg',
                            'password' => password_hash($this->data['password'], PASSWORD_DEFAULT, [
                                'cost' => 10
                            ]),
                            'role' => 'client',
                ]);
                $this->auth->attempt($user->email, $this->data['password']);
                $this->flash->addMessage('success', "Could not sign in with those details.");
                return $response->withRedirect($this->router->pathFor('register'));
            }
        endif;
        // $this->flash->addMessage('info', "Register a new membership.");
        return $this->renderer->render($response, "admin/auth/register.phtml", [
                    'defaultMsg' => 'Register a new membership.',
                    'validation' => $validation]);
    }

    public function forgot(RequestInterface $request, ResponseInterface $response) {
        if ($request->isPost()):

        endif;
        // $this->flash->addMessage('info', "Forgot my password.");
        return $this->renderer->render($response, "admin/auth/forgot.phtml", ['defaultMsg' => 'Forgot my password.']);
    }

    public function logout(RequestInterface $request, ResponseInterface $response) {
        $this->auth->logout();
        $this->flash->addMessage('success', "You have been signed out!");
        return $response->withRedirect($this->router->pathFor('login'));
    }

}
