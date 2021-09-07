<?php

namespace App\Http\Requests;

use Dotenv\Validator;
use GuzzleHttp\Psr7\Request;
use Illuminate\Foundation\Http\FormRequest;

class CheckInforRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            'username' => 'required|string|max:255',
            'old_password' => 'string|min:8',
            'new_password' => 'string|min:8',
        ];
    }
}
