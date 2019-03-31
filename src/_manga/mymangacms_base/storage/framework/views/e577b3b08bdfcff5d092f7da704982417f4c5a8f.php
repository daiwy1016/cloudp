

<?php $__env->startSection('head'); ?>
<script>
    checked = Array();
    $(document).ready(function () {
        $('.box-body').on('click', 'input[type="checkbox"]', function () {
            if ($(this).prop('checked') == true) {
                if ($(this).val() == 'all') {
                    checked = Array();
                    $('table input[type="checkbox"]').each(function () {
                        $(this).prop('checked', 'checked');
                        checked.push($(this).val());
                    });
                } else {
                    checked.push($(this).val());
                    allChecked = true;
                    $('table input[type="checkbox"]').each(function () {
                        if ($(this).prop('checked') != true) {
                            allChecked = false;
                        }
                    });

                    $('.box-body input.all').prop('checked', allChecked);
                }
            } else {
                if ($(this).val() == 'all') {
                    checked = Array();
                    $('table input[type="checkbox"]').each(function () {
                        $(this).prop('checked', '');
                    });
                } else if (checked.indexOf($(this).val()) != -1) {
                    checked.splice(checked.indexOf($(this).val()), 1);
                    $('.box-body input.all').prop('checked', '');
                }
            }

            $("#chapters-ids").val(checked.join(','));
        });
    });
</script>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('breadcrumbs'); ?>
<?php echo Breadcrumbs::render('admin.manga.show', $manga); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="row">
    <div class="col-md-9" style="padding: 0">
        <div class="col-md-12" >
            <div class="box box-primary">
                <div class="box-header with-border">
                    <i class="fa fa-square fa-fw"></i> <?php echo e($manga->name); ?>

                    <div class="box-tools">
                        <?php if((Sentinel::check()->id==$manga->user->id && Sentinel::hasAccess('manage_my_manga')) || Sentinel::hasAccess('manga.manga.edit')): ?>
                            <?php echo e(link_to_route('admin.manga.edit', Lang::get('messages.admin.manga.edit-manga'), $manga->id, array('class' => 'btn btn-primary btn-xs'))); ?>

                        <?php endif; ?>
                        <?php if((Sentinel::check()->id==$manga->user->id && Sentinel::hasAccess('manage_my_manga')) || Sentinel::hasAccess('manga.manga.destroy')): ?>
                            <div style="display:inline-block;">
                                <?php echo e(Form::open(array('route' => array('admin.manga.destroy', $manga->id), 'method' => 'delete'))); ?>

                                <?php echo e(Form::submit(Lang::get('messages.admin.manga.delete-manga'), array('class' => 'btn btn-danger btn-xs',  'onclick' => 'if (!confirm("'. Lang::get('messages.admin.manga.confirm-delete') .'")) {return false;}'))); ?>

                                <?php echo e(Form::close()); ?>

                            </div>
                        <?php endif; ?>
                        <?php echo e(link_to_route('admin.manga.index', Lang::get('messages.admin.manga.back'), [], array('class' => 'btn btn-default btn-xs'))); ?>

                    </div>
                </div>
                <!-- /.panel-heading -->
                <div class="box-body">
                    <dl class="dl-horizontal">
                        <?php if(!is_null($manga->status)): ?>
                        <dt><?php echo e(Lang::get('messages.admin.manga.detail.status')); ?></dt>
                        <dd>
                            <?php if($manga->status->id == 1): ?>
                            <span class="label label-success"><?php echo e($manga->status->label); ?></span>
                            <?php else: ?>
                            <span class="label label-danger"><?php echo e($manga->status->label); ?></span>
                            <?php endif; ?>          
                        </dd>
                        <?php endif; ?>

                        <?php if(!is_null($manga->otherNames) && $manga->otherNames != ""): ?>
                        <dt><?php echo e(Lang::get('messages.admin.manga.detail.other-names')); ?></dt>
                        <dd><?php echo e($manga->otherNames); ?></dd>
                        <?php endif; ?>

                        <?php if(count($manga->authors)>0): ?>
                        <dt><?php echo e(Lang::get('messages.admin.manga.detail.author')); ?></dt>
                        <dd><?php echo e(HelperController::listAsString($manga->authors, ', ')); ?></dd>
                        <?php endif; ?>
                        
                        <?php if(count($manga->artists)>0): ?>
                        <dt>Artist(s):</dt>
                        <dd><?php echo e(HelperController::listAsString($manga->artists, ', ')); ?></dd>
                        <?php endif; ?>

                        <?php if(!is_null($manga->releaseDate) && $manga->releaseDate != ""): ?>
                        <dt><?php echo e(Lang::get('messages.admin.manga.detail.released')); ?></dt>
                        <dd><?php echo e($manga->releaseDate); ?></dd>
                        <?php endif; ?>

                        <?php if(count($manga->categories)>0): ?>
                        <dt><?php echo e(Lang::get('messages.admin.manga.detail.categories')); ?></dt>
                        <dd>
                            <?php echo e(HelperController::listAsString($manga->categories, ', ')); ?>

                        </dd>
                        <?php endif; ?>

                        <?php if(!is_null($manga->summary) && $manga->summary != ""): ?>
                        <dt><?php echo e(Lang::get('messages.admin.manga.detail.summary')); ?></dt>
                        <dd><?php echo e($manga->summary); ?></dd>
                        <?php endif; ?>

                        <?php if(count($manga->tags)>0): ?>
                        <dt><?php echo e(Lang::get('messages.admin.manga.create.tags')); ?></dt>
                        <dd>
                            <?php echo e(App::make("HelperController")->listAsString($manga->tags, ', ')); ?>

                        </dd>
                        <?php endif; ?>
                    </dl>
                </div>
                <!-- /.panel-body -->
            </div>
        </div>
        <div class="col-md-12">
            <div class="box box-default">
                <div class="box-header with-border">
                    <i class="fa fa-list-alt"></i> <?php echo e(Lang::get('messages.admin.manga.chapters', array('manganame' => $manga->name))); ?>

                    <div class="box-tools">
                        <?php if((Sentinel::check()->id==$manga->user->id) && Sentinel::hasAccess('manage_my_chapters') || Sentinel::hasAccess('manga.chapter.destroy')): ?>
                        <div style="display: inline-block;">
                            <?php echo e(Form::open(array('route' => array('admin.manga.chapter.destroyChapters', $manga->id), 'method' => 'delete'))); ?>

                            <?php echo e(Form::submit(Lang::get('messages.admin.chapter.edit.delete-chapters'), array('class' => 'btn btn-danger btn-xs delete',  'onclick' => 'if (!confirm("'. Lang::get('messages.admin.chapter.edit.confirm-delete-chapters'). '")) {return false;}'))); ?>

                            <input type="hidden" name="chapters-ids" id="chapters-ids"/>
                            <?php echo e(Form::close()); ?>

                        </div>
                        <?php endif; ?>
                        <?php if((Sentinel::check()->id==$manga->user->id && Sentinel::hasAccess('manage_my_chapters')) || Sentinel::hasAccess('manga.chapter.create')): ?>
                        <?php if(Sentinel::hasAccess('manga.chapter.scrap')): ?>
                        <div class="btn-group">
                            <button type="button" class="btn btn-default btn-xs dropdown-toggle" data-toggle="dropdown">
                                <?php echo e(Lang::get('messages.admin.manga.create-chapter')); ?>

                                <span class="caret"></span>
                            </button>

                            <ul class="dropdown-menu pull-right" role="menu">
                                <li>                                        
                                    <?php echo e(link_to_route('admin.manga.chapter.create', Lang::get('messages.admin.chapter.edit.manually'), $manga->id)); ?>

                                </li>
                                
                                <li>
                                    <?php echo e(link_to_route('admin.manga.chapter.scraper', Lang::get('messages.admin.chapter.edit.grap-sites'), array('manga' => $manga->id))); ?>

                                </li>
                            </ul>
                        </div>
                        <?php else: ?>
                            <?php echo e(link_to_route('admin.manga.chapter.create', Lang::get('messages.admin.manga.create-chapter'), $manga->id, array('class' => 'btn btn-default btn-xs'))); ?>

                        <?php endif; ?>
                        <?php endif; ?>
                    </div>
                </div>
                <!-- /.panel-heading -->
                <div class="box-body">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>
                                    <?php if((Sentinel::check()->id==$manga->user->id && Sentinel::hasAccess('manage_my_chapters')) || Sentinel::hasAccess('manga.chapter.destroy')): ?>
                                    <input type="checkbox" name="check-all" class="all" value="all"/></th>
                                    <?php endif; ?>
                                    </th>
                                    <th><?php echo e(Lang::get('messages.admin.manga.chapter-number')); ?></th>
                                    <th><?php echo e(Lang::get('messages.admin.manga.chapter-name')); ?></th>
                                    <th><?php echo e(Lang::get('messages.admin.manga.owner')); ?></th>
                                    <th style="width: 110px"><?php echo e(Lang::get('messages.admin.manga.created')); ?></th>
                                </tr>
                            </thead>
                            <?php if(count($manga->chapters)>0): ?>
                            <?php $__currentLoopData = $manga->sortedChapters(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $chapter): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td>
                                <?php if((Sentinel::check()->id==$manga->user->id) && Sentinel::hasAccess('manage_my_chapters') || Sentinel::hasAccess('manga.chapter.destroy')): ?>
                                <input type="checkbox" value="<?php echo e($chapter->id); ?>"/>
                                <?php endif; ?>
                                </td>
                                <td>
                                    <?php if(((Sentinel::check()->id==$chapter->user->id||Sentinel::check()->id==$manga->user->id) && Sentinel::hasAccess('manage_my_chapters')) 
                                    || Sentinel::hasAccess('manga.chapter.index')): ?>
                                    <?php echo e(link_to_route("admin.manga.chapter.show", $chapter->number, array($chapter->manga_id, $chapter->id))); ?>

                                    <?php else: ?>
                                    <?php echo e($chapter->number); ?>

                                    <?php endif; ?>
                                </td>
                                <td class="chapter-title">
                                    <?php if(((Sentinel::check()->id==$chapter->user->id||Sentinel::check()->id==$manga->user->id) && Sentinel::hasAccess('manage_my_chapters')) 
                                    || Sentinel::hasAccess('manga.chapter.index')): ?>
                                    <?php echo e(link_to_route("admin.manga.chapter.show", $chapter->name, array($chapter->manga_id, $chapter->id))); ?>

                                    <?php else: ?>
                                    <?php echo e($chapter->name); ?>

                                    <?php endif; ?>
                                </td>
                                <td>
                                    <?php echo e($chapter->user->username); ?>

                                </td>
                                <td>
                                    <?php echo e(HelperController::formateCreationDate($chapter->created_at)); ?>

                                </td>
                            </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php else: ?>
                            <tr>
                                <td colspan="5">
                                    <div class="center-block">
                                        <p><?php echo e(Lang::get('messages.admin.dashboard.no-chapter')); ?></p>
                                    </div>
                                </td>
                            </tr>
                            <?php endif; ?>
                        </table>
                    </div>
                </div>
                <!-- /.panel-body -->
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div id="coverContainer">
            <div class="coverWrapper">
                <div class="previewWrapper">
                    <?php if($manga->cover): ?>
                    <img class="img-responsive img-rounded" src='<?php echo e(HelperController::coverUrl("{$manga->slug}/cover/cover_250x350.jpg")); ?>' alt='<?php echo e($manga->name); ?>'>
                    <?php else: ?>
                    <i class="fa fa-file-image-o"></i>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('base::layouts.default', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>