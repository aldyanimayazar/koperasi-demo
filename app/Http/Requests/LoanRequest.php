<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LoanRequest extends FormRequest
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
            'membership_id' => 'required',
            'amount' => 'required|digits_between:1,10',
            'interest' => 'required|digits_between:1,3',
            'interest_by' => 'required',
            'tenor' => 'required|numeric',
            'admin_fee' => 'required|digits_between:1,10',
            'note' => 'max:255',
        ];
    }
}
