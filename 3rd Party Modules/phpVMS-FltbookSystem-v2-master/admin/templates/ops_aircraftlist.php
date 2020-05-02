<?php if(!defined('IN_PHPVMS') && IN_PHPVMS !== true) { die(); } ?>
<h3>Aircraft List</h3>
<p>These are all the aircraft that your airline operates.</p>
<?php
if(!$allaircraft)
{
	echo '<p id="error">No aircraft have been added</p>';
	return;
}
?>
<table id="tabledlist" class="table-sorter">
<thead>
<tr>
	<th align="center">ICAO</th>
	<th align="center">Name/Type</th>
	<th align="center">Full Name</th>
	<th align="center">Registration</th>
    <th align="center">Airline</th>
	<th align="center">Location</th>
	<th align="center">Max Pax</th>
	<th align="center">Max Cargo</th>
	<th>Options</th>
</tr>
</thead>
<tbody>
<?php
foreach($allaircraft as $aircraft)
{
?>
<tr class="<?php echo ($aircraft->enabled==0)?'disabled':''?>">
	<td align="center"><?php echo $aircraft->icao; ?></td>
	<td align="center"><?php echo $aircraft->name; ?></td>
	<td align="center"><?php echo $aircraft->fullname; ?></td>
	<td align="center"><?php echo $aircraft->registration; ?></td>
    <td align="center"><?php echo $aircraft->airline; ?></td>
	<td align="center">
		<?php
		if ($aircraft->location !== null && $aircraft->location !== "") {
			echo $aircraft->location;
		} else {
			echo "-";
		}
		?>
	</td>
	<td align="center"><?php echo $aircraft->maxpax; ?></td>
	<td align="center"><?php echo $aircraft->maxcargo; ?></td>
	<td align="center" width="1%" nowrap>
		<button class="{button:{icons:{primary:'ui-icon-wrench'}}}"
			onclick="window.location='<?php echo adminurl('/operations/editaircraft?id='.$aircraft->id.'&icao='.$aircraft->airline);?>';">Edit</button>
	</td>
</tr>
<?php
}
?>
</tbody>
</table>
