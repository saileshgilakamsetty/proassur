<div class="content-wrapper">
   <!-- Content Header (Page header) -->
   <section class="content-header">
      <div class="header-icon">
         <i class="pe-7s-note2"></i>
      </div>
      <div class="header-title">
         <h1><?=getContentLanguageSelected('TRAVEL_POLICIES',defaultSelectedLanguage())?></h1>
         <small><?=getContentLanguageSelected('TRAVEL_POLICIES_EDIT',defaultSelectedLanguage())?></small>
         <ol class="breadcrumb hidden-xs">
            <li><a href="<?=base_url('admin/dashboard');?>"><i class="pe-7s-home"></i> <?=getContentLanguageSelected('HOME',defaultSelectedLanguage())?></a></li>
            <li class="active"><?=getContentLanguageSelected('TRAVEL_POLICIES_EDIT',defaultSelectedLanguage())?></li>
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
                           <label><?=getContentLanguageSelected('PEOPLE_INSURED',defaultSelectedLanguage())?><span class="required">*</span></label>
                           <?php $data = ' class="form-control input" id="people_insured" ';
                              $people_insured = $travel_people_insured->people_insured;
                           
                           echo form_dropdown('people_insured',getPeopleOptions('Select People'),set_value("people_insured",isset($people_insured)?$people_insured:''),$data); ?>
                           <?=form_error('people_insured'); ?>
                        </div>
                        <?php
                           // print_r($travel_people_details);
                        ?>
                        <div class="form-group people_to_insure" >
                           <div id="people_html1">
                              <?php

                                 if(set_value('people_insured')) {
                                    for($i = 1; $i <= set_value('people_insured');$i++) { ?>

                                       <label><?=getContentLanguageSelected('PEOPLE_TO_BE_INSURED',defaultSelectedLanguage())?><span class="required">*</span></label>

                                       <input type="text" class="form-control" name="firstname_1" id="firstname_1" placeholder="First Name" value="<?php echo set_value('firstname_'.$i,isset($value->first_name)?$value->first_name:'') ?>">
                                       <?=form_error('firstname_'.$i); ?>

                                       <input type="text" class="form-control" name="lastname_<?= $i;?>" id="lastname_<?= $i;?>" placeholder="Last Name" value="<?php echo set_value('lastname_'.$i,isset($value->last_name)?$value->last_name:'') ?>">
                                       <?=form_error('lastname_'.$i); ?>

                                       <label><?=getContentLanguageSelected('AGE_OF_PERSON',defaultSelectedLanguage())?></label>
                                       <input type="text" class="form-control" name="age_<?= $i;?>" id="age_<?= $i;?>" placeholder="Age of Person" value="<?php echo set_value('age_'.$i,isset($age_of_person)?$age_of_person:'') ?>">
                                       <?=form_error('age_'.$i);
                                    }
                                 } else {
                                    $i = 1;
                                    foreach ($travel_people_details as $key => $value) { 
                                       $age_of_person = date("m/d/Y",strtotime($value->age_of_person)); ?>
                                       
                                       <label><?=getContentLanguageSelected('PEOPLE_TO_BE_INSURED',defaultSelectedLanguage())?><span class="required">*</span></label>

                                       <input type="text" class="form-control" name="firstname_1" id="firstname_1" placeholder="First Name" value="<?php echo set_value('firstname_'.$i,isset($value->first_name)?$value->first_name:'') ?>">
                                       <?=form_error('firstname_'.$i); ?>

                                       <input type="text" class="form-control" name="lastname_<?= $i;?>" id="lastname_<?= $i;?>" placeholder="Last Name" value="<?php echo set_value('lastname_'.$i,isset($value->last_name)?$value->last_name:'') ?>">
                                       <?=form_error('lastname_'.$i); ?>

                                       <label><?=getContentLanguageSelected('AGE_OF_PERSON',defaultSelectedLanguage())?></label>
                                       <input type="text" class="form-control" name="age_<?= $i;?>" id="age_<?= $i;?>" placeholder="Age of Person" value="<?php echo set_value('age_'.$i,isset($age_of_person)?$age_of_person:'') ?>">
                                       <?=form_error('age_'.$i); ?>  
                                       <?php $i++;
                                    }
                                 }

                              ?>
                           </div>
                        </div>






                        <div class="form-group">
                           <label><?=getContentLanguageSelected('TRAVEL_START_DATE',defaultSelectedLanguage())?><span class="required">*</span></label>
                           <?php
                              $travel_start_date = date("m/d/Y",strtotime($travel_destination_details->travel_start_date));
                           ?>
                           <input type="text" class="form-control" name="travel_start_date" id="travel_start_date" placeholder="Travel Start Date" value="<?php echo set_value('travel_start_date',isset($travel_start_date)?$travel_start_date:'') ?>">
                           <?=form_error('travel_start_date'); ?>
                        </div>

                        <div class="form-group">
                           <label><?=getContentLanguageSelected('TRAVEL_END_DATE',defaultSelectedLanguage())?><span class="required">*</span></label>
                           <?php
                              $travel_end_date = date("m/d/Y",strtotime($travel_destination_details->travel_end_date));
                           ?>
                           <input type="text" class="form-control" name="travel_end_date" id="travel_end_date" placeholder="Travel End Date" value="<?php echo set_value('travel_end_date',isset($travel_end_date)?$travel_end_date:'') ?>">
                           <?=form_error('travel_end_date'); ?>
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