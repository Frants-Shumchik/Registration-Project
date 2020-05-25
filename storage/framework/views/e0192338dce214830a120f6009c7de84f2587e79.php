<?php $__env->startSection('content'); ?>
    <h1 class="ui header">New test creation</h1>
    <form method="post">
    <?php echo csrf_field(); ?>
    <div class="ui centered grid">
        <div class="ten wide column">
            <div class="ui form">
                <div class="field">
                    <label>Test name</label>
                    <input name="testName" type="text">
                </div>
                <div class="field">
                    <label>Test description</label>
                    <textarea name="testDescription"></textarea>
                </div>
            </div>
            <div class="ui button add-btn" onclick="addQuestion()">Add question</div>
        </div>
    </div>
    <div class="ui centered grid">
        <button class="huge ui primary button" type="submit">Create test</button>
    </div>
    </form>
    <div class="ui segment" id="questionTemplate" style="display: none">
        <div class="field">
            <label class="questionLabel"></label>
            <textarea class="questionText" rows="3"></textarea>
        </div>
        <?php for($i = 0; $i < 4; $i++): ?>
            <div class="inline fields">
                <div class="sixteen wide field">
                    <label style="white-space: nowrap">Answer <?php echo e($i + 1); ?></label>
                    <input type="text" placeholder="Question answer">
                    <div class="ui radio" style="margin-left: 10px">
                        <input type="radio" class="hidden">
                        <label></label>
                    </div>
                </div>
            </div>
        <?php endfor; ?>
        <button class="ui basic button">
            <i class="icon tag"></i>
            Add Answer
        </button>
    </div>
    <script>
        let questionCounter = 1;
        function addQuestion() {
            const question = $('#questionTemplate').clone();

            $(question).css({ display: 'block' });
            $(question).attr('id', null);
            $(question).find('.questionLabel').text(`Question #${questionCounter}`);
            $(question).find('.questionText').attr('name', `question-${questionCounter}`);

            // String answers
            $(question).find('.fields input[type="text"]').each((index, item) => {
                $(item).attr('name', `answers[${questionCounter}][]`);
            });

            // Correct answer
            $(question).find('.fields input[type="radio"]').each((index, item) => {
                $(item).attr('name', `correct_answers[${questionCounter}]`);
                $(item).attr('value', index);
            });

            $('.ui.form').append(question);

            questionCounter++;
        }

        function addAnswer() {

        }
    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>