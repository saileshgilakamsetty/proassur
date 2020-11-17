
<section class="travelInsur">
  <div class="container">
    <div class="row">
      <aside class="col-sm-6"><img src="<?=base_url(); ?>assets/front/images/travel-insurance.jpg" class="img-responsive"></aside>
      <aside class="col-sm-6">
        <h1><?=getContentLanguageSelected('TRAVEL_INSURANCE',defaultSelectedLanguage())?></h1>
        <div class="insureForm">
      		<form action="" method="post" id="travel_basic_info_form">
            <input type="hidden" name="user_id" id="user_id" value="<?= $this->session->userdata('user_id');?>">
            <div class="form-group">
              <label><?=getContentLanguageSelected('NO_PERSONS_TO_INSURED',defaultSelectedLanguage())?></label>
              <?php $data = ' class="form-control input" id="people_to_be_insured" ';
                echo form_dropdown('people_insured',getPeopleOptions('Select People'),set_value("people_insured"),$data);?>
              <?=form_error('people_insured'); ?>
            </div>
            <div id="people_to_insured">
              <div class="form-group">
                <label><?=getContentLanguageSelected('PEOPLE_TO_BE_INSURED',defaultSelectedLanguage())?></label>
                <!-- <a href="#" class="addMore">Add More people</a> -->
                <div class="clearfix"></div>
                <div class="row">
                  <div class="col-sm-6">
                    <input name="firstname_1" id="firstname_1" type="text" placeholder="First Name" value="<?php echo set_value('firstname_1') ?>">
                    <?=form_error('firstname_1'); ?>
                  </div>
                  <div class="col-sm-6">
                    <input name="lastname_1" id="lastname_1" type="text" placeholder="Last Name" value="<?php echo set_value('lastname_1') ?>">
                    <?=form_error('lastname_1'); ?>
                  </div>
                </div>
              </div>
              <div class="form-group calen1">
                <label><?=getContentLanguageSelected('AGE_OF_PERSON',defaultSelectedLanguage())?></label>
                <input name="age_1" id="age_1" type="text" placeholder="Enter Date" value="<?php echo set_value('age_1') ?>">
                <i class="far fa-calendar-alt"></i> 
                <?=form_error('age_1'); ?>
              </div>
            </div>
            <button type="button" id="travel_basic_info_submit"><?=getContentLanguageSelected('SAVE_AND_PROCEED',defaultSelectedLanguage())?></button>
          </form>
        </div>
      </aside>
    </div>
  </div>
</section>
<!-- Travel Insurance -->
<hr>
