

<?php $__env->startSection('title'); ?>
<?php echo e(Lang::get('messages.front.home.title', array('sitename' => $settings['seo.title']))); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('description'); ?>
<?php echo e($settings['seo.description']); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('keywords'); ?>
<?php echo e($settings['seo.keywords']); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('header'); ?>
<?php
echo Jraty::js();

echo Jraty::js_init(array(
    'score' => 'function() { return $(this).attr(\'data-score\'); }',
    'number' => 5,
    'click' => 'function(score, evt) {
                $.post(\'save/item_rating\',{
                    item_id: $(this).attr(\'data-item\'),
                    score: score
                });
              }',
    'path' => '\'packages/escapeboy/jraty/raty/lib/img\''
));
?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('front.themes.'.$theme.'.blocs.menu', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('front.themes.'.$theme.'.blocs.hot_manga', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('front.themes.'.$theme.'.blocs.content', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('front.themes.'.$theme.'.blocs.sidebar', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

<?php echo $__env->make('front.layouts.default', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>