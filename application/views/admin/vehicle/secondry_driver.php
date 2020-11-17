<div class="content-wrapper">
<!-- Content Header (Page header) -->
<section class="content-header">
   <div class="header-icon">
      <i class="pe-7s-note2"></i>
   </div>
   <div class="header-title">
      <h1><?=getContentLanguageSelected('SECONDRY_DRIVER',defaultSelectedLanguage())?></h1>
      <small><?=getContentLanguageSelected('SECONDRY_DRIVER',defaultSelectedLanguage())?></small>
      <ol class="breadcrumb hidden-xs">
         <li><a href="<?=base_url('admin/dashboard');?>"><i class="pe-7s-home"></i> <?=getContentLanguageSelected('HOME',defaultSelectedLanguage())?></a></li>
         <li class="active"><?=getContentLanguageSelected('SECONDRY_DRIVER',defaultSelectedLanguage())?></li>
      </ol>
   </div>
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
               <div class="panel-body">
                  <form  method="post" enctype="multipart/form-data">
                     <div class="col-md-12" >
                        <div class="control-group">
                           <label><?=getContentLanguageSelected('DECLARE_SECONDRY_DRIVER',defaultSelectedLanguage())?>?<span class="required">*</span></label><br>
                           <label class="cus_radio">
                           <input type="radio" name="owner" vehicle_detail_id= "<?=$vehicle_detail_id?>" value="1" checked="checked"><?=getContentLanguageSelected('YES',defaultSelectedLanguage())?></label>
                           <label class="cus_radio"><input type="radio" name="owner" vehicle_detail_id= "<?=$vehicle_detail_id?>" value="0" ><?=getContentLanguageSelected('NO',defaultSelectedLanguage())?></label>
                           <?=form_error('owner'); ?>
                        </div>
                     </div>                     
                     <div class="col-md-6" >
                        <div class="form-group">
               
                         <label><?=getContentLanguageSelected('NAME_VEHICLE_DRIVER',defaultSelectedLanguage())?><span class="required">*</span></label>

                        <input type="text" class="form-control" name="name" id="name" placeholder="<?=getContentLanguageSelected('NAME_VEHICLE_DRIVER',defaultSelectedLanguage())?>" value="<?php echo set_value('name') ?>">

                           <?=form_error('name'); ?>
                                  
                        </div>

                        <div class="form-group">
                           <label><?=getContentLanguageSelected('ISSUE_DATE_LICENSE',defaultSelectedLanguage())?><span class="required">*</span></label>
                           <input type="text" class="form-control" name="issue_date_license" id="issue_date_license" placeholder="<?=getContentLanguageSelected('ISSUE_DATE_LICENSE',defaultSelectedLanguage())?>" value="<?php echo set_value('issue_date_license') ?>">
                           <?=form_error('issue_date_license'); ?>
                        </div>

                        <div class="form-group">
                           <label><?=getContentLanguageSelected('YEARS_FOR_LICENSE_EXPIRE',defaultSelectedLanguage())?><span class="required">*</span></label>
                           <input type="text" class="form-control" name="year_license_expire" id="year_license_expire" placeholder="<?=getContentLanguageSelected('YEARS_FOR_LICENSE_EXPIRE',defaultSelectedLanguage())?>" value="<?php echo set_value('year_license_expire') ?>">
                           <?=form_error('year_license_expire'); ?>
                        </div>
                     </div>   
                     <div class="col-md-6" >
                        <div class="form-group">
                           <label><?=getContentLanguageSelected('LICENSE_NUMBER',defaultSelectedLanguage())?><span class="required">*</span></label>
                           <input type="text" class="form-control" name="license_number" id="license_number" placeholder="<?=getContentLanguageSelected('LICENSE_NUMBER',defaultSelectedLanguage())?>" value="<?php echo set_value('license_number') ?>">
                           <?=form_error('license_number'); ?>
                        </div>

                          <div class="form-group">
                           <label><?=getContentLanguageSelected('PERMIT',defaultSelectedLanguage())?><span class="required">*</span></label>

                          <?php $data = 'class="form-control" id="permit_id" ';
                          echo form_dropdown('permit_id',getVehiclePermitOption('tbl_vehicle_permit','Select Permit',1),set_value("permit_id"),$data);?>
                              <?=form_error('permit_id'); ?>
                        </div>
                        <div class="control-group">
                           <label><?=getContentLanguageSelected('DOUBLE_COMMAND',defaultSelectedLanguage())?><span class="required">*</span></label><br>
                           <label class="cus_radio">
                           <input type="radio" name="double_command" value="1" checked="checked"><?=getContentLanguageSelected('YES',defaultSelectedLanguage())?></label>
                           <label class="cus_radio"><input type="radio" name="double_command" value="0" ><?=getContentLanguageSelected('NO',defaultSelectedLanguage())?></label>
                           <?=form_error('double_command'); ?>
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