<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar sidebar-offcanvas">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel">
            <div class="pull-left image">
                <?php if($userCmp->avatar == 1): ?>
                <img class="img-circle" src='<?php echo e(HelperController::avatarUrl($userCmp->id)); ?>' alt='<?php echo e($userCmp->username); ?>'>
                <?php else: ?>
                <img class="img-circle" src="<?php echo e(asset('images/placeholder.png')); ?>" alt='<?php echo e($userCmp->username); ?>'/>
                <?php endif; ?>
            </div>
            <div class="pull-left info">
                <p><?php echo e(($userCmp->name=='')?$userCmp->username:$userCmp->name); ?></p>
                <a href="<?php echo e(Sentinel::hasAccess('user.profile')?route('admin.settings.profile'):''); ?>">
                    <i class="fa fa-circle text-success"></i>
                    Online
                </a>
            </div>
        </div>
        
        <?php echo $sidebar; ?>

    </section>
    <!-- /.sidebar -->
</aside>
