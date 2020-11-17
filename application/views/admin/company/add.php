<div class="content-wrapper">

   <!-- Content Header (Page header) -->
   <section class="content-header">
      <div class="header-icon">
         <i class="pe-7s-note2"></i>
      </div>
      <div class="header-title">
         <h1><?= getContentLanguageSelected('COMPANY', defaultSelectedLanguage()) ?></h1>
         <small><?= getContentLanguageSelected('COMPANY_ADD', defaultSelectedLanguage()) ?></small>
         <ol class="breadcrumb hidden-xs">
            <li><a href="<?=base_url('admin/dashboard');?>"><i class="pe-7s-home"></i> <?= getContentLanguageSelected('HOME', defaultSelectedLanguage()) ?></a></li>
            <li class="active"><?= getContentLanguageSelected('COMPANY', defaultSelectedLanguage()) ?></li>
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
                     <a class="btn btn-primary" href="<?=base_url('admin/company/lists')?>"> <i class="fa fa-list"></i>  <?= getContentLanguageSelected('COMPANY_LIST', defaultSelectedLanguage()) ?></a>  
                  </div>
               </div>
               <div class="panel-body">
                  <form  method="post" enctype="multipart/form-data">
                     <div class="col-md-6" >
                        <div class="form-group">
                           <label><?= getContentLanguageSelected('NAME', defaultSelectedLanguage()) ?><span class="required">*</span></label>
                           <input type="text" class="form-control" name="name" id="name" placeholder="Company Name" value="<?php echo set_value('name') ?>">
                           <?=form_error('name'); ?>
                        </div>

                        <div class="form-group">
                           <label><?=getContentLanguageSelected('CONTACT_NUMBER',defaultSelectedLanguage())?><span class="required">*</span></label>
                           <div  >
                              <input type="text" class="form-control" name="dial_code" id="dial_code" placeholder="Dial Code" readonly value="<?=getAreaCode() ?>"  style='display: inline; width: 17%;'>
                              <input type="text" class="form-control" name="mobile" id="mobile" placeholder="Mobile" value="<?php echo set_value('mobile') ?>"  style='display: inline; width: 82%;'>
                              <?=form_error('dial_code'); ?>
                              <?=form_error('mobile'); ?>
                           </div>
                        </div>

                        <div class="form-group">
                           <label><?= getContentLanguageSelected('EMAIL', defaultSelectedLanguage()) ?><span class="required">*</span></label>
                           <input type="text" class="form-control" name="email" id="email" placeholder="Email" value="<?php echo set_value('email') ?>">
                           <?=form_error('email'); ?>
                        </div>

                        <div class="form-group">
                           <label><?= getContentLanguageSelected('PASSWORD', defaultSelectedLanguage()) ?><span class="required">*</span></label>
                           <input type="password" class="form-control" name="password" id="password" placeholder="Password" value="<?php echo set_value('password') ?>">
                           <?=form_error('password'); ?>
                        </div>

                        <div class="form-group">
                           <label><?= getContentLanguageSelected('CONFIRM_PASSWORD', defaultSelectedLanguage()) ?><span class="required">*</span></label>
                           <input type="password" class="form-control" name="re_password" id="re_password" placeholder="Confirm Password" value="<?php echo set_value('re_password') ?>">
                           <?=form_error('re_password'); ?>
                        </div>

                        <div class="control-group">
                           <label><?= getContentLanguageSelected('STATUS', defaultSelectedLanguage()) ?></label><br>
                           <label class="cus_radio">
                           <input type="radio" name="status" value="1" checked="checked"><?= getContentLanguageSelected('ACTIVE', defaultSelectedLanguage()) ?></label>
                           <label class="cus_radio"><input type="radio" name="status" value="0" ><?= getContentLanguageSelected('INACTIVE', defaultSelectedLanguage()) ?></label>
                        </div>

                        <div class="control-group">
                           <label><?= getContentLanguageSelected('IMAGE', defaultSelectedLanguage()) ?></label>
                           <input type="file"  name="image" id="image"/>
                        </div>

                     </div>

                     <div class="col-sm-6">
                        <div class="form-group">
                           <label for="location"><?= getContentLanguageSelected('ADDRESS', defaultSelectedLanguage()) ?><span class="required">*</span></label>
                           <input type="text" class="form-control" id="site_location" name="site_location" value="<?=set_value('address', isset($dataCollection->address)?$dataCollection->address:""); ?>">
                           <?=form_error('site_location'); ?>
                        </div>

                        <div class="control-group">
                           <label for="disabled-input" class="control-label "><?= getContentLanguageSelected('COUNTRY', defaultSelectedLanguage()) ?><span class="required">*</span></label>
                           <div class="controls">
                              <div class="form-group">
                                 <input type="text" name="country" id="country" class="form-control" placeholder="Country"  value="<?=(isset($dataCollection->country))?$dataCollection->country:'';?>" >
                                 <?=form_error('country'); ?>
                              </div>
                           </div>
                        </div>

                        <div class="control-group">
                           <label for="disabled-input" class="control-label "><?= getContentLanguageSelected('STATE', defaultSelectedLanguage()) ?><span class="required">*</span></label>
                           <div class="controls">
                              <div class="form-group">
                                 <input type="text" name="state" id="administrative_area_level_1" class="form-control" placeholder="State" value="<?=(isset($dataCollection->state))?$dataCollection->state:'';?>" >
                                 <?=form_error('state'); ?>
                              </div>
                           </div>
                        </div>

                        <div class="control-group">
                           <label for="disabled-input" class="control-label "><?= getContentLanguageSelected('CITY', defaultSelectedLanguage()) ?><span class="required">*</span></label>
                           <div class="controls">
                              <div class="form-group">
                                 <input type="text" name="city" class="form-control" placeholder="City" value="<?=(isset($dataCollection->city))?$dataCollection->city:'';?>" id="locality">
                                 <?=form_error('city'); ?>
                              </div>
                           </div>
                        </div>

                        <div class="control-group">
                           <label for="disabled-input" class="control-label "><?= getContentLanguageSelected('ZIP_CODE', defaultSelectedLanguage()) ?></label>
                           <div class="controls">
                              <div class="form-group">
                                 <input type="text" name="postal_code" class="form-control" placeholder="Zip Code" value="<?=(isset($dataCollection->postal_code))?$dataCollection->postal_code:'';?>" id="postal_code">
                                 <?=form_error('postal_code'); ?>
                              </div>
                           </div>
                        </div>
                     </div>
                     <div id="address">
                        <input type="hidden" id="street_number" disabled="true">
                        <input type="hidden" id="route" disabled="true">                
                        <input type="hidden" id="latitude" name="latitude" value="<?php echo set_value('latitude'); ?>">
                        <input type="hidden" id="longitude" name="longitude" value="<?php echo set_value('longitude'); ?>">
                     </div>

                     <div class="col-sm-12">
                        <div class="form-group">
                           <label><?= getContentLanguageSelected('DESCRIPTION', defaultSelectedLanguage()) ?></label>
                           <textarea class="form-control" name="description" placeholder="Description" id="description"  rows="10"><?=set_value('description', isset($dataCollection->notes)?$dataCollection->notes:""); ?></textarea>
                           <?=form_error('description'); ?>
                        </div>
                     </div>



                     <div class="col-md-12" >
                        <div class="reset-button">
                           <button class="btn btn-success"><?= getContentLanguageSelected('SAVE', defaultSelectedLanguage()) ?></button>
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