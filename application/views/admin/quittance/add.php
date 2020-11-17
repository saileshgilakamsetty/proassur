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
                           <input type="text" class="form-control" name="policy_number" id="policy_number" placeholder=" " value="<?php echo set_value('policy_number') ?>">
                           <?=form_error('policy_number'); ?>
                        </div>
                        <div class="form-group">
                           <label><?=getContentLanguageSelected('POLICY_CREATION_DATE',defaultSelectedLanguage())?><span class="required">*</span></label>
                           <input type="text" class="form-control" name="policy_creation_date" id="policy_creation_date" placeholder=" " value="<?php echo set_value('policy_creation_date') ?>">
                           <?=form_error('policy_creation_date'); ?>
                        </div>
                        <div class="form-group">
                           <label><?=getContentLanguageSelected('POLICY_START_DATE',defaultSelectedLanguage())?><span class="required">*</span></label>
                           <input type="text" class="form-control" name="policy_start_date" id="policy_start_date" placeholder=" " value="<?php echo set_value('policy_start_date') ?>">
                           <?=form_error('policy_start_date'); ?>
                        </div>
                        <div class="form-group">
                           <label><?=getContentLanguageSelected('POLICY_END_DATE',defaultSelectedLanguage())?><span class="required">*</span></label>
                           <input type="text" class="form-control" name="policy_end_date" id="policy_end_date" placeholder=" " value="<?php echo set_value('policy_end_date') ?>">
                           <?=form_error('policy_end_date'); ?>
                        </div>
                        <div class="form-group">
                           <label><?=getContentLanguageSelected('COMPANY',defaultSelectedLanguage())?><span class="required">*</span></label>
                           <?php $data = ' class="form-control input" id="company_id" disabled onChange = "getBranchByCompanyId(this.value);" ';
                              echo form_dropdown('company_idd',getCompanyOptions('tbl_company','Company',1),set_value("company_id"),$data);?>
                           <?=form_error('company_id'); ?>
                        </div>
                        <div class="form-group">
                           <label><?=getContentLanguageSelected('BRANCH',defaultSelectedLanguage())?><span class="required">*</span></label>
                           <?php $data = 'class="form-control " disabled id="branch_by_company" ';
                              echo form_dropdown('branch_idd',getSingleOptions('tbl_branch','Branch',1),set_value("branch_id"),$data);?>
                           <?=form_error('branch_id'); ?>
                        </div>
                        <div class="form-group">
                           <label><?=getContentLanguageSelected('RISQUE',defaultSelectedLanguage())?></label>
                           <?php $data = 'class="form-control " disabled id="risque_by_branch"';
                              echo form_dropdown('risque_idd',getSingleOptions('tbl_risque','Risque',1),set_value("risque_id"),$data);?>
                           <?=form_error('risque_id'); ?>
                        </div>
                        <div class="form-group">
                           <label><?=getContentLanguageSelected('NAME',defaultSelectedLanguage())?><span class="required">*</span></label>
                           <?php $data = 'class="form-control " id="user_id" disabled ';
                              echo form_dropdown('user_idd',getEndUserOptions('tbl_users','Select User'),set_value("user_id"),$data);?>
                           <?=form_error('user_id'); ?>
                        </div>
                        <input type="hidden" name="company_id" value="">
                        <input type="hidden" name="branch_id" value="">
                        <input type="hidden" name="risque_id" value="">
                        <input type="hidden" name="user_id" value="">
                        <div class="form-group">
                           <label><?=getContentLanguageSelected('AMOUNT',defaultSelectedLanguage())?><span class="required">*</span></label>
                           <input type="text" class="form-control" name="amount" id="amount_quittance" placeholder=" Amount" value="<?php echo set_value('amount') ?>">
                           <?=form_error('amount'); ?>
                        </div>
                        <div class="form-group">
                           <label><?=getContentLanguageSelected('TAX',defaultSelectedLanguage())?><span class="required">*</span></label>
                           <input type="text" class="form-control" name="tax" id="tax" placeholder=" TAX" value="<?php echo set_value('tax') ?>">
                           <?=form_error('tax'); ?>
                        </div>
                        <div class="form-group">
                           <label><?=getContentLanguageSelected('ACCESSORIES',defaultSelectedLanguage())?><span class="required">*</span></label>
                           <input type="text" class="form-control" name="accessories" id="accessories" placeholder=" Accessories" value="<?php echo set_value('accessories') ?>">
                           <?=form_error('accessories'); ?>
                        </div>
                        <div class="form-group">
                           <label><?=getContentLanguageSelected('TOTAL_AMOUNT',defaultSelectedLanguage())?><span class="required">*</span></label>
                           <input type="text" class="form-control" name="total_amount" id="total_amount" placeholder=" Total Amount" value="<?php echo set_value('total_amount') ?>">
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

<script>
   $('#policy_number').on('input',function() {
      var policy_number = $('#policy_number').val();
      var myurl         = '<?= base_url("admin/quittance/getPolicyDataByPolicyNumber")?>';
      if(policy_number != '') {
         $.ajax({
            type    : 'post',
            data    : {'policy_number':policy_number},
            url     : myurl,
            success : function(data) {
               if(data != '') {
                  var response   = JSON.parse(data);
                  var company_id = response.company_id;
                  var branch_id  = response.branch_id;
                  var risque_id  = response.risque_id;
                  var user_id    = response.user_id;
                  var start_date = response.start_date;
                  var end_date   = response.end_date;
                  if( (company_id != null) || (company_id != undefined) || (company_id != '') || (company_id != 0)) {
                     $('#company_id').val(company_id);
                     sessionStorage.setItem("selected_company", document.getElementById('company_id').value);
                     $('input[name="company_id"]').val(company_id);
                  }

                  if( (branch_id != null) || (branch_id != undefined) || (branch_id != '') || (branch_id != 0)) {
                     $('#branch_by_company').val(branch_id);
                     sessionStorage.setItem("selected_branch", branch_id);
                     $('input[name="branch_id"]').val(branch_id);
                  }

                  if( (risque_id != null) || (risque_id != undefined) || (risque_id != '') || (risque_id != 0)) {
                     $('#risque_by_branch').val(risque_id);
                     sessionStorage.setItem("selected_risque", risque_id);
                     $('input[name="risque_id"]').val(risque_id);
                  }

                  if( (user_id != null) || (user_id != undefined) || (user_id != '') || (user_id != 0)) {
                     $('#user_id').val(user_id);
                     sessionStorage.setItem("selected_user", user_id);
                     $('input[name="user_id"]').val(user_id);
                  }
                  $('#policy_start_date').val(start_date);
                  $('#policy_end_date').val(end_date);
               }
            }
         });
      }
   });
   $(document).ready(function() {
      var selected_company = sessionStorage.getItem('selected_company');
      var selected_branch  = sessionStorage.getItem('selected_branch');
      var selected_risque  = sessionStorage.getItem('selected_risque');
      var selected_user    = sessionStorage.getItem('selected_user');
      $('#company_id').val(selected_company);
      $('#branch_id').val(selected_branch);
      $('#risque_id').val(selected_risque);
      $('#user_id').val(selected_user);
   })
</script>
