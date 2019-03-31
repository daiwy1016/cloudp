<?php $__currentLoopData = $menuNodes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $node): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<?php if($node->children->count()>0): ?>
<li class="dropdown <?php if($node->css_class): ?> <?php echo e($node->css_class); ?> <?php endif; ?>">
    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
        <?php echo e($node->title); ?> <span class="caret"></span>
    </a>
    <ul class="dropdown-menu">
        <?php  for($i=0;$i<$node->children->count();$i++) {  ?>
        <li <?php if($node->children[$i]->css_class): ?> class="<?php echo e($node->children[$i]->css_class); ?>" <?php endif; ?>>
             <a href="<?php echo e(($node->children[$i]->type === 'route')?(Route::has($node->children[$i]->url)?route($node->children[$i]->url):'#'):
                         (($node->children[$i]->type == 'page')?route('front.index').'/'.$node->children[$i]->url:$node->children[$i]->url)); ?>"
           <?php if($node->children[$i]->target): ?> target="<?php echo e($node->children[$i]->target); ?>" <?php endif; ?>
           title="<?php echo e($node->children[$i]->title); ?>">
           <?php if($node->children[$i]->icon_font): ?> <i class="<?php echo e($node->children[$i]->icon_font); ?>"></i> <?php endif; ?>
                <?php echo e($node->children[$i]->title); ?>

            </a>
        </li>
        <?php  }  ?>
    </ul>
</li>
<?php else: ?>
<li <?php if($node->css_class): ?> class="<?php echo e($node->css_class); ?>" <?php endif; ?>>
     <a href="<?php echo e(($node->type == 'route')?(Route::has($node->url)?route($node->url):'#'):
                 (($node->type == 'page')?route('front.index').'/'.$node->url:$node->url)); ?>"
   <?php if($node->target): ?> target="<?php echo e($node->target); ?>" <?php endif; ?>
   title="<?php echo e($node->title); ?>">
   <?php if($node->icon_font): ?>
   <i class="<?php echo e($node->icon_font); ?>"></i>
        <?php endif; ?>
        <?php echo e($node->title); ?>

    </a>
</li>
<?php endif; ?>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
