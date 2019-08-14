<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TutorStoreRequest extends FormRequest
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
            'TutorEmail' => 'required|unique:Tutor',
            'TutorPassword' => 'required',
            'TutorName' => 'required',
            'TutorPhoneNumber' => 'required',
            //'StatusID' => 'required',
            //'IsActive' => 'required',
            //'AccountTypeID' => 'required',
            //'Icon' => 'required',
        ];
    }
}
