<?php $__env->startSection('breadcrumbs'); ?>
<?php echo Breadcrumbs::render('admin.settings.gdrive'); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <i class="fa fa-google fa-fw"></i> <?php echo e(Lang::get('messages.admin.settings.gdrive')); ?>

            </div>
            <br/>

            <!-- /.panel-heading -->
            <div class="panel-body">
                <div class="row">
                    <div class="col-md-12">
                        <div>
                            <p>
                                Contact me via my Envato profile page: <a href="https://codecanyon.net/user/cyberziko">https://codecanyon.net/user/cyberziko</a> with the message "Google Drive extension" to get this extension.
                                <br/>
                                I will send it to you as soon as possible.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.panel-body -->
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('base::layouts.default', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>