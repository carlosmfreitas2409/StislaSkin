<?php if(!defined('IN_PHPVMS') && IN_PHPVMS !== true) { die(); } ?>
<div class="section-header">
	<h1><?php echo SITE_NAME; ?> Fleet</h1>
    <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="<?php echo SITE_URL; ?>">Dashboard</a></div>
        <div class="breadcrumb-item"><a href="javascript::">Pilot Administration</a></div>
        <div class="breadcrumb-item">Fleets</div>
    </div>
</div>

<div class="row">
    <div class="col-12 col-md-12 col-lg-12">
        <div class="card">
            <div class="card-body">
				<table class="table">
					<thead>
						<tr>
							<th>Aircraft Registration</th>
							<th>Aircraft Type</th>
							<th>Range</th>
							<th>Max Passengers</th>
							<th>Max Cargo</th>
							<th>Details</th>
						</tr>
					</thead>
					<tbody>
					<?php if($aircrafts != null){ foreach($aircrafts as $aircrafts){ ?>
						<tr>
							<td><?php echo $aircrafts->registration; ?></td>
							<td><?php echo $aircrafts->fullname; ?></td>
							<td><?php echo $aircrafts->range; ?><i> miles</i></td>
							<td><?php echo $aircrafts->maxpax; ?></td>
							<td><?php echo $aircrafts->maxcargo; ?></td>
							<td><a href="<?php echo url('fleet/view/' . $aircrafts->id); ?>">View</a></td>
						</tr>
					<?php } }?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>