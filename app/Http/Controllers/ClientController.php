<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Products;
use App\Models\ProductType;
use App\Models\User;

class ClientController extends Controller
{
    //
    public function __construct(){
    	$categoryall=Category::where('status',1)->get();
    	$category = Category::where('status',1)->paginate(7);
    	$productype = ProductType::where('status',1)->get();
    	view()->share(['categoryall'=>$categoryall,'producttype'=>$productype,'category'=>$category]);
    }

    public function index(){
    	$phone = Products::where('idCategory',2)->paginate(6);
    	//dd($phone);

    	$tablet= Products::where('idCategory',1)->paginate(6);

    	$phukien = Products::where('idCategory',11)->paginate(6);
    	//dd($tablet);
    	$dienmay = Products::where('idCategory',5)->paginate(9);
    	return view('client.pages.index',['phone'=>$phone,'tablet'=>$tablet,'phukien'=>$phukien,'dienmay'=>$dienmay]);

    }
}
