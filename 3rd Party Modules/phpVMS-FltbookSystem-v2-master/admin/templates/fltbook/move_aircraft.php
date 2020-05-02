<?php
$setting = FltbookData::getSettingByName('lock_aircraft_location')->value;
if($setting != 1) {
  echo '<meta http-equiv="refresh" content="0; url='.adminurl('/Fltbook').'" />';
  exit;
}
?>

<h3>Transfer Aircraft</h3>
<br />

<form action="<?php echo SITE_URL; ?>/admin/index.php/Fltbook/moveAircraft" method="post">
    <table>
        <tr>
            <td><label>Enter Aircraft Registration:</label></td>
            <td><input type="text" name="registration" placeholder="e.g. N371DA" /></td>
        </tr>
        <tr>
            <td><label>Enter New Location (Airport ICAO):</label></td>
            <td><input type="text" name="location" placeholder="e.g. KLAX" /></td>
        </tr>
        <tr>
            <td colspan="2">
                <input type="hidden" name="action" value="move_aircraft" />
                <input type="submit" name="submit" value="Transfer Aircraft" />
            </td>
        </tr>
    </table>
</form>
