<div class="content-wrapper">
   <!-- Content Header (Page header) -->
   <section class="content-header">
      <div class="header-icon">
         <i class="pe-7s-note2"></i>
      </div>
      <div class="header-title">
         <h1><?=getContentLanguageSelected('HEALTH_INSURANCE_POLICIES',defaultSelectedLanguage())?></h1>
         <small><?=getContentLanguageSelected('HEALTH_INSURANCE_POLICIES_EDIT',defaultSelectedLanguage())?></small>
         <ol class="breadcrumb hidden-xs">
            <li><a href="<?=base_url('admin/dashboard');?>"><i class="pe-7s-home"></i> <?=getContentLanguageSelected('HOME',defaultSelectedLanguage())?></a></li>
            <li class="active"><?=getContentLanguageSelected('HEALTH_INSURANCE_POLICIES_EDIT',defaultSelectedLanguage())?></li>
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
               <div class="panel-body">
                  <form  method="post" action=""enctype="multipart/form-data">
                     <div class="col-md-6" >

                        <div class="form-group">
                           <label><?=getContentLanguageSelected('POLICY_NUMBER',defaultSelectedLanguage())?><span class="required">*</span></label>
                           <input type="text" class="form-control" id="policy_number" name="policy_number" placeholder="Policy Number" value="<?=set_value('policy_number',isset($policy_number)?$policy_number:''); ?>">
                           <?=form_error('policy_number'); ?>
                        </div>

                        <div class="form-group">
                          <label><?=getContentLanguageSelected('WHAT_DO_YOU_WANT_TO_INSURE',defaultSelectedLanguage())?><span class="required">*</span></label>

                          <?php 
                          
                           $data = ' class="form-control input" id="health_insurance_type_id" ';
                           $health_insurance_type_id = $health_insurance_details->health_insurance_type_id;
                           echo form_dropdown('health_insurance_type_id',getHealthInsuranceTypeOptions('tbl_health_insurance_type','Select Insurance Type',1),set_value("health_insurance_type_id",isset($health_insurance_type_id)?$health_insurance_type_id:''),$data);
                           ?>
                          <?=form_error('health_insurance_type_id'); ?>
                        </div>

                        <div class="family_insurance">
                           <?php
                              $name_of_chief   = $health_insurance_details->name_of_chief;
                              $age_of_chief    = date("m/d/Y",strtotime($health_insurance_details->age_of_chief)); 
                              $persons_insured = $health_insurance_details->persons_insured;
                           ?>
                           <div class="form-group">
                              <label><?=getContentLanguageSelected('NAME_OF_CHIEF/FATHER',defaultSelectedLanguage())?><span class="required">*</span></label>
                              <input type="text" class="form-control" name="name_of_chief" id="name_of_chief" placeholder="Name" value="<?php echo set_value('name_of_chief',isset($name_of_chief)?$name_of_chief:'') ?>">
                              <?=form_error('name_of_chief'); ?>
                           </div>

                           <div class="form-group">
                              <label><?=getContentLanguageSelected('AGE_OF_PERSON',defaultSelectedLanguage())?><span class="required">*</span></label>
                              <input type="text" class="form-control" name="age_of_chief" id="age_of_chief" placeholder="Age Of Person" value="<?php echo set_value('age_of_chief',isset($age_of_chief)?$age_of_chief:'') ?>">
                              <?=form_error('age_of_chief'); ?>
                           </div>                       

                           <div class="form-group">
                              <label><?=getContentLanguageSelected('NO_OF_PERSONS_TO_BE_INSURED',defaultSelectedLanguage())?><span class="required">*</span></label>
                                 <?php $data = ' class="form-control input" id="persons_insured" ';
                                    echo form_dropdown('persons_insured',getPersonsOptions('Select People'),set_value("persons_insured",isset($persons_insured)?$persons_insured:''),$data);?>
                              <?=form_error('persons_insured'); ?>
                           </div>
                           <div id="family_insurance_people1">
                              <?php
                                 if(set_value('persons_insured')) {
                                    for($i = 1; $i <= set_value('people_insured');$i++) { ?>
                                       <div class="form-group">
                                          <label><?=getContentLanguageSelected('PEOPLE_TO_BE_INSURED',defaultSelectedLanguage())?><span class="required">*</span></label>
                                          <input type="text" class="form-control" name="full_name_<?= $i?>" id="full_name_<?= $i?>" placeholder="Full Name" value="<?php echo set_value('full_name_'.$i) ?>">
                                          <?=form_error('full_name_'.$i); ?>
                                       </div>

                                       <div class="form-group">
                                          <label><?=getContentLanguageSelected('AGE_OF_EACH_PERSON',defaultSelectedLanguage())?><span class="required">*</span></label>
                                          <input type="text" class="form-control age_of_each_person" name="age_of_each_person_<?= $i?>" id="age_of_each_person_<?= $i?>" placeholder="Age Of Each Person" value="<?php echo set_value('age_of_each_person_'.$i) ?>">
                                          <?=form_error('age_of_each_person_'.$i); ?>
                                       </div> 

                                       <?php
                                    }
                                 } else {
                                    $i = 1;
                                    foreach ($health_insurance_person_details as $key => $value) {
                                       $full_name          = $value->full_name; 
                                       $age_of_each_person = date("m/d/Y",strtotime($value->age_of_each_person)); ?>

                                       <div class="form-group">
                                          <label><?=getContentLanguageSelected('PEOPLE_TO_BE_INSURED',defaultSelectedLanguage())?><span class="required">*</span></label>
                                          <input type="text" class="form-control" name="full_name_<?= $i?>" id="full_name_<?= $i?>" placeholder="Full Name" value="<?php echo set_value('full_name_'.$i,isset($full_name)?$full_name:'') ?>">
                                          <?=form_error('full_name_'.$i); ?>
                                       </div>

                                       <div class="form-group">
                                          <label><?=getContentLanguageSelected('AGE_OF_EACH_PERSON',defaultSelectedLanguage())?><span class="required">*</span></label>
                                          <input type="text" class="form-control age_of_each_person" name="age_of_each_person_<?= $i?>" id="age_of_each_person_<?= $i?>" placeholder="Age Of Each Person" value="<?php echo set_value('age_of_each_person_'.$i,isset($age_of_each_person)?$age_of_each_person:'') ?>">
                                          <?=form_error('age_of_each_person_'.$i); ?>
                                       </div>  
                                       <?php $i++;
                                    }
                                 }
                              ?> 
                           </div>
                        </div>

                        <div class="individual_insurance" style="display: none;">
                           <?php
                              $first_name = $health_insurance_details->first_name;
                              $last_name  = $health_insurance_details->last_name;
                              $age_of_person = date("m/d/Y",strtotime($health_insurance_details->age_person));
                           ?>
                           <div class="form-group" id="" >
                              <label><?=getContentLanguageSelected('PEOPLE_TO_BE_INSURED',defaultSelectedLanguage())?><span class="required">*</span></label>

                              <input type="text" class="form-control" name="first_name" id="first_name" placeholder="First Name" value="<?php echo set_value('first_name',isset($first_name)?$first_name:'') ?>">
                              <?=form_error('first_name'); ?>

                              <input type="text" class="form-control" name="last_name" id="last_name" placeholder="Last Name" value="<?php echo set_value('last_name',isset($last_name)?$last_name:'') ?>">
                              <?=form_error('last_name'); ?>
                           </div>

                           <div class="form-group">
                              <label><?=getContentLanguageSelected('AGE_OF_PERSON',defaultSelectedLanguage())?></label>
                              <input type="text" class="form-control" name="age_person" id="age_person" placeholder="Age of Person" value="<?php echo set_value('age_person',isset($age_of_person)?$age_of_person:'') ?>">
                              <?=form_error('age_person'); ?>
                           </div>
                        </div>

                      
                        <div class="form-group">
                           <label><?=getContentLanguageSelected('SELECT_THE_START_DATE',defaultSelectedLanguage())?><span class="required">*</span></label>
                           <?php
                              $start_date = date("m/d/Y",strtotime($health_insurance_details->start_date));
                           ?>
                           <input type="text" class="form-control" name="start_date" id="start_date" placeholder="Start Date" value="<?php echo set_value('start_date',isset($start_date)?$start_date:'') ?>">
                           <?=form_error('start_date'); ?>
                        </div>

                        <div class="form-group">
                           <label><?=getContentLanguageSelected('SELECT_THE_END_DATE',defaultSelectedLanguage())?><span class="required">*</span></label>
                           <?php
                              $end_date = date("m/d/Y",strtotime($health_insurance_details->end_date));
                           ?>
                           <input type="text" class="form-control" name="end_date" id="end_date" placeholder="End Date" value="<?php echo set_value('end_date',isset($end_date)?$end_date:'') ?>">
                           <?=form_error('end_date'); ?>
                        </div>
                     </div>                     

                     <div class="col-md-12" >
                        <div class="reset-button">
                           <button class="btn btn-success" onclick="return confirm('If you update this policy without changing your policy number, your old data will be lost. Do You want to Update This Policy? ')"><?=getContentLanguageSelected('SAVE',defaultSelectedLanguage())?></button>
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
