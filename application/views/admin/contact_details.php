<!--Start of assets for GMap-->  
    <link type="text/css" rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500">
    <style>
    #locationField, #controls {
      position: relative;
    }
    .map-canvas{
      position: relative;
      padding: 2px;
      height: 300px;
    }
    
    </style>
    <!--End of assets for GMap-->
    
    <!-- jQuery -->
    <!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>-->

<div class="row">
  <div class="col-lg-12">
    <div class="panel panel-default">
      <div class="panel-heading">
        <?='Contact Info'?>
      </div>
      <div class="panel-body">
        <div class="row">
          <form role="form" id="frm" method="post" action="<?=base_url().'admin/settings/contact_details'?>">
            <?php if(validation_errors()) echo "<p class='col-lg-12' style='color:red'><b>Please enter the required fields correctly.</b></p>"; ?>
            <div class="col-lg-6">
              <div class="form-group">
                <label>Phone</label>
                <input name="phone" type='tel' class="form-control" placeholder="Enter Phone Number" value="<?=set_value('phone',$info['phone']);?>">
                <?=form_error('phone')?>
              </div>

              <div class="form-group">
                <label>Fax</label>
                <input name="fax" type='tel' class="form-control" placeholder="Enter Fax Number" value="<?=set_value('fax',$info['fax']);?>">
                <?=form_error('fax')?>
              </div>

              <div class="form-group">
                <label>Email</label>
                <input name="email" type='tel' class="form-control" placeholder="Enter Fax Number" value="<?=set_value('email',$info['email']);?>">
                <?=form_error('email')?>
              </div>

              <div class="form-group">
                <label>Office Hours(Weekdays)</label>
                <?php 
                  if(form_error('weekday_start_time') || form_error('weekday_end_time') || form_error('weekend_start_time') || form_error('weekend_end_time')) {
                    echo "<p style='color:red'>Please Enter Office Hours Correctly</p>";
                  }
                ?>
                <p style="color:#00F">Please Use 12Hr Time Format</p>
                <div class='controls'>
                <input name="weekday_start_time" type='time' placeholder="hrs:mins" pattern="^([0-1]?[0-9]|2[0-3]):([0-5][0-9])(:[0-5][0-9])?$" value="<?=set_value('weekday_start_time',$info['weekday_start_time']);?>"> &nbsp;-&nbsp; <input type="time" id="fax" name="weekday_end_time" placeholder="hrs:mins" pattern="^([0-1]?[0-9]|2[0-3]):([0-5][0-9])(:[0-5][0-9])?$" value="<?=set_value('weekday_end_time', $info['weekday_end_time']);?>" >
              </div>
              </div>

              <div class="form-group">
                <label>Office Hours(Weekends)</label><br>
                <input type="time" id="fax" name="weekend_start_time" placeholder="hrs:mins" pattern="^([0-1]?[0-9]|2[0-3]):([0-5][0-9])(:[0-5][0-9])?$" value="<?=set_value('weekend_start_time',$info['weekend_start_time']);?>" > &nbsp;-&nbsp; <input type="time" id="fax" name="weekend_end_time" placeholder="hrs:mins" pattern="^([0-1]?[0-9]|2[0-3]):([0-5][0-9])(:[0-5][0-9])?$" value="<?=set_value('weekend_end_time',$info['weekend_end_time']);?>" >   
              </div>

            </div>

            <div class='col-lg-6'>
              <div class="form-group">
                <label> Office Location</label> 
                <div class="control-group">
                          
                            
                          <div style="color:#309" class="map-canvas" id="map-canvas"></div>
                            
                            <div class = "infoPanel" id="infoPanel">
                            
                            <div class="myLoc">
                                    <a class="btn btn-primary pull-left" onClick="getMyLocation()">Get My Current Location</a>
                                    <a class="btn btn-warning pull-right" onClick="getMap()">Reset Office Location</a>
                                    <br /><br />
                                </div>
                            
                  <b>Current position:</b>
                  <div class="iP" id="info"><?php echo $info["lat"].", ".$info["lon"] ?></div>
                  <b>Closest matching address:</b>
                  <div class="iP" id="address"><?php echo $info["address"]; ?></div>
                                <input type="hidden" name="lat" id="lat" value="<?=set_value('lat',$info['lat']);?>"> <!--Latitude-->
                                <input type="hidden" name="lon" id="lon" value="<?=set_value('lon',$info['lon']);?>"> <!--Longitude-->
                                <?php /* <input type="hidden" name="pos_acc" id="pos_acc" value="<?=set_value('pos_acc',$info['pos_acc']);?>"> */ ?> <!-- Position Accuracy -->
                                <input type="hidden" name="address" id="map_address" value="<?=set_value('address',$info['address']);?>"> <!-- Closest Matching Address Obtained From GPS Coordinates -->
              </div>
                            
                        </div> 
              </div>
            </div>
            <!-- col-lg-6 -->

            <legend>&nbsp;</legend>
            <div class='pull-right col-lg-12'>
              <div class='pull-right'>
                <button class="btn btn-success" type="submit">Submit</button>
                <button class="btn btn-warning" type="reset">Reset</button>
              </div>
            </div>

            </form>
          </div>
        </div>
	    <!-- row -->
      </div>
      <!-- panel-body -->
      </div>
    <!-- panel panel-default -->
  </div>
  <!-- col-lg-12 -->
</div>
<!-- row -->


<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?v=3.exp&signed_in=false&libraries=places"></script>
    
<script type="text/javascript">
var geocoder = new google.maps.Geocoder();

var y = document.getElementById("map-canvas");

var lat = <?php if ($info["lat"] != 0)echo $info["lat"]; else echo 27.7038;?>;
var lon = <?php if ($info["lon"] != 0)echo $info["lon"]; else echo 85.3232;?>;
//var pos_acc = <?php if ($info["pos_acc"] > 0)echo $info["pos_acc"]; else echo 10000;?>;

function getMyLocation() {
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(showPosition,  showError,{
    enableHighAccuracy: true,
    timeout:750000
    });
    } else { 
        y.innerHTML = "Geolocation is not supported by this browser, choose <b>Use Form</b> option to fill the address form.";
    }
}

function getMap() {
  var latLng = new google.maps.LatLng(lat, lon);
  
  var center = new google.maps.LatLng(lat, lon);

  var zoomlevel=15;

  var map = new google.maps.Map(document.getElementById('map-canvas'), {
    zoom: zoomlevel,
    center: center,
    mapTypeId: google.maps.MapTypeId.HYBRID
  });   
  // init markers
  var marker = new google.maps.Marker({
    position: new google.maps.LatLng(lat, lon),
    map: map,
    title: "Office Location Here",
    draggable:true
  });
          
  // Update current position info.
  updateMarkerPosition(latLng);
  geocodePosition(latLng);
  
  // Add dragging event listeners.
  google.maps.event.addListener(marker, 'dragstart', function() {
    updateMarkerAddress('Dragging...');
  });
  
  google.maps.event.addListener(marker, 'drag', function() {
    updateMarkerPosition(marker.getPosition());
  });
  
  google.maps.event.addListener(marker, 'dragend', function() {
    geocodePosition(marker.getPosition());
  });

  function geocodePosition(pos) {
    geocoder.geocode({
    latLng: pos
    }, function(responses) {
      if (responses && responses.length > 0) {
        updateMarkerAddress(responses[0].formatted_address);
        document.getElementById("autocomplete").value=responses[0].formatted_address;
      } else {
        updateMarkerAddress('Cannot determine address at this location.');
      }
    });
  }
  
  function updateMarkerPosition(latLng) {
    document.getElementById('info').innerHTML = [
      latLng.lat(),
      latLng.lng()
    ].join(', ');
    document.getElementById("lat").value=latLng.lat();
    document.getElementById("lon").value=latLng.lng();
  }
  
  function updateMarkerAddress(str) {
    document.getElementById('address').innerHTML = str;
  }
          
  }

function showPosition(position) {
  var latLng = new google.maps.LatLng(position.coords.latitude, position.coords.longitude);
  if(position.coords.accuracy<2000){
    var zoomlevel=16;
  }
  else if(position.coords.accuracy<50000){
    var zoomlevel=13;
  }
  else if(position.coords.accuracy>100000){
    var zoomlevel=11;
  }
  else{
    var zoomlevel=12;
  }
  //document.getElementById("pos_acc").value=position.coords.accuracy;
  if(!((position.coords.altitudeAccuracy==0)||(position.coords.altitudeAccuracy==null))){
    document.getElementById("alt").value=position.coords.altitude;
    document.getElementById("alt_acc").value=position.coords.altitudeAccuracy;
  }
  var myOptions = {
    
  zoom: zoomlevel,
  center: latLng,
  mapTypeId: google.maps.MapTypeId.HYBRID
  };
  var map = new google.maps.Map(document.getElementById("map-canvas"),myOptions);

  var marker = new google.maps.Marker({
    position:latLng,
    map:map,
    title:'Your Location',
    animation: google.maps.Animation.DROP,
    draggable:true
    
  });
  
  // Update current position info.
  updateMarkerPosition(latLng);
  geocodePosition(latLng);
  
  // Add dragging event listeners.
  google.maps.event.addListener(marker, 'dragstart', function() {
    updateMarkerAddress('Dragging...');
  });
  
  google.maps.event.addListener(marker, 'drag', function() {
    updateMarkerPosition(marker.getPosition());
  });
  
  google.maps.event.addListener(marker, 'dragend', function() {
    geocodePosition(marker.getPosition());
  });

  function geocodePosition(pos) {
    geocoder.geocode({
    latLng: pos
    }, function(responses) {
      if (responses && responses.length > 0) {
        updateMarkerAddress(responses[0].formatted_address);
        document.getElementById("autocomplete").value=responses[0].formatted_address;
      } else {
        updateMarkerAddress('Cannot determine address at this location.');
      }
    });
  }
  
  function updateMarkerPosition(latLng) {
    document.getElementById('info').innerHTML = [
      latLng.lat(),
      latLng.lng()
    ].join(', ');
    document.getElementById("lat").value=latLng.lat();
    document.getElementById("lon").value=latLng.lng();
  }
  
  function updateMarkerAddress(str) {
    document.getElementById('address').innerHTML = str;
  } 
}

function showError(error) {
    switch(error.code) {
        case error.PERMISSION_DENIED:
            y.innerHTML = "You denied the request for Geolocation. If you are concerned with your privacy, please choose <b>Use Form</b> option to fill the address form."
            break;
        case error.POSITION_UNAVAILABLE:
            y.innerHTML = "Location information is unavailable. Choose <b>Use Form</b> option to fill the address form."
            break;
        case error.TIMEOUT:
            y.innerHTML = "The request to get user location timed out. Choose <b>Use Form</b> option to fill the address form."
            break;
        case error.UNKNOWN_ERROR:
            y.innerHTML = "An unknown error occurred. Choose <b>Use Form</b> option to fill the address form."
            break;
    }
}
  google.maps.event.addDomListener(window, 'load', getMap);
    </script>