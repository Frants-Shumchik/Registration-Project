<?php $__env->startSection('content'); ?>
    <h1 class="ui header"><?php echo e($test ? 'Test editing' : 'New test creation'); ?></h1>
    <form method="post">
    <?php echo csrf_field(); ?>
    <div class="ui centered grid">
        <div class="ten wide column">
            <div class="ui form">
                <div class="field">
                    <label>Test name</label>
                    <input name="testName" type="text" value="<?php echo e($test ? $test->name : ''); ?>">
                </div>
                <div class="field">
                    <label>Test description</label>
                    <textarea name="testDescription"><?php echo e($test ? $test->description : ''); ?></textarea>
                </div>
                <div class="field">
                    <label>Available time (leave empty to unlimit)</label>
                    <input name="availableTime" type="text" value="<?php echo e($test ? $test->available_time : ''); ?>">
                </div>
                <?php if($test && count($test->questions) > 0): ?>
                    <?php $__currentLoopData = $test->questions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $question): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="ui segment question">
                            <div class="remove-btn" onclick="removeQuestion(<?php echo e($index); ?>)">X</div>
                            <div class="field">
                                <label class="questionLabel">Question #<?php echo e($index + 1); ?></label>
                                <textarea class="questionText" name="questions[<?php echo e($question->id); ?>]" rows="3"><?php echo e($question->question); ?></textarea>
                            </div>
                            <?php $__currentLoopData = $question->answers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $answer): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="inline fields">
                                    <div class="sixteen wide field">
                                        <label style="white-space: nowrap">Answer <?php echo e($key + 1); ?></label>
                                        <input type="text" placeholder="Question answer" name="answers[<?php echo e($answer->id); ?>]" value="<?php echo e($answer->answer); ?>">
                                        <div class="ui radio" style="margin-left: 10px">
                                            <input type="radio" class="hidden" name="correct_answers[<?php echo e($question->id); ?>]" value="<?php echo e($answer->id); ?>"<?php echo e($question->correct_answer_id === $answer->id ? ' checked' : ''); ?>>
                                            <label></label>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <button class="ui basic button">
                                <i class="icon tag"></i>
                                Add Answer
                            </button>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php endif; ?>
            </div>
            <div class="ui button add-btn" onclick="addQuestion()">Add question</div>
        </div>
    </div>
    <div class="ui centered grid">
        <button class="huge ui primary button" type="submit"><?php echo e($test ? 'Save test' : 'Create test'); ?></button>
    </div>
    </form>
    <div class="ui segment" id="questionTemplate" style="display: none">
        <div class="remove-btn">X</div>
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
        let questionCounter = <?php echo e($test ? count($test->questions) + 1 : 1); ?>;
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
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>