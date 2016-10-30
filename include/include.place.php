<?php 
$s = new Session; 
?>
<div class="row-offcanvas row-offcanvas-left">
    <div id="sidebar" class="sidebar-offcanvas">
        <?php include_once 'include/include.side.bar.php'; ?>
    </div>
    <div id="main">
        <div class="col-md-9">
            <p class="visible-xs">
                <button type="button" class="btn btn-primary btn-xs" data-toggle="offcanvas"><i class="glyphicon glyphicon-chevron-left"></i></button>
            </p>
            <div class="place-page">
                <?php
                if(httpGet('address')){
                    $data_arr = geocode(httpGet('address'));
                    if($data_arr){
                        
                        $latitude = $data_arr[0];
                        $longitude = $data_arr[1];
                        $formatted_address = $data_arr[2];
                                    
                    ?>
                    <div class="panel panel-default">
                        <div id="gmap_canvas">Loading map...</div>
                        <div id='map-label' class="panel-body">
                            <p>Map shows approximate location.<p>
                            <p><?=httpGet('address')?></p>
                        </div>
                    </div>
                    
                    <script type="text/javascript">
                        function init_map() {
                            var myOptions = {
                                zoom: 15,
                                center: new google.maps.LatLng(<?=$latitude?>, <?=$longitude?>),
                                mapTypeId: google.maps.MapTypeId.ROADMAP
                            };
                            map = new google.maps.Map(document.getElementById("gmap_canvas"), myOptions);
                            marker = new google.maps.Marker({
                                map: map,
                                position: new google.maps.LatLng(<?=$latitude?>, <?=$longitude?>)
                            });
                            infowindow = new google.maps.InfoWindow({
                                content: "<?=$formatted_address?>"
                            });
                            google.maps.event.addListener(marker, "click", function () {
                                infowindow.open(map, marker);
                            });
                            infowindow.open(map, marker);
                        }
                        google.maps.event.addDomListener(window, 'load', init_map);
                    </script>
                
                    <?php
                
                    }else{
                        echo "No map found.";
                    }
                }
                ?>
            </div>
        </div>
        <div class="col-md-3 right-side">
            <div class="panel panel-default">
                <div id="location-map"></div>
                <div class="panel-body">
                    <span class="location"></span>
                </div>
            </div>
             <div class="panel panel-default">
                <div class="panel-body">
                    <label>Nearby Places <small>(within)</small></label>
                    <form action="<?=htmlspecialchars($_SERVER["PHP_SELF"])?>" method="GET">
                        <input type="hidden" name="address" value="<?=httpGet('address')?>" />
                        <select class="form-control" name="radius" id="radius">
                            <option value="1000" <?=httpGet('radius')==1000?'selected':''?>>1km</option>
                            <option value="5000" <?=httpGet('radius')==5000?'selected':''?>>5km</option>
                            <option value="10000" <?=httpGet('radius')==10000?'selected':''?>>10km</option>
                            <option value="15000" <?=httpGet('radius')==15000?'selected':''?>>15km</option>
                        </select>
                    </form>
                </div>
                <div class="list-group nearby"></div>
            </div>
        </div>
    </div>
</div>