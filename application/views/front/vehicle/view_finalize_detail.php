<?php
$total_amount =0;
    foreach ($final_data as $record) {
      if ($record->type == 'warranties') {
        $total_amount +=$record->value;
        $warranties_name[] = $record->name;
      }
      else if($record->type == 'franchise') {
        $total_amount -=$record->value;
        $franchise_name[] = $record->name;
      }
      else if($record->type == 'trans_person') {
        $total_amount +=$record->value;
        $trans_person_name[] = $record->name;
      }
      else if($record->type == 'required_data') {
        $total_amount +=$record->value;
      }     
    }
?>


<?php
   $accessories_id    = getAccessoriesId($total_amount,$company_id,$branch_id);
   $accessories_value = getAccessoriesValue($total_amount,$company_id,$branch_id);
   // $tax_amount        = getTaxAmount($accessories_value + $total_amount);
   $premium_value     = ($premium_rate*$estimation_amount)/100;
   $tax_amount        = getTaxAmount(($accessories_value + $premium_value),$company_id,$branch_id);
   $total_premium     = $accessories_value + $tax_amount + $premium_value;

   // $total_premium     = $total_amount + $accessories_value + $tax_amount + $premium_value;

?>

<section class="insurForm">
   <div class="container">
      <form action="" method="post">
         <input type="hidden" name="insurance_type_id" value="1">
         <input type="hidden" name="accessories_id" value="<?= $accessories_id;?>">
         <div class="row">
            <div class="col-xs-12">
               <h3 class="title"><?=getContentLanguageSelected('FINAL_DETAILS',defaultSelectedLanguage())?></h3>
            </div>
         </div>
         <div class="formFildes">
            <div class="row">

               <div class="col-xs-12 col-sm-6">
                  <div class="form-group">
                     <!-- <label><?=getContentLanguageSelected('POLICY_PREMIUM',defaultSelectedLanguage())?><span class="required">*</span></label> -->
                     <label><?=getContentLanguageSelected('NET_PREMIUM',defaultSelectedLanguage())?><span class="required">*</span></label>
                     <input type="text" class="form-control" readonly name="policy_premium" id="policy_premium" placeholder="policy_premium" value="<?=$premium_value?>">
                     <?=form_error('policy_premium'); ?>
                  </div>
               </div>
               
               <!-- <div class="col-xs-12 col-sm-6">
                  <div class="form-group">
                     <label><?=getContentLanguageSelected('NET_PREMIUM',defaultSelectedLanguage())?> <span class="required">*</span></label> -->
                     <input type="hidden" class="form-control" name="net_premium" id="net_premium" readonly placeholder="Net Premium" value="<?php  print_r($total_amount);?>">
                     <!-- <?=form_error('net_premium'); ?>
                  </div>
               </div> -->
               <div class="col-xs-12 col-sm-6">
                  <div class="form-group">
                     <label><?=getContentLanguageSelected('OPTIONAL_WARRANTIES',defaultSelectedLanguage())?><span class="required">*</span></label>
                     <input type="text" class="form-control" readonly name="optional_warranties1" id="optional_warranties" placeholder="Optional Warranties" value="<?php echo trim(implode(',', $warranties_name)); ?>">
                     <?=form_error('optional_warranties'); ?>
                  </div>
               </div>
            </div>
            <div class="row">
               <div class="col-xs-12 col-sm-6">
                  <div class="form-group">
                     <label><?=getContentLanguageSelected('INSURANCE_FOR_PEOPLE_BEING_TRANSPORTED',defaultSelectedLanguage())?><span class="required">*</span></label>
                     <input type="text" class="form-control" readonly name="trans_insurance" id="trans_insurance" placeholder="Insurance For People Being Transported" value="<?php echo implode(' ,',$trans_person_name) ?>">
                     <?=form_error('trans_insurance'); ?>
                  </div>
               </div>
               <div class="col-xs-12 col-sm-6">
                  <div class="form-group">
                     <label><?=getContentLanguageSelected('OPTIONAL_FRANCHISE',defaultSelectedLanguage())?><span class="required">*</span></label>
                     <input type="text" class="form-control" name="optional_franchise" id="optional_franchise" readonly placeholder="Optional Franchise" value="<?php echo implode(' ,', $franchise_name) ?>">
                     <?=form_error('optional_franchise'); ?>
                  </div>
               </div>
            </div>
            <div class="row">
               <div class="col-xs-12 col-sm-6">
                  <div class="form-group">
                     <label><?=getContentLanguageSelected('ACCESSORIES',defaultSelectedLanguage())?><span class="required">*</span>
                     </label>
                     <input type="text" class="form-control" name="accessories" readonly id="accessories" placeholder="Accessories" value="<?=$accessories_value?>">
                     <?=form_error('accessories'); ?>
                  </div>
               </div>
               <div class="col-xs-12 col-sm-6">
                  <div class="form-group">
                     <label><?=getContentLanguageSelected('TAX',defaultSelectedLanguage())?><span class="required">*</span></label>
                     <input type="text" class="form-control" readonly name="tax" id="tax" placeholder="Tax" value="<?=$tax_amount?>">
                     <?=form_error('tax'); ?>
                  </div>
               </div>

<!--                <div class="col-xs-12 col-sm-6">
                  <div class="form-group">
                     <label><?=getContentLanguageSelected('NET_PREMIUM',defaultSelectedLanguage())?><span class="required">*</span></label>
                     <input type="text" class="form-control" readonly name="policy_premium" id="policy_premium" placeholder="policy_premium" value="<?=$premium_value?>">
                     <?=form_error('policy_premium'); ?>
                  </div>
               </div> -->
            </div>
            <div class="row">
               <div class="col-xs-12 col-sm-6">
                  <div class="form-group">
                     <label><?=getContentLanguageSelected('TOTAL_PREMIUM',defaultSelectedLanguage())?><span class="required">*</span></label>
                     <input type="text" class="form-control" readonly name="total_premium" id="total_premium" placeholder="Total Premium" value="<?=$total_premium?>">
                     <?=form_error('total_premium'); ?>
                  </div>
               </div>
            </div>
            <div class="col-xs-12">
               <input type="submit" id="" value="SAVE_AND_PROCEED" class="subBtn">
            </div>
            <div class="clearfix"></div>
         </div>
      </form>
   </div>
</section>
<hr>


