<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\User;

class MemberShipRequest extends FormRequest
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
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:memberships',
            'nik' => 'required|max:16',
            'group_id' => 'required|numeric',
            'member_role_id' => 'required|numeric', 
            'gender' => 'required|in:laki-laki,perempuan', 
            'date_of_birth' => 'required|date|date_format:Y-m-d', 
            'blood_type' => 'required|in:A,AB,B,O', 
            'religion' => 'required|in:islam,protestan,katolik,hindu,budha,kepercayaan', 
            'address' => 'required|max:255', 
            'phone' => 'required|numeric|digits_between:11,12|unique:memberships',
            'savings' => 'digits_between:1,12|numeric',
            'salary' => 'digits_between:1,12|numeric',
            'max_plafond_debiting' => 'regex:/^\d{1,13}(\.\d{1,2})?$/',
        ];
    }
}
