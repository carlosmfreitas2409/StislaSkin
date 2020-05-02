<?php if(!defined('IN_PHPVMS') && IN_PHPVMS !== true) { die(); } ?>
<div class="section-header">
	<h1>PIREPs List</h1>
    <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="<?php echo SITE_URL; ?>">Dashboard</a></div>
        <div class="breadcrumb-item"><a href="javascript::">Flight Operations</a></div>
        <div class="breadcrumb-item">PIREPs List</div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h4>PIREPs List (with Route Map)</h4>
            </div>
            <div class="card-body">
                <?php
                    if(!$pireps) {
                        echo '<div class="alert alert-primary mb-2" role="alert"><strong>No Reports Found!</strong> You have not filed any reports. File one through the ACARS software or manual report submission to see its details and status on this page.</div>';
                    } else {
                ?>
                <?php require 'flown_routes_map.php'; ?>
                <div class="table-responsive">
                    <table class="table mt-3">
                        <thead>
                            <tr>
                                <th scope="row">Flight Number</th>
                                <th scope="row">Departure</th>
                                <th scope="row">Arrival</th>
                                <th scope="row">Aircraft</th>
                                <th scope="row">Flight Time</th>
                                <th scope="row">Submitted</th>
                                <th scope="row">Status</th>
                                <?php
                                    // Only show this column if they're logged in, and the pilot viewing is the owner/submitter of the PIREPs
                                    if(Auth::LoggedIn() && Auth::$userinfo->pilotid == $userinfo->pilotid) {
                                        echo '<th>Options</th>';
                                    }
                                ?>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                foreach ($pireps as $report) {
                            ?>
                            <tr>
                                <td><a href="<?php echo url('/pireps/view/'.$report->pirepid);?>"><?php echo $report->code . $report->flightnum; ?></a></td>
                                <td><?php echo $report->depicao; ?></td>
                                <td><?php echo $report->arricao; ?></td>
                                <td><?php echo $report->aircraft . " ($report->registration)"; ?></td>
                                <td><?php echo $report->flighttime; ?></td>
                                <td><?php echo date(DATE_FORMAT, $report->submitdate); ?></td>
                                <td>
                                    <?php
                                    if($report->accepted == PIREP_ACCEPTED)
                                        echo '<div id="success" class="label label-success">Accepted</div>';
                                    elseif($report->accepted == PIREP_REJECTED)
                                        echo '<div id="error" class="label label-danger">Rejected</div>';
                                    elseif($report->accepted == PIREP_PENDING)
                                        echo '<div id="error" class="label label-info">Approval Pending</div>';
                                    elseif($report->accepted == PIREP_INPROGRESS)
                                        echo '<div id="error" class="label label-warning">Flight in Progress</div>';
                                    ?>
                                </td>
                                <?php
                                    // Only show this column if they're logged in, and the pilot viewing is the owner/submitter of the PIREPs
                                    if(Auth::LoggedIn() && Auth::$userinfo->pilotid == $report->pilotid) {
                                ?>
                                <td>
                                    <a href="<?php echo url('/pireps/addcomment?id='.$report->pirepid);?>">Add Comment</a>
                                    <span> | </span>
                                    <a href="<?php echo url('/pireps/editpirep?id='.$report->pirepid);?>">Edit PIREP</a>
                                </td>
                                <?php } ?>
                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
                <?php } ?>
            </div>
        </div>
    </div>
</div>