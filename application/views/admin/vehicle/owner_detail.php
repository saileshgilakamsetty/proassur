<div class="content-wrapper">
<!-- Content Header (Page header) -->
<section class="content-header">
   <div class="header-icon">
      <i class="pe-7s-note2"></i>
   </div>
   <div class="header-title">
      <h1><?=getContentLanguageSelected('OWNER_DETAILS',defaultSelectedLanguage())?></h1>
      <small><?=getContentLanguageSelected('OWNER_DETAILS',defaultSelectedLanguage())?></small>
      <ol class="breadcrumb hidden-xs">
         <li><a href="<?=base_url('admin/dashboard');?>"><i class="pe-7s-home"></i> Home</a></li>
         <li class="active"><?=getContentLanguageSelected('OWNER_DETAILS',defaultSelectedLanguage())?></li>
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
                           <label><?=getContentLanguageSelected('OWNER_OF_VEHICLE',defaultSelectedLanguage())?>?<span class="required">*</span></label><br>
                           <label class="cus_radio">
                           <input type="radio" name="owner" value="1" checked="checked" vehicle_detail_id = "<?= $this->uri->segment(4) ?>" ><?=getContentLanguageSelected('YES',defaultSelectedLanguage())?></label>
                           <label class="cus_radio"><input type="radio" name="owner" value="0" vehicle_detail_id = "<?= $this->uri->segment(4) ?>" ><?=getContentLanguageSelected('NO',defaultSelectedLanguage())?></label>
                           <?=form_error('owner'); ?>
                        </div>
                     </div>                     
                     <div class="col-md-6" >
                        <div class="form-group">
               
                         <label><?=getContentLanguageSelected('NAME',defaultSelectedLanguage())?><span class="required">*</span></label>

                         <?php $data = ' class="form-control input" ';
                            echo form_dropdown('user_id',getCustomerUserOptions('tbl_users','Select User',1),set_value("user_id"),$data);?>
                         <?=form_error('user_id'); ?>
                                  
                        </div>

                        <div class="form-group">
                           <label><?=getContentLanguageSelected('ADDRESS',defaultSelectedLanguage())?><span class="required">*</span></label>
                           <input type="text" class="form-control" name="address" id="address" placeholder="Address" value="<?php echo set_value('address') ?>">
                           <?=form_error('address'); ?>
                        </div>

                        <div class="form-group">
                           <label><?=getContentLanguageSelected('OWNER_DETAIL_IMAGE',defaultSelectedLanguage())?></label>
                           <input type="file"  name="image" id="image"/>
                        </div>

                     </div>   

                     <div class="col-md-6" >


                                    <div class="form-group">
                                     <label><?=getContentLanguageSelected('REGION',defaultSelectedLanguage())?><span class="required">*</span></label>

                                     <?php $data = ' class="form-control input" onChange = "getDepartmentByRegionId(this.value);" ';
                                        echo form_dropdown('region_id',getRegionOptions('tbl_region','Select Region',1),set_value("region_id"),$data);?>
                                     <?=form_error('region_id'); ?>
                                  </div>

                                  <div class="form-group">
                                     <label><?=getContentLanguageSelected('DEPARTMENT',defaultSelectedLanguage())?><span class="required">*</span></label>

                                     <?php $data = ' class="form-control input" onChange = "getCommuneByDepartmentId(this.value);" id="department_by_region"';
                                        echo form_dropdown('department_id',getDepartmentByRegionId(set_value('region_id')),set_value("department_id"),$data);?>
                                     <?=form_error('department_id'); ?>
                                  </div>

                                  <div class="form-group">
                                     <label><?=getContentLanguageSelected('COMMUNE',defaultSelectedLanguage())?><span class="required">*</span></label>

                                     <?php $data = ' class="form-control input"  id="commune_by_department"';
                                        echo form_dropdown('commune_id',getCommuneByDepartmentId(set_value('region_id')),set_value("commune_id"),$data);?>
                                     <?=form_error('commune_id'); ?>
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