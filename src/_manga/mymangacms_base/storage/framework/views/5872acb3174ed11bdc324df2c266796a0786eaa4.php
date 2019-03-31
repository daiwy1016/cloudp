<!DOCTYPE html>
<html lang="<?php echo e(App::getLocale()); ?>">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
        <meta name="description" content="Administration">
        <title> 
            <?php if(Session::has('sitename')): ?>
            <?php echo e(Lang::get('messages.admin.layout.site-name', array('sitename' => Session::get('sitename')))); ?>

            <?php endif; ?>
        </title>
        <!--<link rel="shortcut icon" href="{-- get_setting('favicon', 'favicon.png') --}"/>-->

        <link rel="stylesheet" href="<?php echo e(asset('css/bootstrap.min.css')); ?>">
        <link rel="stylesheet" href="<?php echo e(asset('css/admin/AdminLTE.min.css')); ?>">
        <link rel="stylesheet" href="<?php echo e(asset('css/admin/skins/skin-blue.min.css')); ?>">
        <link rel="stylesheet" href="<?php echo e(asset('css/font-awesome.min.css')); ?>">
        <link rel="stylesheet" href="<?php echo e(asset('css/admin/style.css')); ?>">

        <script src="<?php echo e(asset('js/vendor/jquery-1.11.0.min.js')); ?>"></script>

        <?php echo $__env->yieldContent('head'); ?>

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
            <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->

        <!-- Google Font -->
        <link rel="stylesheet"
              href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
    </head>

    <body class="hold-transition skin-blue sidebar-mini">
        <div class="wrapper">
            <!-- Main Header -->
            <?php echo $__env->make('base::admin._partials.header', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

            <!-- Left side column. contains the logo and sidebar -->
            <?php echo $__env->make('base::admin._partials.sidebar', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">

                <!-- alert messages-->
                <div class="row">
                    <div class="col-md-12">
                        <?php echo $__env->make('base::admin._partials.notifications', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                    </div>
                </div>

                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <?php echo $__env->yieldContent('breadcrumbs'); ?>
                </section>

                <!-- Main content -->
                <section class="content container-fluid">
                    <?php echo $__env->yieldContent('content'); ?>
                </section>
                <!-- /.content -->
            </div>
            <!-- /.content-wrapper -->

            <!-- Main Footer -->
            <?php echo $__env->make('base::admin._partials.footer', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

            <!-- Add the sidebar's background. This div must be placed
            immediately after the control sidebar -->
            <div class="control-sidebar-bg"></div>
        </div>
        <!-- ./wrapper -->

        <!-- Change Log -->
        <?php echo $__env->make('base::admin._partials.modals', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

        <script src="<?php echo e(asset('js/admin/adminlte.min.js')); ?>"></script>
        <script src="<?php echo e(asset('js/vendor/bootstrap.min.js')); ?>"></script>

        <?php echo $__env->yieldPushContent('js'); ?>

        <?php echo $__env->yieldContent('js'); ?>

    </body>
</html>
