<?php
    $last_location = FltbookData::getLocation(Auth::$userinfo->pilotid);
    $airs = FltbookData::arrivalairport($last_location->arricao);

    if(!$airs) {
?>
<div class='card-body'>
    <div class='alert alert-primary mb-2' role='alert'>
        <strong>Opss!</strong> We do not have any flights leaving your current location.
    </div>
</div>
<?php } else { ?>
<div id="routemap" style="border-bottom-right-radius: .5rem;; border-bottom-left-radius: .5rem; height: 500px;"></div>
    
<!-- Create Map -->
<script type="text/javascript" src="<?php echo SITE_URL; ?>/lib/js/bootstrap.js"></script>
<script src="<?php echo SITE_URL?>/lib/js/base_map.js"></script>
<script>
    const map = createMap({
        render_elem: 'routemap',
        worldCopyJump: true,
        provider: '<?php echo Config::Get("MAP_TYPE"); ?>'
    });
</script>

<?php
    foreach ($airs as $air) {
        foreach ($airlines as $airline) {
            $allroutes = FltbookData::findschedule($air->arricao, $last_location->arricao, $airline->code);
            foreach($allroutes as $route) {
                $departure = OperationsData::getAirportInfo($route->depicao);
                $arrival   = OperationsData::getAirportInfo($route->arricao);
?>

<script type="text/javascript">
    var depLatlng = [{latitude: "<?php echo $departure->lat; ?>", longitude: "<?php echo $departure->lng; ?>"}];
    var arrLatlng = [{latitude: "<?php echo $arrival->lat; ?>", longitude: "<?php echo $arrival->lng; ?>"}];
    var selPoints = [];
    var selPointsLayer;

    // Departure & Arrival ICONs
    var depIcon = L.icon({iconUrl: url + '/lib/skins/StislaSkin/assets/img/light_blue_marker_user.png', iconAnchor: [10, 33]});
    <?php if ($arrival->hub) { ?>
        <?php $hub = "(HUB)"; ?>
        var arrIcon = L.icon({iconUrl: url + '/lib/skins/StislaSkin/assets/img/light_blue_marker_house.png', iconAnchor: [10, 33]});
    <?php } else { ?>
        <?php $hub = ""; ?>
        var arrIcon = L.icon({iconUrl: url + '/lib/skins/StislaSkin/assets/img/light_blue_marker_plane.png', iconAnchor: [10, 33]});
    <?php } ?>

    // Departure Things
    depLatlng.forEach(function(d, i) {
        if(d.latitude != null && d.latitude != undefined) {
            // Set LatLng to get dep points
            pushDep = L.latLng([d.latitude, d.longitude]);
            selPoints.push(pushDep);

            // Marker
            selDepMarker = L.marker([d.latitude, d.longitude], {
                icon: depIcon,
                title: "<?php echo $departure->icao.' - '.$departure->name; ?>"
            }).addTo(map);
        }
    });

    // Arrival Marker
    arrLatlng.forEach(function(d, i) {
        if(d.latitude != null && d.latitude != undefined) {
            // Set LatLng to get arr points
            pushArr = L.latLng([d.latitude, d.longitude]);

            // Content to open modal
            var contentString = '<?php echo $route->arricao.' - '.$arrival->name.' '.$hub?> | <a data-toggle="modal" href="<?php echo SITE_URL?>/action.php/fltbook/confirm?id=<?php echo $route->id?>&airline=<?php echo $route->code?>&aicao=<?php echo $route->aircrafticao?>" data-target="#confirm" class="m-link">Book Flight</a>';

            // Marker
            selArrMarker = L.marker([d.latitude, d.longitude], {
                icon: arrIcon,
                title: "<?php echo $arrival->icao.' - '.$arrival->name; ?>"
            }).addTo(map).bindPopup(contentString, {maxWidth: 390});

            // On click marker function
            selArrMarker.on('click', function(event) {
                // Check if polyline already exist (if exist, the polyline will be deleted and the points reset.)
                if(selPointsLayer) {
                    selPointsLayer.remove();
                    selPointsLayer = null;
                    selPoints = [];
                }

                // Get marker and set points
                var marker = event.target;
                selPoints.push(pushDep);
                selPoints.push(marker.getLatLng());

                // Set polyline and options
                selPointsLayer = L.polyline.antPath([selPoints], {
                    weight: 2,
                    opacity: 1.0,
                    color: '#49ABEF',
                    steps: 10,
                    dashArray: [
                        15,
                        30
                    ],
                    pulseColor: "#216a9c"
                }).addTo(map);

                // Resize zoom to fit polyline
                map.fitBounds(selPointsLayer.getBounds());
            });

            // Resize zoom to all airports
            map.fitBounds([[pushDep], [pushArr]]);
        }
    });
</script>

<?php } } } } ?>