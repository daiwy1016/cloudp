<li class="dropdown messages-menu">
    <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
        <i class="fa fa-bell-o"></i>
        <span class="label label-success notificationsCounter animated"><?php echo e($notifications->count()); ?></span>
    </a>
    <ul class="dropdown-menu">
        <li>
            <div class="slimScrollDiv">
                <ul class="menu notifications-list">
                    <?php if ($notifications->count() === 0): ?>
                    <li class="noNotifications">
                        <a href="#">
                            <?php echo e(trans('notification::messages.no notifications')); ?>

                        </a>
                    </li>
                    <?php endif; ?>
                    <?php foreach ($notifications as $notification): ?>
                    <li>
                        <a href="<?php echo e($notification->link); ?>">
                            <div class="pull-left notificationIcon">
                                <i class="<?php echo e($notification->icon_class); ?>"></i>
                            </div>
                            <h4>
                                <?php echo e($notification->title); ?>

                                <small>
                                    <i class="fa fa-clock-o"></i> <?php echo e($notification->time_ago); ?>

                                    <i class="fa fa-close removeNotification" data-id="<?php echo e($notification->id); ?>"></i>
                                </small>
                            </h4>
                            <p><?php echo e($notification->message); ?></p>
                        </a>
                    </li>
                    <?php endforeach; ?>
                </ul>
            </div>
            <li class="footer"><a href="<?php echo e(route('front.notification.index')); ?>"><?php echo e(trans('notification::messages.view all')); ?></a></li>
        </li>
    </ul>
</li>

<?php $__env->startPush('js'); ?>
<script>
    $( document ).ready(function() {
        $('.removeNotification').on('click', function(e) {
            e.preventDefault();
            e.stopPropagation();
            var self = this;
            $.ajax({
                type: 'POST',
                url: '<?php echo e(route('front.notification.read')); ?>',
                data: {
                    'id': $(this).data('id'),
                    '_token': '<?php echo e(csrf_token()); ?>'
                },
                success: function(data) {
                    if (data.updated) {
                        var notification = $(self).closest('li');
                        notification.addClass('animated fadeOut');
                        setTimeout(function() {
                            notification.remove();
                        }, 510)
                        var count = parseInt($('.notificationsCounter').text());
                        $('.notificationsCounter').text(count - 1);
                    }
                }
            });
        });
    });
</script>
<?php $__env->stopPush(); ?>
