<?php

namespace App\Http\Requests\InputInvoice;

use Illuminate\Foundation\Http\FormRequest;

class StoreInputInvoicePostRequest extends FormRequest
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
            'supplier_id'                  => ['required', 'integer'],
            'payment_method'               => ['required', 'string'],
            'supplier_bank'                => ['sometimes', 'required', 'string'],
            'supplier_bank_account_number' => ['required_with:supplier_bank', 'string'],
            'deliver_name'                 => ['required', 'string'],
            'deliver_phone'                => ['required', 'string'],
            'details'                      => ['required', 'array'],
            'details.*.specification_id'   => ['required', 'integer'],
            'details.*.amount'             => ['required', 'integer'],
            'details.*.price'              => ['required'],
        ];
    }

    public function validated ($key = null, $default = null)
    {
        return parent::validated($key, $default) + ['user_id' => auth()->id()];
    }
}
