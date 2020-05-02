<?php if(!defined('IN_PHPVMS') && IN_PHPVMS !== true) { die(); } ?>

<?php
    if($field_list) {
        foreach($field_list as $field) {
?>

<div class="form-group">
    <label for="<?php echo $field->fieldname; ?>"><?php echo $field->title; ?><?php if($field->required == 1) echo ' *'; ?></label>

	<?php
		if($field->type == 'dropdown') {
			echo "<select class='form-control selectric' name=\"{$field->fieldname}\">";
			$values = explode(',', $field->value);
		
			if(is_array($values)) {						
				foreach($values as $val) {
					$val = trim($val);
					echo "<option value=\"{$val}\">{$val}</option>";
				}
			}
			
			echo '</select>';
		} elseif($field->type == 'textarea') {
			echo '<textarea id="'.$field->fieldname.'" class="form-control" name="'.$field->fieldname.'" class="customfield_textarea"></textarea>';
		} else {
    ?>

    <input id="<?php echo $field->fieldname; ?>" type="text" class="form-control" name="<?php echo $field->fieldname; ?>" value="<?php echo Vars::POST($field->fieldname);?>" />

    <?php	
        }

        if(${"custom_".$field->fieldname."_error"} == true) {
            echo '<p class="error">Please enter your '.$field->title.'.</p>';
        }
    ?>
</div>

<?php
        }
    }
?>