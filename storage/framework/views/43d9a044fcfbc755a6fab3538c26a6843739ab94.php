<?php $__env->startSection('content'); ?>
<div class="ui middle aligned center aligned grid">
    <div class="column">
        <h2 class="ui white header">
            <div class="content">
                Education Test System
            </div>
        </h2>
        <form method="POST" action="<?php echo e(route('register')); ?>" class="ui huge form">
            <?php echo csrf_field(); ?>
            <div class="ui stacked segment left aligned">
                <div class="field<?php echo e($errors->has('personalCode') ? ' error' : ''); ?>">
                    <label>Organization personal code</label>
                    <input type="text" name="personalCode" value="<?php echo e(old('personalCode')); ?>" required>
                </div>
                <div class="field<?php echo e($errors->has('firstName') ? ' error' : ''); ?>">
                    <label>First name</label>
                    <input type="text" name="firstName" value="<?php echo e(old('firstName')); ?>" required>
                </div>
                <div class="field<?php echo e($errors->has('lastName') ? ' error' : ''); ?>">
                    <label>Last name</label>
                    <input type="text" name="lastName" value="<?php echo e(old('lastName')); ?>" required>
                </div>
                <div class="field<?php echo e($errors->has('email') ? ' error' : ''); ?>">
                    <label>Email</label>
                    <input type="email" name="email" value="<?php echo e(old('email')); ?>" required>
                </div>
                <div class="field<?php echo e($errors->has('password') ? ' error' : ''); ?>">
                    <label>Password</label>
                    <input type="password" name="password" required>
                </div>
                <div class="field">
                    <label>Password confirmation</label>
                    <input type="password" name="password_confirmation" required>
                </div>
                <button type="submit" class="ui fluid large teal submit button">Register</button>
            </div>
        </form>
        <div class="ui message">
            Already have an account? <a href="<?php echo e(route('login')); ?>">Login</a>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.auth', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>