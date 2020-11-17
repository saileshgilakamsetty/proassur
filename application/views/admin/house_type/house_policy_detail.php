<div class="content-wrapper">
   <!-- Content Header (Page header) -->
   <section class="content-header">
      <div class="header-icon">
         <i class="pe-7s-note2"></i>
      </div>
      <div class="header-title">
         <h1><?=getContentLanguageSelected('HOUSE_POLICIES',defaultSelectedLanguage())?></h1>
         <small><?=getContentLanguageSelected('HOUSE_POLICIES_EDIT',defaultSelectedLanguage())?></small>
         <ol class="breadcrumb hidden-xs">
            <li><a href="<?=base_url('admin/dashboard');?>"><i class="pe-7s-home"></i> <?=getContentLanguageSelected('HOME',defaultSelectedLanguage())?></a></li>
            <li class="active"><?=getContentLanguageSelected('HOUSE_POLICIES_EDIT',defaultSelectedLanguage())?></li>
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
               <!-- <div class="panel-heading">
                  <div class="btn-group"> 
                     <a class="btn btn-primary" href="<?=base_url('admin/housingterification/list_house_tarification')?>"> <i class="fa fa-list"></i>  <?=getContentLanguageSelected('HOUSE',defaultSelectedLanguage())?></a>  
                  </div>
               </div> -->
               <div class="panel-body">
                  <form  method="post" enctype="multipart/form-data">
                     <div class="col-sm-6" >
                        <div class="form-group">
                           <label><?=getContentLanguageSelected('POLICY_NUMBER',defaultSelectedLanguage())?><span class="required">*</span></label>
                           <input type="text" class="form-control" id="policy_number" name="policy_number" placeholder="Policy Number" value="<?=set_value('policy_number',isset($policy_number)?$policy_number:''); ?>">
                           <?=form_error('policy_number'); ?>
                        </div>
                        <div class="form-group">
                           <label><?=getContentLanguageSelected('INSURER_QUALITY',defaultSelectedLanguage())?></label>
                           <?php $data = ' class="form-control input" ';
                              echo form_dropdown('insurer_quality_id',getSingleOptions('tbl_insurer_quality','Select Insurer',1),set_value("insurer_quality_id",isset($house_detail['insurer_quality_id'])?$house_detail['insurer_quality_id']:''),$data);?>
                           <?=form_error('insurer_quality_id'); ?>
                        </div>

                        <div class="form-group">
                           <label><?=getContentLanguageSelected('HOUSE_TYPE',defaultSelectedLanguage())?></label>
                           <?php $data = ' class="form-control input" ';
                              echo form_dropdown('house_type_id',getSingleOptions('tbl_house_type','Select House Type',1),set_value("house_type_id",isset($house_detail['house_type_id'])?$house_detail['house_type_id']:''),$data);?>
                           <?=form_error('house_type_id'); ?>
                        </div>
                        <div class="form-group">
                           <label><?=getContentLanguageSelected('HOUSE_CATEGORY',defaultSelectedLanguage())?></label>
                           <?php $data = ' class="form-control input" ';
                              echo form_dropdown('house_category_id',getSingleOptions('tbl_house_category','Select Category',1),set_value("house_category_id",isset($house_detail['house_category_id'])?$house_detail['house_category_id']:''),$data);?>
                           <?=form_error('house_category_id'); ?>
                        </div>
                        <div class="form-group">
                           <label><?=getContentLanguageSelected('Interval',defaultSelectedLanguage())?></label>
                           <?php $data = ' class="form-control input" onChange = "setIntervalSelected_(this.value);" ';
                              echo form_dropdown('month_id',getMonthOptions('Select Month'),set_value("month_id",isset($house_detail['month_id'])?$house_detail['month_id']:''),$data);?>
                              <input type="hidden" class="form-control" name="selected_interval" id="selected_interval" placeholder="" value="">
                           <?=form_error('month_id'); ?>
                        </div>
                     </div>
                     <div class="col-sm-6" >
                        <div class="form-group">
                           <label><?=getContentLanguageSelected('NUMBER_OF_ROOMS',defaultSelectedLanguage())?></label>
                           <input type="text" class="form-control" name="room" id="room" placeholder=" Number Of Room" value="<?php echo set_value('room',isset($house_detail['room'])?$house_detail['room']:'') ?>">
                           <?=form_error('room'); ?>
                        </div>
                        <div class="form-group">
                           <label><?=getContentLanguageSelected('VALUE_OF_CONTENT',defaultSelectedLanguage())?></label>
                           <input type="text" class="form-control" name="content_value" id="content_value" placeholder=" Content Value" value="<?php echo set_value('content_value',isset($house_detail['content_value'])?$house_detail['content_value']:'') ?>">
                           <?=form_error('content_value'); ?>
                        </div>
                        <div class="form-group">
                           <label><?=getContentLanguageSelected('VALUE_OF_BUILDING',defaultSelectedLanguage())?></label>
                           <input type="text" class="form-control" name="building_value" id="building_value" placeholder=" Building Value" value="<?php echo set_value('building_value',isset($house_detail['building_value'])?$house_detail['building_value']:'') ?>">
                           <?=form_error('building_value'); ?>
                        </div>
                        <div class="form-group">
                           <label><?=getContentLanguageSelected('MONTHLY_RENT',defaultSelectedLanguage())?></label>
                           <input type="text" class="form-control" name="monthly_rent" id="monthly_rent" placeholder=" MONTHLY_RENT" value="<?php echo set_value('monthly_rent',isset($house_detail['monthly_rent'])?$house_detail['monthly_rent']:'') ?>">
                           <?=form_error('monthly_rent'); ?>
                        </div>
                        <div class="form-group">
                           <label><?=getContentLanguageSelected('SUPERFICY',defaultSelectedLanguage())?></label>
                           <input type="text" class="form-control" name="superficy" id="superficy" placeholder=" superficy" value="<?php echo set_value('superficy',isset($house_detail['superficy'])?$house_detail['superficy']:'') ?>">
                           <?=form_error('superficy'); ?>
                        </div>
                     </div>
                     <div class="col-sm-10" >
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