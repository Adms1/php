<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Auth;

class TestPackageStoreRequest extends FormRequest
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
            'TestPackageName' => 'required|unique:TestPackage,TestPackageName,'.$this->id.',TestPackageID,TutorID,'.$user_id,
            'TestPackageSalePrice' => 'required',
            'StatusID' => 'required',
            'TestPackageDescription' => 'required',
            'TestPackageListPrice' => 'required',
            'NumberOfTest' => 'required',
            //'IsActive' => 'required',
            // 'TestPackageSalePriceTCD' => 'required',
            // 'TestPackageListPriceTCD' => 'required',
            // 'SubjectID' => 'required',
            //'Icon' => 'required',
        ];
    }
}
