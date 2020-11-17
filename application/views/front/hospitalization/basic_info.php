<!-- Health Insurance -->
<section class="travelInsur hlthInsur">
  <div class="container">
    <div class="row">
      <aside class="col-sm-6"><img src="<?= base_url();?>assets/front/images/health-insurance.jpg" class="img-responsive"></aside>
      <aside class="col-sm-6">
        <h1><?=getContentLanguageSelected('HOSPITALIZATION_APPROVAL',defaultSelectedLanguage())?></h1>
        <div class="insureForm ins2">
          <form method="post" id="policy_number_submit" action="<?= base_url('hospitalization/policy-number-submit')?>">
            <div class="form-group">
              <label><?=getContentLanguageSelected('POLICY_NUMBER',defaultSelectedLanguage())?></label>
              <input name="hospitalizationn_policy_number" id="hospitalizationn_policy_number" type="text" value="" placeholder="Enter Policy Number">
              <div id="error_msg" class="error">
                <?php if(!empty($this->session->flashdata('message'))) { 
                  echo $this->session->flashdata('message');
                }?>
              </div>
            </div>
            <div class="form-group clearfix"><button type="button" id="hospitalization_policy_number_submit"><?=getContentLanguageSelected('SAVE_AND_PROCEED',defaultSelectedLanguage())?></button> </div>
          </form>

          <div class="orLine clearfix">
            <span><?=getContentLanguageSelected('OR',defaultSelectedLanguage())?></span>
          </div>
          
          <form method="post" id="policy_holder_info_submit" action="<?= base_url('hospitalization/policy-holder-info-submit')?>"> 
            <input name="hospitalization_policy_number" id="hospitalization_policy_number" type="hidden" value="" placeholder="Enter Policy Number">
            <div class="row">
              <div class="col-sm-6">
                <label><?=getContentLanguageSelected('POLICY_HOLDER_NAME',defaultSelectedLanguage())?></label>
                <?php $data = ' class="form-control input" id="policy_holder_name" onchange=getCompanyIdForPolicyHolder(this.value) ';
                  echo form_dropdown('policy_holder_name',getPolicyHolderNameOptions('tbl_payment','Select Name',1),set_value("policy_holder_name"),$data);?>
                <div id="error_msg_" class="error"></div>
              </div>
              <div class="col-sm-6">
                <div class="form-group">
                  <label><?=getContentLanguageSelected('INSURANCE_COMPANY',defaultSelectedLanguage())?></label>
                  <?php $data = ' class="form-control input" id="insurance_company_id" readonly ';
                    echo form_dropdown('insurance_company_id',getCompanyOptions('tbl_company','Insurance Company',1),set_value("insurance_company_id"),$data);?>
                </div>
              </div>
            </div>
            <div class="form-group clearfix"><button type="button" id="hospitalization_policy_info_submit"><?=getContentLanguageSelected('SAVE_AND_PROCEED',defaultSelectedLanguage())?></button> </div> 
          </form>  
        </div>
      </aside>
    </div>
  </div>
</section>
<!-- Health Insurance -->