<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends ApiRequest
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
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            'name' => ["required"],
            'surname'=>['string'],
            'patronymic'=>['string'],
            'login' => ["required", "unique:users"],
            'password' => ["required"],
            'photo_file' => ['image:png,jpeg'],
            'role_id'=>["required", "exists:roles,id"]
        ];
    }
}
