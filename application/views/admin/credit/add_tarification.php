<div class="content-wrapper">
   <!-- Content Header (Page header) -->
   <section class="content-header">
      <div class="header-icon">
         <i class="pe-7s-note2"></i>
      </div>
      <div class="header-title">
         <h1><?=getContentLanguageSelected('CREDIT_TARIFICATION',defaultSelectedLanguage())?> </h1>
         <small><?=getContentLanguageSelected('CREDIT_TARIFICATION',defaultSelectedLanguage())?></small>
         <ol class="breadcrumb hidden-xs">
            <li><a href="<?=base_url('admin/dashboard');?>"><i class="pe-7s-home"></i> <?=getContentLanguageSelected('HOME',defaultSelectedLanguage())?></a></li>
            <li class="active"><?=getContentLanguageSelected('CREDIT_TARIFICATION',defaultSelectedLanguage())?></li>
         </ol>
      </div>
      <?php // print_r(getCompanyIdsByBranch(getHousingBranchId()));?>
   </section>
   <!-- Main content -->
   <section class="content">
      <div class="row">
         <!-- Form controls -->
         <div class="col-sm-12">
            <div class="panel panel-bd">
               <div class="panel-heading">
                  <div class="btn-group"> 
                     <a class="btn btn-primary" href="<?=base_url('admin/credit/list_tarification')?>"> <i class="fa fa-list"></i>  <?=getContentLanguageSelected('CREDIT_TARIFICATION',defaultSelectedLanguage())?></a>  
                  </div>
               </div>
               <div class="panel-body">
                  <form  method="post" enctype="multipart/form-data">
                     <div class="col-sm-6" >
                        <div class="form-group">
                           <label><?=getContentLanguageSelected('MINIMUM_AMOUNT_OF_LOAN',defaultSelectedLanguage())?><span class="required">*</span></label>
                           <input type="text" class="form-control" name="min_loan_amount" id="min_loan_amount" placeholder="Minimum Amount Of Loan" value="<?php echo set_value('min_loan_amount') ?>">
                           <?=form_error('min_loan_amount'); ?>
                        </div>

                        <div class="form-group">
                           <label><?=getContentLanguageSelected('MAXIMUM_AMOUNT_OF_LOAN',defaultSelectedLanguage())?><span class="required">*</span></label>
                           <input type="text" class="form-control" name="max_loan_amount" id="max_loan_amount" placeholder="Maximum Amount Of Loan" value="<?php echo set_value('max_loan_amount') ?>">
                           <?=form_error('max_loan_amount'); ?>
                        </div>

                        <div class="form-group">
                           <label><?=getContentLanguageSelected('DURATION_OF_LOAN',defaultSelectedLanguage())?><span class="required">*</span></label>
                           <input type="text" class="form-control" name="loan_duration" id="loan_duration" placeholder="Minimum Duration Of Loan In Years" value="<?php echo set_value('loan_duration') ?>">
                           <?=form_error('loan_duration'); ?>
                        </div>

                        <div class="form-group">
                           <label><?=getContentLanguageSelected('MINIMUM_AGE_OF_CUSTOMER',defaultSelectedLanguage())?><span class="required">*</span></label>
                           <input type="text" class="form-control" name="min_customer_age" id="min_customer_age" placeholder="Age Of Customer" value="<?php echo set_value('min_customer_age') ?>">
                           <?=form_error('min_customer_age'); ?>
                        </div>

                        <div class="form-group">
                           <label><?=getContentLanguageSelected('MAXIMUM_AGE_OF_CUSTOMER',defaultSelectedLanguage())?><span class="required">*</span></label>
                           <input type="text" class="form-control" name="max_customer_age" id="max_customer_age" placeholder="Age Of Customer" value="<?php echo set_value('max_customer_age') ?>">
                           <?=form_error('max_customer_age'); ?>
                        </div>

                        <div class="form-group">
                           <label><?=getContentLanguageSelected('INSURANCE_RATE',defaultSelectedLanguage())?><span class="required">*</span></label>
                           <input type="text" class="form-control" name="insurance_rate" id="insurance_rate" placeholder="Insurance Rate" value="<?php echo set_value('insurance_rate') ?>">
                           <?=form_error('insurance_rate'); ?>
                        </div>
                        <div class="form-group">
                           <label><?=getContentLanguageSelected('LOAN_SIZE',defaultSelectedLanguage())?><span class="required">*</span></label>
                           <input type="text" class="form-control" name="loan_size" id="loan_size" placeholder="LOAN SIZE" value="<?php echo set_value('loan_size') ?>">
                           <?=form_error('loan_size'); ?>
                        </div>
                     </div>

                     <div class="col-sm-6" >
                        <div class="form-group">
                           <label><?=getContentLanguageSelected('COMPANY',defaultSelectedLanguage())?><span class="required">*</span>
                           </label>
                           <?php $data = ' class="form-control input" ';
                              echo form_dropdown('company_id',getCompanyIdsByBranch(getCreditBranchId()),set_value("company_id"),$data);?>
                           <?=form_error('company_id'); ?>
                        </div>

                        <div class="form-group">
                           <label><?=getContentLanguageSelected('BRANCH',defaultSelectedLanguage())?><span class="required">*</span></label>
                           <input type="text" readonly="" class="form-control" name="branch_id" placeholder="Branch" id="branch_id" value="<?php echo getBranchName(getCreditBranchId()); ?>">
                           <?=form_error('branch_id'); ?>
                        </div>

                        <div class="form-group">
                           <label><?=getContentLanguageSelected('RISQUE',defaultSelectedLanguage())?><span class="required">*</span></label>
                           <?php $data = 'class="form-control " id="risque_by_credittar"';
                              echo form_dropdown('risque_id',getRisqueByBranchId(getCreditBranchId()),set_value("risque_id"),$data);?>
                           <?=form_error('risque_id'); ?>
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