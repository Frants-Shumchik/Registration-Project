<?php $__env->startSection('content'); ?>
    <h1 class="ui header">Organization information</h1>
    <form method="post" action="/admin/organization" class="ui form">
        <?php echo csrf_field(); ?>
        <div class="field">
            <label>Organization name</label>
            <input type="text" name="organizationName" value="<?php echo e($organization->name); ?>" placeholder="Organization name">
        </div>
        <div class="field">
            <label>Organization address</label>
            <input type="text" name="organizationAddress" value="<?php echo e($organization->address); ?>" placeholder="Organization address">
        </div>
        <button class="ui button primary" type="submit">Save</button>
    </form>
    <h1 class="ui header">Organization Members Table</h1>
    <table class="ui celled table">
        <thead>
        <tr>
            <th>#</th>
            <th>Personal code</th>
            <th>First name</th>
            <th>Last name</th>
        </tr>
        </thead>
        <tbody>
        <?php if(count($members) > 0): ?>
            <?php $index = 1 ?>
            <?php $__currentLoopData = $members; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $member): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr<?php echo e(!$member->user_id ? " class=warning" : ''); ?>>
                    <td><?php echo e($index++); ?></td>
                    <td><?php echo e($member->personal_code); ?></td>
                    <?php if($member->user_id && $member->user): ?>
                        <td><?php echo e($member->user->firstName); ?></td>
                        <td><?php echo e($member->user->lastName); ?></td>
                    <?php else: ?>
                        <td><i class="attention icon"></i>None</td>
                        <td><i class="attention icon"></i>None</td>
                    <?php endif; ?>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <?php else: ?>
            <tr>
                <td class="center aligned" colspan="4">No members have been added yet</td>
            </tr>
        <?php endif; ?>
        </tbody>
    </table>
    <div class="ui grid centered aligned">
        <div class="eight wide column">
            <div class="ui segment">
                <h3>Add personal code</h3>
                <form method="post" class="ui form">
                    <?php echo csrf_field(); ?>
                    <div class="inline fields">
                        <div class="sixteen wide field">
                            <input type="text" name="personal_code" value="<?php echo e($random_code); ?>" placeholder="Personal code">
                            <button class="ui button" type="submit">Add</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>