<div class="content-wrapper">
   <!-- Content Header (Page header) -->
   <section class="content-header">
      <div class="header-icon">
         <i class="pe-7s-note2"></i>
      </div>
      <div class="header-title">
         <h1><?=getContentLanguageSelected('VEHICLE_TYPE',defaultSelectedLanguage())?></h1>
         <small><?=getContentLanguageSelected('VEHICLE_TYPE_ADD',defaultSelectedLanguage())?></small>
         <ol class="breadcrumb hidden-xs">
            <li><a href="<?=base_url('admin/dashboard');?>"><i class="pe-7s-home"></i> <?=getContentLanguageSelected('HOME',defaultSelectedLanguage())?></a></li>
            <li class="active"><?=getContentLanguageSelected('VEHICLE_TYPE',defaultSelectedLanguage())?></li>
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
                     <a class="btn btn-primary" href="<?=base_url('admin/vehicle/vehicle-type')?>"> <i class="fa fa-list"></i> <?=getContentLanguageSelected('VEHICLE_TYPE_LIST',defaultSelectedLanguage())?></a>  
                  </div>
               </div>
               <div class="panel-body">
                  <form  method="post" enctype="multipart/form-data">
                     <div class="col-md-6" >
                        <div class="form-group">
                           <label><?=getContentLanguageSelected('NAME',defaultSelectedLanguage())?><span class="required">*</span></label>
                           <input type="text" class="form-control" name="name" id="name" placeholder="Name" value="<?php echo set_value('name') ?>">
                           <?=form_error('name'); ?>
                        </div>

                        <div class="form-group">
                           <label><?=getContentLanguageSelected('TARIFF_CODE',defaultSelectedLanguage())?><span class="required">*</span></label>
                           <input type="text" class="form-control" name="tariff_code" id="tariff_code" placeholder="Tariff Code" value="<?php echo set_value('tariff_code') ?>">
                           <?=form_error('tariff_code'); ?>
                        </div>


                        <div class="form-group">
                          <label><?=getContentLanguageSelected('USAGE',defaultSelectedLanguage())?><span class="required">*</span></label>
                          <?php $data = 'class="form-control" id="usage_id" ';
                          echo form_dropdown('usage_id',getSingleOptions('tbl_usage','Select Usage',1),set_value("usage_id"),$data);?>
                              <?=form_error('usage_id'); ?>
                      </div>
                     
                        <div class="form-group">
                           <label><?=getContentLanguageSelected('DESCRIPTION',defaultSelectedLanguage())?></label>
                           <textarea class="form-control" name="description" placeholder="Description" id="description"  rows="10"><?=set_value('description', isset($dataCollection->notes)?$dataCollection->notes:""); ?></textarea>
                           <?=form_error('description'); ?>
                        </div>
                     
                        <div class="control-group">
                           <label>Status</label><br>
                           <label class="cus_radio">
                           <input type="radio" name="status" value="1" checked="checked">Active</label>
                           <label class="cus_radio"><input type="radio" name="status" value="0" >InActive</label>
                        </div>



                     </div>                     

                     <div class="col-md-12" >
                        <div class="reset-button">
                           <button class="btn btn-success">Save</button>
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