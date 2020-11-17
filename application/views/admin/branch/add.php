<div class="content-wrapper">
   <!-- Content Header (Page header) -->
   <section class="content-header">
      <div class="header-icon">
         <i class="pe-7s-note2"></i>
      </div>
      <div class="header-title">
         <h1><?=getContentLanguageSelected('BRANCH',defaultSelectedLanguage())?></h1>
         <small><?=getContentLanguageSelected('BRANCH_ADD',defaultSelectedLanguage())?></small>
         <ol class="breadcrumb hidden-xs">
            <li><a href="<?=base_url('admin/dashboard');?>"><i class="pe-7s-home"></i> <?=getContentLanguageSelected('HOME',defaultSelectedLanguage())?></a></li>
            <li class="active"><?=getContentLanguageSelected('BRANCH',defaultSelectedLanguage())?></li>
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
                     <a class="btn btn-primary" href="<?=base_url('admin/branch/lists')?>"> <i class="fa fa-list"></i>  <?=getContentLanguageSelected('BRANCH_LIST',defaultSelectedLanguage())?></a>  
                  </div>
               </div>
               <div class="panel-body">
                  <form  method="post" enctype="multipart/form-data">
                     <div class="col-md-6" >
                        <div class="form-group">
                           <label><?=getContentLanguageSelected('NAME',defaultSelectedLanguage())?><span class="required">*</span></label>
                           <input type="text" class="form-control" name="name" id="name" placeholder="Branch Name" value="<?php echo set_value('name') ?>">
                           <?=form_error('name'); ?>
                        </div>
                     </div>                     
                     <div class="col-md-6" >
                        <div class="form-group">
                           <label><?=getContentLanguageSelected('COMPANY',defaultSelectedLanguage())?><span class="required">*</span></label>
                           <?php $data = 'class="form-control multiselect"';
                              echo form_multiselect('company_id[]',getMultipleOptions('tbl_company','Select Company',1),set_value("company_id[]"),$data);?>
                           <?=form_error('company_id[0]'); ?>
                        </div>
                     </div>
                     <div class="col-sm-12">
                        <div class="form-group">
                           <label><?=getContentLanguageSelected('DESCRIPTION',defaultSelectedLanguage())?></label>
                           <textarea class="form-control" name="description" placeholder="Description" id="description"  rows="10"><?=set_value('description', isset($dataCollection->notes)?$dataCollection->notes:""); ?></textarea>
                           <?=form_error('description'); ?>
                        </div>
                     </div>
                     <div class="col-sm-12">
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