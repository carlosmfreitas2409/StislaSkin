<h3>Tasks</h3>
<ul class="filetree treeview-famfamfam">
	<li><span class="file">
		<a href="<?php echo SITE_URL?>/admin/index.php/Fltbook">Index</a>
	</span></li>

	<?php
	$setting = FltbookData::getSettingByName('search_from_current_location')->value;
	if($setting == 1) {
	?>
	<li><span class="file">
		<a href="<?php echo SITE_URL?>/admin/index.php/Fltbook/transfer">Transfer Pilots</a>
	</span></li>
	<?php
	}
	?>

	<?php
	$setting = FltbookData::getSettingByName('lock_aircraft_location')->value;
	if($setting == 1) {
	?>
	<li><span class="file">
		<a href="<?php echo SITE_URL?>/admin/index.php/Fltbook/moveAircraft">Transfer Aircraft</a>
	</span></li>
	<?php
	}
	?>

	<li><span class="file">
		<a href="<?php echo SITE_URL?>/admin/index.php/Fltbook/bids">View All Bids</a>
	</span></li>

  <li><span class="file">
    <a href="<?php echo SITE_URL?>/admin/index.php/Fltbook/settings">Module Settings</a>
  </span></li>
</ul>
<h3>Help</h3>
<p>
Fltbook Scheduling System Admin
<br />
Current Version: v2
</p>
