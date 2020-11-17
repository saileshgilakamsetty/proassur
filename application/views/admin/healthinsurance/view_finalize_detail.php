<?php
$estimation_amount = 0;
foreach ($estimation_data as  $record) {
   if($record->name == 'person_amount') {
      $estimation_amount +=$record->amount;
      $estimation_covered[] = $record->name;
   }
}

   $health_quote_record           = getHealthInsuranceQuoteRecordByCompanyId($company_id,$days_to_health_insurance);
  
   $agesOfInsuredPerson = getAgesOfInsuredPersonHealthByHealthId($health_insurance_id);

   foreach ($agesOfInsuredPerson as $value) {
      if (!empty($health_quote_record)) {
         if($value <= $health_quote_record->child_below_age  ) {
            $amount['child'] += $health_quote_record->amount_child_below_age;
            $person['child'] += 1;
         }
         else if($value >= $health_quote_record->adult_above_age && $value <=$health_quote_record->surprime_above_age) {
            $amount['adult'] += $health_quote_record->amount_adult_above_age;
            $person['adult'] += 1;
         }
         else {
            $amount['surprime'] += $health_quote_record->amount_surprime_above_age;
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

   // $net_premium       = $estimation_amount + $person_amount;
   $net_premium       = $person_amount;
   $accessories_id    = getAccessoriesId($net_premium,$company_id,$branch_id);
   $accessories_value = getAccessoriesValue($net_premium,$company_id,$branch_id);
   //$tax_amount        = getTaxAmount($accessories_value + $estimation_amount + $person_amount);
   $tax_amount        = getTaxAmount(($accessories_value + $net_premium),$company_id,$branch_id);
   $total_premium     = $net_premium + $accessories_value + $tax_amount;

?>


<div class="content-wrapper">
   
   <section class="content-header">
      <div class="header-icon">
         <i class="pe-7s-box1"></i>
      </div>
      <div class="header-title">
         <h1><?=getContentLanguageSelected('SELECTED_COMPANY_NAME',defaultSelectedLanguage())?></h1>
         <small><?=getContentLanguageSelected('SELECTED_COMPANY_NAME',defaultSelectedLanguage())?></small>
         <ol class="breadcrumb hidden-xs">
            <li><a href="<?=base_url('admin/dashboard');?>"><i class="pe-7s-home"></i><?=getContentLanguageSelected('HOME',defaultSelectedLanguage())?></a></li>
            <li class="active"><?=getContentLanguageSelected('SELECTED_COMPANY_NAME',defaultSelectedLanguage())?></li>
         </ol>
      </div>
   </section>
  
   <section class="content">
      <div class="row">
         <div class="col-sm-12">
            <?php $success= $this->session->flashdata('message'); 
               if(!empty($success)) { ?>
            <div class="panel panel-success">
               <div class="panel-heading">
                  <?php echo $this->session->flashdata('message'); ?>
               </div>
            </div>
            <?php } ?>


            <div class="panel panel-bd">
               <div class="panel-heading">
                  <form  method="post" enctype="multipart/form-data">
                     <input type="hidden" name="insurance_type_id" value="2" >
                     <input type="hidden" name="person_amount" value="<?= $person_amount?>" >
                     <input type="hidden" name="estimation_amount" value="<?= $estimation_amount?>" >
                     <input type="hidden" name="accessories_id" value="<?= $accessories_id?>" >
                     <div class="form-group">
                        <label><?=getContentLanguageSelected('PERSON_AMOUNT',defaultSelectedLanguage())?> <span class="required">*</span></label>
                        <div class="panel-body">
                           <div class="table-responsive">
                              <table id="example2" class="table table-bordered table-hover">
                                 <thead>
                                    <tr>
                                       <td></td>
                                       <td><?=getContentLanguageSelected('ADULT',defaultSelectedLanguage())?></td>
                                       <td><?=getContentLanguageSelected('CHILD',defaultSelectedLanguage())?></td>
                                       <td><?=getContentLanguageSelected('SURPRIME',defaultSelectedLanguage())?></td>
                                    </tr>
                                    <tr>
                                       <td><?=getContentLanguageSelected('AMOUNT',defaultSelectedLanguage())?></td>
                                    <?php
                                    foreach ($amount as $value) { ?>
                                       <td><?=$value?></td>
                                    <?php }?>
                                    </tr>
                                    <tr>
                                    <td><?=getContentLanguageSelected('NUMBER',defaultSelectedLanguage())?></td>
                                    <?php
                                    foreach ($person as $value) { ?>
                                       <td>
                                       <?=$value?>
                                       </td>
                                    <?php }?>
                                    </tr>
                                    <tr>
                                       <td></td>
                                       <td></td>
                                       <td></td>
                                       <td></td>
                                    </tr>
                                    <tr>
                                    <td><?=getContentLanguageSelected('TOTAL_AMOUNT',defaultSelectedLanguage())?></td>
                                    <td></td>
                                    <td></td>
                                       <td><b><?=$person_amount?></b></td>
                                    </tr>
                                 </thead>
                              </table>
                           </div>
                        </div>
                     </div>


                      <div class="row">
                        <div class="form-group col-md-6">
                           <label><?=getContentLanguageSelected('NET_PREMIUM',defaultSelectedLanguage())?> <span class="required">*</span></label>
                              <input type="text" class="form-control" name="net_premium" id="net_premium" readonly placeholder="Net Premium" value="<?php  print_r($net_premium);?>">
                              <?=form_error('net_premium'); ?>
                        </div>


                        <div class="form-group col-md-6">
                           <label><?=getContentLanguageSelected('ACCESSORIES',defaultSelectedLanguage())?><span class="required">*</span>
                           </label>
                              <input type="text" class="form-control" name="accessories" readonly id="accessories" placeholder="Accessories" value="<?=$accessories_value?>">
                              <?=form_error('accessories'); ?>
                        </div>
                     </div>
                     
                     <div class="row">
                        <div class="form-group col-md-6">
                           <label><?=getContentLanguageSelected('TAX',defaultSelectedLanguage())?><span class="required">*</span></label>
                              <input type="text" class="form-control" readonly name="tax" id="tax" placeholder="Tax" value="<?=$tax_amount?>">
                              <?=form_error('tax'); ?>
                        </div>
                        <div class="form-group col-md-6">
                           <label><?=getContentLanguageSelected('TOTAL_PREMIUM',defaultSelectedLanguage())?><span class="required">*</span></label>
                           <input type="text" class="form-control" readonly name="total_premium" id="total_premium" placeholder="Total Premium" value="<?=$total_premium?>">
                           <?=form_error('total_premium'); ?>
                        </div>
                     </div>

                     <div class="row">
                      <div class="form-group col-md-6">
                         <label><?=getContentLanguageSelected('POLICY_CODE',defaultSelectedLanguage())?><span class="required">*</label>
                         <input type="text" class="form-control" name="policy_code" id="travel_policy_number" readonly value="<?= getPolicyCodeForCompany($company_id)?>" autocomplete="off" >
                         <span class="text-danger" id="travel_policy_error"></span>
                      </div>
                      <div class="form-group col-md-6">
                         <label><?=getContentLanguageSelected('POLICY_NUMBER',defaultSelectedLanguage())?><span class="required">*</label>
                         <input type="text" class="form-control" name="policy_prefix" id="travel_policy_number" value="" autocomplete="off" placeholder="Policy Number Prefix ">
                         <span class="text-danger" id="travel_policy_error"></span>
                      </div>
                  </div>

                     <!--div class="form-group">
                        <label><?=getContentLanguageSelected('ESTIMATION_COVERED',defaultSelectedLanguage())?><span class="required">*</span></label>

                        <div class="panel-body">
                           <div class="table-responsive">
                              <table id="example2" class="table table-bordered table-hover">
                                 <thead>    
                                       <?php
                                       foreach ($estimation_data as $value) { ?>
                                          <tr>
                                          <td><?=$value->name?></td>
                                          <td><?=$value->amount?></td>
                                          </tr>
                                       <?php }
                                       ?>
                                       <tr>
                                       <td> <?=getContentLanguageSelected('ESTIMATION_AMOUNT',defaultSelectedLanguage())?></td>
                                       <td>
                                       <b>
                                          <?=$estimation_amount?>
                                       </b>
                                       </td>
                                       </tr>                           
                                 </thead>
                              </table>
                           </div>
                        </div>
                     </div-->

                     <div class="reset-button">
                        <button class="btn btn-success" id="get_the_value"><?=getContentLanguageSelected('SAVE_AND_PROCEED',defaultSelectedLanguage())?></button>
                     </div>
                  </form>
   
               </div>
            </div>
         </div>
      </div>
   </section>
</div>
