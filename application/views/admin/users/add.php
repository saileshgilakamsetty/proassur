<div class="content-wrapper">
   <!-- Content Header (Page header) -->
   <section class="content-header">
      <div class="header-icon">
         <i class="pe-7s-note2"></i>
      </div>
      <div class="header-title">
         <h1><?=getContentLanguageSelected('USERS',defaultSelectedLanguage())?></h1>
         <small><?=getContentLanguageSelected('USERS_ADD',defaultSelectedLanguage())?></small>
         <ol class="breadcrumb hidden-xs">
            <li><a href="<?=base_url('admin/dashboard');?>"><i class="pe-7s-home"></i> <?=getContentLanguageSelected('HOME',defaultSelectedLanguage())?></a></li>
            <li class="active"><?=getContentLanguageSelected('USERS',defaultSelectedLanguage())?></li>
         </ol>
      </div>
   </section>
   <!-- Main content -->
   <section class="content">
      <div class="row">
         <!-- Form controls -->
         <div class="col-sm-12">
            <div class="panel panel-bd">
               <div class="panel-heading">
                  <div class="btn-group"> 
                     <a class="btn btn-primary" href="<?=base_url('admin/users/lists')?>"> <i class="fa fa-list"></i>  <?=getContentLanguageSelected('USERS_LIST',defaultSelectedLanguage())?></a>  
                  </div>
               </div>
               <div class="panel-body">
                  <form  method="post" enctype="multipart/form-data">
                     <div class="col-md-6" >
                        <div class="form-group">
                           <label><?=getContentLanguageSelected('FIRST_NAME',defaultSelectedLanguage())?><span class="required">*</span></label>
                           <input type="text" class="form-control" name="first_name" id="first_name" placeholder="First Name" value="<?php echo set_value('first_name') ?>">
                           <?=form_error('first_name'); ?>
                        </div>
                     </div>
                     <div class="col-md-6" >
                        <div class="form-group">
                           <label><?=getContentLanguageSelected('LAST_NAME',defaultSelectedLanguage())?><span class="required">*</span></label>
                           <input type="text" class="form-control" name="last_name" id="last_name" placeholder="Last Name" value="<?php echo set_value('last_name') ?>">
                           <?=form_error('last_name'); ?>
                        </div>
                     </div>
                     <div class="col-md-6" >
                        <div class="form-group">
                           <label><?=getContentLanguageSelected('CONTACT_NUMBER',defaultSelectedLanguage())?><span class="required">*</span></label>
                           <div  >
                              <input type="text" class="form-control" name="dial_code" id="dial_code" placeholder="Dial Code" readonly value="<?=getAreaCode() ?>"  style='display: inline; width: 17%;'>
                              <input type="text" class="form-control" name="mobile" id="mobile" placeholder="Mobile" value="<?php echo set_value('mobile') ?>"  style='display: inline; width: 82%;'>
                              <?=form_error('dial_code'); ?>
                              <?=form_error('mobile'); ?>
                           </div>
                        </div>
                     </div>
                     <div class="col-md-6" >
                        <div class="form-group">
                           <label><?=getContentLanguageSelected('DATE_OF_BIRTH',defaultSelectedLanguage())?><span class="required">*</span></label>
                           <input type="text" class=" form-control input start_datepicker" id="start_datepicker" name="dob" value="<?php echo set_value('dob'); ?>" />
                           <?=form_error('dob'); ?>
                        </div>
                     </div>
                     <div class="col-md-6" >
                        <div class="form-group">
                           <label><?=getContentLanguageSelected('EMAIL',defaultSelectedLanguage())?></label>
                           <input type="text" class="form-control" name="email" id="email" placeholder="Email" value="<?php echo set_value('email') ?>">
                           <?=form_error('email'); ?>
                        </div>
                     </div>
                     <input type="hidden" class="form-control" name="id" id="id" placeholder="id" value="1">
                     <div class="col-md-6" >
                        <div class="form-group">
                           <label><?=getContentLanguageSelected('PASSWORD',defaultSelectedLanguage())?><span class="required">*</span></label>
                           <input type="password" class="form-control" name="password" id="password" placeholder="Password" value="<?php echo set_value('password') ?>">
                           <?=form_error('password'); ?>
                        </div>
                     </div>
                     <div class="col-md-6" >
                        <div class="form-group">
                           <label><?=getContentLanguageSelected('CONFIRM_PASSWORD',defaultSelectedLanguage())?><span class="required">*</span></label>
                           <input type="password" class="form-control" name="re_password" id="re_password" placeholder="Confirm Password" value="<?php echo set_value('re_password') ?>">
                           <?=form_error('re_password'); ?>
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
                           <!-- <label for="disabled-input" class="control-label "><?=getContentLanguageSelected('ZIP_CODE',defaultSelectedLanguage())?></label>
                           <div class="controls">
                              <div class="form-group">
                                 <input type="text" name="postal_code" class="form-control" placeholder="Zip Code" value="<?=(isset($dataCollection->postal_code))?$dataCollection->postal_code:'';?>" id="postal_code">
                              </div>
                           </div> -->
                           <input type="hidden" name="postal_code" class="form-control" placeholder="Zip Code" value="<?=(isset($dataCollection->postal_code))?$dataCollection->postal_code:'';?>" id="postal_code">
                           <label for="disabled-input" class="control-label "><?=getContentLanguageSelected('ACCOUNT_NUMBER',defaultSelectedLanguage())?><span class="required">*</span></label>
                           <div class="controls">
                              <div class="form-group">
                                 <input type="text" name="account_number" class="form-control" placeholder="Account Number" value="<?= set_value('account_number')?>" id="account_number">
                                 <?= form_error('account_number');?>
                              </div>
                           </div>
                        </div>
                     </div>

                     <div class="col-md-6" >
                        <div class="control-group">
                           <label><?=getContentLanguageSelected('ROLE',defaultSelectedLanguage())?><span class="required">*</span> </label><br>
                           <?php $data = ' id="select_user_role" class="form-control input"  ';
                              echo form_dropdown('role',getUserRoleOption(),set_value("role"),$data);?>
                           <?=form_error('role'); ?>
                        </div>
                     </div>

                     <div id="partner_addition_data"></div>

                     <div id="address">
                        <input type="hidden" id="street_number" disabled="true">
                        <input type="hidden" id="route" disabled="true">                
                        <input type="hidden" id="latitude" name="latitude" value="<?php echo set_value('latitude'); ?>">
                        <input type="hidden" id="longitude" name="longitude" value="<?php echo set_value('longitude'); ?>">
                     </div>
                     <div class="col-md-6" >
                        <div class="control-group">
                           <label><?=getContentLanguageSelected('GENDER',defaultSelectedLanguage())?></label><br>
                           <label class="cus_radio">
                           <input name="gender" checked="checked" value="0" type="radio">
                           <?=getContentLanguageSelected('MALE',defaultSelectedLanguage())?></label>
                           <label class="cus_radio">
                           <input name="gender" value="1" type="radio">
                           <?=getContentLanguageSelected('FEMALE',defaultSelectedLanguage())?> </label>
                           <label class="cus_radio">
                           <input name="gender" value="2" type="radio">
                           <?=getContentLanguageSelected('OTHER',defaultSelectedLanguage())?></label>
                           <div class="clearfix"></div>
                           <?=form_error('gender'); ?>
                        </div>
                     </div>
                     <div class="col-md-6">
                        <div class="control-group">
                           <label><?=getContentLanguageSelected('IMAGE',defaultSelectedLanguage())?></label>
                           <input type="file"  name="image" id="image"/>
                        </div>
                     </div>
                     <div class="col-md-6" >
                        <div class="control-group">
                           <label><?=getContentLanguageSelected('STATUS',defaultSelectedLanguage())?></label><br>
                           <label class="cus_radio">
                           <input type="radio" name="status" value="1" checked="checked"><?=getContentLanguageSelected('ACTIVE',defaultSelectedLanguage())?></label>
                           <label class="cus_radio"><input type="radio" name="status" value="0" ><?=getContentLanguageSelected('INACTIVE',defaultSelectedLanguage())?></label>
                        </div>
                     </div>                     

                     <div class="col-md-12" >
                        <div class="reset-button">
                           <button class="btn btn-success"><?=getContentLanguageSelected('SAVE',defaultSelectedLanguage())?></button>
                        </div>
                     </div>
                  </form>
               </div>
            </div>
         </div>
      </div>
   </section>
   <!-- /.content -->
</div>
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>

<style type="text/css">
   .inlineinput div {
    display: inline;
}
</style>