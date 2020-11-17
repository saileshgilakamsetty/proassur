<div class="content-wrapper">
   <?php //print_r($dataCollection); ?>
   <section class="content-header">
      <div class="header-icon">
         <i class="pe-7s-note2"></i>
      </div>
      <div class="header-title">
         <h1><?=getContentLanguageSelected('USERS',defaultSelectedLanguage())?></h1>
         <small><?=getContentLanguageSelected('USERS_EDIT',defaultSelectedLanguage())?></small>
         <ol class="breadcrumb hidden-xs">
            <li><a href="<?=base_url('admin/dashboard');?>"><i class="pe-7s-home"></i> <?=getContentLanguageSelected('HOME',defaultSelectedLanguage())?></a></li>
            <li class="active"><?=getContentLanguageSelected('USERS',defaultSelectedLanguage())?></li>
         </ol>
      </div>
   </section>
   <section class="content">
      <div class="row">
         <div class="col-sm-12">
            <div class="panel panel-bd">
               <div class="panel-heading">
                  <div class="btn-group"> 
                     <a class="btn btn-primary" href="<?=base_url('admin/users/lists')?>"> <i class="fa fa-list"></i>  <?=getContentLanguageSelected('USERS_LIST',defaultSelectedLanguage())?></a>  
                  </div>
               </div>
               <div class="panel-body">
                  <form  method="post" enctype="multipart/form-data">
                     <input type="hidden" class="form-control" name="old_password" id="" placeholder="User Name" value="<?=set_value('password', isset($dataCollection->password)?$dataCollection->password:""); ?>" >
                     <input type="hidden" name="checked_password" id="checked_password" value="0">
                     <input type="hidden" name="id" id="id" value="<?=set_value('id', isset($dataCollection->role)?$dataCollection->role:""); ?>">
                     <?php $checked_password=set_value('checked_password'); ?>
                     <div class="col-md-6" >
                        <div class="form-group">
                           <label><?=getContentLanguageSelected('FIRST_NAME',defaultSelectedLanguage())?><span class="required">*</span></label>
                           <input type="text" class="form-control" name="first_name" id="first_name" placeholder="First Name" value="<?=set_value('first_name', isset($dataCollection->first_name)?$dataCollection->first_name:""); ?>" >
                           <?=form_error('first_name'); ?>
                        </div>
                     </div>
                     <div class="col-md-6" >
                        <div class="form-group">
                           <label><?=getContentLanguageSelected('LAST_NAME',defaultSelectedLanguage())?><span class="required">*</span></label>
                           <input type="text" class="form-control" name="last_name" id="last_name" placeholder="Last Name" value="<?=set_value('last_name', isset($dataCollection->last_name)?$dataCollection->last_name:""); ?>" >
                           <?=form_error('last_name'); ?>
                        </div>
                     </div>
                     <div class="col-md-6" >
                        <div class="form-group">
                           <label><?=getContentLanguageSelected('CONTACT_NUMBER',defaultSelectedLanguage())?><span class="required">*</span></label>
                           <div>
                           <input type="text" class="form-control" name="dial_code" id="dial_code" placeholder="Dial Code" readonly value="<?php echo set_value('dial_code',isset($dataCollection->dial_code)?$dataCollection->dial_code:"") ?>"  style='display: inline; width: 17%;'>
                              <input type="text" class="form-control" name="mobile" id="mobile" placeholder="Mobile" value="<?php echo set_value('mobile',isset($dataCollection->mobile)?$dataCollection->mobile:"") ?>"  style='display: inline; width: 82%;'>
                              <?=form_error('dial_code'); ?>
                              <?=form_error('mobile'); ?>
                           </div>
                           <!-- <input type="text" class="form-control" name="mobile" id="mobile" placeholder="Enter Mobile" value="<?=set_value('mobile', isset($dataCollection->mobile)?$dataCollection->mobile:""); ?>"> -->
                           <!-- <?=form_error('mobile'); ?> -->
                        </div>
                     </div>
                     <div class="col-md-6" >
                        <div class="form-group">
                           <label><?=getContentLanguageSelected('DATE_OF_BIRTH',defaultSelectedLanguage())?><span class="required">*</span></label>
                           <input type="text" class=" form-control input start_datepicker" id="start_datepicker" name="dob" value="<?=set_value('dob', isset($dataCollection->dob)?$dataCollection->dob:""); ?>" />
                           <?=form_error('dob'); ?>
                        </div>
                     </div>
                     <div class="col-md-6" >
                        <div class="form-group">
                           <label><?=getContentLanguageSelected('EMAIL',defaultSelectedLanguage())?></label>
                           <input type="text" class="form-control" name="email" id="email" placeholder="Enter Email" value="<?=set_value('email', isset($dataCollection->email)?$dataCollection->email:""); ?>"  >
                           <?=form_error('email'); ?>
                        </div>
                     </div>
                     <div class="col-sm-6">
                        <div class="form-group">
                           <label for="location"><?=getContentLanguageSelected('ADDRESS',defaultSelectedLanguage())?><span class="required">*</span></label>
                           <input type="text" class="form-control" id="site_location" name="site_location" value="<?=set_value('address', isset($dataCollection->address)?$dataCollection->address:""); ?>">
                           <?=form_error('site_location'); ?>
                        </div>
                     </div>
                     <div class="col-sm-6">
                        <div class="control-group">
                           <label for="disabled-input" class="control-label "><?=getContentLanguageSelected('COUNTRY',defaultSelectedLanguage())?><span class="required">*</span></label>
                           <div class="controls">
                              <div class="form-group">
                                 <input type="text" name="country" id="country" class="form-control" placeholder="Country"  value="<?=(isset($dataCollection->country))?$dataCollection->country:'';?>" >
                                 <?=form_error('country'); ?>
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="col-sm-6">
                        <div class="control-group">
                           <label for="disabled-input" class="control-label "><?=getContentLanguageSelected('STATE',defaultSelectedLanguage())?><span class="required">*</span></label>
                           <div class="controls">
                              <div class="form-group">
                                 <input type="text" name="state" id="administrative_area_level_1" class="form-control" placeholder="State" value="<?=(isset($dataCollection->state))?$dataCollection->state:'';?>" >
                                 <?=form_error('state'); ?>
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="col-sm-6">
                        <div class="control-group">
                           <label for="disabled-input" class="control-label "><?=getContentLanguageSelected('CITY',defaultSelectedLanguage())?><span class="required">*</span></label>
                           <div class="controls">
                              <div class="form-group">
                                 <input type="text" name="city" class="form-control" placeholder="City" value="<?=(isset($dataCollection->city))?$dataCollection->city:'';?>" id="locality">
                                 <?=form_error('city'); ?>
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="col-sm-6">
                        <div class="control-group">
                           <!-- <label for="disabled-input" class="control-label ">Zip Code</label>
                           <div class="controls">
                              <div class="form-group">
                                 <input type="text" name="postal_code" class="form-control" placeholder="Zip Code" value="<?=(isset($dataCollection->postal_code))?$dataCollection->postal_code:'';?>" id="postal_code">
                                 <?=form_error('postal_code'); ?>
                              </div>
                           </div> -->
                           <input type="hidden" name="postal_code" class="form-control" placeholder="Zip Code" value="<?=(isset($dataCollection->postal_code))?$dataCollection->postal_code:'';?>" id="postal_code">

                           <label for="disabled-input" class="control-label "><?=getContentLanguageSelected('ACCOUNT_NUMBER',defaultSelectedLanguage())?><span class="required">*</span></label>
                           <div class="controls">
                              <div class="form-group">
                                 <input type="text" name="account_number" class="form-control" placeholder="Account Number" value="<?=(isset($dataCollection->account_number))?$dataCollection->account_number:'';?>" id="account_number">
                                 <?=form_error('account_number'); ?>
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="col-sm-6">



                        <div class="control-group">
                           <label><?=getContentLanguageSelected('ROLE',defaultSelectedLanguage())?><span class="required">*</span></label>
                           <?php $data = ' id="select_user_role" class="form-control"  ';
                              $role = $dataCollection->role;
                              
                              echo form_dropdown('role',getUserRoleOption(),set_value('role',isset($role)?$role:""),$data);?>
                           <?=form_error('role'); ?>
                        </div>
                     </div>
                  <?php if($dataCollection->role != 5){ ?>
                     <div id="partner_addition_data">
                        
                        <div class="col-sm-6">
                           <div class="form-group">
                              <label for="location"><?=getContentLanguageSelected('LICENSE_ID',defaultSelectedLanguage())?><span class="required">*</span></label>
                              <input type="text" class="form-control" id="license_id" name="license_id" value="<?=set_value('license_id', isset($dataPartner['license_id'])?$dataPartner['license_id']:""); ?>"><?=form_error('license_id'); ?>
                           </div>
                        </div>


                        
                        <div class="col-sm-6">
                           <div class="form-group">
                              <label for="location"><?=getContentLanguageSelected('MOTOR_INSURANCE_COMMISSION',defaultSelectedLanguage())?><span class="required">*</span></label>
                              <input type="text" class="form-control" id="motar_commission" name="motar_commission" value="<?=set_value('motar_commission', isset($dataPartner['motar_commission'])?$dataPartner['motar_commission']:""); ?>"><?=form_error('motar_commission'); ?>
                           </div>
                        </div>
                        
                        
                        <div class="col-sm-6">
                           <div class="form-group">
                              <label for="location"><?=getContentLanguageSelected('TRAVEL_INSURANCE_COMMISSION',defaultSelectedLanguage())?><span class="required">*</span></label>
                              <input type="text" class="form-control" id="travel_commission" name="travel_commission" value="<?=set_value('travel_commission', isset($dataPartner['travel_commission'])?$dataPartner['travel_commission']:""); ?>"><?=form_error('travel_commission'); ?>
                           </div>
                        </div>

                        <div class="col-sm-6">
                           <div class="form-group">
                              <label for="location"><?=getContentLanguageSelected('HEALTH_INSURANCE_COMMISSION',defaultSelectedLanguage())?><span class="required">*</span></label>
                              <input type="text" class="form-control" id="health_commission" name="health_commission" value="<?=set_value('health_commission', isset($dataPartner['health_commission'])?$dataPartner['health_commission']:""); ?>"><?=form_error('health_commission'); ?>
                           </div>
                        </div>

                        
                        <div class="col-sm-6">
                           <div class="form-group">
                              <label for="location"><?=getContentLanguageSelected('CREDIT_INSURANCE_COMMISSION',defaultSelectedLanguage())?><span class="required">*</span></label>
                              <input type="text" class="form-control" id="credit_commission" name="credit_commission" value="<?=set_value('credit_commission', isset($dataPartner['credit_commission'])?$dataPartner['credit_commission']:""); ?>"><?=form_error('credit_commission'); ?>
                           </div>
                        </div>


                        <div class="col-sm-6">
                           <div class="form-group">
                              <label for="location"><?=getContentLanguageSelected('HOUSE_INSURANCE_COMMISSION',defaultSelectedLanguage())?><span class="required">*</span></label>
                              <input type="text" class="form-control" id="house_commission" name="house_commission" value="<?=set_value('house_commission', isset($dataPartner['house_commission'])?$dataPartner['house_commission']:""); ?>"><?=form_error('house_commission'); ?>
                           </div>
                        </div>



                        
                        <div class="col-sm-6">
                           <div class="form-group">
                              <label for="location"><?=getContentLanguageSelected('PROFESSIONAL_INSURANCE_COMMISSION',defaultSelectedLanguage())?><span class="required">*</span></label><input type="text" class="form-control" id="professional_commission" name="professional_commission" value="<?=set_value('professional_commission', isset($dataPartner['professional_commission'])?$dataPartner['professional_commission']:""); ?>"><?=form_error('professional_commission'); ?>
                           </div>
                        </div>


                        
                        <div class="col-sm-6">
                           <div class="form-group">
                              <label for="location"><?=getContentLanguageSelected('INDIVIDUAL_INSURANCE_COMMISSION',defaultSelectedLanguage())?><span class="required">*</span></label>
                              <input type="text" class="form-control" id="individual_accident_commission" name="individual_accident_commission" value="<?=set_value('individual_accident_commission', isset($dataPartner['individual_accident_commission'])?$dataPartner['individual_accident_commission']:""); ?>"><?=form_error('individual_accident_commission'); ?>
                           </div>
                        </div>
                     </div>
                  <?php } ?>
                     <div id="address">
                        <input type="hidden" id="street_number" disabled="true">
                        <input type="hidden" id="route" disabled="true">                
                        <input type="hidden" id="latitude" name="latitude" value="<?=(isset($dataCollection->latitude))?$dataCollection->latitude:'';?>">     
                        <input type="hidden" id="longitude" name="longitude" value="<?=(isset($dataCollection->longitude))?$dataCollection->longitude:'';?>">    
                     </div>
                     <div class="col-md-6" >
                        <div class="form-group">
                           <label><?=getContentLanguageSelected('GENDER',defaultSelectedLanguage())?></label><br>
                           <?php $gender=$dataCollection->gender ?>
                           <label class="cus_radio">
                           <input type="radio" name="gender" value="0" <?php if($gender=="0") { ?>  checked="checked" <?php } ?>><?=getContentLanguageSelected('MALE',defaultSelectedLanguage())?></label>
                           <label class="cus_radio">
                           <input type="radio" name="gender" value="1" <?php if($gender=="1") { ?>  checked="checked" <?php } ?>>
                           <?=getContentLanguageSelected('FEMALE',defaultSelectedLanguage())?> </label>
                           <label class="cus_radio">
                           <input type="radio" name="gender" value="2" <?php if($gender=="2") { ?>  checked="checked" <?php } ?>>
                           <?=getContentLanguageSelected('OTHER',defaultSelectedLanguage())?></label>
                           <div class="clearfix"></div>
                        </div>
                     </div>
                     <div class="col-md-6">
                        <div class="form-group">
                           <input type="file"  name="image" id="image"/>
                           <div class="pull-right"> 
                              <?php echo getUserImage($dataCollection->id); ?>
                           </div>
                        </div>
                     </div>
                     <div class="col-md-6" >
                        <div class="form-check">
                           <label><?=getContentLanguageSelected('STATUS',defaultSelectedLanguage())?></label><br>
                           <label class="radio-inline">
                           <?php $status=$dataCollection->status ?>
                           <input type="radio" name="status" value="1" <?php if($status==1) { ?>  checked="checked" <?php } ?>><?=getContentLanguageSelected('ACTIVE',defaultSelectedLanguage())?></label>
                           <label class="radio-inline"><input type="radio" name="status" value="0" <?php if($status==0) { ?>  checked="checked" <?php } ?>><?=getContentLanguageSelected('INACTIVE',defaultSelectedLanguage())?></label>
                        </div>
                     </div>
                     <div class="col-sm-10" >
                        <div class="reset-button">
                           <button class="btn btn-success"><?=getContentLanguageSelected('EDIT',defaultSelectedLanguage())?></button>
                        </div>
                     </div>
                  </form>
               </div>
            </div>
         </div>
      </div>
   </section>
</div>
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script> 
<script>
   var ckbox = $('#checkbox');
   $('input').click(function () {
       if (ckbox.is(':checked')) {
           $('#password').show();
           $('#re_password').show();
           $('#checked_password').attr('value',1);
   
       } else {
           $('#password').hide();
           $('#re_password').hide();
           $('#checked_password').attr('value',0); 
       }
   });
</script>