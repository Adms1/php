<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TutorUpdateRequest extends FormRequest
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
            'TutorEmail' => 'required|unique:Tutor,TutorEmail,'.$this->segment(3).',TutorID',
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
