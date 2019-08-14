<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategoryCreateRequest extends FormRequest
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
            'category_name' => 'required|max:191|unique:category,category_name,'.$this->id.',category_id,is_active,1',
            'photo' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:1024',
        ];
    }
}
