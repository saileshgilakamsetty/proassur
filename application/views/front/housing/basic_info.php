<section class="insurForm">
   <div class="container">
      <form action="" method="post" id="house_basic_info_form">
         <input type="hidden" name="user_id" id="user_id" value="<?= $this->session->userdata('user_id');?>">
         <div class="row">
            <div class="col-xs-12">
               <h3 class="title"><?=getContentLanguageSelected('HOUSE_INSURANCE',defaultSelectedLanguage())?></h3>
            </div>
         </div>
         <?php 
            $message = $this->session->flashdata('message'); 
            if(!empty($message)) { ?>
               <div class="panel panel-warning">
                  <div class="panel-heading">
                     <?php echo $this->session->flashdata('message'); ?>
                  </div>
               </div>
            <?php } 
         ?>
         <div class="formFildes">
            <div class="col-xs-12 col-sm-6">
               <div class="form-group">
                  <label><?=getContentLanguageSelected('INSURER_QUALITY',defaultSelectedLanguage())?></label>
                  <?php $data = ' class="form-control input" ';
                     echo form_dropdown('insurer_quality_id',getSingleOptions('tbl_insurer_quality','Select Insurer',1),set_value("insurer_quality_id"),$data);?>
                  <?=form_error('insurer_quality_id'); ?>
               </div>

               <div class="form-group">
                  <label><?=getContentLanguageSelected('HOUSE_TYPE',defaultSelectedLanguage())?></label>
                  <?php $data = ' class="form-control input" ';
                     echo form_dropdown('house_type_id',getSingleOptions('tbl_house_type','Select House Type',1),set_value("house_type_id"),$data);?>
                  <?=form_error('house_type_id'); ?>
               </div>
               <div class="form-group">
                  <label><?=getContentLanguageSelected('HOUSE_CATEGORY',defaultSelectedLanguage())?></label>
                  <?php $data = ' class="form-control input" ';
                     echo form_dropdown('house_category_id',getSingleOptions('tbl_house_category','Select Category',1),set_value("house_category_id"),$data);?>
                  <?=form_error('house_category_id'); ?>
               </div>
               <div class="form-group">
                  <label><?=getContentLanguageSelected('Interval',defaultSelectedLanguage())?></label>
                  <?php $data = ' class="form-control input" onChange = "setIntervalSelectedHousing_(this.value);" ';
                     echo form_dropdown('month_id',getMonthOptions('Select Month'),set_value("month_id"),$data);?>
                     <input type="hidden" class="form-control" name="selected_interval_housing" id="selected_interval_housing" placeholder="" value="">
                  <?=form_error('month_id'); ?>
               </div>
               <div class="form-group">
                  <label><?=getContentLanguageSelected('FROM',defaultSelectedLanguage())?></label>
                  <input type="text"  class="form-control firstcal" name="from" placeholder="From" id="from_" value="<?php echo set_value('from') ?>">
                  <?=form_error('from'); ?>
               </div>
               <div class="form-group">
                  <label><?=getContentLanguageSelected('TO',defaultSelectedLanguage())?></label>
                  <input type="text" readonly="" class="form-control secondcal" name="to"  placeholder="To" value="">
                  <?=form_error('to'); ?>
               </div>
            </div>
            <div class="col-xs-12 col-sm-6">
               <div class="form-group">
                  <label><?=getContentLanguageSelected('NUMBER_OF_ROOMS',defaultSelectedLanguage())?></label>
                  <input type="text" class="form-control" name="room" id="room" placeholder=" Number Of Room" value="<?php echo set_value('room') ?>">
                  <?=form_error('room'); ?>
               </div>
               <div class="form-group">
                  <label><?=getContentLanguageSelected('VALUE_OF_CONTENT',defaultSelectedLanguage())?></label>
                  <input type="text" class="form-control" name="content_value" id="content_value" placeholder=" Content Value" value="<?php echo set_value('content_value') ?>">
                  <?=form_error('content_value'); ?>
               </div>
               <div class="form-group">
                  <label><?=getContentLanguageSelected('VALUE_OF_BUILDING',defaultSelectedLanguage())?></label>
                  <input type="text" class="form-control" name="building_value" id="building_value" placeholder=" Building Value" value="<?php echo set_value('building_value') ?>">
                  <?=form_error('building_value'); ?>
               </div>
               <div class="form-group">
                  <label><?=getContentLanguageSelected('MONTHLY_RENT',defaultSelectedLanguage())?></label>
                  <input type="text" class="form-control" name="monthly_rent" id="monthly_rent" placeholder=" MONTHLY_RENT" value="<?php echo set_value('monthly_rent') ?>">
                  <?=form_error('monthly_rent'); ?>
               </div>
               <div class="form-group">
                  <label><?=getContentLanguageSelected('SUPERFICY',defaultSelectedLanguage())?></label>
                  <input type="text" class="form-control" name="superficy" id="superficy" placeholder=" superficy" value="<?php echo set_value('superficy') ?>">
                  <?=form_error('superficy'); ?>
               </div>
               <div class="form-group">
                  <label><?= getContentLanguageSelected('ANY',defaultSelectedLanguage())?></label>
                  <input type="text" class="form-control" name="house_other_info" id="house_other_info" placeholder=" Any Additional Information" value="<?php echo set_value('house_other_info') ?>">
                  <?=form_error('house_other_info'); ?>
               </div>
               <div class="form-group">
                  <input name= "basic_info_submit"  id="house_basic_info_submit" type="submit" value="Submit" class="subBtn">
               </div>
               <div class="clearfix"></div>
            </div>
            <div class="clearfix"></div>
         </div>
      </form>
   </div>
</section>
