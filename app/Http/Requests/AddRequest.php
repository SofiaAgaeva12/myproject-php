<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class addRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'id' => 'required|integer',
            'name' => 'required|string',
            'surname' => 'required|string',
            'patronymic' => 'string',
            'login' => 'required|string|unique:users',
            'photo_file' => 'image|mines:jpg,jpeg,png',
            'password' => 'required|string',
            'role_id' => 'required|integer|exists:users,id',
        ];
    }
}
