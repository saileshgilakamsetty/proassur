<div class="content-wrapper">
   <!-- Content Header (Page header) -->
   <section class="content-header">
      <div class="header-icon">
         <i class="pe-7s-note2"></i>
      </div>
      <div class="header-title">
         <h1><?=getContentLanguageSelected('HEALTH_INSURANCE_QUOTE',defaultSelectedLanguage())?> </h1>
         <small><?=getContentLanguageSelected('HEALTH_INSURANCE_QUOTE',defaultSelectedLanguage())?></small>
         <ol class="breadcrumb hidden-xs">
            <li><a href="<?=base_url('admin/dashboard');?>"><i class="pe-7s-home"></i> <?=getContentLanguageSelected('HOME',defaultSelectedLanguage())?></a></li>
            <li class="active"><?=getContentLanguageSelected('HEALTH_INSURANCE_QUOTE',defaultSelectedLanguage())?></li>
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
                     <a class="btn btn-primary" href="<?=base_url('admin/health-insurance-quote/lists')?>"> <i class="fa fa-list"></i>  <?=getContentLanguageSelected('HEALTH_INSURANCE_QUOTE_LIST',defaultSelectedLanguage())?></a>  
                  </div>
               </div>
               <div class="panel-body">
                  <form  method="post" enctype="multipart/form-data">
                     <div class="col-sm-6" >
                        <div class="form-group">
                           <label><?=getContentLanguageSelected('COMPANY',defaultSelectedLanguage())?><span class="required">*</span></label>
                           <?php $data = ' class="form-control input" ';
                              echo form_dropdown('company_id',getCompanyOptions('tbl_company','Select Company',1),set_value("company_id"),$data);?>
                           <?=form_error('company_id'); ?>
                        </div>
                        <div class="form-group">
                           <label><?=getContentLanguageSelected('ZONE',defaultSelectedLanguage())?><span class="required">*</span></label>
                           <?php $data = 'id="zone_id" onchange=getAreaByZoneId(this.value) class="form-control input" ';
                              echo form_dropdown('zone_id',getZoneOptions('Select Zone'),set_value("zone_id"),$data);?>
                           <?=form_error('zone_id'); ?>
                        </div>

                        <div class="form-group">
                           <label><?=getContentLanguageSelected('MINIMUM_DAYS',defaultSelectedLanguage())?><span class="required">*</span></label>
                           <input type="text" class="form-control" name="min_days" id="min_days" placeholder="Minimum Days" value="<?php echo set_value('min_days') ?>">
                           <?=form_error('min_days'); ?>
                        </div>
                        <div class="form-group">
                           <label><?=getContentLanguageSelected('MAXIMUM_DAYS',defaultSelectedLanguage())?><span class="required">*</span></label>
                           <input type="text" class="form-control" name="max_days" id="max_days" placeholder="Maximum Days" value="<?php echo set_value('max_days') ?>">
                           <?=form_error('max_days'); ?>
                        </div>
                        
                        <div class="form-group">
                           <label><?=getContentLanguageSelected('AREA',defaultSelectedLanguage())?><span class="required">*</span></label>

                           <?php $data = 'class="form-control " id="area_id"';
                              echo form_dropdown('area_id',getAreaByZoneId(set_value('zone_id')),set_value("area_id"),$data);?>
                           <?=form_error('area_id'); ?>
                        </div>

                     </div>
                     <div class="col-sm-6" >
                        <div class="form-group">
                           <label><?=getContentLanguageSelected('CHILD_BELOW_AGE',defaultSelectedLanguage())?><span class="required">*</span></label>
                           <input type="text" class="form-control" name="child_below_age" id="child_below_age" placeholder="Child Below Age" value="<?php echo set_value('child_below_age') ?>">
                           <?=form_error('child_below_age'); ?>
                        </div>
                        <div class="form-group">
                           <label><?=getContentLanguageSelected('AMOUNT_CHILD_BELOW_AGE',defaultSelectedLanguage())?><span class="required">*</span></label>
                           <input type="text" class="form-control" name="amount_child_below_age" id="amount_child_below_age" placeholder="Amount Child Below Age" value="<?php echo set_value('amount_child_below_age') ?>">
                           <?=form_error('amount_child_below_age'); ?>
                        </div>

                        <div class="form-group">
                           <label><?=getContentLanguageSelected('ADULT_ABOVE_AGE',defaultSelectedLanguage())?><span class="required">*</span></label>
                           <input type="text" class="form-control" name="adult_above_age" id="adult_above_age" placeholder="Adult Above Age" value="<?php echo set_value('adult_above_age') ?>">
                           <?=form_error('adult_above_age'); ?>
                        </div>
                        <div class="form-group">
                           <label><?=getContentLanguageSelected('AMOUNT_ADULT_ABOVE_AGE',defaultSelectedLanguage())?><span class="required">*</span></label>
                           <input type="text" class="form-control" name="amount_adult_above_age" id="amount_adult_above_age" placeholder="Amount Child Below Age" value="<?php echo set_value('amount_adult_above_age') ?>">
                           <?=form_error('amount_adult_above_age'); ?>
                        </div>
                        <div class="form-group">
                           <label><?=getContentLanguageSelected('SURPRIME_ABOVE_AGE',defaultSelectedLanguage())?><span class="required">*</span></label>
                           <input type="text" class="form-control" name="surprime_above_age" id="surprime_above_age" placeholder="Surprime Above Age" value="<?php echo set_value('surprime_above_age') ?>">
                           <?=form_error('surprime_above_age'); ?>
                        </div>
                        <div class="form-group">
                           <label><?=getContentLanguageSelected('AMOUNT_SURPRIME_ABOVE_AGE',defaultSelectedLanguage())?><span class="required">*</span></label>
                           <input type="text" class="form-control" name="amount_surprime_above_age" id="amount_surprime_above_age" placeholder="Amount Surprime Above Age" value="<?php echo set_value('amount_surprime_above_age') ?>">
                           <?=form_error('amount_surprime_above_age'); ?>
                        </div>
                     </div>
                     <div class="col-sm-10">
                        <div class="form-group">
                           <label><?=getContentLanguageSelected('DESCRIPTION',defaultSelectedLanguage())?><span class="required">*</span></label>
                           <textarea class="form-control " name="description" id="description" placeholder="Description" rows="10"><?php echo set_value('description') ?></textarea>
                           <?=form_error('description'); ?>
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