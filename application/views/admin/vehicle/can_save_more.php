<style type="text/css">
   td.make_bold {
    font-weight: bold;
}
</style>


<div class="content-wrapper">
   
   <section class="content-header">
      <div class="header-icon">
         <i class="pe-7s-box1"></i>
      </div>
      <div class="header-title">
         <h1><?=getContentLanguageSelected('CAN_SAVE_MORE',defaultSelectedLanguage())?></h1>
         <small><?=getContentLanguageSelected('CAN_SAVE_MORE',defaultSelectedLanguage())?></small>
         <ol class="breadcrumb hidden-xs">
            <li><a href="<?=base_url('admin/dashboard');?>"><i class="pe-7s-home"></i><?=getContentLanguageSelected('HOME',defaultSelectedLanguage())?></a></li>
            <li class="active"><?=getContentLanguageSelected('CAN_SAVE_MORE',defaultSelectedLanguage())?></li>
         </ol>
      </div>
   </section>
  
   <section class="content">
      <div class="row">
         <div class="col-sm-12">
            <?php $success= $this->session->flashdata('message'); 
               if(!empty($success)) { ?>
            <div class="panel panel-success">
               <div class="panel-heading">
                  <?php echo $this->session->flashdata('message'); ?>
               </div>
            </div>
            <?php } ?>
            <div class="panel panel-bd">
               <div class="panel-heading">
                  <form  method="post" enctype="multipart/form-data">
                     <input type="hidden" id="vehicle_detail_id" name="vehicle_detail_id" value=<?=$vehicle_detail_id?> >
                     <input type="hidden" id="warranties_selected" name="warranties_selected" value=<?=implode(",",$selected_warranty_name_id)?> >
                     <input type="hidden" id="franchises_selected" name="franchises_selected" value=<?=implode(",",$selected_francise_name_id)?> >
                     <input type="hidden" id="total_estimation" name="total_estimation" value="">
                     <div class="form-group">
                        <label><?=getContentLanguageSelected('SELECT_COMPANIES',defaultSelectedLanguage())?><span class="required">*</span></label>
                        <?php $data = 'class="form-control multiselect"';
                        $company_id = $company_id;
                           echo form_multiselect('company_id[]',getMultipleOptions('tbl_company','Select Company',1),set_value("company_id[]",$company_id),$data);?>
                        <?=form_error('company_id[0]'); ?>
                     </div>
                        <div class="reset-button">
                           <button class="btn btn-success" id="get_the_value"><?=getContentLanguageSelected('SUBMIT',defaultSelectedLanguage())?></button>
                        </div>
                        </form>
                    
                        <div class="reset-button">
                           <button class="btn btn-success" id="finalize_company"><?=getContentLanguageSelected('FINALIZE_COMPANY',defaultSelectedLanguage())?></button>
                        </div>    
                                </div>
<?php
print_r($qwerty);
?>

            </div>
         </div>
      </div>
   </section>
</div>
