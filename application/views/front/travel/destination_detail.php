<section class="travelInsur">
  <div class="container">
    <div class="row">
      <aside class="col-sm-6"><img src="<?=base_url(); ?>assets/front/images/travel-insurance.jpg" class="img-responsive"></aside>
      <aside class="col-sm-6">
        <h1><?=getContentLanguageSelected('TRAVEL_INSURANCE',defaultSelectedLanguage())?></h1>
        <div class="insureForm">
          <form method="post" action="">
            <div class="form-group">
              <label><?=getContentLanguageSelected('TRAVELLING_DATE',defaultSelectedLanguage())?></label>
              <div class="clearfix"></div>
              <div class="row">
                <div class="col-sm-6">
                  <input type="text" class="form-control" name="travel_start_date" id="travel_start_date" placeholder="From" value="<?php echo set_value('travel_start_date') ?>">
                  <?=form_error('travel_start_date'); ?>
                </div>
                <div class="col-sm-6">
                  <input type="text" class="form-control" name="travel_end_date" id="travel_end_date" placeholder="To" value="<?php echo set_value('travel_end_date') ?>">
                  <?=form_error('travel_end_date'); ?>
                </div>
              </div>
            </div>
            <div class="form-group">
              <div class="row">
                <div class="col-sm-6">
                  <label><?=getContentLanguageSelected('TRIP_DESTINATION',defaultSelectedLanguage())?></label>
                  <input type="text" class="form-control" name="destination_of_trip" id="destination_of_trip" placeholder="Destination of Trip" value="<?php echo set_value('destination_of_trip') ?>">
                  <?=form_error('destination_of_trip'); ?>
                </div>
                <div class="col-sm-6">
                  <label><?=getContentLanguageSelected('NO_OF_TRAVELLERS',defaultSelectedLanguage())?></label>
                  <?php $data = ' class="form-control input" id="total_travelers" ';
                  echo form_dropdown('total_travelers',getTravelerOptions('Select'),set_value("total_travelers"),$data);?>
                  <?=form_error('total_travelers'); ?>
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
<!-- Travel Insurance -->
<hr>
