<!-- Health Insurance -->
<section class="travelInsur hlthInsur">
  <div class="container">
    <div class="row">
      <aside class="col-sm-6"><img src="<?= base_url();?>assets/front/images/health-insurance.jpg" class="img-responsive"></aside>
      <aside class="col-sm-6">
        <h1><?=getContentLanguageSelected('HEALTH_INSURANCE',defaultSelectedLanguage())?></h1>
        <div class="insureForm">
          <form method = "post" action = "">
            <div class="form-group">
              <label><?=getContentLanguageSelected('PEOPLE_TO_BE_INSURED',defaultSelectedLanguage())?></label>
              <div class="clearfix"></div>
              <div class="row">
                <div class="col-sm-6">
                  <input name="first_name" id="first_name" type="text" placeholder="First Name">
                  <?= form_error('first_name');?>
                </div>
                <div class="col-sm-6">
                  <input name="last_name" id="last_name" type="text" placeholder="Last Name">
                  <?= form_error('last_name');?>
                </div>
              </div>
            </div>
            <div class="form-group calen1">
              <label><?=getContentLanguageSelected('AGE_OF_PERSON',defaultSelectedLanguage())?></label>
              <input name="age_person" id="age_person" type="text" placeholder="Enter Date">
              <i class="far fa-calendar-alt"></i> 
              <?= form_error('age_person');?>
            </div>
            <button type="submit"><?=getContentLanguageSelected('SAVE_AND_PROCEED',defaultSelectedLanguage())?></button>
          </form>
        </div>
      </aside>
    </div>
  </div>
</section>
<!-- Health Insurance -->