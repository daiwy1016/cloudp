<?php $__env->startSection('content'); ?>
<!-- ads -->
<div class="row">
    <div class="col-xs-12" style="padding: 0">
        <div class="ads-large" style="display: table; margin: 10px auto;">
            <?php echo isset($ads['TOP_LARGE'])?$ads['TOP_LARGE']:''; ?>

        </div>
        <div style="display: table; margin: 10px auto;">
            <div class="pull-left ads-sqre1" style="margin-right: 10px;">
                <?php echo isset($ads['TOP_SQRE_1'])?$ads['TOP_SQRE_1']:''; ?>

            </div>
            <div class="pull-right ads-sqre2">
                <?php echo isset($ads['TOP_SQRE_2'])?$ads['TOP_SQRE_2']:''; ?>

            </div>
        </div>
    </div>
</div>

<?php if (is_module_enabled('Blog')): ?>
    <!-- news -->
    <?php if(count($mangaNews)>0): ?>
    <h2 class="listmanga-header">
        <i class="fa fa-newspaper-o"></i> <?php echo e(Lang::get('messages.front.home.news')); ?>

    </h2>
    <hr/>

    <div class="manganews">
        <?php $__currentLoopData = $mangaNews; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $post): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="news-item" style="display: inline-block; width: 100%;">
            <h3 class="manga-heading <?php if(config('settings.orientation') === 'rtl'): ?> pull-right <?php else: ?> pull-left <?php endif; ?>">
                <i class="fa fa-square"></i>
                <a href="<?php echo e(route('front.news', $post->slug)); ?>"><?php echo e($post->title); ?></a>
            </h3>
            <div class="<?php if(config('settings.orientation') === 'rtl'): ?> pull-left <?php else: ?> pull-right <?php endif; ?>" style="font-size: 13px;">
                <span class="<?php if(config('settings.orientation') === 'rtl'): ?> pull-right <?php else: ?> pull-left <?php endif; ?>" style="width: 110px">
                    <i class="fa fa-clock-o"></i> <?php echo e(App::make("HelperController")->formateCreationDate($post->created_at)); ?>&nbsp;&middot;&nbsp;
                </span>
                <span class="<?php if(config('settings.orientation') === 'rtl'): ?> pull-right <?php else: ?> pull-left <?php endif; ?>"><i class="fa fa-user"></i> <?php echo e($post->user->username); ?></span>
                <?php if(!is_null($post->manga)): ?>
                <span class="<?php if(config('settings.orientation') === 'rtl'): ?> pull-right <?php else: ?> pull-left <?php endif; ?>">&nbsp;&middot;&nbsp;<i class="fa fa-folder-open-o"></i> <?php echo e(link_to_route('front.manga.show', $post->manga->name, $post->manga->slug)); ?></span>
                <?php endif; ?>
            </div>
        </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
    <?php endif; ?>
<?php endif; ?>

<?php if (is_module_enabled('Manga')): ?>
    <h2 class="listmanga-header">
        <i class="fa fa-bars"></i><?php echo e(Lang::get('messages.front.home.latest-manga')); ?>

    </h2>
    <hr/>

    <?php if(count($latestMangaUpdates)>0): ?>
    <div class="mangalist">
        <?php $__currentLoopData = $latestMangaUpdates; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $date => $dateGroup): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <?php $__currentLoopData = $dateGroup; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $manga): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="manga-item">
            <h3 class="manga-heading <?php if(config('settings.orientation') === 'rtl'): ?> pull-right <?php else: ?> pull-left <?php endif; ?>">
                <i class="fa fa-book"></i>
                <a href="<?php echo e(route('front.manga.show',$manga['manga_slug'])); ?>"><?php echo e($manga["manga_name"]); ?></a>
                <?php if($manga["hot"]): ?>
                <span class="label label-danger"><?php echo e(Lang::get('messages.front.home.hot')); ?></span>
                <?php endif; ?>
            </h3>
            <small class="<?php if(config('settings.orientation') === 'rtl'): ?> pull-left <?php else: ?> pull-right <?php endif; ?>" style="direction: ltr;">  
                <?php if($date == 'Y'): ?>
                <?php echo e(Lang::get('messages.front.home.yesterday')); ?>

                <?php elseif($date == 'T'): ?>
                <?php echo e(Lang::get('messages.front.home.today')); ?>

                <?php else: ?>
                <?php echo e($date); ?>

                <?php endif; ?>
            </small>
            <?php $__currentLoopData = $manga['chapters']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $chapter): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="manga-chapter">
                <h6 class="events-subtitle">
                    <?php echo e(link_to_route('front.manga.reader', "#".$chapter['chapter_number'].". ".$chapter['chapter_name'], [$manga['manga_slug'], $chapter['chapter_slug']])); ?>

                </h6>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>        
    </div>
    <?php else: ?>
    <div class="center-block">
        <p><?php echo e(Lang::get('messages.front.home.no-chapter')); ?></p>
    </div>
    <?php endif; ?>
<?php endif; ?>

<!-- ads -->
<div class="row">
    <div class="col-xs-12" style="padding: 0">
        <div class="ads-large" style="display: table; margin: 10px auto;">
            <?php echo isset($ads['BOTTOM_LARGE'])?$ads['BOTTOM_LARGE']:''; ?>

        </div>
        <div style="display: table; margin: 10px auto 0;">
            <div class="pull-left ads-sqre1" style="margin-right: 10px;">
                <?php echo isset($ads['BOTTOM_SQRE_1'])?$ads['BOTTOM_SQRE_1']:''; ?>

            </div>
            <div class="pull-right ads-sqre2">
                <?php echo isset($ads['BOTTOM_SQRE_2'])?$ads['BOTTOM_SQRE_2']:''; ?>

            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

