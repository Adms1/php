<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StandardCreateRequest extends FormRequest
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
            'standard_name' => 'required|max:191|unique:standard,standard_name,'.$this->id.',standard_id,is_active,1',
        ];
    }
}
