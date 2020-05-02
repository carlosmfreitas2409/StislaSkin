<?php if(!defined('IN_PHPVMS') && IN_PHPVMS !== true) { die(); } ?>
<style>
    .routeimg {
        height: 35px;
        margin-right: 3px;
    }
</style>
<div class="section-header">
	<h1>Schedule Briefing</h1>
    <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="<?php echo SITE_URL; ?>">Dashboard</a></div>
        <div class="breadcrumb-item"><a href="javascript::">Flight Operations</a></div>
        <div class="breadcrumb-item"><a href="javascript::">My Reservations</a></div>
        <div class="breadcrumb-item">Schedule Briefing</div>
    </div>
</div>

<form id="sbapiform">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>Flight Plan Briefing</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="row">Airline</th>
                                    <th scope="row">Flight No.</th>
                                    <th scope="row">Dep ICAO</th>
                                    <th scope="row">Arr ICAO</th>
                                    <th scope="row">Distance</th>
                                    <th scope="row">Date</th>
                                    <th scope="row">Dep Time (UTC)</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td><?php echo $schedule->code.$schedule->airline; ?></td>
                                    <td><?php echo $schedule->code.$schedule->flightnum; ?></td>
                                    <td><?php echo "{$schedule->depname} ($schedule->depicao)"; ?></td>
                                    <td><?php echo "{$schedule->arrname} ($schedule->arricao)"; ?></td>
                                    <td><?php echo "{$schedule->distance}"; ?></td>
                                    <td>
                                        <input class="form-control datepicker" name="date" type="text" id="datepicker">
                                    </td>

                                    <td>
                                        <?php
                                            $r = range(1, 24);
                    
                                            $selected = is_null($selected) ? date('H') : $selected;
                                            $select = "<select class='form-control' style='width: auto; display: inline;' name=deph id=dephour>\n";
                                            foreach ($r as $hour)
                                            {
                                                    $select .= "<option value=\"$hour\"";
                                                    $select .= ($hour==$selected) ? ' selected="selected"' : '';
                                                    $select .= ">$hour</option>\n";
                                            }
                                            $select .= '</select>';
                                            echo $select;
                                            echo":";
                                                                                    $rminutes = range(1, 60);

                                            $selected = is_null($selected) ? date('i') : $selected;
                                            $selectminutes = "<select class='form-control' style='width: auto; display: inline;' name=depm id=dephour>\n";
                                            foreach ($rminutes as $minutes) {
                                                    $selectminutes .= "<option value=\"$minutes\"";
                                                    $selectminutes .= ($hour==$selected) ? ' selected="selected"' : '';
                                                    $selectminutes .= ">$minutes</option>\n";
                                            }
                                            $selectminutes .= '</select>';
                                            echo $selectminutes;
                                        ?>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h4>Flight Plan Options</h4>
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <tr>
                            <td>Aircraft:</td>
                            <td>
                                <select class="form-control" name="type">
                                    <?php
                                        $equipment = OperationsData::getAllAircraftSingle(true);
                                        if(!$equipment) $equipment = array();
                                        foreach($equipment as $equip) {
                                            echo '<option value="'.$equip->icao.'">'.$equip->icao.' - '.$equip->name.'</option>';
                                        }
                                    ?>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td>Origin:</td>
                            <td><input class="form-control" name="orig" size="5" type="text" placeholder="ZZZZ" maxlength="4" value="<?php echo "$schedule->depicao"; ?>"></td>
                        </tr>
                        <tr>
                            <td>Destination:</td>
                            <td><input class="form-control" name="dest" size="5" type="text" placeholder="ZZZZ" maxlength="4" value="<?php echo "$schedule->arricao"; ?>"></td>
                        </tr>
                        <tr>
                            <td>Units:</td>
                            <td><select class="form-control" name="units"><option value="KGS">KGS</option><option value="LBS" selected>LBS</option></select></td>
                        </tr>
                        <tr>
                            <td>Cont Fuel: </td>
                            <td><select class="form-control" name="contpct"><option value="auto" selected>AUTO</option><option value="0">0 PCT</option><option value="0.02">2 PCT</option><option value="0.03">3 PCT</option><option value="0.05">5 PCT</option><option value="0.1">10 PCT</option><option value="0.15">15 PCT</option><option value="0.2">20 PCT</option></select></td>
                        </tr>
                        <tr>
                            <td>Reserve Fuel: </td>
                            <td><select class="form-control" name="resvrule"><option value="auto">AUTO</option><option value="0">0 MIN</option><option value="15">15 MIN</option><option value="30">30 MIN</option><option value="45" selected>45 MIN</option><option value="60">60 MIN</option><option value="75">75 MIN</option><option value="90">90 MIN</option></select></td>
                        </tr>	
                        <tr>
                            <td>Detailed Navlog: </td>
                            <td><input type="hidden" name="navlog" value="0"><input type="checkbox" name="navlog" value="1" checked></td>
                        </tr>
                        <tr>
                            <td>ETOPS Planning: </td>
                            <td><input type="hidden" name="etops" value="0"><input type="checkbox" name="etops" value="1"></td>
                        </tr>
                        <tr>
                            <td>Plan Stepclimbs: </td>
                            <td><input type="hidden" name="stepclimbs" value="0"><input type="checkbox" name="stepclimbs" value="1" checked></td>
                        </tr>
                        <tr>
                            <td>Runway Analysis: </td>
                            <td><input type="hidden" name="tlr" value="0"><input type="checkbox" name="tlr" value="1" checked></td>
                        </tr>
                        <tr>
                            <td>Include NOTAMS: </td>
                            <td><input type="hidden" name="notams" value="0"><input type="checkbox" name="notams" value="1" checked></td>
                        </tr>
                        <tr>
                            <td>FIR NOTAMS: </td>
                            <td><input type="hidden" name="firnot" value="0"><input type="checkbox" name="firnot" value="1"></td>
                        </tr>
                        <tr>
                            <td>Flight Maps: </td>
                            <td><select class="form-control" name="maps"><option value="detail">Detailed</option><option value="simple">Simple</option><option value="none">None</option></select></td>
                        </tr>
                        <tr>
                            <td>Plan Layout:</td>
                            <td><select class="form-control" onchange="" name="planformat" id="planformat"><option value="lido" selected="">LIDO</option><option value="aal">AAL</option><option value="aca">ACA</option><option value="afr">AFR</option><option value="awe">AWE</option><option value="baw">BAW</option><option value="ber">BER</option><option value="dal">DAL</option><option value="dlh">DLH</option><option value="ezy">EZY</option><option value="gwi">GWI</option><option value="jbu">JBU</option><option value="jza">JZA</option><option value="klm">KLM</option><option value="ryr">RYR</option><option value="swa">SWA</option><option value="uae">UAE</option><option value="ual">UAL</option><option value="ual f:wz">UAL F:WZ</option></select></td> 
                        </tr>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h4>Route Planner</h4>
                </div>
                <div class="card-body">
                    <table class="table">
                        <tr>
                            <td>
                                <span class="disphead">Route</span> (<a href="https://www.simbrief.com/system/guide.php#routeguide" target="_blank">?</a>)
                                <span style="font-size:14px;font-weight:bold;padding:0px 5px">&rarr;</span>
                                <a href="http://flightaware.com/analysis/route.rvt?origin=<?php echo $schedule->depicao ; ?>&destination=<?php echo $schedule->arricao ; ?>" id="falink" target="_blank">
                                <img class="routeimg" src="<?php echo fileurl('/lib/skins/StislaSkin/assets/img/logos/flightaware.png');?>" alt="Flightaware" title="FlightAware"></a> 
                                <a href="https://skyvector.com/?chart=304&zoom=6&fpl=<?php echo $schedule->depicao ; ?>%20%20<?php echo $schedule->arricao ; ?>" id="sklink" target="_blank">
                                <img class="routeimg" src="<?php echo fileurl('/lib/skins/StislaSkin/assets/img/logos/routes_skv.png');?>" alt="SkyVector" title="SkyVector"></a>
                                <a href="http://rfinder.asalink.net/free/" id="rflink" target="_blank">
                                <img class="routeimg" src="<?php echo fileurl('/lib/skins/StislaSkin/assets/img/logos/routefinder.png');?>" alt="RouteFinder" title="RouteFinder"></a>
                                <a target="_blank" style="cursor:pointer" onclick="validate_cfmu();">
                                <img class="routeimg" src="<?php echo fileurl('/lib/skins/StislaSkin/assets/img/logos/euro-ctl.png');?>" alt="CFMU Validation" title="CFMU Validation"></a>
                            </td>
                        </tr>
                        <tr>
                            <td><textarea class="form-control" name="route" placeholder="Enter your route here"></textarea></td>
                        </tr>
                        <tr>
                            <td><em><strong>Note: Remove any reference to &quot;SID&quot; &amp; &quot;STAR&quot; in your route, before generating your OFP. You may get errors if you don't.</strong></em></td>
                        </tr>
                    </table>
                </div>
            </div>
            
            <p><em><strong>Note: Remember to sign up for your free <a href="http://www.simbrief.com" title="Sign up for SimBrief">SimBrief</a> account before using this feature. It won't work without it!</strong></em></p>   
            <button type="button" style="width:100%" class="btn btn-primary btn-lg" onclick="simbriefsubmit('<?php echo SITE_URL; ?>/index.php/SimBrief');" style="font-size:30px" value="Generate SimBrief">Click to Generate OFP</button>
        </div>
    </div>
</form>