<?php

namespace App\Http\Requests;

use App\Exceptions\ApiException;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;

class APIRequest extends FormRequest
{
    protected function failedAuthorization()
    {
       throw new ApiException(401, 'Authentication failed');
    }
    protected function failedValidation(Validator $validator)
    {
        throw new ApiException(422, 'Validation error', $validator->errors());
    }

    public function messages()
    {
        $messages = parent::messages();
        $messages += [
            'exist' => ':attribute does not exist'
        ];
        return $messages;
    }

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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            //
        ];
    }
}
