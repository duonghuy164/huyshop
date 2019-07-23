<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Products;
use App\Models\Category;
use App\Models\ProductType;

use App\Http\Requests\StoreProductRequest;
use File;
use Validator;
class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $product = Products::where('status',1)->paginate(5);
        return view('admin.pages.product.list',compact('product'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */    public function create()
    {
        $category = Category::where('status',1)->get();
        $producttype = ProductType::where('status',1)->get();
        return view('admin.pages.product.add',compact('category','producttype'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Illuminate\Http\StoreProductRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store( Request $request)
    {
        //
       if($request->hasFile('image')){
            $file = $request->image;
            //Lấy tên file
            $file_name = $file->getClientOriginalName();
            //Lấy loại file
            $file_type = $file->getMimeType();
            //Kích thước file với đơn vị byte
            $file_size = $file->getSize();
            if($file_type == 'image/png' || $file_type == 'image/jpg' || $file_type == 'image/jpeg' || $file_type == 'image/gif'){
                if($file_size <= 1048576){
                    $file_name = date('D-m-yyyy').'-'.rand().'-'.utf8tourl($file_name);

                    if($file->move('img/upload/product',$file_name)){
                        $data = $request->all();
                        $data['slug'] = utf8tourl($request->name);
                        $data['image'] = $file_name;
                        Products::create($data);

                        return redirect()->route('product.index')->with('thongbao','Đã thêm thành công sản phẩm mới');
                    }
                }else{
                    return back()->with('error','Bạn không thể upload ảnh quá 1mb');
                }
            }else{
                return back()->with('error','File bạn chọn không là hình ảnh');
            }
        }else{
            return back()->with('error','Bạn chưa thêm ảnh minh họa cho sản phẩm');
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Products  $products
     * @return \Illuminate\Http\Response
     */
    public function show(Products $products)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Products  $products
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
         $category = Category::where('status',1)->get();
        $producttype = ProductType::where('status',1)->get();
        $product = Products::find($id);
        return response()->json(['category'=>$category,'producttype'=>$producttype,'product'=>$product],200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Products  $products
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //bat loi khi sua
        $validator = Validator::make($request->all(),
            [
                'name' => 'required|min:2|max:255',
                'description' => 'required|min:2',
                'quantity' => 'required|numeric',
                'price' => 'required|numeric',
                'promotinal' => 'numeric',
                'image' => 'image',

            ],
            [
                'required' => ':attribute không được bỏ trống',
                'min' => ':attribute tối thiểu có 2 ký tự',
                'max' => ':attribute tối đa có 255 ký tự',
                'numeric' => ':attribute phải là một số ',
                'image' => ':attribute không là hình ảnh',


            ],
            [
                'name' => 'Tên sản phẩm',
                'description' => 'Mô tả sản phẩm',
                'quantity' => 'Số lượng sản phẩm',
                'price' => 'Đơn giá sản phẩm',
                'promotinal' => 'Giá khuyến mại',
                'image' => 'Ảnh minh họa',


            ],
        );

        if($validator->fails()){
            return response()->json( ['error'=>'true','message' => $validator->errors() ],200);
        }


        $product = Products::find($id);
        $data = $request->all();
        $data['slug'] = utf8tourl($request->name);
        if($request->hasFile('image')){
            $file = $request->image;
            //Lấy tên file
            $file_name = $file->getClientOriginalName();
            //Lấy loại file
            $file_type = $file->getMimeType();
            //Kích thước file với đơn vị byte
            $file_size = $file->getSize();
            if($file_type == 'image/png' || $file_type == 'image/jpg' || $file_type == 'image/jpeg' || $file_type == 'image/gif'){
                if($file_size <= 1048576){
                    $file_name = date('D-m-yyyy').'-'.rand().'-'.utf8tourl($file_name);
                    if($file->move('img/upload/product',$file_name)){
                        $data['image'] = $file_name;
                        if(File::exists('img/upload/product'.$product->image)){
                            //Xóa file
                            unlink('img/upload/product'.$product->image);
                        }
                    }
                }else{
                    return response()->json(['error' => 'Ảnh của bạn quá lớn chỉ được upload ảnh dưới 1mb'],200);
                }
            }else{
                return response()->json(['error' => 'File bạn chọn không là hình ảnh'],200);
            }
        }else{
            $data['image'] = $product->image;
        }
        $product->update($data);
        return response()->json(['result' => 'Đã sửa thành công sản phẩm có id là '.$id],200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Products  $products
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Products::find($id);
        if($product->delete()){
            // xoa file anh 
            if(File::exists('img/upload/product/'.$product->image))
            {
                unlink('img/upload/product/'.$product->image);
            }
            return response()->json(['result'=>'Đã xóa thành công sản phẩm'],200);
        }else{
            return response()->json(['result'=>'Đã xóa không thành công '],200);
        }
    }
}
