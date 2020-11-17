<div class="content-wrapper">
   <!-- Content Header (Page header) -->
   <section class="content-header">
      <div class="header-icon">
         <i class="pe-7s-note2"></i>
      </div>
      <div class="header-title">
         <h1><?=getContentLanguageSelected('EXAMINATION',defaultSelectedLanguage())?> </h1>
         <small><?=getContentLanguageSelected('EXAMINATION',defaultSelectedLanguage())?></small>
         <ol class="breadcrumb hidden-xs">
            <li><a href="<?=base_url('admin/dashboard');?>"><i class="pe-7s-home"></i> <?=getContentLanguageSelected('HOME',defaultSelectedLanguage())?></a></li>
            <li class="active"><?=getContentLanguageSelected('EXAMINATION',defaultSelectedLanguage())?></li>
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
                     <a class="btn btn-primary" href="<?=base_url('admin/health-insurance-conditions/lists')?>"> <i class="fa fa-list"></i> <?=getContentLanguageSelected('EXAMINATION_LIST',defaultSelectedLanguage())?></a>  
                  </div>
               </div>
               <div class="panel-body">
                  <form  method="post" enctype="multipart/form-data">
                     <div class="col-sm-6" >
                        <div class="form-group">
                           <label><?=getContentLanguageSelected('CONDITION_NAME',defaultSelectedLanguage())?><span class="required">*</span></label>
                           <input type="text" class="form-control" name="name" id="name" placeholder="Condition Name" value="<?php echo set_value('name') ?>">
                           <?=form_error('name'); ?>
                        </div>
                        <div class="form-group">
                           <label><?=getContentLanguageSelected('AMOUNT',defaultSelectedLanguage())?><span class="required">*</span></label>
                           <input type="text" class="form-control" name="amount" id="amount" placeholder="Amount" value="<?php echo set_value('amount') ?>">
                           <?=form_error('amount'); ?>
                        </div>
                     </div>
                     <div class="col-sm-6" >
                        <div class="form-group">
                           <label><?=getContentLanguageSelected('COMPANY',defaultSelectedLanguage())?><span class="required">*</span></label>
                           <?php $data = ' class="form-control input" onChange = "getBranchByCompanyId(this.value);" ';
                              echo form_dropdown('company_id',getCompanyOptions('tbl_company','Select Company',1),set_value("company_id"),$data);?>
                           <?=form_error('company_id'); ?>
                        </div>
                        <div class="form-group">
                           <label><?=getContentLanguageSelected('BRANCH',defaultSelectedLanguage())?><span class="required">*</span></label>
                           <?php $data = 'class="form-control " id="branch_by_company" onChange = "getRisqueByBranchId(this.value);"';
                              echo form_dropdown('branch_id',getBranchByCompanyId(set_value('company_id')),set_value("branch_id"),$data);?>
                           <?=form_error('branch_id'); ?>
                        </div>
                        <div class="form-group">
                           <label><?=getContentLanguageSelected('RISQUE',defaultSelectedLanguage())?><span class="required">*</span></label>
                           <?php $data = 'class="form-control " id="risque_by_branch"';
                              echo form_dropdown('risque_id',getRisqueByBranchId(set_value('branch_id')),set_value("risque_id"),$data);?>
                           <?=form_error('risque_id'); ?>
                        </div>
                     </div>
                     <div class="col-sm-10">
                        <div class="form-group">
                           <label><?=getContentLanguageSelected('DESCRIPTION',defaultSelectedLanguage())?><span class="required">*</span></label>
                           <textarea class="form-control " name="description" id="description" placeholder="Description" rows="10"><?php echo set_value('description') ?></textarea>
                           <?=form_error('description'); ?>
                        </div>
                     </div>
                     <div class="col-sm-10" >
                        <div class="form-check">
                           <label><?=getContentLanguageSelected('STATUS',defaultSelectedLanguage())?></label><br>
                           <label class="radio-inline">
                           <input type="radio" name="status" value="1" checked="checked"><?=getContentLanguageSelected('ACTIVE',defaultSelectedLanguage())?></label>
                           <label class="radio-inline"><input type="radio" name="status" value="0" ><?=getContentLanguageSelected('INACTIVE',defaultSelectedLanguage())?></label>
                        </div>
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