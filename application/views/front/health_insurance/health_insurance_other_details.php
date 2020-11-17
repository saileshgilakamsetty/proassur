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
              <label><?=getContentLanguageSelected('POLICY_COVERAGE_AREA',defaultSelectedLanguage())?></label>
              <div class="form-group">
                <?php $data = ' class="form-control input" id="" onchange="getDataByPolicyCoveargeAreaId(this.value)" ';
                echo form_dropdown('policy_coverage_area_id',getCompanyOptions('tbl_policycoverage_area','Select Policy Coverage Area',1),set_value("policy_coverage_area_id"),$data);?>
                <?=form_error('policy_coverage_area_id'); ?>
              </div>
            </div>
            <div class="row">
              <div class="col-sm-12">
                <div class="form-group">
                  <label><?=getContentLanguageSelected('CLAIM_REIMBURSEMENT_RATE',defaultSelectedLanguage())?></label>
                  <?php $data = 'class="form-control " id="claim_reimbursement_rate"'; 
                  echo form_dropdown('claim_reimbursement_rate',getRateByPolicyCoveargeAreaId(set_value('policy_coverage_area_id')),set_value("claim_reimbursement_rate"),$data);?>
                  <?=form_error('claim_reimbursement_rate'); ?>
                </div>
              </div>
              <div class="col-sm-6">
                <!-- <label><?=getContentLanguageSelected('AMOUNT_TO_PAY',defaultSelectedLanguage())?></label> -->
                <input type="hidden" class="form-control" name="amount_to_pay" id="amount_to_pay" placeholder="Amount To Pay" value="<?php echo set_value('amount_to_pay') ?>" readonly >
                <?=form_error('amount_to_pay'); ?>
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