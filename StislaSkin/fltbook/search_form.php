<?php if(!defined('IN_PHPVMS') && IN_PHPVMS !== true) { die(); } ?>
<?php
    $pilotid = Auth::$userinfo->pilotid;
    $last_location = FltbookData::getLocation($pilotid);
    $last_name = OperationsData::getAirportInfo($last_location->arricao);
    if(!$last_location) {
        FltbookData::updatePilotLocation($pilotid, Auth::$userinfo->hub);
    }
?>

<div class="section-header">
	<h1>Flight Booking</h1>
    <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="<?php echo SITE_URL; ?>">Dashboard</a></div>
        <div class="breadcrumb-item"><a href="javascript::">Flight Operations</a></div>
        <div class="breadcrumb-item">Schedule Search</div>
    </div>
</div>

<div class="row">
    <div class="col-md-4">
        <div class="card">
            <div class="card-header">
                <h4>Schedule Search</h4>
            </div>

            <div class="card-body">
                <form action="<?php echo url('/Fltbook');?>" method="post">
                    <div class="alert alert-info">
                        <?php if($settings['search_from_current_location'] == 1) { ?>
                            <input id="depicao" name="depicao" type="hidden" value="<?php echo $last_location->arricao; ?>">
                            Departing from <?php echo $last_name->name; ?> (<?php echo $last_name->icao; ?>)
                        <?php } else { ?>
                            Departing from <?php echo $last_name->name; ?> (<?php echo $last_name->icao; ?>)
                        <?php } ?>
                    </div>

                    <?php if($settings['search_from_current_location'] == 0) { ?>
                    <div class="form-group">
                        <label>Select An Departure Location</label>
                        <select class="form-control" name="depicao">
                            <option value="" selected disabled>Select an option</option>
                            <?php
                                foreach ($airports as $airport) {
                                    echo '<option value="'.$airport->icao.'">'.$airport->icao.' - '.$airport->name.'</option>';
                                }
                            ?>
                        </select>
                    </div>
                    <?php } ?>

                    <div class="form-group">
                        <label>Select An Airline</label>
                        <select class="form-control" name="airline">
                            <option value="">Select an option</option>
                            <?php
                                foreach ($airlines as $airline) {
                                    echo '<option value="'.$airline->code.'">'.$airline->name.'</option>';
                                }
                            ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Select An Aircraft Type</label>
                        <select class="form-control" name="aircraft">
                            <option value="" selected>Select an option</option>
                            <?php
                                if($settings['search_from_current_location'] == 1) {
                                    $airc = FltbookData::routeaircraft($last_location->arricao);
                                    if(!$airc) {
                                        echo '<option>No Aircraft Available!</option>';
                                    } else {
                                        foreach ($airc as $air) {
                                            $ai = FltbookData::getaircraftbyID($air->aircraft);
                                            echo '<option value="'.$ai->icao.'">'.$ai->name.'</option>';
                                        }
                                    }
                                } else {
                                    $airc = FltbookData::routeaircraft_depnothing();
                                    if(!$airc) {
                                        echo '<option>No Aircraft Available!</option>';
                                    } else {
                                        foreach($airc as $ai) {
                                            echo '<option value="'.$ai->icao.'">'.$ai->name.'</option>';
                                        }
                                    }
                                }
                            ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Select Arrival Airfield</label>
                        <select class="form-control" name="arricao">
                            <option value="">Any</option>
                            <?php
                                if($settings['search_from_current_location'] == 1) {
                                    $airs = FltbookData::arrivalairport($last_location->arricao);
                                    if(!$airs) {
                                        echo '<option>No Airports Available!</option>';
                                    } else {
                                        foreach ($airs as $air) {
                                            $nam = OperationsData::getAirportInfo($air->arricao);
                                            echo '<option value="'.$air->arricao.'">'.$air->arricao.' - '.$nam->name.'</option>';
                                        }
                                    }
                                } else {
                                    foreach($airports as $airport) {
                                        echo '<option value="'.$airport->icao.'">'.$airport->icao.' - '.$airport->name.'</option>';
                                    }
                                }
                            ?>
                        </select>
                    </div>

                    <input type="hidden" name="action" value="search" />
                    <input type="submit" name="submit" value="Search" class="btn btn-primary mr-1" style="float: right;">
                </form>
            </div>
        </div>

        <?php if($settings['search_from_current_location'] == 1) { ?>
        <div class="card">
            <div class="card-header">
                <h4>JumpSeat</h4>
            </div>

            <div class="card-body">
                <form action="<?php echo url('/Flights/jumpseat');?>" method="post">
                    <div class="form-group">
                        <label>Destination</label>
                        <select class="form-control" onchange="calculate_transfer(this.value)" name="depicao">
                            <option value="" selected disabled>Select an option</option>
                            <?php
                                foreach($airports as $airport) {
                                    if($airport->icao == $last_location->arricao) {
                                        continue;
                                    }

                                    echo '<option value="'.$airport->icao.'">'.$airport->icao.' - '.$airport->name.'</option>';
                                }
                            ?>
                        </select>
                        <div style="margin-top: 5px;" id="errors"></div>
                    </div>
                    
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Cost</label>
                                <input type="text" class="form-control" id="jump_purchase_cost" readonly>
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Distance</label>
                                <input type="text" class="form-control" id="distance_travelling" readonly>
                            </div>
                        </div>
                    </div>

                    <input type="submit" id="purchase_button" disabled="disabled" class="btn btn-primary mr-1" style="float: right;" value="Purchase Transfer">
                    <input type="hidden" name="cost">
                    <input type="hidden" name="airport">
                </form>
            </div>
        </div>
        <?php } ?>
    </div>

    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h4>Flights Map</h4>
            </div>

            <div class="card-body p-0">
                <?php require 'search_form_script.php'; ?>
            </div>
        </div>
    </div>
</div>

<?php if($settings['search_from_current_location'] == 1) { ?>
<script type="text/javascript">
    function calculate_transfer(arricao) {
        var distancediv = $('#distance_travelling')[0];
        var costdiv     = $('#jump_purchase_cost')[0];
        var errorsdiv     = $('#errors')[0];
        errorsdiv.innerHTML = '';
        $.ajax({
            url: baseurl + "/action.php/Flights/get_jumpseat_cost",
            type: 'POST',
            data: { depicao: "<?php echo $last_location->arricao; ?>", arricao: arricao, pilotid: "<?php echo Auth::$userinfo->pilotid; ?>" },
            success: function(data) {
            data = $.parseJSON(data);
            console.log(data);
            if(data.error) {
                $("#purchase_button").prop('disabled', true);
                errorsdiv.innerHTML = "<font color='red'>Not enough funds for this transfer!</font>";
            } else {
                $("#purchase_button").prop('disabled', false);
                distancediv.value = data.distance + "nm";
                costdiv.value = "$" + data.total_cost;
            }
            },
            error: function(e) {
            console.log(e);
            }
        });
    }
</script>
<?php } ?>