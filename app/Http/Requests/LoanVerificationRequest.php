<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class LoanVerificationRequest extends FormRequest
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
    public function rules(Request $request)
    {
        if ($request->status == 'reject') {
            return [
                'transaction_id' => 'required',
                'status' => 'required',
                'note_status' => 'required',
            ];
        }

        return [
            'transaction_id' => 'required',
            'status' => 'required',
        ];
    }
}
