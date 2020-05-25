@extends('layout')

@section('content')
    <h1 class="ui header">{{ $test->name }}</h1>
    <h3>Test time left: <span id="testTimer">{{ $test->available_time ? $test->available_time : 'Unlimited' }}</span></h3>
    <form id="testForm" class="ui form" method="post">
        @csrf
        @php $index = 0; @endphp
        @foreach($questions as $question)
        <div class="grouped fields">
            <label for="fruit">{{ ++$index }}. {{ $question->question }}</label>
            @if( $question->questionType->name === 'Radio' )
                @foreach($question->answers as $answer)
                    <div class="field">
                        <div class="ui radio checkbox">
                            <input type="radio" name="{{ $question->id }}" value="{{ $answer->id }}" class="hidden">
                            <label>{{ $answer->answer }}</label>
                        </div>
                    </div>
                @endforeach
            @elseif ( $question->questionType->name === 'Checkbox' ) <!-- TODO add checkbox logic here -->
                @foreach($question->answers as $answer)
                <div class="field">
                    <div class="ui checkbox">
                        <input type="checkbox" name="{{ $question->id }}[]" value="{{ $answers[$i] }}" class="hidden">
                        <label>{{ $answers }}</label>
                    </div>
                </div>
                @endforeach
            @endif
        </div>
        @endforeach
        <input type="hidden" name="spentTime" value="0" />
        <button class="ui button" type="submit">Submit</button>
    </form>
    <script>
        $('.ui.checkbox').checkbox();

        function prettyTime(totalSeconds) {
            const minutes = Math.floor(totalSeconds / 60);
            const seconds = totalSeconds % 60;
            return `${minutes < 10 ? '0' + minutes : minutes}:${seconds < 10 ? '0' + seconds : seconds}`
        }

        if ($('#testTimer').text() !== 'Unlimited') {
            const timeAvailable = Number.parseInt($('#testTimer').text());
            let timeLeft = timeAvailable;
            $('#testTimer').text(prettyTime(timeLeft));

            const timer = setInterval(() => {
                timeLeft--;
                $('#testTimer').text(prettyTime(timeLeft));

                if (timeLeft === 0) {
                    clearInterval(timer);

                    $('input[name="spentTime"]').val(timeAvailable);
                    $('#testForm').submit();
                }
            }, 1000);

            $('#testForm').on('submit', function () {
                $('input[name="spentTime"]').val(timeAvailable - timeLeft);
            });
        }
    </script>
@endsection