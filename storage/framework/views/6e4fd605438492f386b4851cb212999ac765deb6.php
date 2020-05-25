<?php $__env->startSection('content'); ?>
    <h1 class="ui header">Personal results table</h1>
    <table class="ui celled padded table">
        <thead>
            <tr>
                <th>User</th>
                <th>Test</th>
                <th>Complete time</th>
                <th>Spent time (minutes)</th>
                <th>Right Answers</th>
                <th>Mark</th>
            </tr>
        </thead>
        <tbody>
        <?php $__currentLoopData = $results; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $result): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr class="center aligned">
                <td>
                    <?php echo e($result->user->lastName); ?>

                    <?php echo e($result->user->firstName); ?>

                </td>
                <td class="left aligned">
                    <?php echo e($result->test->name); ?>

                </td>
                <td class="single line">
                    <?php echo e($result->created_at); ?>

                </td>
                <td>
                    <?php echo e(number_format($result->spent_time / 60, 2)); ?>

                </td>
                <td>
                    <?php echo e($result->correct); ?> /
                    <?php echo e($result->test->questions->count()); ?>

                </td>
                <td>
                    <h2 class="ui center aligned header"><?php echo e($result->mark); ?></h2>
                </td>
            </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
    </table>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>