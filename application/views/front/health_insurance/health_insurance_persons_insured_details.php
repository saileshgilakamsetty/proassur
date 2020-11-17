<!-- Health Insurance -->
<section class="travelInsur hlthInsur">
  <div class="container">
    <div class="row">
      <aside class="col-sm-6"><img src="<?= base_url();?>assets/front/images/health-insurance.jpg" class="img-responsive"></aside>
      <aside class="col-sm-6">
        <h1><?=getContentLanguageSelected('HEALTH_INSURANCE',defaultSelectedLanguage())?></h1>
        <div class="insureForm">
          <form method = "post" action = "">
            <?php for($i = 1; $i <= $persons_insured; $i++) { ?>
              <div class="form-group">
                <label><?=getContentLanguageSelected('PEOPLE_TO_BE_INSURED',defaultSelectedLanguage())?></label>
                <input name="full_name_<?= $i;?>" id="full_name_<?= $i?>" type="text" placeholder="Name">
                <?= form_error('full_name_'.$i);?>
              </div>
              <div class="form-group calen1">
                <label>Age of person</label>
                <input name="age_of_each_person_<?= $i;?>" id="age_of_each_person_<?= $i;?>" class = "age_of_each_person" type="text" placeholder="Enter Date">
                <i class="far fa-calendar-alt"></i> 
                <?= form_error('age_of_each_person_'.$i);?>
              </div>
            <?php } ?>
            <button type="submit"><?=getContentLanguageSelected('SAVE_AND_PROCEED',defaultSelectedLanguage())?></button>
          </form>
        </div>
      </aside>
    </div>
  </div>
</section>
<!-- Health Insurance -->