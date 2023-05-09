<?php

namespace App\Http\Requests\Unit;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUnitPatchRequest extends FormRequest
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
            'name'      => ['sometimes', 'required', 'string'],
            'parent_id' => ['sometimes', 'required', 'integer'],
        ];
    }
}
