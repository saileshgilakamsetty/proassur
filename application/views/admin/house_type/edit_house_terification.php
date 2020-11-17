<div class="content-wrapper">
   <!-- Content Header (Page header) -->
   <section class="content-header">
      <div class="header-icon">
         <i class="pe-7s-note2"></i>
      </div>
      <div class="header-title">
         <h1><?=getContentLanguageSelected('EDIT_HOUSE_TARIFICATION',defaultSelectedLanguage())?> </h1>
         <small><?=getContentLanguageSelected('EDIT_HOUSE_TARIFICATION',defaultSelectedLanguage())?></small>
         <ol class="breadcrumb hidden-xs">
            <li><a href="<?=base_url('admin/dashboard');?>"><i class="pe-7s-home"></i> <?=getContentLanguageSelected('HOME',defaultSelectedLanguage())?></a></li>
            <li class="active"><?=getContentLanguageSelected('EDIT_HOUSE_TARIFICATION',defaultSelectedLanguage())?></li>
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
                     <a class="btn btn-primary" href="<?=base_url('admin/housingterification/list_house_tarification')?>"> <i class="fa fa-list"></i>  <?=getContentLanguageSelected('LIST_HOUSE_TARIFICATION',defaultSelectedLanguage())?></a>  
                  </div>
               </div>
               <div class="panel-body">
                  <form  method="post" enctype="multipart/form-data">
                     <div class="col-sm-6" >
                        <div class="form-group">
                           <label><?=getContentLanguageSelected('INSURER_QUALITY',defaultSelectedLanguage())?></label>


                           <?php $data = ' class="form-control input" ';
                           $insurer_quality_id = $dataCollection->insurer_quality_id;
                              echo form_dropdown('insurer_quality_id',getSingleOptions('tbl_insurer_quality','Select Insurer',1),set_value("insurer_quality_id",isset($insurer_quality_id)?$insurer_quality_id:""),$data);?>
                           <?=form_error('insurer_quality_id'); ?>
                        </div>
                        <div class="form-group">
                           <label><?=getContentLanguageSelected('MINIMUM_NUMBER_OF_ROOMS',defaultSelectedLanguage())?><span class="required">*</span></label>
                           <input type="text" class="form-control" name="minimum_room" id="minimum_room" placeholder="Minimum Number Of Room" value="<?php echo set_value('minimum_room',isset($dataCollection->minimum_room)?$dataCollection->minimum_room:'') ?>">
                           <?=form_error('minimum_room'); ?>
                        </div>
                        <div class="form-group">
                           <label><?=getContentLanguageSelected('MAXIMUM_NUMBER_OF_ROOMS',defaultSelectedLanguage())?><span class="required">*</span></label>
                           <input type="text" class="form-control" name="maximum_room" id="maximum_room" placeholder="Maximum Number Of Room" value="<?php echo set_value('maximum_room',isset($dataCollection->maximum_room)?$dataCollection->maximum_room:'') ?>">
                           <?=form_error('maximum_room'); ?>
                        </div>
                        <div class="form-group">
                           <label><?=getContentLanguageSelected('MINIMUM_VALUE_OF_CONTENT',defaultSelectedLanguage())?></label>
                           <input type="text" class="form-control" name="minimum_content_value" id="minimum_content_value" placeholder=" Content Value" value="<?php echo set_value('minimum_content_value',isset($dataCollection->minimum_content_value)?$dataCollection->minimum_content_value:'') ?>">
                           <?=form_error('minimum_content_value'); ?>
                        </div>
                        <div class="form-group">
                           <label><?=getContentLanguageSelected('MAXIMUM_VALUE_OF_CONTENT',defaultSelectedLanguage())?></label>
                           <input type="text" class="form-control" name="maximum_content_value" id="maximum_content_value" placeholder=" Content Value" value="<?php echo set_value('maximum_content_value',isset($dataCollection->maximum_content_value)?$dataCollection->maximum_content_value:'') ?>">
                           <?=form_error('maximum_content_value'); ?>
                        </div>
                        <div class="form-group">
                           <label><?=getContentLanguageSelected('MINIMUM_VALUE_OF_BUILDING',defaultSelectedLanguage())?></label>
                           <input type="text" class="form-control" name="minimum_building_value" id="minimum_building_value" placeholder=" Building Value" value="<?php echo set_value('minimum_building_value',isset($dataCollection->minimum_building_value)?$dataCollection->minimum_building_value:'') ?>">
                           <?=form_error('minimum_building_value'); ?>
                        </div>
                        <div class="form-group">
                           <label><?=getContentLanguageSelected('MAXIMIUM_VALUE_OF_BUILDING',defaultSelectedLanguage())?></label>
                           <input type="text" class="form-control" name="maximum_building_value" id="maximum_building_value" placeholder=" Building Value" value="<?php echo set_value('maximum_building_value',isset($dataCollection->maximum_building_value)?$dataCollection->maximum_building_value:'') ?>">
                           <?=form_error('maximum_building_value'); ?>
                        </div>
                        <div class="form-group">
                           <label><?=getContentLanguageSelected('MINIMUM_MONTHLY_RENT',defaultSelectedLanguage())?></label>
                           <input type="text" class="form-control" name="minimum_monthly_rent" id="minimum_monthly_rent" placeholder="Minimum MONTHLY_RENT" value="<?php echo set_value('minimum_monthly_rent',isset($dataCollection->minimum_monthly_rent)?$dataCollection->minimum_monthly_rent:'') ?>">
                           <?=form_error('minimum_monthly_rent'); ?>
                        </div>
                        <div class="form-group">
                           <label><?=getContentLanguageSelected('MAXIMUM_MONTHLY_RENT',defaultSelectedLanguage())?></label>
                           <input type="text" class="form-control" name="maximum_monthly_rent" id="maximum_monthly_rent" placeholder="Maximum MONTHLY_RENT" value="<?php echo set_value('maximum_monthly_rent',isset($dataCollection->maximum_monthly_rent)?$dataCollection->maximum_monthly_rent:'') ?>">
                           <?=form_error('maximum_monthly_rent'); ?>
                        </div>
                        <!-- <div class="form-group">
                           <label><?=getContentLanguageSelected('FROM',defaultSelectedLanguage())?></label>
                           <input type="text"  class="form-control firstcal" name="from" placeholder="From" id="from_" value="<?php echo set_value('from') ?>">
                           <?=form_error('from'); ?>
                        </div>

                        <div class="form-group">
                           <label><?=getContentLanguageSelected('TO',defaultSelectedLanguage())?></label>
                           <input type="text" readonly="" class="form-control secondcal" name="to"  placeholder="To" value="<?php echo set_value('to') ?>">
                           <?=form_error('to'); ?>
                        </div> -->
                     </div>
                     <div class="col-sm-6" >
                        <div class="form-group">
                           <label><?=getContentLanguageSelected('MINIMUM_SUPERFICY',defaultSelectedLanguage())?></label>
                           <input type="text" class="form-control" name="minimum_superficy" id="minimum_superficy" placeholder="Minimum Superficy" value="<?php echo set_value('minimum_superficy',isset($dataCollection->minimum_superficy)?$dataCollection->minimum_superficy:'') ?>">
                           <?=form_error('minimum_superficy'); ?>
                        </div>
                        <div class="form-group">
                           <label><?=getContentLanguageSelected('MAXIMUM_SUPERFICY',defaultSelectedLanguage())?></label>
                           <input type="text" class="form-control" name="maximum_superficy" id="maximum_superficy" placeholder="Maximum Superficy" value="<?php echo set_value('maximum_superficy',isset($dataCollection->maximum_superficy)?$dataCollection->maximum_superficy:'') ?>">
                           <?=form_error('maximum_superficy'); ?>
                        </div>
                        <div class="form-group">
                           <label><?=getContentLanguageSelected('HOUSE_TYPE',defaultSelectedLanguage())?></label>
                           <?php $data = ' class="form-control input" ';
                           $house_type_id = $dataCollection->house_type_id;
                              echo form_dropdown('house_type_id',getSingleOptions('tbl_house_type','Select House Type',1),set_value("house_type_id",isset($house_type_id)?$house_type_id:""),$data);?>
                           <?=form_error('house_type_id'); ?>
                        </div>
                        <div class="form-group">
                           <label><?=getContentLanguageSelected('HOUSE_CATEGORY',defaultSelectedLanguage())?></label>
                           <?php $data = ' class="form-control input" ';
                           $house_category_id = $dataCollection->house_category_id;
                              echo form_dropdown('house_category_id',getSingleOptions('tbl_house_category','Select Category',1),set_value("house_category_id",isset($house_category_id)?$house_category_id:""),$data);?>
                           <?=form_error('house_category_id'); ?>
                        </div>
                        <div class="form-group">
                           <label><?=getContentLanguageSelected('Interval',defaultSelectedLanguage())?></label>
                           <?php $data = ' class="form-control input" onChange = "setIntervalSelected_(this.value);" ';
                           $selected_interval = $dataCollection->month_id;
                              echo form_dropdown('month_id',getMonthOptions('Select Month'),set_value("month_id",isset($selected_interval)?$selected_interval:""),$data);?>
                              <input type="hidden" class="form-control" name="selected_interval" id="selected_interval" placeholder="" value="">
                           <?=form_error('month_id'); ?>
                        </div>
                        <div class="form-group">
                           <label><?=getContentLanguageSelected('COMPANY',defaultSelectedLanguage())?><span class="required">*</span>
                           </label>
                           <?php $data = ' class="form-control input" ';
                           $company_id = $dataCollection->company_id;
                              echo form_dropdown('company_id',getCompanyIdsByBranch(getHousingBranchId()),set_value("company_id",isset($company_id)?$company_id:""),$data);?>
                           <?=form_error('company_id'); ?>
                        </div>
                        <div class="form-group">
                           <label><?=getContentLanguageSelected('BRANCH',defaultSelectedLanguage())?><span class="required">*</span></label>

                           <input type="text" readonly="" class="form-control" name="branch_id" placeholder="From" id="branch_id" value="<?php echo getBranchName(getHousingBranchId()); ?>">
                           <?=form_error('branch_id'); ?>
                        </div>

                        <div class="form-group">
                           <label><?=getContentLanguageSelected('RISQUE',defaultSelectedLanguage())?><span class="required">*</span></label>
                           <?php $data = 'class="form-control" ';
                              $branchValue = $dataCollection->branch_id;
                              $risqueValue = $dataCollection->risque_id;
                              echo form_dropdown('risque_id',getRisqueByBranchId($branchValue),set_value("risque_id",isset($risqueValue)?$risqueValue:""),$data);
                           ?>
                        </div>

                        <div class="form-group">
                           <label><?=getContentLanguageSelected('AMOUNT',defaultSelectedLanguage())?><span class="required">*</span></label>
                           <input type="text" class="form-control" name="amount" id="amount" placeholder="Amount" value="<?=set_value('amount', isset($dataCollection->amount)?$dataCollection->amount:""); ?>">
                           <?=form_error('amount'); ?>
                        </div>

                     </div>

       
                     <div class="col-sm-10" >
                        <div class="form-check">
                           <label><?=getContentLanguageSelected('STATUS',defaultSelectedLanguage())?></label><br>
                           <label class="radio-inline">
                           <input type="radio" name="status" value="1" checked="checked"><?=getContentLanguageSelected('ACTIVE',defaultSelectedLanguage())?></label>
                           <label class="radio-inline"><input type="radio" name="status" value="0" ><?=getContentLanguageSelected('INACTIVE',defaultSelectedLanguage())?></label>
                        </div>
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
   <!-- /.content -->
</div>