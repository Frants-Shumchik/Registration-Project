<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
    <title>Fixed Menu Example - Semantic</title>
    <link rel="stylesheet" type="text/css" href="<?php echo e(url('css/semantic.min.css')); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo e(url('css/main.css')); ?>">
</head>
<body>
<script src="https://code.jquery.com/jquery-3.3.1.min.js"
        integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
<script src="<?php echo e(url('js/semantic.min.js')); ?>"></script>
<div class="app">
    <div class="ui inverted menu">
        <div class="ui container">
            <a href="#" class="header item">
                Education Test System
            </a>
            <a href="<?php echo e(url('admin/members')); ?>" class="item">Members</a>
            <a href="<?php echo e(url('admin/tests')); ?>" class="item">Tests</a>
            <a href="<?php echo e(url('admin/results')); ?>" class="item">Results</a>
            <div class="right menu">
                <a class="ui inverted item">
                    <?php echo e($user->firstName); ?> <?php echo e($user->lastName); ?> (<?php echo e($user->role->name); ?>)
                </a>
                <a class="ui inverted item" href="<?php echo e(url('/logout')); ?>">
                    Logout
                </a>
            </div>
        </div>
    </div>
    <div class="ui container content">
        <?php echo $__env->yieldContent('content'); ?>
    </div>
    <div class="ui inverted vertical footer segment">
        <div class="ui center aligned container">
            Danila INC @ 2019
        </div>
    </div>
</div>
</body>
</html>