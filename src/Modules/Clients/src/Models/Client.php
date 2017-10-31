<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace SIGA\Clients\Models;

use Illuminate\Database\Eloquent\Model;
/**
 * Description of Client
 *
 * @author caltj
 */
class Client extends Model{
    
      protected $fillable = [
       'id', 'empresa', 'first_name', 'last_name', 'cover', 'status'
    ];
}
