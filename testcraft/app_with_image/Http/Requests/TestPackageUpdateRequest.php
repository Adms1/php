<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Auth;

class TestPackageUpdateRequest extends FormRequest
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
        if (Auth::guard('tutor')->check()) {
            $user_id = Auth::guard('tutor')->user()->TutorID;
        } else {
            $user_id = Auth::guard('admin')->user()->UserID;
        }

        return [
            'TestPackageName' => 'required|unique:TestPackage,TestPackageName,'.$this->segment(3).',TestPackageID,TutorID,'.$user_id,
            'TestPackageSalePrice' => 'required',
            'IsActive' => 'required',
            'TestPackageDescription' => 'required',
            'TestPackageListPrice' => 'required',
            // 'TestPackageSalePriceTCD' => 'required',
            // 'TestPackageListPriceTCD' => 'required',
            'NumberOfTest' => 'required',
            // 'SubjectID' => 'required',
            //'Icon' => 'required',
        ];
    }
}
