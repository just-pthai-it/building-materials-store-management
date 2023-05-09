<?php

namespace App\Http\Requests\Product;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProductPatchRequest extends FormRequest
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
            'category_id' => ['sometimes', 'required', 'integer'],
            'unit_id'     => ['sometimes', 'required', 'integer'],
            'name'        => ['sometimes', 'required', 'string'],
            'brand_name'  => ['sometimes', 'required', 'string'],
            'tax'         => ['sometimes', 'required'],
        ];
    }
}
