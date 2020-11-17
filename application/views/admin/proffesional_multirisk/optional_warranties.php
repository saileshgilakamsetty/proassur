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
                              <input type="radio" proffesional_multirisk_quote_id="<?=$proffesional_multirisk_quote_id?>" name="optional_warranty_want_proffesional_multirisk" value="1" checked="checked">Yes
                           </label>
                           <label class="cus_radio">
                              <input type="radio" proffesional_multirisk_quote_id="<?=$proffesional_multirisk_quote_id?>" name="optional_warranty_want_proffesional_multirisk" value="0" >No
                           </label>
                           <?=form_error('optional_warranty_want_proffesional_multirisk'); ?>
                        </div>
                     </div>                     
                     <div class="col-md-6" >
                        <?=form_error('value_selected_proffesional_multirisk_warranty'); ?>
                        <input type="hidden" id="value_selected_proffesional_multirisk_warranty" name="value_selected_proffesional_multirisk_warranty" value="">
                        <?php
                        foreach ($optional_warranties as $value) { ?>
                           <div class="form-group">
                            <input type="checkbox" name="optional_warranties_proffesional_multirisk" id="<?=$value->id?>" placeholder="Name" value="<?=$value->id?>">
                            <?=getWarrantyName($value->warranty_name_id)?>
                           </div>
                        <?php }
                        ?>
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