<?php if(Session::has('success')): ?>
    <div class="alert alert-success fade in alert-dismissable" style="border-radius: 0">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <?php echo e(Session::get('success')); ?>

    </div>
<?php endif; ?>

<?php if(Session::has('error')): ?>
    <div class="alert alert-danger fade in alert-dismissable" style="border-radius: 0">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <?php echo e(Session::get('error')); ?>

    </div>
<?php endif; ?>

<?php if(Session::has('warning')): ?>
    <div class="alert alert-warning fade in alert-dismissable" style="border-radius: 0">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <?php echo e(Session::get('warning')); ?>

    </div>
<?php endif; ?>
