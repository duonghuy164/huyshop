<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    //
    protected $table ='category';
    protected $fillable=[
    	'name','slug','status',
        // nhũng trường này sẽ thêm mới trong databe . fillable giup giam so dong them du lieu trong controler
    ];

    public function productType()
    {
    	// lay cac productType trong category
    	return $this->hasMany('App\Models\ProductType','idCategory','id');
    }
}
