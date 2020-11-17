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
              <label><?=getContentLanguageSelected('NAME_OF_CHIEF/FATHER',defaultSelectedLanguage())?></label>
              <div class="clearfix"></div>
              <div class="row">
                <div class="col-sm-6">
                  <input name="name_of_chief" id="name_of_chief" type="text" placeholder="Name">
                </div>
              </div>
              <?= form_error('name_of_chief');?>
            </div>
            <div class="row">
              <div class="col-sm-6">
                <div class="form-group calen1">
                  <label><?=getContentLanguageSelected('AGE_OF_PERSON',defaultSelectedLanguage())?></label>
                  <input name="age_of_chief" id="age_of_chief" type="text" placeholder="Enter Date">
                  <i class="far fa-calendar-alt"></i>
                  <?= form_error('age_of_chief');?> 
                </div>
              </div>
              <div class="col-sm-6">
                <div class="form-group">
                  <label><?=getContentLanguageSelected('NO_OF_PERSONS_TO_BE_INSURED',defaultSelectedLanguage())?></label>
                  <?php $data = ' class="form-control input" id="persons_insured" ';
                  echo form_dropdown('persons_insured',getPersonsOptions('Select People'),set_value("persons_insured"),$data);?>
                  <?=form_error('persons_insured'); ?>
                </div>
              </div>
            </div>
            <button type="submit"><?=getContentLanguageSelected('SAVE_AND_PROCEED',defaultSelectedLanguage())?></button>
          </form>
        </div>
      </aside>
    </div>
  </div>
</section>
<!-- Health Insurance -->