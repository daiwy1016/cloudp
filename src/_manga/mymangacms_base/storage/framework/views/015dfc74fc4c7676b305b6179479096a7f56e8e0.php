<?php $__env->startSection('sidebar'); ?>

<!-- ads -->
<div class="row">
    <div class="col-xs-12" style="padding: 0">
        <div style="display: table; margin: 10px auto;">
            <?php echo isset($ads['RIGHT_SQRE_1'])?$ads['RIGHT_SQRE_1']:''; ?>

        </div>
        <div style="display: table; margin: 10px auto;">
            <?php echo isset($ads['RIGHT_WIDE_1'])?$ads['RIGHT_WIDE_1']:''; ?>

        </div>
    </div>
</div>

<?php $__currentLoopData = $widgets; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index=>$widget): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<?php if($widget->type == 'site_description'): ?>
<!-- About Me -->
<div class="alert alert-success">
    <div class="about">
        <h2><?php echo e($settings['site.name']); ?></h2>
        <h6><?php echo e($settings['site.slogan']); ?></h6>
        <p>
            <?php echo e($settings['site.description']); ?>

        </p>
    </div>
</div>
<!--/ About Me -->
<?php elseif($widget->type == 'top_rates'): ?>
<!-- Manga Top 10 -->
<?php if (is_module_enabled('Manga')): ?>
    <script>
        $(document).ready(function () {
            $('#waiting').show();

            $.ajax({
                url: "<?php echo e(route('front.topManga')); ?>",
            }).done(function (data) {
                $('#waiting').hide();
                $('.top_rating_blade').html(data);
            });
        });
    </script>
    <div class="panel panel-success">
        <?php if(strlen(trim($widget->title))>0): ?>
        <div class="panel-heading">
            <h3 class="panel-title"><strong><?php echo e($widget->title); ?></strong></h3>
        </div>
        <?php endif; ?>
        <div id="waiting" style="display: none;text-align: center;">
            <img src="<?php echo e(asset('images/ajax-loader.gif')); ?>" />
        </div>
        <ul class="top_rating_blade"></ul>
    </div>
<?php endif; ?>
<!--/ Manga Top 10 -->
<?php elseif($widget->type == 'top_views'): ?>
<?php if(count($topViewsManga)>0): ?>
<div class="panel panel-success">
    <?php if(strlen(trim($widget->title))>0): ?>
    <div class="panel-heading">
        <h3 class="panel-title"><strong><?php echo e($widget->title); ?></strong></h3>
    </div>
    <?php endif; ?>
    <ul>
        <?php $__currentLoopData = $topViewsManga; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index=>$manga): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <li class="list-group-item">
            <div class="media">
                <div class="media-left">
                    <a href="<?php echo e(route('front.manga.show',$manga->slug)); ?>">
                        <?php if($manga->cover): ?>
                        <img width="50" src='<?php echo e(HelperController::coverUrl("$manga->slug/cover/cover_thumb.jpg")); ?>' alt='<?php echo e($manga->name); ?>'>
                        <?php else: ?>
                        <img width="50" src='<?php echo e(asset("images/no-image.png")); ?>' alt='<?php echo e($manga->name); ?>' />
                        <?php endif; ?>
                    </a>
                </div>
                <div class="media-body">
                    <h5 class="media-heading"><a href="<?php echo e(route('front.manga.show',$manga->slug)); ?>" class="chart-title"><strong><?php echo e($manga->name); ?></strong></a></h5>
                    <i class="fa fa-eye"></i> <?php echo e($manga->views); ?>

                </div>
            </div>
        </li>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </ul>
</div>
<?php endif; ?>
<?php elseif($widget->type == 'custom_code'): ?>
<div class="panel panel-default">
    <?php if(strlen(trim($widget->title))>0): ?>
    <div class="panel-heading">
        <h3 class="panel-title"><strong><?php echo e($widget->title); ?></strong></h3>
    </div>
    <?php endif; ?>
    <div class="panel-body">
        <?php echo $widget->code; ?>

    </div>
</div>
<?php elseif($widget->type == 'tags' && count($tags) > 0): ?>
<div class="panel tag-widget" style="box-shadow: none">
    <div class="tag-links">
        <?php $__currentLoopData = $tags; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $slug=>$tag): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <?php echo e(link_to_route('front.manga.list.archive', $tag, ['tag', $slug])); ?>

        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
</div>
<?php endif; ?>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

<!-- ads -->
<div class="row">
    <div class="col-xs-12" style="padding: 0">
        <div style="display: table; margin: 10px auto;">
            <?php echo isset($ads['RIGHT_SQRE_2'])?$ads['RIGHT_SQRE_2']:''; ?>

        </div>
        <div style="display: table; margin: 10px auto;">
            <?php echo isset($ads['RIGHT_WIDE_2'])?$ads['RIGHT_WIDE_2']:''; ?>

        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
