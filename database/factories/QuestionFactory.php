<?php

namespace Database\Factories;

use App\Models\Question;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class QuestionFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Question::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $title = $this->faker->sentence(rand(5,10));
        $slug = Str::slug($title, '-');

        return [
            'title' => $title,
            'slug' => $slug,
            'content' => $this->faker->paragraphs(rand(3, 6), true),
            'views' => rand(0,10),
            'answers' => rand(0,10),
            'up_vote' => rand(0,10),
            'down_vote' => rand(0,10),
            'user_id' => rand(1,5),
            'tag_id' => rand(1,5),
        ];
    }
}
