<div class="content-wrapper">
   <!-- Content Header (Page header) -->
   <section class="content-header">
      <div class="header-icon">
         <i class="pe-7s-note2"></i>
      </div>
      <div class="header-title">
         <h1><?=getContentLanguageSelected('HOUSE',defaultSelectedLanguage())?> </h1>
         <small><?=getContentLanguageSelected('HOUSE',defaultSelectedLanguage())?></small>
         <ol class="breadcrumb hidden-xs">
            <li><a href="<?=base_url('admin/dashboard');?>"><i class="pe-7s-home"></i> <?=getContentLanguageSelected('HOME',defaultSelectedLanguage())?></a></li>
            <li class="active"><?=getContentLanguageSelected('HOUSE',defaultSelectedLanguage())?></li>
         </ol>
      </div>
      <?php // print_r(getCompanyIdsByBranch(getHousingBranchId()));?>
   </section>

    <?php $success= $this->session->flashdata('message'); 
   if(!empty($success)) { ?>
<div class="panel panel-success">
   <div class="panel-heading">
      <?php echo $this->session->flashdata('message'); ?>
   </div>
</div>
<?php } ?>
   
   <!-- Main content -->
   <section class="content">
      <div class="row">
         <!-- Form controls -->
         <div class="col-sm-12">
            <div class="panel panel-bd">
               <div class="panel-heading">
                  <div class="btn-group"> 
                     <a class="btn btn-primary" href="<?=base_url('admin/housingterification/list_house_tarification')?>"> <i class="fa fa-list"></i>  <?=getContentLanguageSelected('HOUSE',defaultSelectedLanguage())?></a>  
                  </div>
               </div>
               <div class="panel-body">
                  <form  method="post" enctype="multipart/form-data">
                     <div class="col-sm-6" >
                        <div class="form-group">
                          <label><?=getContentLanguageSelected('NAME',defaultSelectedLanguage())?><span class="required">*</span></label>

                          <?php $data = ' class="form-control" input"  ';
                          echo form_dropdown('user_id',getEndUserOptions('tbl_users','Select Name',1),set_value("user_id"),$data);?>
                          <?=form_error('user_id'); ?>
                        </div>
                        <div class="form-group">
                           <label><?=getContentLanguageSelected('INSURER_QUALITY',defaultSelectedLanguage())?><span class="required">*</label>
                           <?php $data = ' class="form-control input" ';
                              echo form_dropdown('insurer_quality_id',getSingleOptions('tbl_insurer_quality','Select Insurer',1),set_value("insurer_quality_id"),$data);?>
                           <?=form_error('insurer_quality_id'); ?>
                        </div>

                        <div class="form-group">
                           <label><?=getContentLanguageSelected('HOUSE_TYPE',defaultSelectedLanguage())?><span class="required">*</label>
                           <?php $data = ' class="form-control input" ';
                              echo form_dropdown('house_type_id',getSingleOptions('tbl_house_type','Select House Type',1),set_value("house_type_id"),$data);?>
                           <?=form_error('house_type_id'); ?>
                        </div>
                        <div class="form-group">
                           <label><?=getContentLanguageSelected('HOUSE_CATEGORY',defaultSelectedLanguage())?><span class="required">*</label>
                           <?php $data = ' class="form-control input" ';
                              echo form_dropdown('house_category_id',getSingleOptions('tbl_house_category','Select Category',1),set_value("house_category_id"),$data);?>
                           <?=form_error('house_category_id'); ?>
                        </div>
                        <div class="form-group">
                           <label><?=getContentLanguageSelected('Interval',defaultSelectedLanguage())?><span class="required">*</label>
                           <?php $data = ' class="form-control input" onChange = "setIntervalSelected_(this.value);" ';
                              echo form_dropdown('month_id',getMonthOptions('Select Month'),set_value("month_id"),$data);?>
                              <input type="hidden" class="form-control" name="selected_interval" id="selected_interval" placeholder="" value="">
                           <?=form_error('month_id'); ?>
                        </div>
                        <div class="form-group">
                           <label><?=getContentLanguageSelected('FROM',defaultSelectedLanguage())?><span class="required">*</label>
                           <input type="text"  class="form-control firstcal" name="from" placeholder="From" id="from_" value="<?php echo set_value('from') ?>">
                           <?=form_error('from'); ?>
                        </div>
                        <div class="form-group">
                           <label><?=getContentLanguageSelected('TO',defaultSelectedLanguage())?><span class="required">*</span></label>
                           <input type="text" readonly="" class="form-control secondcal" name="to"  placeholder="To" value="<?php echo set_value('to') ?>">
                           <?=form_error('to'); ?>
                        </div>
                     </div>
                     <div class="col-sm-6" >
                        <div class="form-group">
                           <label><?=getContentLanguageSelected('NUMBER_OF_ROOMS',defaultSelectedLanguage())?><span class="required">*</span></label>
                           <input type="text" class="form-control" name="room" id="room" placeholder=" Number Of Room" value="<?php echo set_value('room') ?>">
                           <?=form_error('room'); ?>
                        </div>
                        <div class="form-group">
                           <label><?=getContentLanguageSelected('VALUE_OF_CONTENT',defaultSelectedLanguage())?><span class="required">*</span></label>
                           <input type="text" class="form-control" name="content_value" id="content_value" placeholder=" Content Value" value="<?php echo set_value('content_value') ?>">
                           <?=form_error('content_value'); ?>
                        </div>
                        <div class="form-group">
                           <label><?=getContentLanguageSelected('VALUE_OF_BUILDING',defaultSelectedLanguage())?><span class="required">*</span></label>
                           <input type="text" class="form-control" name="building_value" id="building_value" placeholder=" Building Value" value="<?php echo set_value('building_value') ?>">
                           <?=form_error('building_value'); ?>
                        </div>
                        <div class="form-group">
                           <label><?=getContentLanguageSelected('MONTHLY_RENT',defaultSelectedLanguage())?><span class="required">*</span></label>
                           <input type="text" class="form-control" name="monthly_rent" id="monthly_rent" placeholder=" MONTHLY_RENT" value="<?php echo set_value('monthly_rent') ?>">
                           <?=form_error('monthly_rent'); ?>
                        </div>
                        <div class="form-group">
                           <label><?=getContentLanguageSelected('SUPERFICY',defaultSelectedLanguage())?><span class="required">*</label>
                           <input type="text" class="form-control" name="superficy" id="superficy" placeholder=" superficy" value="<?php echo set_value('superficy') ?>">
                           <?=form_error('superficy'); ?>
                        </div>
                        <div class="form-group">
                           <label><?= getContentLanguageSelected('ANY',defaultSelectedLanguage())?></label>
                           <textarea class="form-control" name="house_other_info" row="10" col="4"></textarea>
                        </div>
                     </div>
                     <div class="col-sm-10" >
                        <div class="reset-button">
                           <button class="btn btn-success"><?= getContentLanguageSelected('SAVE',defaultSelectedLanguage())?></button>
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