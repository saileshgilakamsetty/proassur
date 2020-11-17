<?php
$estimation_amount = 0;

foreach ($estimation_data as  $record) {
  if($record->title != 'estimation_amount') {
    $estimation_amount +=$record->amount_to_pay;
    $estimation_covered[] = $record->title;
  }
}

$net_premium       = $estimation_amount;
$accessories_id    = getAccessoriesId($net_premium,$company_id,$branch_id);
$accessories_value = getAccessoriesValue($net_premium,$company_id,$branch_id);
// $tax_amount        = getTaxAmount($accessories_value + $estimation_amount);
$tax_amount        = getTaxAmount(($accessories_value + $net_premium),$company_id,$branch_id);
$total_premium     = $estimation_amount + $accessories_value + $tax_amount;
?>

<!-- Individual Accident Insurance -->
<section class="travelInsur">
  <div class="container">
    <div class="row">
      <aside class="col-sm-6"><img src="<?=base_url(); ?>assets/front/images/accident-insurance.jpg" class="img-responsive"></aside>
      <aside class="col-sm-6">
        <div class="insDetail">
          <form method="post" action="">
            <input type="hidden" name="insurance_type_id" value="5">
            <input type="hidden" name="person_amount" value="<?= ($person_amount)?$person_amount:0;?>">
            <input type="hidden" name="estimation_amount" value="<?= $estimation_amount?>">
            <input type="hidden" name="net_premium" value="<?= $net_premium?>">
            <input type="hidden" name="accessories" value="<?= ($accessories_value)?$accessories_value:0;?>">
            <input type="hidden" name="accessories_id" value="<?= $accessories_id;?>">
            <input type="hidden" name="tax" value="<?= $tax_amount?>">
            <input type="hidden" name="total_premium" value="<?= $total_premium?>">
            <div class="insBox">
              <h1><?= getName($company_id,'tbl_company');?></h1>
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
                 <?php foreach($estimation_data as $value) { if($value->title != 'estimation_amount') { ?>
                    <li><?= $value->title;?><span><?= $value->amount_to_pay;?></span></li>
                 <?php } } ?>
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