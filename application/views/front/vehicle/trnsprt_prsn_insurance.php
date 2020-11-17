<?php
//print_r($vehicle_detail_id);

// die();
?>    
<div class="container">
      
  <div class="formFildes">
         
    <div class="col-xs-12">
      <h3 class="carOwner"><?=getContentLanguageSelected('INSURANCE_PEOPLE_BEING_TRANSPORTED',defaultSelectedLanguage())?></h3>
    </div>
                      
    <div class="col-xs-12">
      <div class="form-group radioCheck">
        <p><?=getContentLanguageSelected('DO_YOU_WANT_THIS_INSURANCE?',defaultSelectedLanguage())?></p>
        <label><input type="radio" vehicle_detail_id="<?=$vehicle_detail_id?>" name="insure_transported_person" value="1"  checked="checked"><?=getContentLanguageSelected('YES',defaultSelectedLanguage())?></label>
        <label><input type="radio" vehicle_detail_id= "<?=$vehicle_detail_id?>" name="insure_transported_person" value="0" ><?=getContentLanguageSelected('NO',defaultSelectedLanguage())?></label>
      </div>
      <hr>
    </div>
    <form  method="post" enctype="multipart/form-data">
      <div>
        <?=form_error('value_selected_travel_insure'); ?>
        <input type="hidden" id="value_selected_travel_insure" name="value_selected_travel_insure" value="">
      </div>
      <?php
      if(!empty($options)) {
        foreach ($options as $value) { ?>
          <div class="col-xs-6 col-md-4 xs12">
          	<div class="selectPlan">
              <label>
                <input type="radio" name="selected_option_transport_person" vehicle_detail_id="<?=$vehicle_detail_id?>" id="selected_option_transport_person_<?=$value->id?>" value="<?=$value->id?>">
              	<h3><?=$value->amount_to_pay?></h3>
                <p class="planName"><?=$value->title?></p>
              </label>
            </div>
          </div>
      <?php } } ?>
      <div class="col-xs-12">
      	<input type="submit" value="<?=getContentLanguageSelected('SAVE_AND_PROCEED',defaultSelectedLanguage())?>" class="subBtn">
      </div>
    </form>        
    <div class="clearfix"></div>
  </div>        
</div>
</section>
<hr>
