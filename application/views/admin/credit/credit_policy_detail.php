<div class="content-wrapper">
   <!-- Content Header (Page header) -->
   <section class="content-header">
      <div class="header-icon">
         <i class="pe-7s-note2"></i>
      </div>
      <div class="header-title">
         <h1><?=getContentLanguageSelected('CREDIT_POLICIES',defaultSelectedLanguage())?></h1>
         <small><?=getContentLanguageSelected('CREDIT_POLICIES_EDIT',defaultSelectedLanguage())?></small>
         <ol class="breadcrumb hidden-xs">
            <li><a href="<?=base_url('admin/dashboard');?>"><i class="pe-7s-home"></i> <?=getContentLanguageSelected('HOME',defaultSelectedLanguage())?></a></li>
            <li class="active"><?=getContentLanguageSelected('CREDIT_POLICIES_EDIT',defaultSelectedLanguage())?></li>
         </ol>
      </div>
      <?php // print_r(getCompanyIdsByBranch(getHousingBranchId()));?>
   </section>

    <?php $success= $this->session->flashdata('message'); 
   if(!empty($success)) { ?>
<div class="panel panel-success">
   <div class="panel-heading">
      <?php echo $this->session->flashdata('message'); ?>
   </div>
</div>
<?php } ?>
   
   <!-- Main content -->
   <section class="content">
      <div class="row">
         <!-- Form controls -->
         <div class="col-sm-12">
            <div class="panel panel-bd">
               <div class="panel-body">
                  <form  method="post" enctype="multipart/form-data">
                     <div class="col-sm-6" >
                        <div class="form-group">
                           <label><?=getContentLanguageSelected('POLICY_NUMBER',defaultSelectedLanguage())?><span class="required">*</span></label>
                           <input type="text" class="form-control" id="policy_number" name="policy_number" placeholder="Policy Number" value="<?=set_value('policy_number',isset($policy_number)?$policy_number:''); ?>">
                           <?=form_error('policy_number'); ?>
                        </div>
                        <div class="form-group">
                           <?php
                              $credit_insurance_start_date = date("m/d/Y",strtotime($credit_detail['credit_insurance_start_date'])); 
                           ?>
                           <label><?=getContentLanguageSelected('INSURANCE_START_DATE',defaultSelectedLanguage())?><span class="required">*</span></label>
                           <input type="text" class="form-control" name="credit_insurance_start_date" id="credit_insurance_start_date" placeholder="Insurance Start Date" value="<?php echo set_value('credit_insurance_start_date',isset($credit_insurance_start_date)?$credit_insurance_start_date:'') ?>">
                           <?=form_error('credit_insurance_start_date'); ?>
                        </div>

                        <div class="form-group">
                           <label><?=getContentLanguageSelected('AMOUNT_OF_THE_LOAN',defaultSelectedLanguage())?><span class="required">*</span></label>
                           <input type="text" class="form-control" name="credit_insurance_loan_amount" id="credit_insurance_loan_amount" placeholder="Amount Of The Loan" value="<?php echo set_value('credit_insurance_loan_amount',isset($credit_detail['credit_insurance_loan_amount'])?$credit_detail['credit_insurance_loan_amount']:'') ?>">
                           <?=form_error('credit_insurance_loan_amount'); ?>
                        </div>

                        
                        <div class="form-group">
                           <?php
                              $credit_insurance_customer_dob = date("m/d/Y",strtotime($credit_detail['credit_insurance_customer_dob'])); 
                           ?>
                           <label><?=getContentLanguageSelected('DATE_OF_BIRTH_OF_CUSTOMER',defaultSelectedLanguage())?><span class="required">*</span></label>
                           <input type="text" class="form-control" name="credit_insurance_customer_dob" id="credit_insurance_customer_dob" placeholder="DOB Of The Customer" value="<?php echo set_value('credit_insurance_customer_dob',isset($credit_insurance_customer_dob)?$credit_insurance_customer_dob:'') ?>">
                           <?=form_error('credit_insurance_customer_dob'); ?>
                        </div>

                        <div class="form-group">
                           <label><?=getContentLanguageSelected('BANK_LOAN_MONTHLY_PAYMENT',defaultSelectedLanguage())?><span class="required">*</span></label>
                           <input type="text" class="form-control" name="credit_bank_loan_monthly_payment" id="credit_bank_loan_monthly_payment" placeholder="Bank Loan Monthly Payment" value="<?php echo set_value('credit_bank_loan_monthly_payment',isset($credit_detail['credit_bank_loan_monthly_payment'])?$credit_detail['credit_bank_loan_monthly_payment']:'') ?>">
                           <?=form_error('credit_bank_loan_monthly_payment'); ?>
                        </div>
                     </div>
                     <div class="col-sm-6" >
                        <div class="form-group">
                           <?php
                              $credit_insurance_expiry_date = date("m/d/Y",strtotime($credit_detail['credit_insurance_expiry_date'])); 
                           ?>
                           <label><?=getContentLanguageSelected('INSURANCE_EXPIRY_DATE',defaultSelectedLanguage())?><span class="required">*</span></label>
                           <input type="text" class="form-control" name="credit_insurance_expiry_date" id="credit_insurance_expiry_date" placeholder="Insurance Expiry Date" value="<?php echo set_value('credit_insurance_expiry_date',isset($credit_insurance_expiry_date)?$credit_insurance_expiry_date:'') ?>">
                           <?=form_error('credit_insurance_expiry_date'); ?>
                        </div>

                        <div class="form-group">
                           <label><?=getContentLanguageSelected('DURATION_OF_THE_LOAN',defaultSelectedLanguage())?><span class="required">*</span></label>
                           <input type="text" class="form-control" name="credit_insurance_loan_duration" id="credit_insurance_loan_duration" placeholder="Minimum Duration Of Loan In Years" value="<?php echo set_value('credit_insurance_loan_duration',isset($credit_detail['credit_insurance_loan_duration'])?$credit_detail['credit_insurance_loan_duration']:'') ?>">
                           <?=form_error('credit_insurance_loan_duration'); ?>
                        </div>

                        <div class="form-group">
                           <label><?=getContentLanguageSelected('LOAN_SIZE',defaultSelectedLanguage())?><span class="required">*</span></label>
                           <input type="text" class="form-control" name="credit_insurance_loan_size" id="credit_insurance_loan_size" placeholder="LOAN SIZE" value="<?php echo set_value('credit_insurance_loan_size',isset($credit_detail['credit_insurance_loan_size'])?$credit_detail['credit_insurance_loan_size']:'') ?>">
                           <?=form_error('credit_insurance_loan_size'); ?>
                        </div>
                     </div>
                     <div class="col-sm-10" >
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