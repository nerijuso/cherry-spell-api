<?php

namespace App\Livewire\Admin\Funnel\PageType;

use App\Models\FunnelPage;
use App\Models\FunnelQuiz\FunnelQuizQuestion;
use App\Services\Funnel\FunnelPageService;
use Livewire\Attributes\Validate;
use Livewire\Component;

class FunnelPageLandingQuestion extends Component
{
    public FunnelPage $funnelPage;

    #[Validate('required|integer')]
    public int $quizID;

    #[Validate('required|integer')]
    public $quizQuestionID;

    public $questions = [];

    public $quizzes = [];

    #[Validate('sometimes|nullable|json')]
    public $configuration = null;

    public function mount()
    {
        $questionID = data_get($this->funnelPage->data, 'question_id');

        if ($questionID) {
            $this->quizID = FunnelQuizQuestion::where('id', $questionID)->first()?->funnel_quiz_id;
            $this->questions = FunnelQuizQuestion::where('funnel_quiz_id', $this->quizID)->get(['id', 'question']);
            $this->quizQuestionID = $questionID;
        }

        $this->configuration = json_encode($this->funnelPage->configuration);
        $this->quizzes = app(FunnelPageService::class)->loadFormData($this->funnelPage->type)['quizzes'];
    }

    public function render()
    {
        return view('livewire.admin.funnel.page-type', [
            'data' => $this->quizzes,
        ]);
    }

    public function save()
    {
        $this->validate();

        $data = $this->funnelPage->data;
        data_set($data, 'question_id', $this->quizQuestionID);

        $this->funnelPage->data = $data;
        $this->funnelPage->configuration = json_decode($this->configuration);
        $this->funnelPage->save();
        $this->dispatch('modal-closed');
        session()->flash('status', 'Successfully updated.');

    }

    public function closeModal()
    {
        $this->dispatch('modal-closed');
    }

    public function getQuestions()
    {
        if ($this->quizID > 0) {
            $this->questions = FunnelQuizQuestion::where('funnel_quiz_id', $this->quizID)->get(['id', 'question']);
        }
    }
}
