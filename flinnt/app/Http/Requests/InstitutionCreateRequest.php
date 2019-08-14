<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class InstitutionCreateRequest extends FormRequest
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
            'institution_name' => 'required|max:500|unique:institution,institution_name,'.$this->id.',institution_id,is_active,1',
            'contact_name' => 'required|max:255',
            'email' => 'required|max:55',
            'address1' => 'required|max:1000',
            'city' => 'required|max:75',
            'state_id' => 'required',
            'country_id' => 'required',
            'pin' => 'required|max:15',
            'status_id' => 'required',
            'phone' => 'required|max:15',
            'institution_image' => 'required'
        ];
    }
}
