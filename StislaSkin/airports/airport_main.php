<!-- This airport info table and it's functionality was created by Adamm, and modified by Stuart Boardman-->
<?php if(!defined('IN_PHPVMS') && IN_PHPVMS !== true) { die(); } ?>
<div class="section-header">
	<h1><?php echo SITE_NAME; ?> Airports</h1>
    <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="<?php echo SITE_URL; ?>">Dashboard</a></div>
        <div class="breadcrumb-item"><a href="javascript::">Pilot Administration</a></div>
        <div class="breadcrumb-item">Airports</div>
    </div>
</div>

<div class="row">
    <div class="col-12 col-md-12 col-lg-12">
        <div class="card">
            <div class="card-body">
				<table class="table">
					<thead>
						<tr>
                            <th>ICAO</th>
                            <th>Airport Name</th>
                            <th>Airport Country</th>
						</tr>
					</thead>
					<tbody>
                    <?php 
                        $allairports = OperationsData::GetAllAirports();
                        foreach ($allairports as $airport) {
                    ?>
						<tr>
							<td><?php echo '<a href=" '.SITE_URL.'/index.php/airports/get_airport?icao='.$airport->icao.'">'.$airport->icao.'</a>';?></td>
                            <td><?php echo $airport->name; ?> </td>
                            <td><?php echo $airport->country; ?></td>
						</tr>
					<?php } ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>