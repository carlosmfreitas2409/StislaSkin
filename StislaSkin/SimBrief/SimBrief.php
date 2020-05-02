<?php if(!defined('IN_PHPVMS') && IN_PHPVMS !== true) { die(); } ?>
<div class="section-header">
	<h1>SimBrief Flight Briefing</h1>
    <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="<?php echo SITE_URL; ?>">Dashboard</a></div>
        <div class="breadcrumb-item"><a href="javascript::">Flight Operations</a></div>
        <div class="breadcrumb-item"><a href="javascript::">My Reservations</a></div>
        <div class="breadcrumb-item">SimBrief Flight Briefing</div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h4>Flight Plan Briefing</h4>
            </div>
            <div class="card-body">
                <table width="98%" align="center" cellpadding="4">
                    <!-- Flight ID -->
                    <tr style="background-color: #333; color: #FFF;">
                        <td>Flight Number</td>
                        <td></td>
                        <td width="36%">Download FlightPlan</td>
                    </tr>
                    
                    <tr>
                        <td width="34%" ><?php echo (string) $info->general[0]->icao_airline.''.(string) $info->general[0]->flight_number; ?></td>
                        <td width="30%" ></td>
                        <td>
                            <script type="text/javascript">
                                function download(d) {
                                        if (d == 'Select Format') return;
                                        window.open('http://www.simbrief.com/ofp/flightplans/' + d);
                                }
                            </script>
                
                            <select name="download" class="form-control" onChange="download(this.value)">
                                <option>Select Format</option>
                                <option value="<?php echo $info->files->pdf->link; ?>"><?php echo $info->files->pdf->name; ?></option>
                                <?php foreach($info->files->file as $file) { ?>
                                    <option value="<?php echo $file->link; ?>"><?php echo $file->name; ?></option>
                                <?php } ?>
                            </select>            
                        </td>
                    </tr> 
                    
                    <tr style="background-color: #333; color: #FFF;">
                        <td>Departure</td>
                        <td>Alternate</td>
                        <td width="36%">Arrival</td>
                    </tr>
                    
                    <tr>
                        <td width="34%" ><?php echo (string) $info->origin[0]->name.'('.(string) $info->origin[0]->icao_code.') <br>Planned RWY '.$info->origin[0]->plan_rwy; ?></td>
                        <td width="30%" ><?php echo (string) $info->alternate[0]->name.'('.(string) $info->alternate[0]->icao_code.') <br>Planned RWY '.$info->alternate[0]->plan_rwy; ?></td>
                        <td><?php echo (string) $info->destination[0]->name.'('.(string) $info->destination[0]->icao_code.') <br>Planned RWY '.$info->destination[0]->plan_rwy; ?></td>                                 </td>
                    </tr>

                    <!-- Times Row -->
                    <tr  style="background-color: #333; color: #FFF;">
                        <td>Departure Time</td>
                        <td>Arrival Time</td>
                        <td width="36%">Flight Time</td>
                    </tr>
                    
                    <tr>
                        <td width="34%" >
                            <?php
                                $epoch = (string) $info->times[0]->sched_out; 
                                $dt = new DateTime("@$epoch");  // convert UNIX timestamp to PHP DateTime
                                echo $dt->format('H:i'); // output = 2012-08-15 00:00:00  
                            ?>
                        </td>
                        <td width="30%" >
                            <?php
                                $epoch = (string) $info->times[0]->est_on; 
                                $dt = new DateTime("@$epoch");  // convert UNIX timestamp to PHP DateTime
                                echo $dt->format('H:i'); // output = 2012-08-15 00:00:00  
                            ?>
                        </td>
                        <td>
                            <?php
                                $epoch = (string) $info->times[0]->est_block; 
                                $dt = new DateTime("@$epoch");  // convert UNIX timestamp to PHP DateTime
                                echo $dt->format('H:i'); // output = 2012-08-15 00:00:00  
                            ?>                                      
                        </td>
                    </tr>   

                    <!-- Aircraft and Distance Row -->       
                    <tr style="background-color: #333; color: #FFF;">
                        <td>Crew</td>
                        <td>Aircraft</td>
                        <td width="36%">Distance</td>
                    </tr>
                    
                    <tr>
                        <td width="34%" ><?php echo (string) $info->crew[0]->cpt ; ?></td>
                        <td width="30%" ><?php echo (string) $info->aircraft[0]->icaocode.'('.(string) $info->aircraft[0]->reg.')'; ?></td>
                        <td><?php echo (string) $info->general[0]->route_distance.'(Nm)'; ?></td>            
                    </tr>

                    <!-- Metar and TAF -->
                    <tr style="background-color: #333; color: #FFF;">
                        <td>Departure METAR</td>
                        <td>Alternate METAR</td>
                        <td colspan="2">Arrival METAR</td>
                    </tr>
                    <tr>
                        <td width="34%" ><?php echo (string) $info->weather[0]->orig_metar; ?></td>
                        <td width="34%" ><?php echo (string) $info->weather[0]->altn_metar; ?></td>
                        <td width="34%" ><?php echo (string) $info->weather[0]->dest_metar; ?></td>
                    </tr>
                    
                    <tr style="background-color: #333; color: #FFF;">
                        <td>Departure TAF</td>
                        <td>Alternate TAF</td>
                        <td colspan="2">Arrival TAF</td>
                    </tr>
                    <tr>
                        <td width="34%" ><?php echo (string) $info->weather[0]->orig_taf; ?></td>
                        <td width="34%" ><?php echo (string) $info->weather[0]->altn_taf; ?></td>
                        <td width="34%" ><?php echo (string) $info->weather[0]->dest_taf; ?></td>
                    </tr>

                    <!-- Route -->
                    <tr style="background-color: #333; color: #FFF;">
                        <td colspan="3">ATC Flight Plan</td>
                    </tr>
                    <tr>
                        <td colspan="3"><?php echo (string) $info->atc[0]->flightplan_text; ?></td>
                    </tr>
                    
                    <!-- Notes -->
                    <tr style="background-color: #333; color: #FFF;">
                        <td colspan="3">Pilot Folder</td>
                    </tr>
                    <tr>
                        <td colspan="2" style="padding: 6px;">
                            <iframe src="http://www.simbrief.com/ofp/flightplans/<?php echo $info->files->pdf->link; ?>" width="100%" height="700px"></iframe>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</div>