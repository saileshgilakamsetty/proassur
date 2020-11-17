<div class="content-wrapper">
   <!-- Content Header (Page header) -->
   <section class="content-header">
      <div class="header-icon">
         <i class="pe-7s-note2"></i>
      </div>
      <div class="header-title">
         <h1><?=getContentLanguageSelected('CLAIM_REIMBURSEMENT_RATE',defaultSelectedLanguage())?></h1>
         <small><?=getContentLanguageSelected('CLAIM_REIMBURSEMENT_RATE_ADD',defaultSelectedLanguage())?></small>
         <ol class="breadcrumb hidden-xs">
            <li><a href="<?=base_url('admin/dashboard');?>"><i class="pe-7s-home"></i> <?=getContentLanguageSelected('HOME',defaultSelectedLanguage())?></a></li>
            <li class="active"><?=getContentLanguageSelected('CLAIM_REIMBURSEMENT_RATE',defaultSelectedLanguage())?></li>
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
                     <a class="btn btn-primary" href="<?=base_url('admin/claim-reimbursement-rate/lists')?>"> <i class="fa fa-list"></i> <?=getContentLanguageSelected('CLAIM_REIMBURSEMENT_RATE_LIST',defaultSelectedLanguage())?> </a>  
                  </div>
               </div>
               <div class="panel-body">
                  <form  method="post" enctype="multipart/form-data">
                     <div class="col-md-6" >
                        <div class="form-group">
                         <label><?=getContentLanguageSelected('POLICY_COVERAGE_AREA',defaultSelectedLanguage())?><span class="required">*</span></label>

                         <?php $data = ' class="form-control input" ';
                            echo form_dropdown('policy_coverage_area_id',getCompanyOptions('tbl_policycoverage_area','Select Policy Coverage Area',1),set_value("policy_coverage_area_id"),$data);?>
                         <?=form_error('policy_coverage_area_id'); ?>
                        </div>

                        <div class="form-group">
                           <label><?=getContentLanguageSelected('Name',defaultSelectedLanguage())?><span class="required">*</span></label>
                           <input type="text" class="form-control" name="name" id="name" placeholder="Claim Reimbursement Name" value="<?php echo set_value('name') ?>">
                           <?=form_error('name'); ?>
                        </div>

                        <div class="form-group">
                           <label><?=getContentLanguageSelected('RATE',defaultSelectedLanguage())?><span class="required">*</span></label>
                           <input type="text" class="form-control" name="rate" id="rate" placeholder="Rate" value="<?php echo set_value('rate') ?>" >
                           <?=form_error('rate'); ?>
                        </div>

                        <div class="form-group">
                           <label><?=getContentLanguageSelected('DESCRIPTION',defaultSelectedLanguage())?><span class="required">*</span></label>
                           <textarea class="form-control " name="description" id="description" placeholder="Description" rows="10"><?php echo set_value('description') ?></textarea>
                           <?=form_error('description'); ?>
                        </div>

                        <!-- <div class="form-group">
                           <label><?=getContentLanguageSelected('AMOUNT',defaultSelectedLanguage())?><span class="required">*</span></label>
                           <input type="text" class="form-control" name="amount" id="amount" placeholder="Amount" value="<?php //echo set_value('amount') ?>" >
                           <?=form_error('amount'); ?>
                        </div> -->

                        <div class="form-group">
                           <label>Company<span class="required">*</span></label>
                           <?php $data = 'class="form-control multiselect"';
                              echo form_multiselect('company_id[]',getMultipleOptions('tbl_company','Select Company',1),set_value("company_id[]"),$data);?>
                           <?=form_error('company_id[0]'); ?>
                        </div>

                        <div class="control-group">
                           <label><?=getContentLanguageSelected('STATUS',defaultSelectedLanguage())?></label><br>
                           <label class="cus_radio">
                           <input type="radio" name="status" value="1" checked="checked">Active</label>
                           <label class="cus_radio"><input type="radio" name="status" value="0" >InActive</label>
                        </div>
                     </div>




                     <div class="col-md-6" >
                     </div>
                     <div class="col-md-12" >
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
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
