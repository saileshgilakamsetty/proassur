<style type="text/css">
   td.make_bold {
    font-weight: bold;
}
</style>

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
      else if($record->type == 'required_data') {
        $total_amount +=$record->value;
        $required_data[] = $record->name;
      }
      else if($record->type == 'required_data') {
        $total_amount +=$record->value;
      }     
    }
  

?>
<?php $company_id    = $final_data[0]->company_id; ?>

<?php
  $accessories_id    = getAccessoriesId($total_amount,$company_id,$branch_id);
  $accessories_value = getAccessoriesValue($total_amount,$company_id,$branch_id);
  // $tax_amount        = getTaxAmount($accessories_value + $total_amount);
  $tax_amount        = getTaxAmount(($accessories_value + $total_amount),$company_id,$branch_id);
  $total_premium     = $total_amount + $accessories_value + $tax_amount;

  // print_r($total_premium);
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
                  <input type="hidden" name="insurance_type_id" value="4" >
                  <input type="hidden" name="company_id" value="<?= $company_id?>" >
                  <input type="hidden" name="accessories_id" value="<?= $accessories_id?>">
                  <div class="row">
                    <div class="form-group col-md-6">
                      <label><?=getContentLanguageSelected('NET_PREMIUM',defaultSelectedLanguage())?> <span class="required">*</span></label>
                         <input type="text" class="form-control" name="net_premium" id="net_premium" readonly placeholder="Net Premium" value="<?php  print_r($total_amount);?>">
                         <?=form_error('net_premium'); ?>
                    </div>
                    <div class="form-group col-md-6">
                      <label><?=getContentLanguageSelected('OPTIONAL_WARRANTIES',defaultSelectedLanguage())?><span class="required">*</span></label>
                         <input type="text" class="form-control" readonly name="optional_warranties" id="optional_warranties" placeholder="Optional Warranties" value="
                         <?php echo trim(implode(',', $warranties_name)); ?>
                         ">
                         <?=form_error('optional_warranties'); ?>
                    </div>
                  </div>

                  <div class="row">
                    <div class="form-group col-md-6">
                      <label><?=getContentLanguageSelected('SELECTED_OPTION',defaultSelectedLanguage())?><span class="required">*</span></label>
                         <input type="text" class="form-control" readonly name="trans_insurance" id="trans_insurance" placeholder="SELECTED_OPTION" value="<?php echo implode(' ,',$required_data) ?>">
                         <?=form_error('trans_insurance'); ?>
                    </div>
                    <div class="form-group col-md-6">
                      <label><?=getContentLanguageSelected('OPTIONAL_FRANCHISE',defaultSelectedLanguage())?><span class="required">*</span></label>
                         <input type="text" class="form-control" name="optional_franchise" id="optional_franchise" readonly placeholder="Optional Franchise" value="<?php echo implode(' ,', $franchise_name) ?>">
                         <?=form_error('optional_franchise'); ?>
                    </div>
                  </div>

                  <div class="row">
                    <div class="form-group col-md-6">
                      <label><?=getContentLanguageSelected('ACCESSORIES',defaultSelectedLanguage())?><span class="required">*</span>
                      </label>
                         <input type="text" class="form-control" name="accessories" readonly id="accessories" placeholder="Accessories" value="<?=$accessories_value?>">
                         <?=form_error('accessories'); ?>
                    </div>
                    <div class="form-group col-md-6">
                      <label><?=getContentLanguageSelected('TAX',defaultSelectedLanguage())?><span class="required">*</span></label>
                         <input type="text" class="form-control" readonly name="tax" id="tax" placeholder="Tax" value="<?=$tax_amount?>">
                         <?=form_error('tax'); ?>
                    </div>
                  </div>

                  <div class="row">
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
