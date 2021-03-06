<div class="content-wrapper">
<!-- Content Header (Page header) -->
<section class="content-header">
   <div class="header-icon">
      <i class="pe-7s-note2"></i>
   </div>
   <div class="header-title">
      <h1><?=getContentLanguageSelected('OPTIONAL_FRANCHISE',defaultSelectedLanguage())?></h1>
      <small><?=getContentLanguageSelected('OPTIONAL_FRANCHISE',defaultSelectedLanguage())?></small>
      <ol class="breadcrumb hidden-xs">
         <li><a href="<?=base_url('admin/dashboard');?>"><i class="pe-7s-home"></i> <?=getContentLanguageSelected('HOME',defaultSelectedLanguage())?></a></li>
         <li class="active"><?=getContentLanguageSelected('OPTIONAL_FRANCHISE',defaultSelectedLanguage())?></li>
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
                           <?=form_error('value_selected_franchise'); ?>
                     <input type="hidden" id="value_selected_franchise" name="value_selected_franchise" value="">
                        <div class="control-group">
                           <label><?=getContentLanguageSelected('OPTIONAL_FRANCHISE_YOU_WANT',defaultSelectedLanguage())?>?<span class="required">*</span></label><br>
                           <label class="cus_radio">
                              <input type="radio" vehicle_detail_id="<?=$vehicle_detail_id?>" name="optional_franchise_want" value="1" checked="checked">Yes
                           </label>
                           <label class="cus_radio">
                              <input type="radio" vehicle_detail_id="<?=$vehicle_detail_id?>" name="optional_franchise_want" value="0" >No
                           </label>
                           <?=form_error('optional_franchise_want'); ?>
                        </div>
                     </div>                     
                     <div class="col-md-6" >
                     <?php
                     foreach ($optional_franchies as $value) { ?>
                     <input type="checkbox" name="selected_optional_franchise" id="selected_optional_franchise_<?=$value->id?>" value="<?=$value->id?>">
                           <label><?=getFranchiseName($value->franchise_name_id)?></label>
                        
                        
                     <?php }
                     ?>
                     

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