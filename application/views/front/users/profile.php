

<?php $success= $this->session->flashdata('message'); 
if(!empty($success)) { ?>
<div class="panel panel-success">
  <div class="panel-heading">
    <?php echo $this->session->flashdata('message'); ?>
  </div>
</div>
<?php } ?>


<div class="mngPay">
   <div class="payBox abtProfl">
      <div class="row">
         <div class="col-sm-12">
          <div class="editProfileBox">
            <form  method="post" enctype="multipart/form-data">

              <div class="proflPick">
                <figure>
                    <!-- <img id="blah" src="#" alt="your image" /> -->
                     <img id="blah" src="<?=getUserImageUrl($this->session->userdata('user_id'))?>" class="img-responsive">
                    <!-- <img id="blah" src="<?=base_url('assets/front/images/profile.jpg')?>" class="img-responsive"> -->
                </figure>
                <div class="clearfix"></div>
                <input type="file" name="image" class="chooser" id="image">
                <a href="#"><span><i class="fas fa-camera"></i></span> <?=getContentLanguageSelected('CHANGE_PICTURE',defaultSelectedLanguage())?></a> 
              </div>

            <div class="row">
               <div class="col-xs-12 col-sm-6">
                <label><?=getContentLanguageSelected('FIRST_NAME',defaultSelectedLanguage())?></label>
                  <input type="text" name="first_name" placeholder="First Name" value="<?=$user_data['first_name']?>" >
                  <?=form_error('first_name'); ?>
               </div>
               <div class="col-xs-12 col-sm-6">
                <label><?=getContentLanguageSelected('LAST_NAME',defaultSelectedLanguage())?></label>
                  <input type="text" name="last_name" placeholder="Last Name" value="<?=$user_data['last_name']?>">
                  <?=form_error('last_name'); ?>
               </div>
               <div class="col-xs-12 col-sm-6">
                <label><?=getContentLanguageSelected('EMAIL',defaultSelectedLanguage())?></label>
                  <input type="text" readonly="true" placeholder="Email" name="email" value="<?=$user_data['email']?>">
                  <?=form_error('email'); ?>
               </div>
               <div class="col-xs-12 col-sm-6">
                <label><?=getContentLanguageSelected('MOBILE',defaultSelectedLanguage())?></label>
                  <input type="text" placeholder="Mobile" name="mobile" value="<?=$user_data['mobile']?>">
                  <?=form_error('mobile'); ?>
               </div>
               <div class="col-xs-12 col-sm-6">
                <label><?=getContentLanguageSelected('ADDRESS',defaultSelectedLanguage())?></label>
                  <input type="text" name="address" placeholder="Address" value="<?=$user_data['address']?>">
                  <?=form_error('address'); ?>
               </div>
               <div class="col-xs-12 text-right">
                  <button class="subtBtn" value="Submit"><?=getContentLanguageSelected('SUBMIT',defaultSelectedLanguage())?></button>
               </div>
            </div>
         </form>
               <?php
               $user_role_id = getUserRoleIdByUserId($this->session->userdata('user_id'));
                if($user_role_id == 3) { ?>
                  <div class="col-xs-12 col-sm-6">
                    <label><?=getContentLanguageSelected('LICENCE_ID',defaultSelectedLanguage())?></label>
                  <input type="text" readonly="true" name="license_id" placeholder="Address" value="<?=$partner_commission['license_id']?>">
               </div>
                <div class="col-xs-12 col-sm-6">
                  <label><?=getContentLanguageSelected('MOTOR_COMMISSION',defaultSelectedLanguage())?></label>
                  <input type="text" readonly="true" name="address" placeholder="Address" value="<?=$partner_commission['motar_commission']?>">
               </div>

                <div class="col-xs-12 col-sm-6">
                  <label><?=getContentLanguageSelected('TRAVEL_COMMISSION',defaultSelectedLanguage())?></label>
                  <input type="text" readonly="true" name="address" placeholder="Address" value="<?=$partner_commission['travel_commission']?>">
               </div>
                <div class="col-xs-12 col-sm-6">
                  <label><?=getContentLanguageSelected('HEALTH_COMMISSION',defaultSelectedLanguage())?></label>
                  <input type="text" readonly="true" name="address" placeholder="Address" value="<?=$partner_commission['health_commission']?>">
               </div>
                <div class="col-xs-12 col-sm-6">
                  <label><?=getContentLanguageSelected('CREDIT_COMMISION',defaultSelectedLanguage())?></label>
                  <input type="text" readonly="true" name="address" placeholder="Address" value="<?=$partner_commission['credit_commission']?>">
               </div>
                <div class="col-xs-12 col-sm-6">
                  <label><?=getContentLanguageSelected('PROFESSIONAL_COMMISSION',defaultSelectedLanguage())?></label>
                  <input type="text" readonly="true" name="address" placeholder="Address" value="<?=$partner_commission['professional_commission']?>">
               </div>
                <div class="col-xs-12 col-sm-6">
                  <label><?=getContentLanguageSelected('INDIVIDUAL_ACCIDENT_COMMISSION',defaultSelectedLanguage())?></label>
                  <input type="text" readonly="true" name="address" placeholder="Address" value="<?=$partner_commission['individual_accident_commission']?>">
               </div> 
                <?php }?>
         </div>
      </div>
   </div>
</div>