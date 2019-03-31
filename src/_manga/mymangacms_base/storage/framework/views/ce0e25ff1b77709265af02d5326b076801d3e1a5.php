<?php $__env->startSection('hotmanga'); ?>
<?php if(count($hotMangaList)>0): ?>
<div class="col-sm-12">
    <h2 class="hotmanga-header"><i class="fa fa-star"></i><?php echo e(Lang::get('messages.front.home.hot-updates')); ?></h2>
    <hr/>

    <ul class="hot-thumbnails">
        <?php $__currentLoopData = $hotMangaList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $manga): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <li class="span3">
            <div class="photo" style="position: relative;">
                <div class="manga-name">
                    <a class="label label-warning" href="<?php echo e(route('front.manga.show',$manga->manga_slug)); ?>"><?php echo e($manga->manga_name); ?></a>
                </div>
                <a class="thumbnail" style="position: relative; z-index: 10; background: rgb(255, 255, 255) none repeat scroll 0% 0%;" href='<?php echo e(route("front.manga.reader", [$manga->manga_slug, $manga->chapter_slug])); ?>'>
                    <?php if($manga->manga_cover): ?>
                    <img src='<?php echo e(HelperController::coverUrl("$manga->manga_slug/cover/cover_250x350.jpg")); ?>' alt='<?php echo e($manga->manga_name); ?>' />
                    <?php else: ?>
                    <img src='<?php echo e(asset("images/no-image.png")); ?>' alt='<?php echo e($manga->manga_name); ?>' />
                    <?php endif; ?>
                </a>
                <div class="well">
                    <p>
                        <i class="fa fa-book"></i>
                        <?php echo e("#".$manga->chapter_number."  ".$manga->chapter_name); ?>

                    </p>
                </div>
            </div></li>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </ul>
</div>
<div style="clear:both"></div>
<?php endif; ?>
<?php $__env->stopSection(); ?>