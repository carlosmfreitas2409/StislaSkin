<div class="modal-header">
	<h5 class="modal-title">Confirm Booking</h5>
	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
		<span aria-hidden="true">&times;</span>
	</button>
</div>

<form action="<?php echo url('/Fltbook/addbid'); ?>" method="post">
	<div class="modal-body">
		<div class="form-group">
			<label>Select Aircraft Registration</label>
			<select name="aircraftid" id="aircraftid" class="form-control">
				<option value="" selected disabled>Select Your Aircraft</option>
				<?php
					$allaircraft = FltbookData::getAllAircraftFltbook($airline, $aicao);
					foreach($allaircraft as $aircraft) {
						# If Aircraft is disabled, remove it from the list
						if($settings['disabled_ac_allow_book'] == 1) {
							if($aircraft->enabled != 1) {
								continue;
							}
						}

						# If Aircraft has been locked to location
						if ($settings['lock_aircraft_location'] == 1) {
							$route = SchedulesData::getSchedule($routeid);
							if ($aircraft->location !== $route->depicao && $aircraft->location !== "") {
								continue;
							}
						}

						# If Aircraft is has been booked, remove it from the list
						if($settings['show_ac_if_booked'] == 0) {
							$acbidded = FltbookData::getBidByAircraft($aircraft->id);
							if($acbidded) { continue; }
						}

						$icaoairline = "{$aircraft->icao}{$airline}";
						if($aircraft->registration == $icaoairline) {
							echo '';
						} else {
							echo '<option value="'.$aircraft->id.'" '.$sel.'>'.$aircraft->registration.' - '.$aircraft->icao.' - '.$aircraft->name.'</option>';
						}
					}
				?>
			</select>
		</div>
	</div>

	<div class="modal-footer bg-whitesmoke br">
		<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
		<input type="hidden" name="routeid" value="<?php echo $routeid; ?>" />
		<input type="submit" name="submit" class="btn btn-primary" value="Book" />
	</div>
</form>