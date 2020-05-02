<?php if(!defined('IN_PHPVMS') && IN_PHPVMS !== true) { die(); } ?>
<div class="section-header">
	<h1>Edit PIREP</h1>
    <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="<?php echo SITE_URL; ?>">Dashboard</a></div>
        <div class="breadcrumb-item"><a href="javascript::">Flight Operations</a></div>
        <div class="breadcrumb-item"><a href="javascript::">PIREPs List</a></div>
        <div class="breadcrumb-item">Edit PIREP</div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <form action="<?php echo url('/pireps/viewpireps');?>" method="post">
                    <?php
                        // List all of the custom PIREP fields
                        if(!$pirepfields) {
                            echo '<div class="alert alert-danger">There are no custom fields to edit for PIREPs!</div>';
                            return;
                        }

                        foreach($pirepfields as $field) {
                    ?>
                    <div class="form-group">
                        <label><?php echo $field->title ?></label>
                        <?php
                            // Determine field by the type
                            $value = PIREPData::GetFieldValue($field->fieldid, $pirep->pirepid);

                            if($field->type == '' || $field->type == 'text') {
                        ?>
                        <input type="text" class="form-control" name="<?php echo $field->name ?>" value="<?php echo $value ?>" />
                        <?php
                            } elseif($field->type == 'textarea') {
                                echo '<textarea class="form-control" name="'.$field->name.'">'.$value.'</textarea>';
                            } elseif($field->type == 'dropdown') {
                                $values = explode(',', $field->options);
                                
                                echo '<select class="form-control" name="'.$field->name.'">';
                                foreach($values as $fvalue) {
                                    if($value == $fvalue) {
                                        $sel = 'selected="selected"';
                                    } else {
                                        $sel = '';
                                    }
                                    
                                    $value = trim($fvalue);
                                    echo '<option value="'.$fvalue.'" '.$sel.'>'.$fvalue.'</option>';
                                }
                                echo '</select>';		
                            }
                        ?>
                    </div>
                    <?php } ?>

                    <input type="hidden" name="action" value="editpirep" />
                    <input type="hidden" name="pirepid" value="<?php echo $pirep->pirepid?>" />
                    <input type="submit" name="submit" class="btn btn-primary float-right" value="Save fields" />
                </form>
            </div>
        </div>
    </div>
</div>