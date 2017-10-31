<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace SIGA\Admin\Models;

/**
 * Description of Category
 *
 * @author caltj
 */
class Category extends \Illuminate\Database\Eloquent\Model{
   
     protected $fillable = [
        'empresa', 'name', 'cover', 'alias', 'status'
    ];
     
}
