<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class VendorUpdateRequest extends FormRequest
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
            'vendor_name' => 'required|max:500',
            'email' => 'required|max:55|unique:vendor,email,'.$this->id.',vendor_id,is_active,1',
            'vendor_address1' => 'required|max:255',
            'vendor_address2' => 'required|max:255',
            'vendor_city' => 'required|max:75',
            'vendor_state_id' => 'required',
            'vendor_country_id' => 'required',
            'vendor_pin' => 'required|max:15',
            'vendor_status_id' => 'required',
            'vendor_gst_number' => 'required|max:100',
            'flint_charge' => 'required|max:11',
            'vendor_phone' => 'required|max:15',
        ];
    }
}
