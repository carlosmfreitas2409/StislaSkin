<?php if(!defined('IN_PHPVMS') && IN_PHPVMS !== true) { die(); } ?>
<div class="section-header">
	<h1>Events Pilot Ranks</h1>
    <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="<?php echo SITE_URL; ?>">Dashboard</a></div>
        <div class="breadcrumb-item"><a href="javascript::">Flight Operations</a></div>
        <div class="breadcrumb-item"><a href="javascript::">Events</a></div>
        <div class="breadcrumb-item">Events Pilot Ranks</div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="card">
			<div class="card-body">
                <?php
                    if(!$rankings) {
                        echo '<div class="alert alert-danger"><div class="alert-title">Oops</div>There is no rankings available.</div>';
                    } else {
                ?>
                <table class="table table-hover">
                    <tbody>
                        <tr>
                            <th scope="col">Pilot</th>
                            <th scope="col"># Of Events Attended</th>
                        </tr>
                    </tbody>
                    <thead>
                        <tr>
                            <?php
                                foreach($rankings as $rank) {
                                    $pilot = PilotData::getPilotData($rank->pilot_id);
                                    echo '<tr><td>'.PilotData::getPilotCode($pilot->code, $pilot->pilotid).' - '.$pilot->firstname.' '.$pilot->lastname.'</td><td>'.$rank->ranking.'</td></tr>';
                                }
                            ?>
                        </tr>
                    </thead>
                </table>
                <?php } ?>
            </div>
        </div>
    </div>
</div>