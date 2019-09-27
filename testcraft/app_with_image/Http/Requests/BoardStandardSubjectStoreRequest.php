<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BoardStandardSubjectStoreRequest extends FormRequest
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
            'BoardID' => 'required',
            'StandardID' => 'required',
            'SubjectID' => 'required|unique_bss:BoardStandardSubject,BoardID,'.$this->BoardID.',StandardID,'.$this->StandardID,
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
            'unique_bss' => 'The :attribute is not unique.'
        ];
    }
}
