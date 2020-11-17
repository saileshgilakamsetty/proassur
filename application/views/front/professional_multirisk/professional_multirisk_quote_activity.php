<!-- Insurance -->
<section class="travelInsur"> <!-- <img src="<?= base_url();?>assets/front/images/accident-insurance.jpg" class="img-responsive insImg"> -->
  <div class="container">
    <div class="row">
      <div class="col-xs-12 col-sm-8 col-sm-offset-4 col-md-6 col-md-offset-6">
        <h1><?=getContentLanguageSelected('PROFESSIONAL_MULTIRISK_INSURANCE',defaultSelectedLanguage())?></h1>
        <div class="insureForm">
          <form action="" method="post" enctype="multipart/form-data">
            <div class="form-group">
              <label><?=getContentLanguageSelected('ACTIVITY',defaultSelectedLanguage())?><span class="required">*</span></label>
              <?php $data = ' class="form-control" input" ';
                echo form_dropdown('activity_id',getIndividualAccidentActivityOptions('tbl_activity','Select Activity',1),set_value("activity_id"),$data);?>
              <?=form_error('activity_id'); ?>
            </div>
            
            <div class="form-group">
              <label><?=getContentLanguageSelected('ENTER_THE_CAPITAL_TO_BE_INSURED',defaultSelectedLanguage())?><span class="required">*</span></label>
              <input type="text" class="form-control" name="capital_insured" id="capital_insured" placeholder="Enter Capital" value="<?php echo set_value('capital_insured') ?>">
              <?=form_error('capital_insured'); ?>
            </div>

            <button type="submit" id=""><?=getContentLanguageSelected('SAVE_AND_PROCEED',defaultSelectedLanguage())?></button>
          </form>
        </div>
      </div>
    </div>
  </div>
</section>
<!-- Insurance -->