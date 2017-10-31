<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace SIGA\Admin\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Description of Companys
 *
 * @author caltj
 */
class Company extends Model {

    protected $fillable = [
        'id', 'name', 'status'
    ];

}
