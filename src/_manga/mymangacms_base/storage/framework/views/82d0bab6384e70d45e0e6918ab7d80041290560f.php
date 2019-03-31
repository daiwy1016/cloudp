

<?php $__env->startSection('head'); ?>
<link rel="stylesheet" href="<?php echo e(asset('vendor/datatables/jquery.dataTables.min.css')); ?>">
<link rel="stylesheet" href="<?php echo e(asset('vendor/datatables/buttons.dataTables.min.css')); ?>">

<script src="<?php echo e(asset('vendor/datatables/jquery.dataTables.min.js')); ?>"></script>
<script src="<?php echo e(asset('vendor/datatables/dataTables.buttons.min.js')); ?>"></script>
<script src="<?php echo e(asset('vendor/datatables/buttons.server-side.js')); ?>"></script>
<?php echo Jraty::js(); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('breadcrumbs'); ?>
<?php echo Breadcrumbs::render(); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="row">
    <div class="col-md-12">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">
                    <i class="fa fa-list fa-fw"></i> <?php echo e(Lang::get('messages.admin.manga.list')); ?>

                </h3>
                <div class="box-tools">
                    <?php if(Sentinel::hasAnyAccess(['manga.manga.create','manage_my_manga'])): ?>
                    <a class="btn btn-primary btn-sm"
                       href="<?php echo e(route('admin.manga.create')); ?>">
                        <i class="fa fa-plus"></i> <?php echo e(Lang::get('messages.admin.manga.create')); ?>

                    </a>
                    <?php endif; ?>
                </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <?php echo $dataTable->table(); ?>

            </div>
            <!-- /.box-body -->
        </div>
    </div>
</div>

<?php echo $dataTable->scripts(); ?>

<script>
    /*$('#dataTableBuilder') .on('preXhr.dt', function (e, settings, data) { data.mes = '1'; data.anio = '11'; });
    $('#search-form').on('submit', function(e) {
        oTable.draw();
        e.preventDefault();
    });*/
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('base::layouts.default', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>