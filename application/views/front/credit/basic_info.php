<section class="insurForm">
   <div class="container">
      <form action="" method="post" id="credit_basic_info_form">
         <input type="hidden" name="user_id" id="user_id" value="<?= $this->session->userdata('user_id');?>">
         <div class="row">
            <div class="col-xs-12">
               <h3 class="title"><?=getContentLanguageSelected('CREDIT_INSURANCE',defaultSelectedLanguage())?></h3>
            </div>
         </div>
         <?php 
            $message = $this->session->flashdata('message'); 
            if(!empty($message)) { ?>
               <div class="panel panel-warning">
                  <div class="panel-heading">
                     <?php echo $this->session->flashdata('message'); ?>
                  </div>
               </div>
            <?php } 
         ?>
         <div class="formFildes">
            <div class="col-xs-12 col-sm-6">
               <div class="form-group">
                  <label><?=getContentLanguageSelected('INSURANCE_START_DATE',defaultSelectedLanguage())?><span class="required">*</span></label>
                  <input type="text" class="form-control" name="credit_insurance_start_date" id="credit_insurance_start_date" placeholder="Insurance Start Date" value="<?php echo set_value('credit_insurance_start_date') ?>">
                  <?=form_error('credit_insurance_start_date'); ?>
               </div>

               <div class="form-group">
                  <label><?=getContentLanguageSelected('AMOUNT_OF_THE_LOAN',defaultSelectedLanguage())?><span class="required">*</span></label>
                  <input type="text" class="form-control" name="credit_insurance_loan_amount" id="credit_insurance_loan_amount" placeholder="Amount Of The Loan" value="<?php echo set_value('credit_insurance_loan_amount') ?>">
                  <?=form_error('credit_insurance_loan_amount'); ?>
               </div>

               
               <div class="form-group">
                  <label><?=getContentLanguageSelected('DATE_OF_BIRTH_OF_CUSTOMER',defaultSelectedLanguage())?><span class="required">*</span></label>
                  <input type="text" class="form-control" name="credit_insurance_customer_dob" id="credit_insurance_customer_dob" placeholder="DOB Of The Customer" value="<?php echo set_value('credit_insurance_customer_dob') ?>">
                  <?=form_error('credit_insurance_customer_dob'); ?>
               </div>

               <div class="form-group">
                  <label><?=getContentLanguageSelected('BANK_LOAN_MONTHLY_PAYMENT',defaultSelectedLanguage())?><span class="required">*</span></label>
                  <input type="text" class="form-control" name="credit_bank_loan_monthly_payment" id="credit_bank_loan_monthly_payment" placeholder="Bank Loan Monthly Payment" value="<?php echo set_value('credit_bank_loan_monthly_payment') ?>">
                  <?=form_error('credit_bank_loan_monthly_payment'); ?>
               </div>
            </div>
            <div class="col-xs-12 col-sm-6">
               <div class="form-group">
                  <label><?=getContentLanguageSelected('INSURANCE_EXPIRY_DATE',defaultSelectedLanguage())?><span class="required">*</span></label>
                  <input type="text" class="form-control" name="credit_insurance_expiry_date" id="credit_insurance_expiry_date" placeholder="Insurance Expiry Date" value="<?php echo set_value('credit_insurance_expiry_date') ?>">
                  <?=form_error('credit_insurance_expiry_date'); ?>
               </div>

               <div class="form-group">
                  <label><?=getContentLanguageSelected('DURATION_OF_THE_LOAN',defaultSelectedLanguage())?><span class="required">*</span></label>
                  <input type="text" class="form-control" name="credit_insurance_loan_duration" id="credit_insurance_loan_duration" placeholder="Minimum Duration Of Loan In Years" value="<?php echo set_value('credit_insurance_loan_duration') ?>">
                  <?=form_error('credit_insurance_loan_duration'); ?>
               </div>

               <div class="form-group">
                  <label><?=getContentLanguageSelected('LOAN_SIZE',defaultSelectedLanguage())?><span class="required">*</span></label>
                  <input type="text" class="form-control" name="credit_insurance_loan_size" id="credit_insurance_loan_size" placeholder="LOAN SIZE" value="<?php echo set_value('credit_insurance_loan_size') ?>">
                  <?=form_error('credit_insurance_loan_size'); ?>
               </div>
               <div class="form-group">
                  <input name= "basic_info_submit"  id="credit_basic_info_submit" type="submit" value="Submit" class="subBtn">
               </div>
               <div class="clearfix"></div>
            </div>
            <div class="clearfix"></div>
         </div>
      </form>
   </div>
</section>
