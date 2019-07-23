<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductTypeRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            //
            'name'=>'required|min:2|max:255|unique:product_types,name',

        ];
    }

    public function messages(){
        return[
            'required'=>':attribute Không được để trống',
            'min'=>'attribute phải lớn hơn 2 kí tự',
            'max'=>'attribute nhỏ hơn 255 kí tự',
            'unique'=>'attribute  đã tồn tại',


        ];
    }
    public function attribute(){
    return[
        'name'=>'Tên loại sản phẩm',

    ];
    }
}
