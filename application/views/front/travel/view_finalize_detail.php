<?php
$estimation_amount = 0;
foreach ($estimation_data as  $record) {
   $estimation_amount +=$record->amount;
   $estimation_covered[] = $record->name;
}


   $travel_quote_record           = getTravelQuoteRecordByCompanyId($company_id,$days_to_travel);
   $agesOfInsuredPerson           = getAgesOfInsuredPersonTravelByTravelId($travel_id);
   $company_name = getCompanyName($company_id);

   foreach ($agesOfInsuredPerson as $value) {
      if (!empty($travel_quote_record)) {
         if($value <= $travel_quote_record->child_below_age  ) {
            $amount['child'] += $travel_quote_record->amount_child_below_age;
            $person['child'] += 1;
         }
         else if($value >= $travel_quote_record->adult_above_age && $value <=$travel_quote_record->surprime_above_age) {
            $amount['adult'] += $travel_quote_record->amount_adult_above_age;
            $person['adult'] += 1;
         }
         else {
            $amount['surprime'] += $travel_quote_record->amount_surprime_above_age;
            $person['surprime'] += 1;
         }
      }
      else {
         $amount['child']    = 0;
         $amount['adult']    = 0;
         $amount['surprime'] = 0;
      }
   }

   foreach ($amount as $value) {
      $person_amount += $value;
   }

   $net_premium       = $estimation_amount + $person_amount;
   $accessories_id    = getAccessoriesId($net_premium,$company_id,$branch_id);
   $accessories_value = getAccessoriesValue($net_premium,$company_id,$branch_id);
   // $tax_amount        = getTaxAmount($accessories_value + $estimation_amount + $person_amount);
   $tax_amount        = getTaxAmount(($accessories_value + $net_premium),$company_id,$branch_id);
   $total_premium     = $estimation_amount + $person_amount + $accessories_value + $tax_amount;

?>

<!-- Travel Insurance -->
<section class="travelInsur">
  <div class="container">
    <div class="row">
      <aside class="col-sm-6"><img src="<?=base_url(); ?>assets/front/images/travel-insurance.jpg" class="img-responsive"></aside>
      <aside class="col-sm-6">
        <div class="insDetail">
          <form method="post" action="">
            <input type="hidden" name="insurance_type_id" value="3">
            <input type="hidden" name="person_amount" value="<?= ($person_amount)?$person_amount:0;?>">
            <input type="hidden" name="estimation_amount" value="<?= $estimation_amount?>">
            <input type="hidden" name="net_premium" value="<?= $net_premium?>">
            <input type="hidden" name="accessories" value="<?= ($accessories_value)?$accessories_value:0;?>">
            <input type="hidden" name="accessories_id" value="<?= $accessories_id;?>">
            <input type="hidden" name="tax" value="<?= $tax_amount?>">
            <input type="hidden" name="total_premium" value="<?= $total_premium?>">
            <div class="insBox">
              <h1><?= $company_name;?></h1>
              <ul>
                <li><?=getContentLanguageSelected('START_DATE',defaultSelectedLanguage())?><span><?= date("m/d/Y",strtotime($travel_dates->travel_start_date));?></span></li>
                <li><?=getContentLanguageSelected('END_DATE',defaultSelectedLanguage())?><span><?= date("m/d/Y",strtotime($travel_dates->travel_end_date));?></span></li>
              </ul>
            </div>
            <div class="insBox">
              <h3><?=getContentLanguageSelected('PERSON_AMOUNT',defaultSelectedLanguage())?></h3>
              <ul>
                <li><?=getContentLanguageSelected('ADULT',defaultSelectedLanguage())?><span><?= ($person['adult'])?$person['adult']:0;?></span></li>
                <li><?=getContentLanguageSelected('CHILD',defaultSelectedLanguage())?><span><?= ($person['child'])?$person['child']:0;?></span></li>
                <li><?=getContentLanguageSelected('AMOUNT',defaultSelectedLanguage())?><span><?= ($person_amount)?$person_amount:0;?></span></li>
              </ul>
            </div>
            
            <div class="insBox">
              <ul>
                <li><?=getContentLanguageSelected('NET_PREMIUM',defaultSelectedLanguage())?><span><?= $net_premium;?></span></li> 
                <li><?=getContentLanguageSelected('ACCESSORIES',defaultSelectedLanguage())?><span><?= ($accessories_value)?$accessories_value:0;?></span></li>
                <li><?=getContentLanguageSelected('TAX',defaultSelectedLanguage())?><span><?= $tax_amount;?></span></li>
                <li><?=getContentLanguageSelected('TOTAL_PREMIUM',defaultSelectedLanguage())?><span><?= $total_premium;?></span></li>
              </ul>
            </div>

            <div class="insBox">
              <h3><?=getContentLanguageSelected('ESTIMATION_COVERED',defaultSelectedLanguage())?></h3>
              <ul>
                 <?php foreach($estimation_data as $value) { ?>
                    <li><?= $value->name;?><span><?= $value->amount;?></span></li>
                 <?php } ?>
                 <li>Estimation Amount<span><?= $estimation_amount;?></span></li>
              </ul>
            </div>
            <button type="submit"><?=getContentLanguageSelected('SAVE_AND_PROCEED',defaultSelectedLanguage())?></button>
          </form>
        </div>
      </aside>
    </div>
  </div>
</section>
<!-- Travel Insurance -->