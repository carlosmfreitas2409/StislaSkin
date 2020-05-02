<div id="routemap" style="width: 100%; height: 500px; position: relative; overflow: hidden;"></div>

<script src="<?php echo SITE_URL?>/lib/js/base_map.js"></script>
<script type="text/javascript">
    const map = createMap({
        render_elem: 'routemap',
        provider: '<?php echo Config::Get("MAP_TYPE"); ?>',
    });

    <?php 
        $shown = array();
        foreach($pirep_list as $pirep) {	
            // Dont show repeated routes		
            if(in_array($pirep->code.$pirep->flightnum, $shown))
                continue;
            else
                $shown[] = $pirep->code.$pirep->flightnum;
            
            if(empty($pirep->arrlat) || empty($pirep->arrlng) || empty($pirep->deplat) || empty($pirep->deplng)) {
                continue;
            }
	?>

    var depLocation = [{latitude: "<?php echo $pirep->deplat?>", longitude: "<?php echo $pirep->deplng?>"}];
	var arrLocation = [{latitude: "<?php echo $pirep->arrlat?>", longitude: "<?php echo $pirep->arrlng?>"}];
	var points = [];
	
	depLocation.forEach(function(d, i) {
        if(d.latitude != null && d.latitude != undefined) {
            // Marker
            selDepMarker = L.marker([d.latitude, d.longitude], {
                icon: MapFeatures.icons.departure,
                title: "<?php echo "$pirep->depname ($pirep->depicao)"; ?>"
            }).addTo(map);
			
			depPush = L.latLng([d.latitude, d.longitude]);
        }
    });
	
	arrLocation.forEach(function(d, i) {
        if(d.latitude != null && d.latitude != undefined) {
            // Marker
            selArrMarker = L.marker([d.latitude, d.longitude], {
                icon: MapFeatures.icons.arrival,
                title: "<?php echo "$pirep->arrname ($pirep->arricao)"; ?>"
            }).addTo(map);
			
			arrPush = L.latLng([d.latitude, d.longitude]);
        }
    });
	
	points.push(depPush);
	points.push(arrPush);
	
	var selPointsLayer = L.polyline([points], {
		weight: 2,
		opacity: 1.0,
		color: '#49ABEF',
		steps: 10
    }).addTo(map);
    
    map.fitBounds([[depPush], [arrPush]]);
    <?php } ?>
</script>