<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MakeOrder extends FormRequest
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
            'account_name' => 'required',
            'account_password' => 'required|min:6',
            'billing_street' => 'required|max:255',
            'billing_city' => 'required|max:255',
            'billing_zip' => 'required|numeric',
            'billing_country' => 'required|max:255',
            'product_id' => 'required|exists:products,id'
        ];
    }

    public function response($errors)
    {

        return response()->json(['status' => 403, 'errors' => $errors]);
    }

}
