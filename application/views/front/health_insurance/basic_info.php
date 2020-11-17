<!-- Health Insurance -->
<section class="travelInsur hlthInsur">
  <div class="container">
    <div class="row">
      <aside class="col-sm-6"><img src="<?= base_url();?>assets/front/images/health-insurance.jpg" class="img-responsive"></aside>
      <aside class="col-sm-6">
        <h1><?=getContentLanguageSelected('HEALTH_INSURANCE',defaultSelectedLanguage())?></h1>
        <div class="insureForm">
          <div class="selectInsure">
            <form method="post" action="" id="health_insurance_basic_info_form">
              <input type="hidden" name="user_id" id="user_id" value="<?= $this->session->userdata('user_id');?>">
              <h4><?=getContentLanguageSelected('WHOM_DO_YOU_WANT_TO_INSURE ?',defaultSelectedLanguage())?></h4>
              <div class="row">
                <div class="col-sm-6 col-xs-6">
                  <label> <img src="<?= base_url();?>assets/front/images/individual-img.png" class="img-responsive">
                    <input type="radio" name="health_insurance_type_id" value="2" checked="checked">
                    <?=getContentLanguageSelected('INDIVIDUAL',defaultSelectedLanguage())?></label>
                </div>
                <div class="col-sm-6 col-xs-6">
                  <label> <img src="<?= base_url();?>assets/front/images/family.png" class="img-responsive">
                    <input type="radio" name="health_insurance_type_id" value="1" >
                    <?=getContentLanguageSelected('FAMILY',defaultSelectedLanguage())?></label>
                </div>
                <?= form_error('health_insurance_type_id');?>
              </div>
              <button type="button" id="health_insurance_basic_info_submit"><?=getContentLanguageSelected('SAVE_AND_PROCEED',defaultSelectedLanguage())?></button>
            </form>
          </div>
        </div>
      </aside>
    </div>
  </div>
</section>
<!-- Health Insurance -->