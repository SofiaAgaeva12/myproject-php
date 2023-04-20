<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        if ($this->login && $this->password) {
            return User::where([
                'login'=> $this->login,
                'password'=>$this->password,
                'status'=>'working'
            ])->first();
        }
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
            'login'=>'required|string',
            'password'=>'required|string',
        ];
    }
}
