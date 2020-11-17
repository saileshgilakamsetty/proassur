<div class="content-wrapper">
  
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="header-icon">
      <i class="pe-7s-box1"></i>
    </div>
    <div class="header-title">     
      <h1><?=getContentLanguageSelected('TRAVEL_QUOTE',defaultSelectedLanguage())?></h1>
      <small><?=getContentLanguageSelected('TRAVELQUOTE_LIST',defaultSelectedLanguage())?></small>
      <ol class="breadcrumb hidden-xs">
        <li><a href="<?=base_url('admin/dashboard');?>"><i class="pe-7s-home"></i> <?=getContentLanguageSelected('HOME',defaultSelectedLanguage())?></a></li>
        <li class="active"><?=getContentLanguageSelected('TAVEL_QUOTE',defaultSelectedLanguage())?></li>
      </ol>
    </div>
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
                    <div class="col-md-6" >
                      <div class="form-group">
                        <label><?=getContentLanguageSelected('NAME',defaultSelectedLanguage())?><span class="required">*</span></label>

                        <?php $data = ' class="form-control" input"  ';
                        echo form_dropdown('user_id',getEndUserOptions('tbl_users','Select Name',1),set_value("user_id"),$data);?>
                        <?=form_error('user_id'); ?>
                      </div>
                      <div class="form-group">
                        <label><?=getContentLanguageSelected('PEOPLE_INSURED',defaultSelectedLanguage())?><span class="required">*</span></label>
                        <?php $data = ' class="form-control input" id="people_insured" ';
                        
                      	echo form_dropdown('people_insured',getPeopleOptions('Select People'),set_value("people_insured"),$data); ?>
                        <?=form_error('people_insured'); ?>
                      </div>

                      <div class="form-group people_to_insure" id="people_to_insure_1" >
                      	<div id="people_html">
                          <label><?=getContentLanguageSelected('PEOPLE_TO_BE_INSURED',defaultSelectedLanguage())?><span class="required">*</span></label>
	                            
                          <input type="text" class="form-control" name="firstname_1" id="firstname_1" placeholder="First Name" value="<?php echo set_value('firstname_1') ?>">
                          <?=form_error('firstname_1'); ?>

                          <input type="text" class="form-control" name="lastname_1" id="lastname_1" placeholder="Last Name" value="<?php echo set_value('lastname_1') ?>">
                         	<?=form_error('lastname_1'); ?>

                       		<label><?=getContentLanguageSelected('AGE_OF_PERSON',defaultSelectedLanguage())?></label>
                       		<input type="text" class="form-control" name="age_1" id="age_1" placeholder="Age of Person" value="<?php echo set_value('age_1') ?>">
		                        <?=form_error('age_1'); ?>
                        </div>
                      </div>

                      <div class="form-group">
                        <label><?=getContentLanguageSelected('TRAVEL_START_DATE',defaultSelectedLanguage())?><span class="required">*</span></label>
                        
                        <input type="text" class="form-control" name="travel_start_date" id="travel_start_date" placeholder="Travel Start Date" value="<?php echo set_value('travel_start_date') ?>">
                        <?=form_error('travel_start_date'); ?>
                      </div>

                      <div class="form-group">
                        <label><?=getContentLanguageSelected('TRAVEL_END_DATE',defaultSelectedLanguage())?><span class="required">*</span></label>
                       
                        <input type="text" class="form-control" name="travel_end_date" id="travel_end_date" placeholder="Travel End Date" value="<?php echo set_value('travel_end_date') ?>">
                        <?=form_error('travel_end_date'); ?>
                      </div>

                      <div class="form-group">
                        <label><?=getContentLanguageSelected('DESTINATION_OF_TRIP',defaultSelectedLanguage())?><span class="required">*</span></label>
                        <input type="text" class="form-control" name="destination_of_trip" id="destination_of_trip" placeholder="Destination of Trip" value="<?php echo set_value('destination_of_trip') ?>">
                        <?=form_error('destination_of_trip'); ?>
                      </div>

                      <div class="form-group">
                        <label><?=getContentLanguageSelected('TOTAL_NUMBER_OF_TRAVELERS',defaultSelectedLanguage())?><span class="required">*</span></label>
                        <?php $data = ' class="form-control input" id="total_travelers" ';
                        
                        echo form_dropdown('total_travelers',getTravelerOptions('Select Travellers'),set_value("total_travelers"),$data);?>
                        <?=form_error('total_travelers'); ?>
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