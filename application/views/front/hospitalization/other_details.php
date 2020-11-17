<!-- Health Insurance -->
<section class="travelInsur hlthInsur">
  <div class="container">
    <div class="row">
      <aside class="col-sm-6"><img src="<?= base_url();?>assets/front/images/health-insurance.jpg" class="img-responsive"></aside>
      <aside class="col-sm-6">
        <h1><?=getContentLanguageSelected('HOSPITALIZATION_APPROVAL',defaultSelectedLanguage())?></h1>
        <div class="insureForm">
          <form method="post" action="" id="" enctype="multipart/form-data" >
            <input type="hidden" name="user_id" id="user_id" value="<?= $this->session->userdata('user_id');?>">
            <div class="row form-group">
              <div class="col-sm-6">
                <div class="form-group">
                  <label><?=getContentLanguageSelected('HEALTH_CARE_PROVIDER_NAME',defaultSelectedLanguage())?></label>
                  <?php $data = ' class="form-control input" ';
                  echo form_dropdown('healthcareprovider_name_id',getCompanyOptions('tbl_healthcareprovider_name','Select Healthcare Provider',1),(!empty($hospitalization['healthcareprovider_name_id']))?$hospitalization['healthcareprovider_name_id']:set_value("healthcareprovider_name_id"),$data);?>
                  <?=form_error('healthcareprovider_name_id'); ?>
                </div>
                <div class="form-group">
                  <label><?=getContentLanguageSelected('PROVIDER_CONTACT_NUMBER',defaultSelectedLanguage())?></label>
                  <div>
                     <input type="hidden" class="form-control" name="dial_code" id="dial_code" placeholder="Dial Code" value="<?= getAreaCode()?>">
                    <input type="text" class="form-control" name="provider_contact_number" id="provider_contact_number" placeholder="Provider Contact Number" value="<?php echo (!empty($hospitalization['provider_contact_number']))?$hospitalization['provider_contact_number']:set_value('provider_contact_number') ?>" >
                    <?=form_error('provider_contact_number'); ?>
                  </div>
                </div>
                <div class="form-group">
                  <label><?=getContentLanguageSelected('DESCRIPTION',defaultSelectedLanguage())?><span class="required">*</span></label>
                  <textarea class="form-control " name="description" id="description" placeholder="Description" rows="5"><?php echo (!empty($hospitalization['description']))?$hospitalization['description']:set_value('description') ?></textarea>
                  <?=form_error('description'); ?>
                </div>
              </div>
              <div class="col-sm-6">
                <div class="form-group">
                  <label><?=getContentLanguageSelected('PROVIDER_CONTACT_PERSON_NAME',defaultSelectedLanguage())?><span class="required">*</span></label>
                  <input type="text" class="form-control" name="provider_person_name" id="provider_person_name" placeholder="Provider Contact Person Name" value="<?php echo (!empty($hospitalization['provider_person_name']))?$hospitalization['provider_person_name']:set_value('provider_person_name') ?>" >
                  <?=form_error('provider_person_name'); ?>
                </div>
                <div class="form-group">
                  <label><?=getContentLanguageSelected('PROVIDER_ADDRESS',defaultSelectedLanguage())?></label>
                  <input type="text" class="form-control" id="site_location" name="provider_address" value="" placeholder="Provider Address" autocomplete="off" value="<?php echo (!empty($hospitalization['provider_address']))?$hospitalization['provider_address']:set_value('provider_address')?>">
                  <?= form_error('provider_address');?>
                </div>
                <div class="form-group">
                  <label><?=getContentLanguageSelected('ATTACH_DOCUMENTS',defaultSelectedLanguage())?></label>
                  <input type="file" class="form-control" name="images[]" id="" multiple="">
                  <?= form_error('images');?>
                </div>
              </div>
            </div>
            <div id="address">
              <input type="hidden" name="country" id="country" disabled="true">
              <input type="hidden" name="state" id="administrative_area_level_1" disabled="true">
              <input type="hidden" name="city" id="locality" disabled="true">
              <input type="hidden" name="postal_code" id="postal_code" disabled="true">
              <input type="hidden" id="street_number" disabled="true">
              <input type="hidden" id="route" disabled="true">                
              <input type="hidden" id="latitude" name="latitude" value="<?php echo set_value('latitude'); ?>">
              <input type="hidden" id="longitude" name="longitude" value="<?php echo set_value('longitude'); ?>">
            </div>
            <button type="submit" id=""><?=getContentLanguageSelected('SAVE_AND_PROCEED',defaultSelectedLanguage())?></button>
          </form>
        </div>
      </aside>
    </div>
  </div>
</section>
<!-- Health Insurance -->