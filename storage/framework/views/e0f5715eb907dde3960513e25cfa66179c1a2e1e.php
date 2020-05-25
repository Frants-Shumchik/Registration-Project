<?php $__env->startSection('content'); ?>
    <h1 class="ui header">Available tests list</h1>
    <div class="ui cards">
        <?php $__currentLoopData = $tests; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $test): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="ui card">
                <div class="content">
                    <div class="header"><?php echo e($test->name); ?></div>
                    <div class="description">
                        <p><b>Questions count:</b> <?php echo e($test->questions_count); ?></p>
                        <p>
                            <b>Time available:</b>
                            <?php if($test->available_time): ?>
                                <?php echo e((int) ($test->available_time / 60)); ?> mins
                                <?php echo e(number_format($test->available_time % 60)); ?> sec
                            <?php else: ?>
                                Unlimited
                            <?php endif; ?>
                        </p>
                        <p><?php echo e($test->description); ?></p>
                    </div>
                </div>
                <div class="content">
                    <a href="/tests/<?php echo e($test->id); ?>">
                    <button class="ui right labeled icon button">
                        <i class="right arrow icon"></i>
                        Start
                    </button>
                    </a>
                </div>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>