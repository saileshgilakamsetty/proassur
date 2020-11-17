<body class="loginBg">
   <div class="login">
      <div class="container">
         <div class="loginForm signUpForm">
            <figure><a href="<?= base_url()?>"><img src="<?=base_url(); ?>/assets/front/images/logo.png"></a></figure>
            <form class="form-horizontal" action="" method="post" enctype="multipart/form-data ">
               <!-- Name input-->
               <div class="row form-group">
                  <div class="col-md-6">
                     <div class="emailicon space20"><span><img src="<?=base_url(); ?>/assets/front/images/user.png"></span>
                        <input id="first_name" name="first_name" type="text" placeholder="<?=getContentLanguageSelected('FIRST_NAME',defaultSelectedLanguage())?>" class="form-control" value="<?php echo set_value('first_name') ?>">
                     </div>
                        <?=form_error('first_name')?>
                  </div>
                  <div class="col-md-6">
                     <div class="emailicon"><span><img src="<?=base_url(); ?>/assets/front/images/user.png"></span>
                        <input id="last_name" name="last_name" type="text" placeholder="<?=getContentLanguageSelected('LAST_NAME',defaultSelectedLanguage())?>" class="form-control" value="<?=set_value('last_name')?>"> 
                     </div>
                  <?=form_error('last_name')?>
                  </div>
               </div>
               <!-- Email input-->
               <div class="row form-group">

                  <div class="col-md-6">
                     <div class="emailicon"><span><img src="<?=base_url(); ?>/assets/front/images/phone.png"></span>
                        <input id="mobile_code" name="mobile_code" type="text" placeholder="<?=getContentLanguageSelected('COUNTRY_CODE',defaultSelectedLanguage())?>" class="form-control" value="<?=set_value('mobile_code')?>">
                     </div>
                  <?=form_error('mobile_code')?>
                  </div>
                  <div class="col-md-6">
                     <div class="emailicon"><span><img src="<?=base_url(); ?>/assets/front/images/phone.png"></span>
                        <input id="mobile" name="mobile" type="text" placeholder="<?=getContentLanguageSelected('CONTACT_NUMBER',defaultSelectedLanguage())?>">
                     </div>
                  <?=form_error('mobile')?>
                  </div>
               </div>

           

        
               <div class="row form-group">
                  <div class="col-md-6 ">
                     <div class="emailicon space20"><span><img src="<?=base_url(); ?>/assets/front/images/key.png"></span>
                        <input id="password" name="password" value="<?=set_value('password','Amit1234')?>" type="password" placeholder="<?=getContentLanguageSelected('PASSWORD',defaultSelectedLanguage())?>" class="form-control">
                     </div>
                     <?=form_error('password')?>
                  </div>
                  <div class="col-md-6 ">
                     <div class="emailicon space20"><span><img src="<?=base_url(); ?>/assets/front/images/key.png"></span>
                        <input id="confirm_password" name="confirm_password" value="<?=set_value('confirm_password','Amit1234')?>" type="password" placeholder="<?=getContentLanguageSelected('CONFIRM_PASSWORD',defaultSelectedLanguage())?>" class="form-control">
                     </div>
                     <?=form_error('confirm_password')?>
                  </div>

               </div>
               <div class="row form-group">
                  <div class="col-md-6">
                    <div class="emailicon"><span><img src="<?=base_url(); ?>/assets/front/images/map.png"></span>

                     <input type="text" class="form-control" id="site_location" name="site_location" placeholder="<?=getContentLanguageSelected('ADDRESS',defaultSelectedLanguage())?>" value="<?=set_value('address') ?>">
                    </div>
                    <?=form_error('site_location'); ?>
                  </div>
                  <div class="col-md-6 ">
                     <div class="emailicon space20"><span><img src="<?=base_url(); ?>/assets/front/images/email.png"></span>
                        <input id="email" name="email" type="text" placeholder="<?=getContentLanguageSelected('EMAIL',defaultSelectedLanguage())?>" class="form-control" value="<?=set_value('email')?>">
                     </div>
                  <?=form_error('email')?>
                  </div>
                     <div id="address">
                        <input type="hidden" id="street_number" disabled="true">
                        <input type="hidden" id="route" disabled="true">                
                        <input type="hidden" id="country" name="country" value="<?php echo set_value('country'); ?>">
                        <input type="hidden" id="administrative_area_level_1" name="state" value="<?php echo set_value('state'); ?>">
                        <input type="hidden" id="locality" name="city" value="<?php echo set_value('city'); ?>">
                        <input type="hidden" id="postal_code" name="postal_code" value="<?php echo set_value('postal_code'); ?>">
                        <input type="hidden" id="latitude" name="latitude" value="<?php echo set_value('latitude'); ?>">
                        <input type="hidden" id="longitude" name="longitude" value="<?php echo set_value('longitude'); ?>">
                     </div>
               </div>

              <div class="row form-group">
                <div class="col-md-6" >
                  <div class="emailicon space20"><span><img src="<?=base_url(); ?>/assets/front/images/user.png"></span>
                    <?php $data = ' class="form-control" id="user_role"  onChange="getPartnerDetails(this.value)" ';
                      echo form_dropdown('role',getUserRoleOptionForSignup(),set_value("role"),$data);?>
                    <?=form_error('role'); ?>
                  </div>
                </div>
              </div> 

              <div id="partner_addition_data"></div>
              
              <div class="row form-group">
                <div class="col-md-12 inputCheck">
                   <input type="checkbox"  name="terms_condition" id="terms_condition" value="1" <?php echo set_checkbox('terms_condition', '1'); ?> >
                   <label>Agree to Terms & Conditions</label>
                </div>
                   <?=form_error('terms_condition[]')?>
              </div>
               <div class="row form-group">
                  <div class="col-md-6 signUp">
                     <p>Already have an account?</p>
                     <a href="<?=base_url()?>login">Login</a>
                  </div>
                  <div class="col-md-6 sBtn">
                     <button type="submit" class="btn btn-primary btn-lg"><?=getContentLanguageSelected('SIGN_UP',defaultSelectedLanguage())?></button>
                  </div>
               </div>
               <div class="row">
                  <div class="col-md-12">
                     <p class="backHome"><a href="<?=base_url()?>"><?=getContentLanguageSelected('BACK_TO_HOME',defaultSelectedLanguage())?></a></p>
                  </div>
               </div>
            </form>
         </div>
      </div>
   </div>
<script src="<?=base_url(); ?>/assets/front/js/jquery.min.js"></script> 

   <script src="https://maps.googleapis.com/maps/api/js?v=3.exp&signed_in=true&libraries=places&key=AIzaSyApopLJuTwEWnT2la-D0XjBXP6xrai4e7s"></script>

   <script type="text/javascript">


   $("#site_location").on('focus', function () {
       geolocate();
   });
   
   var placeSearch, autocomplete;
   var componentForm = {
       street_number: 'short_name',
       route: 'long_name',
       locality: 'long_name',
       administrative_area_level_1: 'long_name',
       country: 'long_name',
       postal_code: 'short_name'
   };
   
   function initialize() {
       // Create the autocomplete object, restricting the search
       // to geographical location types.
       autocomplete = new google.maps.places.Autocomplete(
       /** @type {HTMLInputElement} */ (document.getElementById('site_location')), {
           types: ['geocode']
       });
       //alert(autocomplete);
       // When the user selects an address from the dropdown,
       // populate the address fields in the form.
       google.maps.event.addListener(autocomplete, 'place_changed', function () {
           fillInAddress();
       });
   }
   
   // [START region_fillform]
   function fillInAddress() {
       // Get the place details from the autocomplete object.
       var place = autocomplete.getPlace();
       document.getElementById("latitude").value = place.geometry.location.lat();
       document.getElementById("longitude").value = place.geometry.location.lng();
   
       for (var component in componentForm) {
           document.getElementById(component).value = '';
           document.getElementById(component).disabled = false;
       }
       // Get each component of the address from the place details
       // and fill the corresponding field on the form.
       for (var i = 0; i < place.address_components.length; i++) {
         //alert(i);
           var addressType = place.address_components[i].types[0];
           if (componentForm[addressType]) {
               var val = place.address_components[i][componentForm[addressType]];
               document.getElementById(addressType).value = val;
           }
       }
   
   
   }
   // [END region_fillform]
   
   // [START region_geolocation]
   // Bias the autocomplete object to the user's geographical location,
   // as supplied by the browser's 'navigator.geolocation' object.
   function geolocate() {
   
       if (navigator.geolocation) {
           navigator.geolocation.getCurrentPosition(function (position) {
               var geolocation = new google.maps.LatLng(
               position.coords.latitude, position.coords.longitude);
   
               var latitude = position.coords.latitude;
               var longitude = position.coords.longitude;
               document.getElementById("latitude").value = latitude;
               document.getElementById("longitude").value = longitude;
   
               autocomplete.setBounds(new google.maps.LatLngBounds(geolocation, geolocation));
           });
       }
   
   }
   initialize();
   // [END region_geolocation]
     

</script>

<script>
  function getPartnerDetails(user_role) {
    if(user_role == 3) { // Partner
      var html = "";
      
      // license id 
      html+='<div class="row form-group">';
      html+='<div class="col-md-6">';
      html+='<div class="emailicon space20"><span><img src="<?=base_url(); ?>/assets/front/images/user.png"></span>';
      //html+='<label for="location"><?=getContentLanguageSelected('LICENSE_ID',defaultSelectedLanguage())?><span class="required">*</span></label>';
      html+='<input type="text" class="form-control" id="license_id" name="license_id" placeholder="License Id" value="<?=set_value('license_id'); ?>">';
      html+='<?=form_error('license_id'); ?></div></div>';

      // License Image 
     /* html+='<div class="row form-group">';
      html+='<div class="col-md-6">';
      html+='<div class="emailicon space20"><span><img src="<?=base_url(); ?>/assets/front/images/user.png"></span>';
      html+='<input type="file" class="form-control" id="license_image" name="license_image" value="">';
      html+='<?=form_error('license_image'); ?></div></div></div>';*/

      // Percent Commision 
      html+='<div class="col-md-6">';
      html+='<div class="emailicon space20"><span><img src="<?=base_url(); ?>/assets/front/images/user.png"></span>';
      html+='<input type="text" class="form-control" id="percent_commission" placeholder="Percent Commission" name="percent_commission" value="<?=set_value('percent_commission'); ?>">';
      html+='<?=form_error('percent_commission'); ?></div></div></div>';

      $("#partner_addition_data").html(html);
    }
    else {
      $("#partner_addition_data").html("");
    }
  }


  $(document).ready(function () {
    if($('#user_role').val() == 3) { // Partner
      var html = "";
      
      // license id 
      html+='<div class="row form-group">';
      html+='<div class="col-md-6">';
      html+='<div class="emailicon space20"><span><img src="<?=base_url(); ?>/assets/front/images/user.png"></span>';
      //html+='<label for="location"><?=getContentLanguageSelected('LICENSE_ID',defaultSelectedLanguage())?><span class="required">*</span></label>';
      html+='<input type="text" class="form-control" id="license_id" name="license_id" placeholder="License Id" value="<?=set_value('license_id'); ?>">';
      html+='<?=form_error('license_id'); ?></div></div>';

      /*// License Image 
      html+='<div class="col-md-6">';
      html+='<div class="emailicon space20"><span><img src="<?=base_url(); ?>/assets/front/images/user.png"></span>';
      html+='<input type="file" class="form-control" id="license_image" name="license_image" value="">';
      html+='<?=form_error('license_image'); ?></div></div></div>';*/

      // Percent Commision 
      // html+='<div class="row form-group">';
      html+='<div class="col-md-6">';
      html+='<div class="emailicon space20"><span><img src="<?=base_url(); ?>/assets/front/images/user.png"></span>';
      html+='<input type="text" class="form-control" id="percent_commission" placeholder="Percent Commission" name="percent_commission" value="<?=set_value('percent_commission'); ?>">';
      html+='<?=form_error('percent_commission'); ?></div></div></div>';

      $("#partner_addition_data").html(html);
    }
    else {
      $("#partner_addition_data").html("");
    }
  });
</script>