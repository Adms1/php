<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Auth;

class TutorProfileUpdateRequest extends FormRequest
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
            'TutorEmail' => 'required|unique:Tutor,TutorEmail,'.Auth::guard('tutor')->user()->TutorID.',TutorID,StatusID,1',
            'TutorName' => 'required',
            'TutorPhoneNumber' => 'required|unique:Tutor,TutorPhoneNumber,'.Auth::guard('tutor')->user()->TutorID.',TutorID,StatusID,1',
            //'StatusID' => 'required',
            //'IsActive' => 'required',
            //'AccountTypeID' => 'required',
            //'Icon' => 'required',
        ];
    }
}
