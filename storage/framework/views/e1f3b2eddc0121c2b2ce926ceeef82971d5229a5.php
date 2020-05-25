<?php $__env->startSection('content'); ?>
    <h1 class="ui header"><?php echo e($test->name); ?></h1>
    <h3>Test time left: <span id="testTimer"><?php echo e($test->available_time ? $test->available_time : 'Unlimited'); ?></span></h3>
    <form id="testForm" class="ui form" method="post">
        <?php echo csrf_field(); ?>
        <?php $index = 0; ?>
        <?php $__currentLoopData = $questions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $question): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="grouped fields">
            <label for="fruit"><?php echo e(++$index); ?>. <?php echo e($question->question); ?></label>
            <?php if( $question->questionType->name === 'Radio' ): ?>
                <?php $__currentLoopData = $question->answers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $answer): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="field">
                        <div class="ui radio checkbox">
                            <input type="radio" name="<?php echo e($question->id); ?>" value="<?php echo e($answer->id); ?>" class="hidden">
                            <label><?php echo e($answer->answer); ?></label>
                        </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php elseif( $question->questionType->name === 'Checkbox' ): ?> <!-- TODO add checkbox logic here -->
                <?php $__currentLoopData = $question->answers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $answer): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="field">
                    <div class="ui checkbox">
                        <input type="checkbox" name="<?php echo e($question->id); ?>[]" value="<?php echo e($answers[$i]); ?>" class="hidden">
                        <label><?php echo e($answers); ?></label>
                    </div>
                </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php endif; ?>
        </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
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
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>