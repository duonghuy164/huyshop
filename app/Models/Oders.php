<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Oders extends Model
{
    //
    protected $table ='oders';
    protected $fillable =[
    	'code_order','idUser','name','address','email','phone','monney','message','status',

    ];

    public function User(){
    	// xem don hang cua user nao
    	return $this->belongsTo('App\Models\User','idOder','id');
    }
    public function Product(){
    	// xem co nhung san pham gi
    	return $this->belongsTo('App\Models\Product','idProduct','id');
    }
}
