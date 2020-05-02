<form action="<?php echo SITE_URL; ?>/admin/index.php/Fltbook/settings" method="post">
  <table class="tablesorter" id="tablesorter" style="width: 100%;">
    <thead>
      <tr>
        <th>Name/Description</th>
        <th align="center">Current Value</th>
        <th align="center">New Value</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td style="min-width: 500px;">Allow aircraft to be booked when they are disabled</td>
        <td align="center">
          <?php
          $value = FltbookData::getSettingByName('disabled_ac_allow_book')->value;
          if($value == 1) {
            echo 'Yes';
          } else {
            echo 'No';
          }
          ?>
        </td>
        <td align="center">
          <select class="search" name="disabled_ac_allow_book">
            <option value="0" <?php if(FltbookData::getSettingByName('disabled_ac_allow_book')->value == 0) { echo 'selected'; } ?>>No</option>
            <option value="1" <?php if(FltbookData::getSettingByName('disabled_ac_allow_book')->value == 1) { echo 'selected'; } ?>>Yes</option>
          </select>
        </td>
      </tr>
      <tr>
        <td style="min-width: 500px;">Allow schedules to be shown if aircraft is disabled (only works if master (fake) aircraft is disabled)</td>
        <td align="center">
          <?php
          $value = FltbookData::getSettingByName('disabled_ac_sched_show')->value;
          if($value == 1) {
            echo 'Yes';
          } else {
            echo 'No';
          }
          ?>
        </td>
        <td align="center">
          <select class="search" name="disabled_ac_sched_show">
            <option value="0" <?php if(FltbookData::getSettingByName('disabled_ac_sched_show')->value == 0) { echo 'selected'; } ?>>No</option>
            <option value="1" <?php if(FltbookData::getSettingByName('disabled_ac_sched_show')->value == 1) { echo 'selected'; } ?>>Yes</option>
          </select>
        </td>
      </tr>
      <tr>
        <td style="min-width: 500px;">Allow aircraft to be booked if someone else has booked a schedule with that aircraft</td>
        <td align="center">
          <?php
          $value = FltbookData::getSettingByName('show_ac_if_booked')->value;
          if($value == 1) {
            echo 'Yes';
          } else {
            echo 'No';
          }
          ?>
        </td>
        <td align="center">
          <select class="search" name="show_ac_if_booked">
            <option value="0" <?php if(FltbookData::getSettingByName('show_ac_if_booked')->value == 0) { echo 'selected'; } ?>>No</option>
            <option value="1" <?php if(FltbookData::getSettingByName('show_ac_if_booked')->value == 1) { echo 'selected'; } ?>>Yes</option>
          </select>
        </td>
      </tr>
      <tr>
        <td style="min-width: 500px;">Lock aircraft to last flown location (pilots cannot book schedule unless aircraft location matches pilot's location)</td>
        <td align="center">
          <?php
          $value = FltbookData::getSettingByName('lock_aircraft_location')->value;
          if($value == 1) {
            echo 'Yes';
          } else {
            echo 'No';
          }
          ?>
        </td>
        <td align="center">
          <select class="search" name="lock_aircraft_location">
            <option value="0" <?php if(FltbookData::getSettingByName('lock_aircraft_location')->value == 0) { echo 'selected'; } ?>>No</option>
            <option value="1" <?php if(FltbookData::getSettingByName('lock_aircraft_location')->value == 1) { echo 'selected'; } ?>>Yes</option>
          </select>
        </td>
      </tr>
      <tr>
        <td style="min-width: 500px;">Pilots search schedules from current location</td>
        <td align="center">
          <?php
          $value = FltbookData::getSettingByName('search_from_current_location')->value;
          if($value == 1) {
            echo 'Yes';
          } else {
            echo 'No';
          }
          ?>
        </td>
        <td align="center">
          <select class="search" name="search_from_current_location">
            <option value="0" <?php if(FltbookData::getSettingByName('search_from_current_location')->value == 0) { echo 'selected'; } ?>>No</option>
            <option value="1" <?php if(FltbookData::getSettingByName('search_from_current_location')->value == 1) { echo 'selected'; } ?>>Yes</option>
          </select>
        </td>
      </tr>
      <tr>
        <td style="min-width: 500px;">Allow schedules to be booked by more than one pilot simultaneously</td>
        <td align="center">
            <?php
                $setting = Config::Get('DISABLE_SCHED_ON_BID');
                if ($setting == false) {
                    echo 'Yes';
                } else {
                    echo 'No';
                }
            ?>
        </td>
        <td align="center">Change via DISABLE_SCHED_ON_BID<br />in local.config.php</td>
      </tr>
      <tr>
        <td style="min-width: 500px;">Jumpseat Cost (per nm in $) if above 'search from current location' is true</td>
        <td align="center">$<?php echo FltbookData::getSettingByName('jumpseat_cost')->value; ?></td>
        <td align="center"><input type="text" name="jumpseat_cost" value="<?php echo FltbookData::getSettingByName('jumpseat_cost')->value; ?>" /></td>
      </tr>
      <tr>
        <td style="min-width: 500px;">Enable pagination on the schedule_results page</td>
        <td align="center">
          <?php
          $value = FltbookData::getSettingByName('pagination_enabled')->value;
          if($value == 1) {
            echo 'Yes';
          } else {
            echo 'No';
          }
          ?>
        </td>
        <td align="center">
          <select class="search" name="pagination_enabled">
            <option value="0" <?php if(FltbookData::getSettingByName('pagination_enabled')->value == 0) { echo 'selected'; } ?>>No</option>
            <option value="1" <?php if(FltbookData::getSettingByName('pagination_enabled')->value == 1) { echo 'selected'; } ?>>Yes</option>
          </select>
        </td>
      </tr>
      <tr>
        <td style="min-width: 500px;">This will allow details to be shown for each flight in the table.</td>
        <td align="center">
          <?php
          $value = FltbookData::getSettingByName('show_details_button')->value;
          if($value == 1) {
            echo 'Yes';
          } else {
            echo 'No';
          }
          ?>
        </td>
        <td align="center">
          <select class="search" name="show_details_button">
            <option value="0" <?php if(FltbookData::getSettingByName('show_details_button')->value == 0) { echo 'selected'; } ?>>No</option>
            <option value="1" <?php if(FltbookData::getSettingByName('show_details_button')->value == 1) { echo 'selected'; } ?>>Yes</option>
          </select>
        </td>
      </tr>
    </tbody>
  </table>

  <input type="hidden" name="action" value="edit_settings" />
  <input type="submit" name="submit" value="Save Settings" />
  <br /><br />
</form>
