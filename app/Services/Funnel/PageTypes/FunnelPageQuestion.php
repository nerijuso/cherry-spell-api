<?php

namespace App\Services\Funnel\PageTypes;

use App\Http\Resources\API\v1\QuizQuestionResource;
use App\Models\FunnelQuiz\FunnelQuiz;
use App\Services\Funnel\FunnelPageType;

class FunnelPageQuestion extends FunnelPageType
{
    public function getName(): string
    {
        return 'Funnel question page';
    }

    public function getData(): array
    {
        return [
            'quizzes' => FunnelQuiz::where('is_published', true)->get(),
        ];
    }

    public function getResource($funnelPage): array
    {
        return [
            'question' => new QuizQuestionResource($funnelPage->funnelQuestion),
        ];
    }
}
