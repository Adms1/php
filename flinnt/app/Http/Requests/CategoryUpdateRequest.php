<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategoryUpdateRequest extends FormRequest
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
            'category_name' => 'required|max:191|unique_custom:category,category_name,category_id,'.$this->id.',is_active,1',
        ];
    }


    /**
     * Inline custome error message.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'unique_custom' => 'The :attribute is not unique.'
        ];
    }
}
