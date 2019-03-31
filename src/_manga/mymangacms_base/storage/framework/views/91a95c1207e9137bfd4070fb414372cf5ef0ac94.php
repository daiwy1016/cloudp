<?php $__env->startSection('menu'); ?>
<?php if(!is_null($settings['site.theme.options']) || "" !== $settings['site.theme.options']): ?>
<?php  $themeOpts=json_decode($settings['site.theme.options'])  ?>
<?php endif; ?>
<nav class="navbar navbar-default" role="navigation">
    <div class="<?php if(isset($themeOpts->boxed) && $themeOpts->boxed == 1): ?> container <?php else: ?> container-fluid <?php endif; ?>">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-menu">
                <span class="sr-only">Toggle navigation</span><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span>
            </button> 
            <h1 class="<?php if(!is_null($themeOpts) && !is_null($themeOpts->logo)): ?>navbar-brand-logo <?php endif; ?>" style="margin:0;">
                <a class="navbar-brand" href="<?php echo e(route('front.index')); ?>">
                    <?php if(!is_null($themeOpts) && !is_null($themeOpts->logo)): ?>
                    <img alt="<?php echo e($settings['site.name']); ?>" src="<?php echo e($themeOpts->logo); ?>"/>
                    <span style="display: none"><?php echo e($settings['site.name']); ?></span>
                    <?php else: ?>
                    <?php echo e($settings['site.name']); ?>

                    <?php endif; ?>
                </a>
            </h1>
        </div>
        <div class="navbar-custom-menu">
            <ul class="nav navbar-nav <?php if(config('settings.orientation') === 'rtl'): ?> navbar-left <?php else: ?> navbar-right <?php endif; ?>">
                <?php if(env('ALLOW_SUBSCRIBE', false)): ?>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="fa fa-user"></i> <span class="caret"></span></a>
                    <ul class="dropdown-menu profil-menu">
                        <?php if(!Sentinel::check()): ?>
                        <li>
                            <a href="<?php echo e(route('register')); ?>">
                                <i class="fa fa-pencil-square-o"></i> <?php echo e(Lang::get('messages.front.home.subscribe')); ?>

                            </a>
                        </li>
                        <li>
                            <a href="<?php echo e(route('login')); ?>">
                                <i class="fa fa-sign-in"></i> <?php echo e(Lang::get('messages.front.home.login')); ?>

                            </a>
                        </li>
                        <?php else: ?>
                        <li class="text-center" style="padding: 5px 0">
                            Hi, <?php echo e($userCmp->username); ?>!
                        </li>
                        <?php if (is_module_enabled('MySpace')): ?>
                        <li>
                            <a href="<?php echo e(route('user.show', $userCmp->username)); ?>">
                                <i class="fa fa-user"></i> <?php echo e(Lang::get('messages.front.myprofil.my-profil')); ?>

                            </a>
                        </li>
                        <li>
                            <a href="<?php echo e(route('bookmark.index')); ?>">
                                <i class="fa fa-heart"></i> <?php echo e(Lang::get('messages.front.bookmarks.title')); ?>

                            </a>
                        </li>
                        <?php endif; ?>
                        <?php if (is_module_enabled('Notification')): ?>
                            <li>
                                <a href="<?php echo e(route('front.notification.index')); ?>">
                                    <i class="fa fa-bell"></i> My Notifications
                                </a>
                            </li>
                        <?php endif; ?>
                        <?php if (is_module_enabled('Notification') || is_module_enabled('MySpace')): ?>
                            <li role="separator" class="divider"></li>
                        <?php endif; ?>
                        <?php if (is_module_enabled('Manga')): ?>
                            <?php if(Sentinel::hasAnyAccess(['manga.manga.create','manga.chapter.create'])): ?>
                            <li>
                                <a href="<?php echo e(route('admin.manga.index')); ?>">
                                    <i class="fa fa-plus"></i> <?php echo e(Lang::get('messages.front.myprofil.add-manga-chapter')); ?>

                                </a>
                            </li>
                            <?php endif; ?>
                        <?php endif; ?>
                        <?php if (is_module_enabled('Blog')): ?>
                            <?php if(Sentinel::hasAccess('blog.manage_posts')): ?>
                            <li>
                                <a href="<?php echo e(route('admin.posts.index')); ?>">
                                    <i class="fa fa-plus"></i> <?php echo e(Lang::get('messages.front.myprofil.add-post')); ?>

                                </a>
                            </li>
                            <?php endif; ?>
                        <?php endif; ?>
                        <?php if(Sentinel::hasAccess('dashboard.index')): ?>
                        <li>
                            <a href="<?php echo e(route('admin.index')); ?>">
                                <i class="fa fa-cogs"></i> <?php echo e(Lang::get('messages.front.home.dashboard')); ?>

                            </a>
                        </li>
                        <li role="separator" class="divider"></li>
                        <?php endif; ?>
                        <li>
                            <a href="<?php echo e(route('logout')); ?>">
                                <i class="fa fa-sign-out"></i> <?php echo e(Lang::get('messages.front.home.logout')); ?>

                            </a>
                        </li>  
                        <?php endif; ?>
                    </ul>
                </li>
                <?php endif; ?>
                <li class="search dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-search"></i></a>
                    <div class="dropdown-menu">
                        <form class="navbar-form">
                            <div class="navbar-form <?php if(config('settings.orientation') === 'rtl'): ?> navbar-left <?php else: ?> navbar-right <?php endif; ?>" role="search">
                                <div class="form-group">
                                    <input id="autocomplete" class="form-control" type="text" placeholder="<?php echo e(Lang::get('messages.front.menu.search')); ?>" style="border-radius:0;"/>
                                </div>
                            </div>
                        </form>
                    </div>
                </li>
                <!-- Notifications Menu -->
                <?php if (is_module_enabled('Notification')): ?>
                    <?php if(Sentinel::check()): ?>
                        <?php if (is_module_enabled('Notification')): ?>
                            <?php echo $__env->make('notification::partials.notifications', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                        <?php endif; ?>
                    <?php endif; ?>
                <?php endif; ?>
            </ul>
        </div>
        <div class="collapse navbar-collapse" id="navbar-menu">
            <!-- menu -->
            <ul class="nav navbar-nav <?php if(config('settings.orientation') === 'rtl'): ?> navbar-left <?php else: ?> navbar-right <?php endif; ?>">
                <?php if(!is_null($themeOpts) && !is_null($themeOpts->main_menu)): ?>
                <?php echo HelperController::renderMenu($themeOpts->main_menu); ?>

                <?php endif; ?>
            </ul>
        </div>
    </div>
</nav>

<style>
    .searching {
        background-image: url('<?php echo e(asset("images/ajax-loader.gif")); ?>');
        background-position: 95% 50%;
        background-repeat: no-repeat;
    }
</style>
<script>
    $('#autocomplete').autocomplete({
        serviceUrl: "<?php echo e(route('front.search')); ?>",
        onSearchStart: function (query) {
            $('#autocomplete').addClass('searching');
        },
        onSearchComplete: function (query, suggestions) {
            $('#autocomplete').removeClass('searching');
        },
        onSelect: function (suggestion) {
            showURL = "<?php echo e(Route::has('front.manga.show')?route('front.manga.show', 'SELECTION'):'#'); ?>";
            window.location.href = showURL.replace('SELECTION', suggestion.data);
        }
    });
</script>
<?php $__env->stopSection(); ?>

