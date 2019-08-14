<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StandardStoreRequest extends FormRequest
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
            'StandardName' => 'required|unique:Standard',
            'IsActive' => 'required',
            //'Icon' => 'required',
        ];
    }
}
