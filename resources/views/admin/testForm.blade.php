@extends('layouts.admin')

@section('content')
    <h1 class="ui header">{{ $test ? 'Test editing' : 'New test creation' }}</h1>
    <form method="post">
    @csrf
    <div class="ui centered grid">
        <div class="ten wide column">
            <div class="ui form">
                <div class="field">
                    <label>Test name</label>
                    <input name="testName" type="text" value="{{ $test ? $test->name : '' }}">
                </div>
                <div class="field">
                    <label>Test description</label>
                    <textarea name="testDescription">{{ $test ? $test->description : '' }}</textarea>
                </div>
                <div class="field">
                    <label>Available time (leave empty to unlimit)</label>
                    <input name="availableTime" type="text" value="{{ $test ? $test->available_time : '' }}">
                </div>
                @if ($test && count($test->questions) > 0)
                    @foreach($test->questions as $index => $question)
                        <div class="ui segment question">
                            <div class="remove-btn" onclick="removeQuestion({{ $index }})">X</div>
                            <div class="field">
                                <label class="questionLabel">Question #{{ $index + 1 }}</label>
                                <textarea class="questionText" name="questions[{{ $question->id }}]" rows="3">{{ $question->question }}</textarea>
                            </div>
                            @foreach ($question->answers as $key => $answer)
                                <div class="inline fields">
                                    <div class="sixteen wide field">
                                        <label style="white-space: nowrap">Answer {{ $key + 1 }}</label>
                                        <input type="text" placeholder="Question answer" name="answers[{{ $answer->id }}]" value="{{ $answer->answer }}">
                                        <div class="ui radio" style="margin-left: 10px">
                                            <input type="radio" class="hidden" name="correct_answers[{{ $question->id }}]" value="{{ $answer->id }}"{{ $question->correct_answer_id === $answer->id ? ' checked' : '' }}>
                                            <label></label>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                            <button class="ui basic button">
                                <i class="icon tag"></i>
                                Add Answer
                            </button>
                        </div>
                    @endforeach
                @endif
            </div>
            <div class="ui button add-btn" onclick="addQuestion()">Add question</div>
        </div>
    </div>
    <div class="ui centered grid">
        <button class="huge ui primary button" type="submit">{{ $test ? 'Save test' : 'Create test' }}</button>
    </div>
    </form>
    <div class="ui segment" id="questionTemplate" style="display: none">
        <div class="remove-btn">X</div>
        <div class="field">
            <label class="questionLabel"></label>
            <textarea class="questionText" rows="3"></textarea>
        </div>
        @for ($i = 0; $i < 4; $i++)
            <div class="inline fields">
                <div class="sixteen wide field">
                    <label style="white-space: nowrap">Answer {{ $i + 1  }}</label>
                    <input type="text" placeholder="Question answer">
                    <div class="ui radio" style="margin-left: 10px">
                        <input type="radio" class="hidden">
                        <label></label>
                    </div>
                </div>
            </div>
        @endfor
        <button class="ui basic button">
            <i class="icon tag"></i>
            Add Answer
        </button>
    </div>
    <script>
        let questionCounter = {{ $test ? count($test->questions) + 1 : 1 }};
        function addQuestion() {
            const question = $('#questionTemplate').clone();

            $(question).fadeIn(800);
            $(question).addClass('question');
            $(question).attr('id', null);
            $(question).find('.questionLabel').text(`Question #${questionCounter}`);
            $(question).find('.questionText').attr('name', `newQuestions[${questionCounter}]`);
            $(question).find('.remove-btn').attr('onclick', `removeQuestion(${questionCounter - 1})`);

            // String answers
            $(question).find('.fields input[type="text"]').each((index, item) => {
                $(item).attr('name', `newAnswers[${questionCounter}][]`);
            });

            // Correct answer
            $(question).find('.fields input[type="radio"]').each((index, item) => {
                $(item).attr('name', `newCorrectAnswers[${questionCounter}]`);
                $(item).attr('value', index);
            });

            $('.ui.form').append(question);

            questionCounter++;
        }

        function removeQuestion(index) {
            const questionElem = $('.question')[index];
            $(questionElem).fadeOut(800);

            questionCounter = 1;
            setTimeout(function () {
                questionElem.remove();
                $('.question').each((index, question) => {
                    $(question).find('.questionLabel').text(`Question #${questionCounter}`);
                    $(question).find('.remove-btn').attr('onclick', `removeQuestion(${questionCounter - 1})`);
                    questionCounter++;
                });
            }, 900);
        }
    </script>
@endsection