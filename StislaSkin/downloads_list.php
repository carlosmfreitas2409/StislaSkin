<?php if(!defined('IN_PHPVMS') && IN_PHPVMS !== true) { die(); } ?>
<div class="section-header">
	<h1>Downloads</h1>
    <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="<?php echo SITE_URL; ?>">Dashboard</a></div>
        <div class="breadcrumb-item"><a href="javascript::">Resources & Support</a></div>
        <div class="breadcrumb-item">Downloads</div>
    </div>
</div>

<div class="row">
    <?php
        if(!$allcategories) {
            echo '<div class="col-md-12"><div class="alert alert-primary"><div class="alert-title">No Downloads!</div>No downloads have been added yet.</div></div>';
        } else {
            foreach($allcategories as $category) {
    ?>
    <div class="col-12 col-md-4 col-lg-4">
        <div class="card">
            <div class="card-header">
                <h4><?php echo $category->name; ?></h4>
            </div>
            <div class="card-body">
                <?php
                    # This loops through every download available in the category
                    $alldownloads = DownloadData::GetDownloads($category->id);

                    if(!$alldownloads) {
                        echo 'There are no downloads under this category';
                        $alldownloads = array();
                    }
                    
                    foreach($alldownloads as $download) {
                        $dwCount = (is_array($alldownloads) ? count($alldownloads) : 0);
                ?>
                <div style="margin-bottom: 8px;" class="chocolat-parent">
                    <a href="<?php echo $download->image; ?>" class="chocolat-image" title="<?php echo $download->name; ?>">
                        <div data-crop-image="285">
                            <img class="img-fluid" src="<?php echo $download->image; ?>" alt="<?php echo $download->name; ?>">
                        </div>
                    </a>
                </div>

	        <strong><?php echo $download->name; ?></strong><br/>
                <?php echo $download->description; ?><br/><br/>

                <a href="<?php echo url('/downloads/dl/'.$download->id);?>">Download</a>
                <?php 
                        if($dwCount > 1) {
                            echo '<hr/>';
                        }
                    }
                ?>
            </div>
        </div>
    </div>
    <?php } } ?>
</div>
