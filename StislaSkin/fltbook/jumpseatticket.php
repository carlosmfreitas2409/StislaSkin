<?php if(!defined('IN_PHPVMS') && IN_PHPVMS !== true) { die(); } ?>
<div class="section-header">
	<h1>Confirm Jumpseat</h1>
    <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="<?php echo SITE_URL; ?>">Dashboard</a></div>
        <div class="breadcrumb-item"><a href="javascript::">Flight Operations</a></div>
        <div class="breadcrumb-item"><a href="javascript::">Schedule Search</a></div>
        <div class="breadcrumb-item">Confirm Jumpseat</div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <form action="<?php echo url('/Fltbook/jumpseatPurchase');?>" method="post">
                    <table class="table">
                        <tr>
                            <td>Destination: <strong><?php echo $airport->name; ?></strong></td>
                        </tr>
                        <tr>
                            <td>Departure Date: <strong><?php echo date('m/d/Y') ?></strong></td>
                        </tr>
                        <tr>
                            <td>Total Cost: <strong>$<?php echo $cost; ?></strong></td>
                        </tr>
                    </table>
                    <div style="text-align: center;">
                        <a href="<?php echo url('/Fltbook');?>"><input type="button" class="btn btn-danger" value="Cancel Jumpseat"></a>
                        <input type="submit" class="btn btn-primary" value="Confirm Jumpseat">
                    </div>
                    <input type="hidden" name="arricao" value="<?php echo $airport->icao; ?>" />
                </form>
            </div>
        </div>
    </div>
</div>