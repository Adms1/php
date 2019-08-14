<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CourseSubjectUpdateRequest extends FormRequest
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
            'CourseID' => 'required',
            'SubjectID' => 'required|unique_custom:CourseSubject,CourseSubjectID,'.$this->segment(3).',CourseID,'.$this->CourseID,
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
