<?php

namespace SIGA\Authentication\Models;

use Illuminate\Database\Eloquent\Model;
use Respect\Validation\Validator as v;
use Slim\Container;

class User extends Model {

    protected $fillable = [
        'empresa', 'first_name', 'last_name', 'email', 'cover', 'password', 'role','desc','code'
    ];
    protected $hidden = [
        'password'
    ];

    public function validator(Container $c, $request) {
        $validation = $c->validator->validate($request, [
            'first_name' => v::noWhitespace()->notEmpty(),
            'last_name' => v::noWhitespace()->notEmpty()
        ]);
        return $validation->failed();
    }

}
