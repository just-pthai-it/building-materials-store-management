<?php

namespace App\Http\Requests\Invoice;

use Illuminate\Foundation\Http\FormRequest;

class StoreInvoicePostRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize () : bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules () : array
    {
        return [
            'payment_method'             => ['required', 'string'],
            'customer_name'              => ['required', 'required', 'string'],
            'customer_phone'             => ['required', 'string'],
            'customer_address'             => ['required', 'string'],
            'details'                    => ['required', 'array'],
            'details.*.specification_id' => ['required', 'integer'],
            'details.*.amount'           => ['required', 'integer'],
        ];
    }

    public function validated ($key = null, $default = null)
    {
        return parent::validated($key, $default) + ['user_id' => auth()->id()];
    }
}
