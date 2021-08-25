<?php

namespace App\Http\Requests;

use App\Rules\QuestionRule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateQuestionRequest extends FormRequest
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
        $titleChecked = new QuestionRule();
        return [
            'title' => [
                'required',
                'max:255',
                $titleChecked
            ],
            'content' => 'required',
            'tags' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'tags.required' => __('question.tag-required'),
            'title.required' => __('question.title-require'),
            'title.max' => __('question.title-max'),
            'title.unique' => __('question.title-unique'),
            'content.required' => __('question.content-required'),
        ];
    }
}
