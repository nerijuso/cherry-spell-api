<div class="col-lg-12">

    <div class="mb-3">
        <label class="form-label" for="quiz">Quiz</label>
        <select class="form-select" name="quiz" wire:change="getQuestions" id="quiz" wire:model="quizID">
            <option>Select</option>
            @foreach ($data as $item)
                <option @if($item->id === $quizID) selected @endif  value="{{ $item->id }}">{{ $item->title }}</option>
            @endforeach
        </select>
    </div>

    <div class="mb-3">
        <label class="form-label" for="quiz-questions">Quiz questions</label>
        <select id="quiz-questions" class="form-select" wire:model="quizQuestionID">
            <option>Select</option>
            @foreach ($questions as $item)
                <option @if($item->id === $quizQuestionID) selected @endif value="{{ $item->id }}">{{ $item->question }}</option>
            @endforeach
        </select>
        <div class="text-danger">@error('quizQuestionID') {{ $message }} @enderror</div>
    </div>
</div>
