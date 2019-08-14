<?php
namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCasinoRequest extends FormRequest
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
            'mCasinoChips' => 'required|numeric',
            'mAllowedTables' => 'required|numeric',
            'mAllowedManagers' => 'required|numeric',
            'mAllowedPlayers' => 'required|numeric',
            'mSubcriptionActive' => 'required',
            'mCurrentSubscribedTime' => 'required',
        ];
    }
}
