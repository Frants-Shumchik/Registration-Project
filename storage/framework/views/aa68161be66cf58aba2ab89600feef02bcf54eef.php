<?php $__env->startSection('content'); ?>
    <h1 class="ui header">Your answers was sent to the server!</h1>
    <h2>Your result: <?php echo e($correctCount); ?>/<?php echo e($totalCount); ?>.</h2>
    <h2>You can check the result <a href="<?php echo e(url('results')); ?>">here</a>.</h2>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>