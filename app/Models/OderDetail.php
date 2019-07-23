<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OderDetail extends Model
{
    //
    protected $table ='oder_details';
    protected $fillable =[
    	'idOrder','idProduct','quantity','price',


    ]
    //xem chi tiet order cua order nao
    public function Order()
    {
    	return $this->belongsTo('App\Models\Order','idOder','id');
    }
}
