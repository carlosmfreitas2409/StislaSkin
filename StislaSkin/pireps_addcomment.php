<?php if(!defined('IN_PHPVMS') && IN_PHPVMS !== true) { die(); } ?>
<div class="section-header">
	<h1>Add Comment</h1>
    <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="<?php echo SITE_URL; ?>">Dashboard</a></div>
        <div class="breadcrumb-item"><a href="javascript::">Flight Operations</a></div>
        <div class="breadcrumb-item"><a href="javascript::">PIREPs List</a></div>
        <div class="breadcrumb-item">Add Comment</div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <form action="<?php echo url('/pireps/viewpireps');?>" method="post">
                    <div class="form-group">
                        <div class="section-title mt-0">Comment</div>
                        <textarea class="summernote-simple" name="comment" width="350"></textarea>
                    </div>

                    <input type="hidden" name="action" value="addcomment" />
                    <input type="hidden" name="pirepid" value="<?php echo $pirep->pirepid?>" />
                    <input type="submit" name="submit" class="btn btn-primary float-right" value="Add Comment" />
                </form>
            </div>
        </div>
    </div>
</div>