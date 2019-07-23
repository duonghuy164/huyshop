<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Requests\StoreCategoryRequest;
use Validator;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $category=Category::paginate(5);
        return view('admin.pages.category.list',['category'=>$category]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('admin.pages.category.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCategoryRequest $request)
    {
        //
        // $category = new Category;
        // $category->name =$request->name;
        // $category->save(); 
        // nếu dùng fillable
        Category::create([
            'name'=>$request->name,
            'slug'=>utf8tourl($request->name),
            'status'=>$request->status, 

        ]);
        return redirect()->route('category.index');


    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function show(Contact $contact)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $category =Category::find($id);
        return response()->json($category,200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $validator = Validator::make($request->all(),
            [
                'name'=>'required|min:2|max:255'
            ],
            [
                'required'=>'Tên danh mục không được để trống',
                'min'=>'Tên danh mục tối thiểu 2 kí tự',
                'max'=>'Tên danh mục tối đa 255 kí tự',
            ]
        );
        if($validator->fails()){
            return response()->json(['error' =>'true','message' => $validator->errors()],200);
        }
        $category= Category::find($id);
        $category->update(
            [
            'name' => $request->name,
            'slug' => utf8tourl($request->name),
            'status' => $request->status
            ]
        );
        return response()->json(['success' => 'Sửa thành công']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $category =Category::find($id);
        $category->delete();
        return response()->json(['success'=>'Xóa Thành Công']);
    }
}
