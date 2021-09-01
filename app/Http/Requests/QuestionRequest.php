<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class QuestionRequest extends FormRequest
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
            'title' => 'required|max:255|unique:questions',
            'content' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'title.required' => __('question.title-require'),
            'title.max' => __('question.title-max'),
            'title.unique' => __('question.title-unique'),
            'content.required' => __('question.content-required'),
        ];
    }
}
