<?php if(!defined('IN_PHPVMS') && IN_PHPVMS !== true) { die(); } ?>
<div class="section-header">
	<h1>Events</h1>
    <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="<?php echo SITE_URL; ?>">Dashboard</a></div>
        <div class="breadcrumb-item"><a href="javascript::">Flight Operations</a></div>
        <div class="breadcrumb-item">Events</div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="card">
			<div class="card-header">
				<h4>Upcoming Events</h4>
			</div>
			<div class="card-body">
                <?php
                    if(!$events) {
                        echo '<div class="alert alert-danger"><div class="alert-title">Oops</div>There is no upcoming events, sorry.</div>';
                    } else {
                ?>
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th scope="col">Date</th>
                            <th scope="col">Event</th>
                            <th scope="col">Details/Signups</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            foreach($events as $event) {
                                if($event->active == '2') {
                                    continue;
                                }

                                echo '<tr><td>'.date('n/j/Y', strtotime($event->date)).'</td>';
                                echo '<td>'.$event->title.'</td>';
                                echo '<td><a href="'.SITE_URL.'/index.php/events/get_event?id='.$event->id.'">Details/Signups</a></td></tr>';
                            }
                        ?>
                    </tbody>
                </table>
                <?php } ?>
			</div>
		</div>

        <div class="card">
			<div class="card-header">
				<h4>Past Events</h4>
			</div>
			<div class="card-body">
                <?php
                    if(!$history) {
                        echo '<div class="alert alert-danger"><div class="alert-title">Oops</div>There is no past events, sorry.</div>';
                    } else {
                ?>
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th scope="col">Date</th>
                            <th scope="col">Event</th>
                            <th scope="col">Details</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            foreach($history as $event) {
                                echo '<tr><td>'.date('n/j/Y', strtotime($event->date)).'</td>';
                                echo '<td>'.$event->title.'</td>';
                                echo '<td><a href="'.SITE_URL.'/index.php/events/get_past_event?id='.$event->id.'">Details</a></td></tr>';
                            }
                        ?>
                    </tbody>
                </table>
                <?php } ?>
			</div>
		</div>

        <center>
			<a href="<?php echo url('/events/get_rankings'); ?>" class="btn btn-primary" name="submit">Show Pilot Rankings For Events</a>
		</center>
    </div>
</div>