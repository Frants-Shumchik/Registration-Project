<?php $__env->startSection('content'); ?>
<div class="ui middle aligned center aligned grid">
    <div class="column">
        <h2 class="ui white header">
            <div class="content">
                Education Test System
            </div>
        </h2>
        <form method="POST" action="<?php echo e(route('login')); ?>" class="ui large form">
            <?php echo csrf_field(); ?>
            <div class="ui stacked segment">
                <div class="field">
                    <div class="ui left icon input">
                        <i class="user icon"></i>
                        <input type="text" name="email" placeholder="E-mail address">
                    </div>
                </div>
                <div class="field">
                    <div class="ui left icon input">
                        <i class="lock icon"></i>
                        <input type="password" name="password" placeholder="Password">
                    </div>
                </div>
                <button type="submit" class="ui fluid large teal submit button">Login</button>
            </div>
        </form>
        <?php if($errors->has('email')): ?>
            <div class="ui error message">
                <strong><?php echo e($errors->first('email')); ?></strong>
            </div>
        <?php elseif($errors->has('password')): ?>
            <div class="ui error message">
                <strong><?php echo e($errors->first('password')); ?></strong>
            </div>
        <?php endif; ?>
        <div class="ui message">
            New to us? <a href="<?php echo e(route('register')); ?>">Register</a>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>



<?php echo $__env->make('layouts.auth', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>