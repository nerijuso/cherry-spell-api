<?php

namespace App\Http\Requests\API\v1;

use App\Models\Enums\FunnelQuizQuestionType;
use App\Models\FunnelQuiz\FunnelQuizQuestion;
use App\Models\FunnelQuiz\FunnelQuizQuestionOption;
use App\Rules\OptionBelongsQuestion;
use App\Services\Funnel\PageTypes\FunnelPageLandingQuestion;
use App\Services\Funnel\PageTypes\FunnelPageQuestion;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;

class StoreFunnelQuizRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        if ($this->funnel->is_active) {
            return true;
        }

        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $funnelPages = $this->funnel->funnelPages->whereIn('type', [
            Str::snake(class_basename(FunnelPageLandingQuestion::class)),
            Str::snake(class_basename(FunnelPageQuestion::class)),
        ]);
        $questionIds = array_unique(data_get($funnelPages, '*.data.question_id'));
        $options = FunnelQuizQuestionOption::where('is_active', true)->whereIn('funnel_quiz_question_id', $questionIds)->get();
        $questions = FunnelQuizQuestion::where('is_active', true)->whereIn('id', $questionIds)->get();

        $data = [
            'email' => 'required|email',
            'quiz' => 'required|array',
            'quiz.*.question_id' => 'required|in:'.implode(',', array_unique($questions->pluck('id')->all())),
            'quiz.*.option' => [
                'required',
                new OptionBelongsQuestion($this->all(), $options),
            ],
        ];

        foreach ($this->input('quiz.*') as $key => $item) {
            $question = $questions->firstWhere('id', $item['question_id']);

            if ($question) {
                if ($question->type === FunnelQuizQuestionType::MULTIPLE_CHOICE) {
                    $data['quiz.' . $key . '.option'] = 'array';
                } elseif ($question->type === FunnelQuizQuestionType::SINGLE_CHOICE) {
                    $data['quiz.' . $key . '.option'] = 'integer';
                } elseif ($question->type === FunnelQuizQuestionType::NUMBER_INPUT) {
                    $data['quiz.' . $key . '.option'] = 'integer';
                } elseif ($question->type === FunnelQuizQuestionType::TEXT_INPUT) {
                    $data['quiz.' . $key . '.option'] = 'string';
                }
            }
        }

        return $data;
    }
}
