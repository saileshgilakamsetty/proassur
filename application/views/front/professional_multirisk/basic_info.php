<!-- Insurance -->
<section class="travelInsur hlthInsur">
  <div class="container">
    <div class="row">
      <div class="col-sm-6">
        <img src="<?= base_url();?>assets/front/images/multirisk-insurance.jpg" class="img-responsive">
      </div>
      <div class="col-xs-12 col-sm-6">
        <h1><?=getContentLanguageSelected('PROFESSIONAL_MULTIRISK_INSURANCE',defaultSelectedLanguage())?></h1>
        <div class="insureForm">
          <form action="" method="post" id="professional_multirisk_basic_info_form" enctype="multipart/form-data">
            <input type="hidden" name="user_id" id="user_id" value="<?= $this->session->userdata('user_id');?>">
            <div class="form-group">
              <label><?=getContentLanguageSelected('ADDRESS',defaultSelectedLanguage())?><span class="required">*</span></label>
              <input type="text" class="form-control" id="site_location" name="address" placeholder="Address" value="<?=set_value('address'); ?>">
              <?=form_error('address'); ?>
            </div>

            <div class="form-group">
              <label><?=getContentLanguageSelected('BUSINESS_ADDRESS',defaultSelectedLanguage())?><span class="required">*</span></label>
              <input type="text" class="form-control" id="site_location_business" name="business_address" placeholder="Business Address" value="<?=set_value('business_address'); ?>">
              <?=form_error('business_address'); ?>
            </div>

            <div class="form-group">
              <label><?=getContentLanguageSelected('CONTACT_NUMBER',defaultSelectedLanguage())?><span class="required">*</span></label>
              <div>
                <input type="hidden" class="form-control" name="dial_code" id="dial_code" placeholder="Dial Code" readonly value="<?=getAreaCode() ?>"  style='display: inline; width: 17%;'>
                <input type="text" class="form-control" name="mobile" id="mobile" placeholder="Enter Contact Number" value="<?php echo set_value('mobile') ?>"  style='display: inline; width: 82%;'>
                <?=form_error('dial_code'); ?>
                <?=form_error('mobile'); ?>
              </div>
            </div>

            <div class="form-group">
              <div class="control-group">
                <label><?=getContentLanguageSelected('ATTACH_DOCUMENTS',defaultSelectedLanguage())?><span class="required">*</span></label>
                <input type="file" name="attach_document" id="attach_document"/>
              </div>
            </div>  

            <div class="form-group radioCheck">
              <p><?=getContentLanguageSelected('TACIT_POLICY',defaultSelectedLanguage())?></p>
              <label><input type="radio" name="tacit_policy"  value="1" checked="checked" >Yes</label>
              <label><input type="radio" name="tacit_policy"  value="0" >No</label>
            </div>
                         
            <button type="button" id="professional_multirisk_basic_info_submit"><?=getContentLanguageSelected('SAVE_AND_PROCEED',defaultSelectedLanguage())?></button>
          </form>
        </div>
      </div>
    </div>
  </div>
</section>
<!-- Insurance -->