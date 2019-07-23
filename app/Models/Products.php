<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
    //
     protected $table = 'products';
     protected $fillable =[
     	'name','slug','quantity','description','price','promotinal','idCategory','image','idProductType','status',

     ];
     public function productType(){
     	// xem san pham thuoc loai san pham nao
     	return $this->belongsTo('App\Models\ProductType','idProductType','id');
     }

     public function category(){
     	// xem san pham thuoc danh muc nao
     	return $this->belongsTo('App\Models\Category','idCategory','id');
     }
}
