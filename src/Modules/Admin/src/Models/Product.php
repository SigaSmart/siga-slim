<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace SIGA\Admin\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Description of Product
 *
 * @author caltj
 */
class Product extends Model {

    protected $fillable = [
        'empresa', 'category', 'name', 'preview', 'cover', 'costs', 'marge','price', 'desc', 'alias'
    ];
    
    public function relationCategories()
    {
        return $this->hasMany(Category::class, 'id')->get();
    }

}
