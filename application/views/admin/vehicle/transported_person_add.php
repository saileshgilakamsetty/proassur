<div class="content-wrapper">
   <!-- Content Header (Page header) -->
   <section class="content-header">
      <div class="header-icon">
         <i class="pe-7s-note2"></i>
      </div>
      <div class="header-title">
         <h1><?=getContentLanguageSelected('TRANSPORTED_PERSON',defaultSelectedLanguage())?></h1>
         <small><?=getContentLanguageSelected('TRANSPORTED_PERSON_ADD',defaultSelectedLanguage())?></small>
         <ol class="breadcrumb hidden-xs">
            <li><a href="<?=base_url('admin/dashboard');?>"><i class="pe-7s-home"></i> <?=getContentLanguageSelected('HOME',defaultSelectedLanguage())?></a></li>
            <li class="active"><?=getContentLanguageSelected('TRANSPORTED_PERSON',defaultSelectedLanguage())?></li>
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
                     <a class="btn btn-primary" href="<?=base_url('admin/vehicle/transported-person')?>"> <i class="fa fa-list"></i><?=getContentLanguageSelected('TRANSPORTED_PERSON_LIST',defaultSelectedLanguage())?></a>  
                  </div>
               </div>
               <div class="panel-body">
                  <form  method="post" enctype="multipart/form-data">
                     <div class="col-md-6" >


                           <div class="form-group">
                           <label><?=getContentLanguageSelected('COMPANY',defaultSelectedLanguage())?><span class="required">*</span></label>

                           <?php $data = ' class="form-control input" onChange = "getBranchByCompanyId(this.value);" ';
                              echo form_dropdown('company_id',getCompanyOptions('tbl_company','Select Company',1),set_value("company_id"),$data);?>
                           <?=form_error('company_id'); ?>
                        </div>

                        <div class="form-group">
                           <label><?=getContentLanguageSelected('TITLE',defaultSelectedLanguage())?><span class="required">*</span></label>
                           <input type="text" class="form-control" name="title" id="title" placeholder="Title" value="<?php echo set_value('title') ?>">
                           <?=form_error('title'); ?>
                        </div>

                        <div class="form-group">
                           <label><?=getContentLanguageSelected('AMOUNT_TO_PAY',defaultSelectedLanguage())?><span class="required">*</span></label>
                           <input type="text" class="form-control" name="amount_to_pay" id="amount_to_pay" placeholder="amount to pay" value="<?php echo set_value('amount_to_pay') ?>">
                           <?=form_error('amount_to_pay'); ?>
                        </div>                        

                        <div class="form-group">
                           <label><?=getContentLanguageSelected('DEATH',defaultSelectedLanguage())?><span class="required">*</span></label>
                           <input type="text" class="form-control" name="death" id="death" placeholder="death" value="<?php echo set_value('death') ?>">
                           <?=form_error('death'); ?>
                        </div>

                        <div class="form-group">
                           <label><?=getContentLanguageSelected('DISABILITY',defaultSelectedLanguage())?><span class="required">*</span></label>
                           <input type="text" class="form-control" name="disability" id="disability" placeholder="Disability" value="<?php echo set_value('disability') ?>">
                           <?=form_error('disability'); ?>
                        </div>

                        <div class="form-group">
                           <label><?=getContentLanguageSelected('MEDICAL_FEES',defaultSelectedLanguage())?><span class="required">*</span></label>
                           <input type="text" class="form-control" name="medical_fees" id="medical_fees" placeholder="medical fees" value="<?php echo set_value('medical_fees') ?>">
                           <?=form_error('medical_fees'); ?>
                        </div>
                     

                     
                        <div class="control-group">
                           <label><?=getContentLanguageSelected('STATUS',defaultSelectedLanguage())?></label><br>
                           <label class="cus_radio">
                           <input type="radio" name="status" value="1" checked="checked"><?=getContentLanguageSelected('ACTIVE',defaultSelectedLanguage())?></label>
                           <label class="cus_radio"><input type="radio" name="status" value="0" ><?=getContentLanguageSelected('INACTIVE',defaultSelectedLanguage())?></label>
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