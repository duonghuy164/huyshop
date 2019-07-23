<?php

namespace App\Http\Controllers;

use App\Models\ProductType;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Http\Requests\StoreProductTypeRequest;
use Validator;

class ProductTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $producttype=ProductType::paginate(5);
         return view('admin.pages.producttype.list',compact('producttype'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $category=Category::where('status',1)->get();
        return view('admin.pages.producttype.add',compact('category'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProductTypeRequest $request)
    {
        //
        $data=$request->all();
        $data['slug'] = utf8tourl($request->name);
        if(ProductType::create($data)){
            return redirect()->route('producttype.index')->with('thongbao','đã thêm thành công');
        }else{
            return back()->with('thongbao','Có lỗi xin kiểm tra lại');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ProductType  $productType
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ProductType  $productType
     * @return \Illuminate\Http\Response
     */
    public function edit( $id)
    {
        //
        $producttype =ProductType::find($id);
        $category =Category::where('status',1)->get();
        return response()->json(['category'=>$category,'producttype'=>$producttype],200);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ProductType  $productType
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $validator =Validator::make($request ->all(),
            [
                'name'=>'required|min:2|max:255',

            ],
            [
                 'required'=>'Tên loại sản phẩm  Không được để trống',
                    'min'=>'Tên loại sản phẩm phải lớn hơn 2 kí tự',
                    'max'=>'Tên loại sản phẩm nhỏ hơn 255 kí tự',
                    

            ]
        );
        if($validator->fails()){
            return response()->json(['error'=>'true','message'=>$validator->errors()],200);

        }
        $producttype =ProductType::find($id);
        $data=$request->all();
        $producttype->update($data);
        $data['slug']=utf8tourl($request->name);
        if($producttype->update($data)){
            return response()->json(['result'=>'Đã sủa thành công sản phẩm'],200);

        }else{
            return response()->json(['result'=>'Đã có lỗi '],200);

        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ProductType  $productType
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $producttype =ProductType::find($id);
        if($producttype->delete()){
            return response()->json(['result'=>'Đã xóa thành công sản phẩm'],200);
        }else{
            return response()->json(['result'=>'Đã xóa không thành công '],200);
        }

    }
}
