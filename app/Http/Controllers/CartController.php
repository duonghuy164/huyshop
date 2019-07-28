<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Products;
use App\Models\Category;
use App\Models\ProductType;
use App\Models\Oders;
use App\Models\OderDetail;
use Cart;
use Auth;
use Mail;
use App\Mail\ShoppingMail;

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
    public function store(Request $request){
        $data =$request->all();
        //$data['monney']=str_replace(',', '',$request->monney);
        $data['idUser']=Auth::user()->id;
        $data['code_order']= 'order'.rand();
        $data['status']=0;
        $order = Oders::create($data);
        $idOder =$order->id;
        $oderdetail=[];

        $oderdetails = [];
        foreach(Cart::content() as $key => $cart){
            $oderdetail['idOrder']= $idOder;
            $oderdetail['idProduct']=$cart->id;
            $oderdetail['quantity']=$cart->qty;
            $oderdetail['price']=$cart->price;
            $oderdetails[$key]=OderDetail::create($oderdetail);



        }
        Mail::to($order->email)->send(new ShoppingMail($order,$oderdetails));
        // xóa giỏ hàng sau khi mua thành công 
        Cart::destroy();
        return response()->json('Đã mua hàng thành công',200);

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

    public function checkout(){
        $user =Auth::user();
        $price = str_replace(',', '', Cart::total());
       
        return view('client.pages.checkout',compact('user','price'));
    }
    

    
    
}
