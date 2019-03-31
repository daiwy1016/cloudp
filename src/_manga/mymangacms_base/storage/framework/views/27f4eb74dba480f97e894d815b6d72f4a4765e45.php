<?php $__env->startSection('title'); ?>
Login In
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="login-box">
    <div class="login-logo">
        <a href="<?php echo e(route('front.index')); ?>"><b><?php echo e($sitename); ?></b></a>
    </div>
    <?php echo $__env->make('base::admin._partials.notifications', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

    <div class="login-box-body">
        <p class="login-box-msg"><?php echo e(trans('user::messages.front.auth.sign_in')); ?></p>

        <?php echo e(Form::open(['route' => 'login.post'])); ?>

        <div class="form-group has-feedback <?php echo e($errors->has('email') ? ' has-error' : ''); ?>">
            <input type="text" class="form-control" autofocus
                   name="email" placeholder="<?php echo e(trans('user::messages.front.auth.email_or_username')); ?>" value="<?php echo e(old('email')); ?>">
            <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
            <?php echo $errors->first('email', '<span class="help-block">:message</span>'); ?>

        </div>
        <div class="form-group has-feedback <?php echo e($errors->has('password') ? ' has-error' : ''); ?>">
            <input type="password" class="form-control"
                   name="password" placeholder="<?php echo e(trans('user::messages.front.auth.password')); ?>" value="<?php echo e(old('password')); ?>">
            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
            <?php echo $errors->first('password', '<span class="help-block">:message</span>'); ?>

        </div>
        
        <?php if(isset($captcha->form_login) && $captcha->form_login === '1'): ?>
        <div class="form-group has-feedback <?php echo e($errors->has('g-recaptcha-response') ? ' has-error' : ''); ?>">
            <?php echo NoCaptcha::renderJs(); ?>

            <?php echo NoCaptcha::display(); ?>

            <?php echo $errors->first('g-recaptcha-response', '<span class="help-block">:message</span>'); ?>

        </div>
        <?php endif; ?>
        
        <div class="row">
            <div class="col-xs-8">
                <div class="checkbox icheck">
                    <label>
                        <input type="checkbox" name="remember_me"> <?php echo e(trans('user::messages.front.auth.remember_me')); ?>

                    </label>
                </div>
            </div>
            <!-- /.col -->
            <div class="col-xs-4">
                <button type="submit" class="btn btn-primary btn-block btn-flat"><?php echo e(trans('user::messages.front.auth.sign_in_btn')); ?></button>
            </div>
            <!-- /.col -->
        </div>
        <?php echo e(Form::close()); ?>


        <a href="<?php echo e(route('reset')); ?>"><?php echo e(trans('user::messages.front.auth.forgot_password')); ?></a><br>
        <?php if(config('subscribe')): ?>
            <a href="<?php echo e(route('register')); ?>" class="text-center"><?php echo e(trans('user::messages.front.auth.register')); ?></a>
        <?php endif; ?>
    </div>
    <!-- /.login-box-body -->
</div>
<!-- /.login-box -->
<?php $__env->stopSection(); ?>

<?php echo $__env->make('user::layouts.auth', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>