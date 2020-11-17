<div class="content-wrapper">
<!-- Content Header (Page header) -->
<section class="content-header">
   <div class="header-icon">
      <i class="pe-7s-note2"></i>
   </div>
   <div class="header-title">
      <h1><?=getContentLanguageSelected('OPTIONAL_WARRANTIES',defaultSelectedLanguage())?></h1>
      <small><?=getContentLanguageSelected('OPTIONAL_WARRANTIES',defaultSelectedLanguage())?></small>
      <ol class="breadcrumb hidden-xs">
         <li><a href="<?=base_url('admin/dashboard');?>"><i class="pe-7s-home"></i> <?=getContentLanguageSelected('HOME',defaultSelectedLanguage())?></a></li>
         <li class="active"><?=getContentLanguageSelected('OPTIONAL_WARRANTIES',defaultSelectedLanguage())?></li>
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
<section class="content">
   <div class="row">
      <div class="col-sm-12">
         <div class="panel panel-bd">
            <div class="panel-heading">
               <div class="panel-body">
                  <form  method="post" enctype="multipart/form-data">
                     <div class="col-md-12" >
                        <div class="control-group">
                           <label><?=getContentLanguageSelected('OPTIONAL_WARRANTIES_YOU_WANT',defaultSelectedLanguage())?>?<span class="required">*</span></label><br>
                           <label class="cus_radio">
                              <input type="radio" credit_detail_id="<?=$credit_detail_id?>" name="optional_warranty_want_credit" value="1" checked="checked"><?=getContentLanguageSelected('YES',defaultSelectedLanguage())?>
                           </label>
                           <label class="cus_radio">
                              <input type="radio" credit_detail_id="<?=$credit_detail_id?>" name="optional_warranty_want_credit" value="0" ><?=getContentLanguageSelected('NO',defaultSelectedLanguage())?>
                           </label>
                           <?=form_error('optional_warranty_want_credit'); ?>
                        </div>
                     </div>                     
                     <div class="col-md-6" >
                        <?=form_error('value_selected_credit_warranty'); ?><br>
                        <label><?=getContentLanguageSelected('WARRANTIES',defaultSelectedLanguage())?></label><br>
                        <input type="hidden" id="value_selected_credit_warranty" name="value_selected_credit_warranty" value="">
                        <label><?=getContentLanguageSelected('MANDATORY_WARRANTIES',defaultSelectedLanguage())?></label>
                        <div class="form-group">
                           <?php
                           foreach ($optional_warranties as $value) { 
                              if($value->type_of_warranties_id == 0) { ?>
                                 <input type="checkbox" name="optional_warranties_credit" id="<?=$value->id?>" type_of_warranties_id="<?= $value->type_of_warranties_id?>" placeholder="Name" value="<?=$value->id?>">
                                 <?=getWarrantyName($value->warranty_name_id)?>
                              <?php }
                           } ?>
                        </div> 

                        <label><?=getContentLanguageSelected('OPTIONAL_WARRANTIES',defaultSelectedLanguage())?></label>
                        <div class="form-group">
                           <?php
                           foreach ($optional_warranties as $value) { 
                              if($value->type_of_warranties_id == 1) { ?>
                              <input type="checkbox" name="optional_warranties_credit" id="<?=$value->id?>" type_of_warranties_id="<?= $value->type_of_warranties_id?>" placeholder="Name" value="<?=$value->id?>">
                              <?=getWarrantyName($value->warranty_name_id)?>
                              <?php }
                           } ?> 
                        </div> 

                        
                        <label><?=getContentLanguageSelected('EXCLUSION_OF_WARRANTIES',defaultSelectedLanguage())?></label>
                        <div class="form-group">
                           <?php
                           foreach ($optional_warranties as $value) { 
                              if($value->type_of_warranties_id == 2) { ?>
                                 
                                 <input type="checkbox" name="optional_warranties_credit" id="<?=$value->id?>" type_of_warranties_id="<?= $value->type_of_warranties_id?>" placeholder="Name" value="<?=$value->id?>">
                                 <?=getWarrantyName($value->warranty_name_id)?>
                                 <?php 
                              } 
                           }
                           ?>
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