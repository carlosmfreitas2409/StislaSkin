            </section>

            <!-- Fltbook Modal -->
            <div class="modal fade" tabindex="-1" role="dialog" id="confirm">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                    
                    </div>
                </div>
            </div>

            <!-- Profile Logbook Modal -->
            <div class="modal fade" id="logbook" tabindex="-1" role="dialog">
                <div class="modal-dialog modal-dialog-scrollable modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="myModalLabel1">LogBook of Capt. <?php echo Auth::$userinfo->firstname.' '.Auth::$userinfo->lastname; ?></h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>

                        <div class="modal-body">
                            <?php
                                $pireps = PIREPData::getAllReportsForPilot($userinfo->pilotid);
                                if(!$pireps) {
                                    echo '<div class="alert alert-primary mb-2" role="alert"><strong>No Reports Found!</strong> You have not filed any reports. File one through the ACARS software or manual report submission to see its details and status on this page.</div>';
                                } else {
                            ?>
                            <div class="table-responsive">
                                <table class="table table-striped table-hover">
                                    <thead>
                                        <tr>
                                            <th>Flight #</th>
                                            <th>Departure</th>
                                            <th>Arrival</th>
                                            <th>Aircraft</th>
                                            <th>Flight Time</th>
                                            <th>Submitted</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($pireps as $report) { ?>
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
                                        </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                            <?php } ?>         
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-outline-danger" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>

            
            <!-- AirMail Modal -->
            <div class="modal fade" id="composeForm" tabindex="-1" role="dialog">
                <div class="modal-dialog modal-dialog-scrollable modal-lg" style="overflow-y: initial !important">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="emailCompose">New Message</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>

                        <form action="<?php echo url('/Mail');?>" method="post" enctype="multipart/form-data">
                            <div class="modal-body" style="height: 640px; overflow-y: auto;">
                                <div class="form-group">
                                    <label>Recipient</label>
                                    <select name="who_to" class="form-control">
                                        <option value="">Select a pilot</option>
                                        <?php 
											if(PilotGroups::group_has_perm(Auth::$usergroups, ACCESS_ADMIN)) { ?>
                                            <option value="all">NOTAM (All Pilots)</option>
                                        <?php 
                                            } $allpilots = PilotData::findPilots(array('p.retired' => '0')); foreach($allpilots as $pilots) {
                                                echo '<option value="'.$pilots->pilotid.'">'.$pilots->firstname.' '.$pilots->lastname.' - '.PilotData::GetPilotCode($pilots->code, $pilots->pilotid).'</option>';
                                            }
                                        ?>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label>Subject</label>
                                    <input type="text" class="form-control" placeholder="Subject" name="subject">
                                </div>

                                <div class="form-group">
                                    <label>Message</label>
                                    <textarea name="message" class="summernote"></textarea>
                                </div>
                            </div>

                            <div class="modal-footer bg-whitesmoke br">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

                                <input type="hidden" name="who_from" value="<?php echo Auth::$userinfo->pilotid; ?>" />
                                <input type="hidden" name="action" value="send" />
                                <input type="submit" class="btn btn-primary" value="Send">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- Main Content -->

        <!-- Footer -->
        <footer class="main-footer">
            <div class="footer-left">Copyright &copy; <?php echo date("Y"); ?> <div class="bullet"></div> Design By <a href="https://getstisla.com/">Muhamad Nauval Azhar</a></div>
            <div class="footer-right">CrewCenter by <a href="https://www.instagram.com/carlosmeduardo/">Carlos Eduardo</a> | Powered by phpVMS</div>
      </footer>
    </div>
    <!-- Main Wrapper -->
</div>