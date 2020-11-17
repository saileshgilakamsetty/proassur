<!-- Health Insurance -->
<section class="travelInsur hlthInsur">
  <div class="container">
    <div class="row">
      <aside class="col-sm-6"><img src="<?= base_url();?>assets/front/images/health-insurance.jpg" class="img-responsive"></aside>
      <aside class="col-sm-6">
        <h1><?=getContentLanguageSelected('HOSPITALIZATION_APPROVAL',defaultSelectedLanguage())?></h1>
        <div class="insureForm">
          <form method="post" action="" id="" >
            <input type="hidden" name="user_id" id="user_id" value="<?= $this->session->userdata('user_id');?>">
            <div class="row form-group">
              <div class="col-sm-6">
                <label><?=getContentLanguageSelected('THE_PATIENT_NAME',defaultSelectedLanguage())?></label>
                <input type="text" class="form-control" name="the_patient_name" id="the_patient_name" placeholder="The Patient Name" value="<?php echo (!empty($hospitalization['the_patient_name']))?$hospitalization['the_patient_name']:set_value('the_patient_name')?>">
                <?= form_error('the_patient_name');?>
              </div>
              <div class="col-sm-6">
                <label><?=getContentLanguageSelected('CONTACT_NUMBER',defaultSelectedLanguage())?></label>
                <input type="hidden" class="form-control" name="contact_dial_code" id="contact_dial_code" placeholder="Contact Dial Code" value="<?= getAreaCode()?>">
                <input type="text" class="form-control" name="contact_number" id="contact_number" placeholder="Contact Number" value="<?php echo (!empty($hospitalization['contact_number']))?$hospitalization['contact_number']:set_value('contact_number')?>">
                <?= form_error('contact_number');?>
              </div>
            </div>
            <button type="submit" id=""><?=getContentLanguageSelected('SAVE_AND_PROCEED',defaultSelectedLanguage())?></button>
          </form>
        </div>
      </aside>
    </div>
  </div>
</section>
<!-- Health Insurance -->