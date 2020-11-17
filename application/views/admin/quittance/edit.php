<div class="content-wrapper">
   <!-- Content Header (Page header) -->
   <section class="content-header">
      <div class="header-icon">
         <i class="pe-7s-note2"></i>
      </div>
      <div class="header-title">
         <h1><?=getContentLanguageSelected('QUITTANCE',defaultSelectedLanguage())?> </h1>
         <small><?=getContentLanguageSelected('QUITTANCE',defaultSelectedLanguage())?></small>
         <ol class="breadcrumb hidden-xs">
            <li><a href="<?=base_url('admin/dashboard');?>"><i class="pe-7s-home"></i> <?=getContentLanguageSelected('HOME',defaultSelectedLanguage())?></a></li>
            <li class="active"><?=getContentLanguageSelected('QUITTANCE',defaultSelectedLanguage())?></li>
         </ol>
      </div>
   </section>
   <!-- Main content -->
   <section class="content">
      <div class="row">
         <!-- Form controls -->
         <div class="col-sm-12">
            <div class="panel panel-bd">
               <div class="panel-heading">
                  <div class="btn-group"> 
                     <a class="btn btn-primary" href="<?=base_url('admin/quittance/lists')?>"> <i class="fa fa-list"></i>  <?=getContentLanguageSelected('QUITTANCE_LIST',defaultSelectedLanguage())?></a>  
                  </div>
               </div>
               <div class="panel-body">
                  <form  method="post" enctype="multipart/form-data">
                     <div class="col-sm-6" >
                      <div class="form-group">
                           <label><?=getContentLanguageSelected('POLICY_NUMBER',defaultSelectedLanguage())?><span class="required">*</span></label>
                           <input type="text" class="form-control" name="policy_number" id="policy_number" placeholder="Policy Start Date" readonly value="<?=set_value('policy_number', isset($dataCollection->policy_number)?$dataCollection->policy_number:""); ?>" >
                           <?=form_error('policy_number'); ?>
                        </div>
                        <div class="form-group">
                          <?php
                            if( ($dataCollection->policy_creation_date == '') || ($dataCollection->policy_creation_date == '0000-00-00 00:00:00')) {
                              $policy_creation_date = '';
                            } else {
                              $policy_creation_date = date("m/d/Y",strtotime($dataCollection->policy_creation_date));
                            } 
                          ?>
                           <label><?=getContentLanguageSelected('POLICY_CREATION_DATE',defaultSelectedLanguage())?><span class="required">*</span></label>
                           <input type="text" class="form-control" name="policy_creation_date" id="policy_creation_date" placeholder="Policy Creation Date" value="<?php echo set_value('policy_creation_date',isset($policy_creation_date)?$policy_creation_date:"") ?>">
                           <?=form_error('policy_creation_date'); ?>
                        </div>
                        <div class="form-group">
                           <?php
                              if(($dataCollection->policy_start_date == '0000-00-00 00:00:00') || ($dataCollection->policy_start_date == '')) {
                                 $policy_start_date = '';
                              } else {
                                 $policy_start_date = $dataCollection->policy_start_date;
                              }
                           ?>
                           <label><?=getContentLanguageSelected('POLICY_START_DATE',defaultSelectedLanguage())?><span class="required">*</span></label>
                           <input type="text" class="form-control" name="policy_start_date" id="policy_start_date" placeholder="Policy Start Date" value="<?php echo set_value('policy_start_date',isset($policy_start_date)?$policy_start_date:"") ?>">
                           <?=form_error('policy_start_date'); ?>
                        </div>
                        <div class="form-group">
                           <?php
                              if(($dataCollection->policy_end_date == '0000-00-00 00:00:00') || ($dataCollection->policy_end_date == '')) {
                                 $policy_end_date = '';
                              } else {
                                 $policy_end_date = $dataCollection->policy_end_date;
                              }
                           ?>
                           <label><?=getContentLanguageSelected('POLICY_END_DATE',defaultSelectedLanguage())?><span class="required">*</span></label>
                           <input type="text" class="form-control" name="policy_end_date" id="policy_end_date" placeholder="Policy End Date" value="<?php echo set_value('policy_end_date',isset($policy_end_date)?$policy_end_date:"") ?>">
                           <?=form_error('policy_end_date'); ?>
                        </div>
                        <div class="form-group">
                           <label><?=getContentLanguageSelected('COMPANY',defaultSelectedLanguage())?><span class="required">*</span></label>

                           <?php $data = ' class="form-control input" disabled onChange = "getBranchByCompanyId(this.value);" ';
                              $company = $dataCollection->company_id;

                              echo form_dropdown('company_id',getCompanyOptions('tbl_company','Select Company',1),set_value('company_id',isset($company)?$company:""),$data);?>
                           <?=form_error('company_id'); ?>
                        </div>

                        <div class="form-group">
                           <label><?=getContentLanguageSelected('BRANCH',defaultSelectedLanguage())?><span class="required">*</span></label>

                           <?php $data = 'class="form-control " disabled onChange = "getRisqueByBranchId(this.value);" id="branch_by_company"';
                           $branchValue = $dataCollection->branch_id;
                              echo form_dropdown('branch_id',getBranchByCompanyId($company),set_value('branch_id',isset($branchValue)?$branchValue:""),$data);?>
                           <?=form_error('branch_id'); ?>
                        </div>

                        <div class="form-group">
                           <label><?=getContentLanguageSelected('RISQUE',defaultSelectedLanguage())?><span class="required">*</span></label>

                           <?php $data = 'class="form-control" id="risque_by_branch" ';
                           $risqueValue = $dataCollection->risque_id;
                              echo form_dropdown('risque_id',getRisqueByBranchId($branchValue),set_value("risque_id",isset($risqueValue)?$risqueValue:""),$data);?>
                           <?=form_error('risque_id'); ?>
                        </div>

                        <div class="form-group">
                           <label><?=getContentLanguageSelected('NAME',defaultSelectedLanguage())?><span class="required">*</span></label>



                           <?php $data = 'class="form-control " disabled ';
                                     $user_id = $dataCollection->user_id;
                              echo form_dropdown('user_id',getEndUserOptions('tbl_users','Select User'),set_value("user_id",isset($user_id)?$user_id:""),$data);?>
                           <?=form_error('user_id'); ?>
                        </div>
                        <input type="hidden" name="company_id" value="<?= $company?>">
                        <input type="hidden" name="branch_id" value="<?= $branchValue?>">
                        <input type="hidden" name="user_id" value="<?= $user_id?>">
                        <div class="form-group">
                           <label><?=getContentLanguageSelected('AMOUNT',defaultSelectedLanguage())?><span class="required">*</span></label>
                           <input type="text" class="form-control" name="amount" id="amount_quittance" placeholder=" Amount" value="<?=set_value('amount', isset($dataCollection->amount)?$dataCollection->amount:""); ?>">
                           <?=form_error('amount'); ?>
                        </div>
                        <div class="form-group">
                           <label><?=getContentLanguageSelected('TAX',defaultSelectedLanguage())?><span class="required">*</span></label>
                           <input type="text" class="form-control" name="tax" id="tax" placeholder=" Amount" value="<?=set_value('tax', isset($dataCollection->tax)?$dataCollection->tax:""); ?>">
                           <?=form_error('tax'); ?>
                        </div>
                        <div class="form-group">
                           <label><?=getContentLanguageSelected('ACCESSORIES',defaultSelectedLanguage())?><span class="required">*</span></label>
                           <input type="text" class="form-control" name="accessories" id="accessories" placeholder=" Accessories" value="<?=set_value('accessories', isset($dataCollection->accessories)?$dataCollection->accessories:""); ?>">
                           <?=form_error('accessories'); ?>
                        </div>
                        <div class="form-group">
                           <label><?=getContentLanguageSelected('TOTAL_AMOUNT',defaultSelectedLanguage())?><span class="required">*</span></label>
                           <input type="text" class="form-control" name="total_amount" id="total_amount" placeholder=" Accessories" value="<?=set_value('total_amount', isset($dataCollection->total_amount)?$dataCollection->total_amount:""); ?>">
                           <?=form_error('total_amount'); ?>
                        </div>
                     </div>
                     <div class="col-sm-6" >
                     </div>
                     <div class="col-sm-10" >
                        <div class="reset-button">
                           <button class="btn btn-success">Save</button>
                        </div>
                     </div>
                  </form>
               </div>
            </div>
         </div>
      </div>
   </section>
   <!-- /.content -->
</div>
