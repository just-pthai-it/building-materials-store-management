<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserPatchRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize () : bool
    {
//        if ($this->has('password'))
//        {
//            return $this->user()->tokenCan('all:crud');
//        }

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
            'name'          => ['sometimes', 'required', 'string'],
            'email'         => ['sometimes', 'required', 'email:rfc'],
            'password'      => ['sometimes', 'required', 'string'],
            'date_of_birth' => ['sometimes', 'required', 'date_format:Y-m-d'],
            'phone'         => ['sometimes', 'required', 'string', 'regex:/^0[0-9]{9}$/'],
            'address'       => ['sometimes', 'required', 'string'],
            'role'          => ['sometimes', 'required', 'integer'],
            'is_male'       => ['sometimes', 'required', 'boolean'],
            'avatar'        => ['sometimes', 'required', 'image'],
        ];
    }

    public function validated ($key = null, $default = null) : array
    {
        $validatedInputs = parent::validated($key, $default);
        if ($this->has('password'))
        {
            $validatedInputs['password'] = bcrypt($validatedInputs['password']);
        }

        return $validatedInputs;
    }
}
