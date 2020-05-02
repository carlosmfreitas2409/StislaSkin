<?php
$setting = FltbookData::getSettingByName('search_from_current_location')->value;
if($setting != 1) {
  echo '<meta http-equiv="refresh" content="0; url='.adminurl('/Fltbook').'" />';
  exit;
}
?>
<table class="tablesorter" id="tablesorter" style="width: 100%;">
  <thead>
    <tr>
      <th>Pilot</th>
      <th>Current Location</th>
      <th>Transfer Pilot To:</th>
    </tr>
  </thead>
  <tbody>
  <?php
  foreach($allpilots as $pilot) {
    $loc = FltbookData::getLocation($pilot->pilotid);
    $currentlocation = OperationsData::getAirportInfo($loc->arricao);
    $pilotcode = PilotData::getPilotCode($pilot->code, $pilot->pilotid);
  ?>
  <tr>
    <td>
      <?php echo $pilotcode.' - '.$pilot->firstname.' '.$pilot->lastname; ?>
    </td>
    <td><?php echo $currentlocation->icao.' - '.$currentlocation->name; ?></td>
    <td>
      <form action="<?php echo SITE_URL; ?>/admin/index.php/Fltbook/transfer" method="post">
        <select name="arricao" class="search">
          <?php
          foreach($allairports as $airport) {
            if($airport->icao == $currentlocation->icao) continue;
            echo '<option value="'.$airport->icao.'">'.$airport->icao.' - '.$airport->name.'</option>';
          }
          ?>
        </select>

        <input type="submit" name="submit" value="Transfer Pilot" />
        <input type="hidden" name="pilotid" value="<?php echo $pilot->pilotid; ?>" />
        <input type="hidden" name="action" value="move_pilot" />
      </form>
    </td>
  </tr>
  <?php
  }
  ?>
  </tbody>
</table>
