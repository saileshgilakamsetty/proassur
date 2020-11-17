<div class="content-wrapper">
   <!-- Content Header (Page header) -->
   <section class="content-header">
      <div class="header-icon">
         <i class="pe-7s-note2"></i>
      </div>
      <div class="header-title">
         <h1><?=getContentLanguageSelected('HEALTH_INSURANCE',defaultSelectedLanguage())?></h1>
         <small><?=getContentLanguageSelected('HEALTH_INSURANCE_ADD',defaultSelectedLanguage())?></small>
         <ol class="breadcrumb hidden-xs">
            <li><a href="<?=base_url('admin/dashboard');?>"><i class="pe-7s-home"></i> <?=getContentLanguageSelected('HOME',defaultSelectedLanguage())?></a></li>
            <li class="active"><?=getContentLanguageSelected('HEALTH_INSURANCE',defaultSelectedLanguage())?></li>
         </ol>
      </div>
   </section>
   <!-- Main content -->
   <section class="content">
      <div class="row">
         <!-- Form controls -->
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
               <!-- <div class="panel-heading">
                  <div class="btn-group"> 
                     <a class="btn btn-primary" href="<?=base_url('admin/health-insurance/lists')?>"> <i class="fa fa-list"></i> <?=getContentLanguageSelected('HEALTH_INSURANCE_LIST',defaultSelectedLanguage())?> </a>  
                  </div>
               </div> -->
               <div class="panel-body">
                  <form  method="post" enctype="multipart/form-data">
                     <div class="col-md-6" >
                        <div class="form-group">
                          <label><?=getContentLanguageSelected('NAME',defaultSelectedLanguage())?><span class="required">*</span></label>

                          <?php $data = ' class="form-control" input"  ';
                          echo form_dropdown('user_id',getEndUserOptions('tbl_users','Select Name',1),set_value("user_id"),$data);?>
                          <?=form_error('user_id'); ?>
                        </div>
                        <div class="form-group">
                          <label><?=getContentLanguageSelected('WHAT_DO_YOU_WANT_TO_INSURE ?',defaultSelectedLanguage())?><span class="required">*</span></label>

                          <?php 
                          
                           $data = ' class="form-control input" id="health_insurance_type_id" ';
                           echo form_dropdown('health_insurance_type_id',getHealthInsuranceTypeOptions('tbl_health_insurance_type','Select Insurance Type',1),set_value("health_insurance_type_id",1),$data);
                           ?>
                          <?=form_error('health_insurance_type_id'); ?>
                        </div>

                        
                        <div class="family_insurance">
                           <div class="form-group">
                              <label><?=getContentLanguageSelected('NAME_OF_CHIEF/FATHER',defaultSelectedLanguage())?><span class="required">*</span></label>
                              <input type="text" class="form-control" name="name_of_chief" id="name_of_chief" placeholder="Name" value="<?php echo set_value('name_of_chief') ?>">
                              <?=form_error('name_of_chief'); ?>
                           </div>

                           <div class="form-group">
                              <label><?=getContentLanguageSelected('AGE_OF_PERSON',defaultSelectedLanguage())?><span class="required">*</span></label>
                              <input type="text" class="form-control" name="age_of_chief" id="age_of_chief" placeholder="Age Of Person" value="<?php echo set_value('age_of_chief') ?>">
                              <?=form_error('age_of_chief'); ?>
                           </div>                       

                           <div class="form-group">
                              <label><?=getContentLanguageSelected('NO_OF_PERSONS_TO_BE_INSURED',defaultSelectedLanguage())?><span class="required">*</span></label>
                                  <?php $data = ' class="form-control input" id="persons_insured" ';
                                    echo form_dropdown('persons_insured',getPersonsOptions('Select People'),set_value("persons_insured"),$data);?>
                              <?=form_error('persons_insured'); ?>
                           </div>
                           <div id="family_insurance_people">
                              <div class="form-group">
                                 <label><?=getContentLanguageSelected('PEOPLE_TO_BE_INSURED',defaultSelectedLanguage())?><span class="required">*</span></label>
                                 <input type="text" class="form-control" name="full_name_1" id="full_name_1" placeholder="Full Name" value="<?php echo set_value('full_name_1') ?>">
                                 <?=form_error('full_name_1'); ?>
                              </div>

                              <div class="form-group">
                                 <label><?=getContentLanguageSelected('AGE_OF_EACH_PERSON',defaultSelectedLanguage())?><span class="required">*</span></label>
                                 <input type="text" class="form-control age_of_each_person" name="age_of_each_person_1" id="age_of_each_person_1" placeholder="Age Of Each Person" value="<?php echo set_value('age_of_each_person_1') ?>">
                                 <?=form_error('age_of_each_person_1'); ?>
                              </div>  
                           </div>
                        </div>

                        <div class="individual_insurance" style="display: none;">
                           <div class="form-group" id="" >
                              <label><?=getContentLanguageSelected('PEOPLE_TO_BE_INSURED',defaultSelectedLanguage())?><span class="required">*</span></label>

                              <input type="text" class="form-control" name="first_name" id="first_name" placeholder="First Name" value="<?php echo set_value('first_name') ?>">
                              <?=form_error('first_name'); ?>

                              <input type="text" class="form-control" name="last_name" id="last_name" placeholder="Last Name" value="<?php echo set_value('last_name') ?>">
                              <?=form_error('last_name'); ?>
                           </div>

                           <div class="form-group">
                              <label><?=getContentLanguageSelected('AGE_OF_PERSON',defaultSelectedLanguage())?></label>
                              <input type="text" class="form-control" name="age_person" id="age_person" placeholder="Age of Person" value="<?php echo set_value('age_person') ?>">
                              <?=form_error('age_person'); ?>
                           </div>

                        </div>

                        <div class="form-group">
                           <label><?=getContentLanguageSelected('SELECT_THE_START_DATE',defaultSelectedLanguage())?><span class="required">*</span></label>
                           
                           <input type="text" class="form-control" name="start_date" id="start_date" placeholder="Start Date" value="<?php echo set_value('start_date') ?>">
                           <?=form_error('start_date'); ?>
                        </div>

                        <div class="form-group">
                           <label><?=getContentLanguageSelected('SELECT_THE_END_DATE',defaultSelectedLanguage())?><span class="required">*</span></label>
                          
                           <input type="text" class="form-control" name="end_date" id="end_date" placeholder="End Date" value="<?php echo set_value('end_date') ?>">
                           <?=form_error('end_date'); ?>
                        </div>

                        <div class="form-group">
                           <label><?=getContentLanguageSelected('POLICY_COVERAGE_AREA',defaultSelectedLanguage())?><span class="required">*</span></label>

                           <?php $data = ' class="form-control input" id="" onchange="getDataByPolicyCoveargeAreaId(this.value)" ';
                           echo form_dropdown('policy_coverage_area_id',getCompanyOptions('tbl_policycoverage_area','Select Policy Coverage Area',1),set_value("policy_coverage_area_id"),$data);?>
                           <?=form_error('policy_coverage_area_id'); ?>
                        </div>

                        <div class="form-group">
                           <label><?=getContentLanguageSelected('CLAIM_REIMBURSEMENT_RATE',defaultSelectedLanguage())?><span class="required">*</span></label>
                              <?php $data = 'class="form-control " id="claim_reimbursement_rate"'; 
                              echo form_dropdown('claim_reimbursement_rate',getRateByPolicyCoveargeAreaId(set_value('policy_coverage_area_id')),set_value("claim_reimbursement_rate"),$data);?>
                           <?=form_error('claim_reimbursement_rate'); ?>
                        </div>


                        <div class="form-group">
                           <!-- <label><?=getContentLanguageSelected('AMOUNT_TO_PAY_RATE',defaultSelectedLanguage())?><span class="required">*</span></label> -->
                           <input type="hidden" class="form-control" name="amount_to_pay" id="amount_to_pay" placeholder="Amount To Pay" value="<?php echo set_value('amount_to_pay') ?>" readonly >
                           <?=form_error('amount_to_pay'); ?>
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
