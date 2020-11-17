<div class="content-wrapper">
   <!-- Content Header (Page header) -->
   <section class="content-header">
      <div class="header-icon">
         <i class="pe-7s-note2"></i>
      </div>
      <div class="header-title">
         <h1><?=getContentLanguageSelected('PROFFESIONAL_MULTI_RISK_QUOTE',defaultSelectedLanguage())?></h1>
         <small><?=getContentLanguageSelected('PROFFESIONAL_MULTI_RISK_QUOTE_ADD',defaultSelectedLanguage())?></small>
         <ol class="breadcrumb hidden-xs">
            <li><a href="<?=base_url('admin/dashboard');?>"><i class="pe-7s-home"></i> <?=getContentLanguageSelected('HOME',defaultSelectedLanguage())?></a></li>
            <li class="active"><?=getContentLanguageSelected('PROFFESIONAL_MULTI_RISK_QUOTE',defaultSelectedLanguage())?></li>
         </ol>
      </div>
   </section>
   <!-- Main content -->
   <section class="content">
      <div class="row">
         <!-- Form controls -->
         <div class="col-sm-12">
            <div class="panel panel-bd">
               <div class="panel-body">
                  <form  method="post" enctype="multipart/form-data">
                     <div class="col-md-6" >
                        <div class="form-group">
                           <label><?=getContentLanguageSelected('NAME',defaultSelectedLanguage())?><span class="required">*</span></label>

                           <?php $data = ' class="form-control" input"  ';
                              echo form_dropdown('user_id',getEndUserOptions('tbl_users','Select Name',1),set_value("user_id"),$data);?>
                           <?=form_error('user_id'); ?>
                        </div>


                        <div class="form-group">
                           <label><?=getContentLanguageSelected('ADDRESS',defaultSelectedLanguage())?><span class="required">*</span></label>

                           <input type="text" class="form-control" id="site_location" name="address" placeholder="Address" value="<?=set_value('address'); ?>">
                           <?=form_error('address'); ?>
                        </div>


                        <div class="form-group">
                           <label><?=getContentLanguageSelected('BUSINESS_ADDRESS',defaultSelectedLanguage())?><span class="required">*</span></label>

                           <input type="text" class="form-control" id="site_location_business" name="business_address" placeholder="Business Address" value="<?=set_value('business_address'); ?>">
                           <?=form_error('business_address'); ?>
                        </div>

                        <div class="form-group">
                           <label><?=getContentLanguageSelected('CONTACT_NUMBER',defaultSelectedLanguage())?><span class="required">*</span></label>
                           <div  >
                              <input type="text" class="form-control" name="dial_code" id="dial_code" placeholder="Dial Code" readonly value="<?=getAreaCode() ?>"  style='display: inline; width: 17%;'>
                              <input type="text" class="form-control" name="mobile" id="mobile" placeholder="Enter Contact Number" value="<?php echo set_value('mobile') ?>"  style='display: inline; width: 82%;'>
                              <?=form_error('dial_code'); ?>
                              <?=form_error('mobile'); ?>
                           </div>
                        </div>

                        <div class="form-group">
                         <div class="control-group">
                            <label><?=getContentLanguageSelected('ATTACH_DOCUMENTS',defaultSelectedLanguage())?><span class="required">*</span></label>
                            <input type="file" name="attach_document" id="attach_document"/>
                         </div>
                        </div>  
                     
                        <div class="control-group">
                           <label><?=getContentLanguageSelected('TACIT_POLICY',defaultSelectedLanguage())?></label><br>
                           <label class="cus_radio">
                           <input type="radio" name="tacit_policy" value="1" >Yes</label>
                           <label class="cus_radio"><input type="radio" name="tacit_policy" checked="checked" value="0" >No</label>
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