<div id="routemap" style="width: 100%; height: 500px; position: relative; overflow: hidden;"></div>

<script src="<?php echo SITE_URL?>/lib/js/base_map.js"></script>
<script type="text/javascript">
    const map = createMap({
        render_elem: 'routemap',
        provider: '<?php echo Config::Get("MAP_TYPE"); ?>',
    });

    var depLocation = L.latLng("<?php echo $depAirport->lat ?>", "<?php echo $depAirport->lng ?>");
	var arrLocation = L.latLng("<?php echo $arrAirport->lat ?>", "<?php echo $arrAirport->lng ?>");
	var points = [];
	
    // Departure Marker
    selDepMarker = L.marker(depLocation, {
        icon: MapFeatures.icons.departure,
        title: "<?php echo "$depAirport->name ($bid->depicao)"; ?>"
    }).addTo(map);
	
    // Arrival Marker
    selArrMarker = L.marker(arrLocation, {
        icon: MapFeatures.icons.arrival,
        title: "<?php echo "$arrAirport->name ($bid->arricao)"; ?>"
    }).addTo(map);
    
	points.push(depLocation);
	points.push(arrLocation);
	
	var selPointsLayer = L.polyline([points], {
		weight: 2,
		opacity: 1.0,
		color: '#49ABEF',
		steps: 10
    }).addTo(map);
    
    map.fitBounds(points);
</script>