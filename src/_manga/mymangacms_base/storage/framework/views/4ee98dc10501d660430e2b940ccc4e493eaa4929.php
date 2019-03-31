<?php $__currentLoopData = $topManga; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index=>$manga): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<li class="list-group-item">
    <div class="media">
        <div class="media-left">
            <a href="<?php echo e(route('front.manga.show',$manga->manga_slug)); ?>">
                <?php if($manga->manga_cover): ?>
                <img width="50" src='<?php echo e(HelperController::coverUrl("$manga->manga_slug/cover/cover_thumb.jpg")); ?>' alt='<?php echo e($manga->manga_name); ?>'>
                <?php else: ?>
                <img width="50" src='<?php echo e(asset("images/no-image.png")); ?>' alt='<?php echo e($manga->manga_name); ?>' />
                <?php endif; ?>
            </a>
        </div>
        <div class="media-body">
            <h5 class="media-heading"><a href="<?php echo e(route('front.manga.show',$manga->manga_slug)); ?>" class="chart-title"><strong><?php echo e($manga->manga_name); ?></strong></a></h5>
            <a href='<?php echo e(route("front.manga.reader", [$manga->manga_slug, $manga->chapter_slug])); ?>' class="chart-title"><?php echo e("#".$manga->chapter_number.". ".$manga->chapter_name); ?></a>
        </div>
    </div>
</li>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
