<!doctype html>
<!--[if lt IE 8 ]><html lang="<?php echo e(App::getLocale()); ?>" class="ie7"> <![endif]-->
<!--[if IE 8 ]><html lang="<?php echo e(App::getLocale()); ?>" class="ie8"> <![endif]-->
<!--[if IE 9 ]><html lang="<?php echo e(App::getLocale()); ?>" class="ie9"> <![endif]-->
<!--[if (gt IE 9)|!(IE)]><!--><html lang="<?php echo e(App::getLocale()); ?>"> <!--<![endif]-->
    <head>
        <meta charset="utf-8"/>
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>
        <title><?php echo $__env->yieldContent('title'); ?></title>
        <meta name="description" content="<?php echo $__env->yieldContent('description'); ?>"/>
        <meta name="keywords" content="<?php echo $__env->yieldContent('keywords'); ?>"/>
        <meta name="viewport" content="width=device-width, initial-scale=1"/>

        <?php if(!is_null($settings['seo.google.webmaster']) || "" !== $settings['seo.google.webmaster']): ?>        
        <meta name="google-site-verification" content="<?php echo e($settings['seo.google.webmaster']); ?>" />
        <?php endif; ?>

        <?php if(!is_null($settings['site.theme.options']) || "" !== $settings['site.theme.options']): ?>
        <?php  $themeOpts=json_decode($settings['site.theme.options'])  ?>
        <?php if(!is_null($themeOpts->icon)): ?>
        <link rel="shortcut icon" href="<?php echo e($themeOpts->icon); ?>">
        <?php endif; ?>
        <?php endif; ?>

        <link rel="canonical" href="<?php echo e(route('front.index')); ?>"/>

        <link rel="stylesheet" href="<?php echo e(asset('css/bootswatch/'.$variation.'/bootstrap.min.css')); ?>"/>
        <link rel="stylesheet" href="<?php echo e(asset('css/style.css')); ?>"/>
        <link rel="stylesheet" href="<?php echo e(asset('css/font-awesome.min.css')); ?>"/>

        <script src="<?php echo e(asset('js/vendor/modernizr-2.6.2-respond-1.1.0.min.js')); ?>"></script>
        <script src="<?php echo e(asset('js/vendor/jquery-1.11.0.min.js')); ?>"></script>
        <script src="<?php echo e(asset('js/vendor/bootstrap.min.js')); ?>"></script>
        <script src="<?php echo e(asset('js/vendor/jquery.autocomplete.min.js')); ?>"></script>
        <script src="<?php echo e(asset('js/main.js')); ?>"></script>

        <?php if(config('settings.orientation') === 'rtl'): ?>
        <link rel="stylesheet" href="<?php echo e(asset('css/bootstrap-rtl.min.css')); ?>">
        <link rel="stylesheet" href="<?php echo e(asset('css/rtl.css')); ?>">
        <?php endif; ?>

        <?php echo $__env->yieldContent('header'); ?>

        <!--[if lt IE 9]>
        <script src="<?php echo e(asset('js/vendor/html5shiv.js')); ?>"></script>
        <script src="<?php echo e(asset('js/vendor/respond.min.js')); ?>"></script>
        <![endif]-->
        <script>if (window != top)
    top.location.href = location.href</script>
    </head>
    <body class="<?php if(isset($themeOpts->boxed) && $themeOpts->boxed == 1): ?> layout-boxed <?php endif; ?>">
        <!--[if lt IE 7]>
            <p class="browsehappy">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->

        <?php if(!is_null($settings['seo.google.analytics']) || "" !== $settings['seo.google.analytics']): ?>
        <?php echo $__env->make('front.analyticstracking', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        <?php endif; ?>

        <div class="wrapper">
            <!-- Website Menu -->
            <?php echo $__env->yieldContent('menu'); ?>
            <!--/ Website Menu -->

            <div class="<?php if(isset($themeOpts->boxed) && $themeOpts->boxed == 1): ?> container <?php else: ?> container-fluid <?php endif; ?>">
                <!-- row -->
                <div class="row">
                    <div class="col-sm-12">
                        <?php echo $__env->yieldContent('allpage'); ?>
                    </div>
                </div>
                <!--/ row -->

                <!-- row -->
                <div class="row"> 
                    <div class="col-sm-4 col-sm-push-8">
                        <?php echo $__env->yieldContent('sidebar'); ?>
                    </div>
                    <div class="col-sm-8 col-sm-pull-4">
                        <?php echo $__env->yieldContent('hotmanga'); ?>

                        <div class="col-sm-12">
                            <?php echo $__env->yieldContent('content'); ?>
                        </div>
                    </div>
                </div>
                <!--/ row -->

                <div class="row"> 
                    <div class="col-sm-12">
                        <div class="row">
                            <div class="manga-footer">
                                <!-- menu -->
                                <ul class="<?php if(config('settings.orientation') === 'rtl'): ?> pull-left <?php else: ?> pull-right <?php endif; ?>">
                                    <?php if(!is_null($themeOpts) && !is_null($themeOpts->footer_menu)): ?>
                                    <?php echo HelperController::renderMenu($themeOpts->footer_menu); ?>

                                    <?php endif; ?>
                                </ul>
                                &copy;&nbsp;<?php echo date("Y") ?>&nbsp;
                                <a href="<?php echo e(route('front.index')); ?>"><?php echo e($settings['site.name']); ?></a>
                                &nbsp;
                                <a href="<?php echo e(route('front.manga.contactUs')); ?>" title="<?php echo e(Lang::get('messages.front.home.contact-us')); ?>"><i class="fa fa-envelope-square"></i></a>
                                &nbsp;
                                <a href="<?php echo e(route('front.feed')); ?>" title="<?php echo e(Lang::get('messages.front.home.rss-feed')); ?>" style="color: #FF9900"><i class="fa fa-rss-square"></i></a>
                            </div>
                        </div>
                    </div>
                </div>

                <?php echo $__env->yieldPushContent('js'); ?>

                <?php echo $__env->yieldContent('js'); ?>

                <script>
                    $(document).ready(function () {
                        var url = window.location.href;
                        var element = $('ul.nav a').filter(function () {
                            if (url.charAt(url.length - 1) == '/') {
                                url = url.substring(0, url.length - 1);
                            }

                            return this.href == url;
                        }).parent();

                        if (element.is('li')) {
                            element.addClass('active');
                        }
                    });
                </script>
            </div>
        </div>
    </div>
</body>
</html>