

<?php $__env->startSection('page_title'); ?>
Dashboard
<?php $__env->stopSection(); ?>

<?php $__env->startSection('breadcrumbs'); ?>
<?php echo Breadcrumbs::render(); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<!-- Small boxes (Stat box) -->
<?php echo $__env->make('base::admin._partials.boxes', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

<?php if (is_module_enabled('Manga')): ?>
    <!-- Hot Manga -->
    <div class="row">
        <!-- Latest Manga -->
        <div class="col-md-12">
            <div class="box box-danger">
                <div class="box-header with-border">
                    <h3 class="box-title">
                        <i class="fa fa-star"></i> <?php echo e(Lang::get('messages.admin.dashboard.hotmanga')); ?>

                    </h3>
                    <?php if(Sentinel::hasAccess('manga.manga.hot')): ?>
                    <div class="box-tools">
                        <?php echo e(link_to_route('admin.manga.hot', Lang::get('messages.admin.dashboard.edit-hotlist'), [], array('class' => 'btn btn-primary btn-xs', 'role' => 'button'))); ?>

                    </div>
                    <?php endif; ?>
                </div>
                <div class="box-body">
                    <?php if(count($mangas)>0): ?>
                    <div class="row">
                        <?php $__currentLoopData = $hotmanga; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $manga): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="col-sm-4 col-md-2 text-center">
                            <a href='<?php if(Sentinel::hasAnyAccess(["manga.manga.index","manga.manga.create","manga.manga.edit","manga.manga.destroy"])): ?> <?php echo e(route("admin.manga.show",$manga->id)); ?> <?php endif; ?>'>                                
                                <img class="img-responsive" src='<?php echo e(HelperController::coverUrl("$manga->slug/cover/cover_250x350.jpg")); ?>' alt='<?php echo e($manga->name); ?>' />
                            </a>
                            <a href='<?php if(Sentinel::hasAnyAccess(["manga.manga.index","manga.manga.create","manga.manga.edit","manga.manga.destroy"])): ?> <?php echo e(route("admin.manga.show",$manga->id)); ?> <?php endif; ?>' class="users-list-name">
                                <?php echo e($manga->name); ?>

                            </a>
                        </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                    <?php else: ?>
                    <p class="text-center"><?php echo e(Lang::get('messages.admin.dashboard.hotlist-empty')); ?></p>
                    <?php endif; ?>
                </div>
                <?php if(Sentinel::hasAccess('manga.manga.hot')): ?>
                <div class="box-footer text-center">
                    <?php echo e(link_to_route('admin.manga.hot', 'View All')); ?>

                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <div class="row">
        <!-- Latest Manga -->
        <div class="col-md-6">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">
                        <i class="fa fa-pencil-square-o fa-fw"></i> <?php echo e(Lang::get('messages.admin.dashboard.latest-added-manga')); ?>

                    </h3>
                    <?php if(Sentinel::hasAccess('manga.manga.create')): ?>
                    <div class="box-tools pull-right">
                        <?php echo e(link_to_route('admin.manga.create', Lang::get('messages.admin.dashboard.create-manga'), [], array('class' => 'btn btn-primary btn-xs', 'role' => 'button'))); ?>

                    </div>
                    <?php endif; ?>
                </div>
                <div class="box-body">
                    <?php if(count($mangas)>0): ?>
                    <ul class="products-list product-list-in-box">
                        <?php $__currentLoopData = $mangas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $manga): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li class="item">
                            <div class="product-img">
                                <a href='<?php if(Sentinel::hasAnyAccess(["manga.manga.index","manga.manga.create","manga.manga.edit","manga.manga.destroy"])): ?> <?php echo e(route("admin.manga.show",$manga->id)); ?> <?php endif; ?>'>                                
                                    <img width="50" height="50" class="media-object" src='<?php echo e(HelperController::coverUrl("$manga->slug/cover/cover_thumb.jpg")); ?>' alt='<?php echo e($manga->name); ?>' />
                                </a>
                            </div>
                            <div class="product-info">
                                <?php if(Sentinel::hasAnyAccess(["manga.manga.index","manga.manga.create","manga.manga.edit","manga.manga.destroy"])): ?>
                                <?php echo e(link_to_route("admin.manga.show", $manga->name, $manga->id, array('class' => 'product-title'))); ?>

                                <?php else: ?>
                                <?php echo e($manga->name); ?>

                                <?php endif; ?>
                                <div class="pull-right">
                                    <i class="fa fa-user"></i>
                                    <small><?php echo e($manga->user->username); ?></small>
                                </div>
                                <div class="product-description">
                                    <i class="fa fa-calendar-o"></i>
                                    <small><?php echo e(HelperController::formateCreationDate($manga->created_at)); ?></small>
                                </div>
                            </div>
                        </li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </ul>
                    <?php else: ?>
                    <p class="text-center"><?php echo e(Lang::get('messages.admin.dashboard.no-manga')); ?></p>
                    <?php endif; ?>
                </div>
                <?php if(Sentinel::hasAnyAccess(["manga.manga.index","manga.manga.create","manga.manga.edit","manga.manga.destroy"])): ?>
                <div class="box-footer text-center">
                    <?php echo e(link_to_route('admin.manga.index', Lang::get('messages.admin.dashboard.view-all-manga'))); ?>

                </div>
                <?php endif; ?>
            </div>
        </div>

        <!-- Latest Chapter -->
        <div class="col-md-6">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">
                        <i class="fa fa-book fa-fw"></i> <?php echo e(Lang::get('messages.admin.dashboard.latest-added-chapter')); ?>

                    </h3>
                </div>
                <div class="box-body">
                    <?php if(count($chapters)>0): ?>
                    <ul class="products-list product-list-in-box">
                        <?php $__currentLoopData = $chapters; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $chapter): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li class="item">
                            <div class="product-img">
                                <a href='<?php if(Sentinel::hasAnyAccess(["manga.manga.index","manga.manga.create","manga.manga.edit","manga.manga.destroy"])): ?> <?php echo e(route("admin.manga.show",$chapter->manga_id)); ?> <?php endif; ?>'>                                
                                    <img width="50" height="50" class="media-object" src='<?php echo e(HelperController::coverUrl("$chapter->manga_slug/cover/cover_thumb.jpg")); ?>' alt='<?php echo e($chapter->manga_name); ?>' />
                                </a>
                            </div>
                            <div class="product-info">
                                <?php if(Sentinel::hasAnyAccess(["manga.chapter.index","manga.chapter.create","manga.chapter.edit","manga.chapter.destroy"])): ?>
                                <?php echo e(link_to_route("admin.manga.chapter.show", $chapter->manga_name. " #". $chapter->number, array($chapter->manga_id, $chapter->id), array('class' => 'product-title'))); ?>

                                <?php else: ?>
                                <?php echo e($chapter->manga_name. " #". $chapter->number); ?>

                                <?php endif; ?>
                                <div class="pull-right">
                                    <i class="fa fa-user"></i>
                                    <small><?php echo e($chapter->username); ?></small>
                                </div>
                                <div class="product-description">
                                    <div class="pull-right">
                                        <i class="fa fa-calendar-o"></i>
                                        <small><?php echo e(HelperController::formateCreationDate($chapter->created_at)); ?></small>
                                    </div>
                                    <em><?php echo e($chapter->name); ?></em>
                                </div>
                            </div>
                        </li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </ul>
                    <?php else: ?>
                    <p class="text-center"><?php echo e(Lang::get('messages.admin.dashboard.no-chapter')); ?></p>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
<?php endif; ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('base::layouts.default', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>