<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Products;
use App\Models\Category;
use App\Models\ProductType;
use Cart;
use Auth;

class CartController extends Controller
{
    //
    public function __construct(){
    	$categoryall=Category::where('status',1)->get();
    	$category = Category::where('status',1)->paginate(7);
    	$productype = ProductType::where('status',1)->get();
    	view()->share(['categoryall'=>$categoryall,'producttype'=>$productype,'category'=>$category]);
    }

    public function index()
    {
    	$cart = Cart::content();
    	return view('client.pages.cart',compact('cart'));
    }
    public function addCart($id,Request $request){
    	$product = Products::find($id);
    	if($request->qty){
    		$qty=$request->qty;
    	}else{
    		$qty=1;
    	}
    	if($product->promotinal>0){
            $price = $product->promotinal;
        }else{
            $price = $product->price;
        }
    	$cart = ['id'=>$id,'name'=>$product->name,'qty'=>$qty,'price'=>$price,'options' => ['img' => $product->image]];
    	Cart::add($cart);
    	 return back()->with('thongbao','Đã thêm '.$product->name.' vào giỏ thành công');
    	

    }

    public function update(Request $request,$id){
    	//id== rowId gui sang 
    	if($request->ajax()){
    		Cart::update($id,$request->qty);
    		return response()->json(['result'=>'Đã update']);
    	}
    }
    public function destroy($id){
    	Cart::remove($id);
    	return response()->json(['result'=>'Đã xóa thành công']);
    }


    
    
}
