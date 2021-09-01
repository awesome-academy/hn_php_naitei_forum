<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class QuestionRule implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $modelQuestion = DB::table('questions')->get('slug');
        $slugList = [];
        foreach ($modelQuestion->toArray() as $question) {
            array_push($slugList, $question->slug);
        }
        $slug = Str::slug($value, '-');
        if (in_array($slug, $slugList)) {
            $countAppearances = array_count_values($slugList)[$slug];
            if ($countAppearances <= 1) {
                return true;
            }
            
            return false;
        }

        return true;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return __('question.title-unique');
    }
}
