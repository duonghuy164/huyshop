<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCategoryRequest extends FormRequest
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
            'name'=>'required|min:2|max:255',
        ];
    }
    public function message(){
        return[
            'required'=>':attribute không được để trống',
            'min'=>':attribute tối thiểu 2 kí tự',
            'max'=>':attribute tối đa 255 kí tự',

        ];
    }

    public function attributes(){
        return [
            'name' => 'Tên danh mục sản phẩm',
        ];
    }

}
