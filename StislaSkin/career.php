<?php if(!defined('IN_PHPVMS') && IN_PHPVMS !== true) { die(); } ?>
<div class="section-header">
	<h1>Career</h1>
    <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="<?php echo SITE_URL; ?>">Dashboard</a></div>
        <div class="breadcrumb-item"><a href="javascript::">Pilot Administration</a></div>
        <div class="breadcrumb-item"><a href="javascript::">Informations</a></div>
        <div class="breadcrumb-item">Career</div>
    </div>
</div>

<div class="row">
	<div class="col-md-12">
		<div class="card">
            <div class="card-header">
                <h4>Pilot Ranks</h4>
            </div>
            <div class="card-body">
				<table class="table">
					<thead>
						<tr>
							<th scope="row">Rank Title</th>
							<th scope="row">Minimum Hours</th>
							<th scope="row">Pay Rate/Hour</th>
							<th scope="row">Can Fly</th>
							<th scope="row">Rank Image</th>
						</tr>
					</thead>
					<tbody>
						<?php foreach($ranks as $rank) { ?>
						<tr>
							<td><?php echo $rank->rank; ?></td>
							<td><?php echo $rank->minhours; ?></td>
							<td>$<?php echo $rank->payrate; ?>/hr</td>
							<td> 
								<?php $rankai = CareerData::getaircrafts($rank->rankid); 
								if(!$rankai) {echo 'All the aircraft';}
								else {
									$i = 0;
									foreach($rankai as $ran) {
										$i++;
										if($i > 1) echo ', ';
										echo $ran->icao;
									} 
								} ?></td>
							<td><img src="<?php echo $rank->rankimage; ?>" title="<?php echo $rank->rank; ?>" /></td>
						</tr>
						<?php } ?>
					</tbody>
				</table>
			</div>
		</div>

		<div class="card">
            <div class="card-header">
                <h4>Awards</h4>
            </div>
            <div class="card-body">
				<table class="table">
					<thead>
						<tr>
							<th scope="row">Award</th>
							<th scope="row">Description</th>
							<th scope="row">Image</th>
						</tr>
					</thead>
					<tbody>
						<?php if(!$generaward) {
							echo '<tr><td align="center" colspan="3">There are no awards at this time!</td></tr>';
						} else {
							foreach($generaward as $gen) { ?>
						<tr>
							<td><?php echo $gen->name; ?></td>
							<td><?php echo $gen->descrip; ?></td>
							<td><img src="<?php echo $gen->image; ?>" title="<?php echo $gen->name; ?>" /></td>
						</tr>
						<?php } } ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>