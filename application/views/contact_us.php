<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<?php
    $this->load->view('common/header');
?>

    <div class="container">
   <div class="single">

<style>
		#map_canvas {
			position: relative;
			padding: 2px;
			height: 400px;
			color:#309;
		}
    </style>

	   <div class="contact_top">
	   	 <h2>Our Addresses</h2>
	     <div class="col-sm-6">
	   	   <address class="addr">
                <div>
                    <b class="secondary3">Address:</b>
                    <p class="secondary2">
                        <?=$contact_details['address']?>
                    </p>
                </div>
                <dl>
                    <dt>Phone:</dt>
                    <dd>
                        <?=$contact_details['phone']?>
                    </dd>
                </dl>
                <dl>
                    <dt>FAX:</dt>
                    <dd>
                        <?=$contact_details['fax']?>
                    </dd>
                </dl>
                <dl class="email">
                    <dt>E-mail:</dt>
                    <dd>
                        <a href="malito:<?=$contact_details['email']?>"><?=$contact_details['email']?></a>
                    </dd>
                </dl>
                <b class="secondary3">
                    Office Hours:
                </b>
                <dl>
                    <dt>Weekdays:</dt>
                    <dd>
                        <?=$contact_details['weekday_start_time']?> a.m - <?=$contact_details['weekday_end_time']?> p.m
                    </dd>
                </dl>
                <dl>
                    <dt>Weekends:</dt>
                    <dd>
                        <?=$contact_details['weekend_start_time']?> a.m - <?=$contact_details['weekend_end_time']?> p.m
                    </dd>
                </dl>

           </address>
           <div class="map_canvas" id="map_canvas">
                <!--Map Here-->
         </div><br>
          </div>
          <div class="col-sm-6">
	   	   <address class="addr">
            <h3>Contact Form</h3>
           <form method="post" id="contact_form" action="<?=base_url().'contact_us'?>">
            <?php
              if(!$this->helper_model->validate_user_session()):
            ?>
             <div class="form-group">
                  <label>Name</label>
                  <input name="name" type='text' class="form-control" placeholder="Enter your full name" value="<?=set_value('name')?>">
                  <?=form_error('name')?>
            </div>

            <div class="form-group">
                  <label>Email</label>
                  <input name="email" type='email' class="form-control" placeholder="Enter your email" value="<?=set_value('email')?>">
                  <?=form_error('email')?>
                </div>
                <?php
                 endif;
                ?>

                <div class="form-group">
                  <label>Subject</label>
                  <input name="subject" type='text' class="form-control" placeholder="Enter subject" value="<?=set_value('subject')?>">
                  <?=form_error('subject')?>
                </div>
                
              <div class="form-group">
                <label>Message</label>
                <textarea class="form-control" rows="10" name="message" placeholder="Enter your questions or message here..." ><?=set_value('message');?></textarea>
                <?=form_error('message')?>
              </div>

              <?php
                    if(!$this->helper_model->validate_user_session()):
                      ?>
              <div class="form-group">
                <label>Captcha</label><br>
                <img id="image_captcha" src="<?=base_url().'Sample.captcha/'.$captcha['filename']?>" alt="captcha here">

                <label>Can't read the letters shown? Click <a id="captcha_refresh" href="javascript:void(0)">here</a> to refresh</label>
                <input name="captcha" type='text' size="20" class="form-control" placeholder="Enter characters seen above" value="">
                <?=form_error('captcha').'<br>'?>
              </div>
              <?php 
                endif;
              ?>

            <div class="form-group form-submit1 form_but1 pull-right">
               <input name="submit" type="submit" id="submit" value="Submit"><br>
            </div>
           </form>
	   	   		
	   	   </address>
          </div>
	   </div>
      </div>
</div>

<?php
    $this->load->view('common/footer');
?>

<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?v=3.exp&signed_in=false&libraries=places"></script>

<script type="text/javascript">
    /*
    //You can handle click events this way too
    $("#captcha_refresh").click(function(){
        alert("1");
    });
*/
    $(document).on('click', '#captcha_refresh', function(){
        $.ajax({
                    url: "<?=base_url().'home/refresh_captcha'; ?>",
                    dataType: 'json',
                    beforeSend: function(){
                        $("#image_captcha").attr("src", "<?php echo base_url('assets/ajax/images/ajax-loader_round.gif');?>");
                    },

                    success: function (data) {
                        if(data['status']) {
                            $("#image_captcha").attr("src", "<?=base_url().'Sample.captcha/'?>" + data["src"]);
                        } else{
                            alert("Can't refresh captcha at the moment. Please try again later.")
                        }
                    },

                    error: function(data) {
                        alert("An unknown error occured. Please try again later");
                    }
                });
     });


  function initialize() {
    var lat = <?php echo $contact_details["lat"] ?>;
    var lon = <?php echo $contact_details["lon"] ?>;
    var pos_acc = <?php if($contact_details['pos_acc']>0)echo $contact_details['pos_acc']; else echo 2000; ?>;

    var center = new google.maps.LatLng(lat, lon);

    if(pos_acc<=2000){
        var zoomlevel=15;
    }
    else if(pos_acc<50000){
        var zoomlevel=13;
    }
    else if(pos_acc>100000){
        var zoomlevel=11;
    }
    else{
        var zoomlevel=12;
    }

    var map = new google.maps.Map(document.getElementById('map_canvas'), {
      zoom: zoomlevel,
      center: center,
      mapTypeId: google.maps.MapTypeId.HYBRID
    });
	
	  
	  var address = "<?php echo $contact_details['address'];?>";
	  
                    // init markers
                    var marker = new google.maps.Marker({
                        position: new google.maps.LatLng(lat, lon),
                        map: map,
                        title: "<?='JobPortal'?>"
                    });

                    (function(marker) {
                        // add click event
						var name = "<?='JobPortal'?>";
						var phone = "<?=$contact_details['phone']?>";
						var fax = "<?php echo $contact_details['fax']?>";
						var email = "<?=$contact_details['email']?>";
                        
						infowindow = new google.maps.InfoWindow({
							content: '<img src="<?php echo base_url();?>uploads/admin/images/logo.png"/><br>' + address + "<br>" + "Phone: " 
							+ phone + " Fax: " + fax 
							+ "<br>Email: " + email
						});
						infowindow.open(map, marker);
						var status = 1;
						google.maps.event.addListener(marker, 'click', function() {
							if(status==1){
								infowindow.close(map, marker);
								status = 0;
							} else {
								infowindow.open(map, marker);
								status = 1;
							}
                        });
                    })(marker);
					i++;
   
  }
  google.maps.event.addDomListener(window, 'load', initialize);
</script>