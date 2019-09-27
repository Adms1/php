<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CourseTypeUpdateRequest extends FormRequest
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
            'CourseTypeName' => 'required|unique:CourseType,CourseTypeName,'.$this->segment(3).',CourseTypeID',
            'IsActive' => 'required',
            //'Icon' => 'required',
        ];
    }
}
