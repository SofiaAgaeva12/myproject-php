<?php

namespace App\Http\Requests;

use App\Exceptions\ApiException;
use App\Models\WorkShift;
use Illuminate\Foundation\Http\FormRequest;

class OpenRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return !WorkShift::where(['active' => true])->first();
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

    protected function failedAuthorization()
    {
        throw new ApiException(403, 'Forbidden. There are open shifts!');
    }
}
