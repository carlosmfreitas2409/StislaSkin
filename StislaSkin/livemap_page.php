<?php if(!defined('IN_PHPVMS') && IN_PHPVMS !== true) { die(); } ?>
<div class="section-header">
	<h1>Live Map</h1>
    <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="<?php echo SITE_URL; ?>">Dashboard</a></div>
        <div class="breadcrumb-item"><a href="javascript::">Pilot Administration</a></div>
        <div class="breadcrumb-item">Live Map</div>
    </div>
</div>

<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-12">
        <div class="card card-primary">
            <div class="card-header">
                <h4>Live Map</h4>
                <div class="card-header-action">
                    <a href="javascript::" class="btn btn-primary">ON FLIGHT: <?php echo ACARSData::getLiveFlightCount(); ?></a>
                </div>
            </div>
            <div class="card-body">
                <?php require 'livemap_script.php'; ?>
            </div>
        </div>
    </div>
</div>