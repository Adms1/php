<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SubjectUpdateRequest extends FormRequest
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
            'SubjectName' => 'required|unique:Subject,SubjectName,'.$this->segment(3).',SubjectID',
            'IsActive' => 'required',
            //'Icon' => 'required',
        ];
    }
}
