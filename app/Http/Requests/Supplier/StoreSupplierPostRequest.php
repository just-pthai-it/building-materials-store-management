<?php

namespace App\Http\Requests\Supplier;

use Illuminate\Foundation\Http\FormRequest;

class StoreSupplierPostRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize ()
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
            'name'                 => ['required', 'string'],
            'email'                => ['required', 'string'],
            'phone'                => ['required', 'string'],
            'representative'       => ['required', 'string'],
            'representative_phone' => ['required', 'string'],
            'tax_code'             => ['required', 'string'],
        ];
    }
}
