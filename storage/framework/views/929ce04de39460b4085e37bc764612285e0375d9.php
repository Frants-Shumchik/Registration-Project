<?php $__env->startSection('content'); ?>
    <h1 class="ui header">Organization Test List</h1>
    <table class="ui compact celled definition table">
        <thead>
            <tr>
                <th>Active</th>
                <th>Name</th>
                <th>Description</th>
                <th>Created</th>
                <th>Questions</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
        <?php $__currentLoopData = $tests; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $test): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
                <td class="collapsing">
                    <div class="ui fitted toggle checkbox">
                        <form action="<?php echo e(url('admin/tests/' . $test->id)); ?>" method="POST" id="testStatus">
                            <?php echo method_field('PATCH'); ?>
                            <?php echo csrf_field(); ?>
                            <input name="is_active" type="checkbox"<?php echo e($test->is_active ? ' checked' : ''); ?>>
                            <label></label>
                        </form>
                    </div>
                </td>
                <td><?php echo e($test->name); ?></td>
                <td><?php echo e($test->description); ?></td>
                <td><?php echo e($test->created_at); ?></td>
                <td><?php echo e($test->questions->count()); ?></td>
                <td>
                    <div style="display: flex">
                        <a href="tests/<?php echo e($test->id); ?>" class="ui small blue button">Edit</a>
                        <form action="<?php echo e(url('admin/tests/' . $test->id)); ?>" method="POST">
                            <?php echo method_field('DELETE'); ?>
                            <?php echo csrf_field(); ?>
                            <button class="ui small red button">Delete</button>
                        </form>
                    </div>
                </td>
            </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
        <tfoot class="full-width">
        <tr>
            <th colspan="6">
                <a href="<?php echo e(url('admin/tests/create')); ?>">
                    <div class="ui right floated small green labeled icon button">
                        <i class="clipboard icon"></i> Add Test
                    </div>
                </a>
            </th>
        </tr>
        </tfoot>
    </table>
    <script type="text/javascript">
        $(document).ready(function () {
            $('#testStatus input[type="checkbox"]').each((index, input) => {
                input.onchange = () => input.parentNode.submit();
            });
        });
    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>