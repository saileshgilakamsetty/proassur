<!-- Health Insurance -->
<section class="travelInsur hlthInsur">
  <div class="container">
    <div class="row">
      <aside class="col-sm-6"><img src="<?= base_url();?>assets/front/images/health-insurance.jpg" class="img-responsive"></aside>
      <aside class="col-sm-6">
        <h1><?=getContentLanguageSelected('HEALTH_INSURANCE',defaultSelectedLanguage())?></h1>
        <div class="insureForm">
          <form method = "post" action = "">
            <div class="form-group calen1">
              <label><?=getContentLanguageSelected('SELECT_START_DATE',defaultSelectedLanguage())?></label>
              <input name="health_insurance_start_date" id="health_insurance_start_date" type="text" placeholder="Enter Start Date">
              <i class="far fa-calendar-alt"></i> 
              <?= form_error('health_insurance_start_date');?>
            </div>

            <div class="form-group calen1">
              <label><?=getContentLanguageSelected('SELECT_END_DATE',defaultSelectedLanguage())?></label>
              <input name="health_insurance_end_date" id="health_insurance_end_date" type="text" placeholder="Enter End Date">
              <i class="far fa-calendar-alt"></i> 
              <?= form_error('health_insurance_end_date');?>
            </div>
            <button type="submit"><?=getContentLanguageSelected('SAVE_AND_PROCEED',defaultSelectedLanguage())?></button>
          </form>
        </div>
      </aside>
    </div>
  </div>
</section>
<!-- Health Insurance -->