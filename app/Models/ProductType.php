<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductType extends Model
{
    //
    protected $table ="product_types";// lien ket model voi ang product_type

    protected $fillable =[
    	'idCategory','name','slug','status',


    ];
    public function Category(){
     	// xem  loai san pham thuoc danh muc nao
     	return $this->belongsTo('App\Models\Category','idCategory','id');
     }
}
