<?php

namespace App\Http\Requests;


use App\Exceptions\ApiException;

class CloseRequest extends ApiRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $workShift = $this->route('workShift');
        return $workShift->active;
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
        throw new ApiException(403, 'Forbidden. The shift is already closed!');
    }
}
