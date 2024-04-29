<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class OptionBelongsQuestion implements Rule
{
    protected array $messages = [];

    public function __construct(public $quizItems, public $options)
    {
    }

    public function passes($attribute, $value)
    {
        $optionsCount = 1;

        if (is_array($value)) {
            $optionsCount = count($value);
        }

        $questionId = data_get($this->quizItems, str_replace('option', 'question_id', $attribute));

        if ($this->options->where('funnel_quiz_question_id', $questionId)->whereIn('id', $value)->count() === $optionsCount) {
            return true;
        }

        return false;
    }

    public function message()
    {
        return 'Bad option id.';
    }
}
