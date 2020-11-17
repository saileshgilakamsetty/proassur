<div class="content-wrapper">
   <!-- Content Header (Page header) -->
   <section class="content-header">
      <div class="header-icon">
         <i class="pe-7s-note2"></i>
      </div>
      <div class="header-title">
         <h1><?=getContentLanguageSelected('COMPANY_QUESTION',defaultSelectedLanguage())?></h1>
         <small><?=getContentLanguageSelected('COMPANY_QUESTION_EDIT',defaultSelectedLanguage())?></small>
         <ol class="breadcrumb hidden-xs">
            <li><a href="<?=base_url('admin/dashboard');?>"><i class="pe-7s-home"></i><?=getContentLanguageSelected('HOME',defaultSelectedLanguage())?></a></li>
            <li class="active"><?=getContentLanguageSelected('COMPANY_QUESTION',defaultSelectedLanguage())?></li>
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
                     <a class="btn btn-primary" href="<?=base_url('admin/company-question/lists')?>"> <i class="fa fa-list"></i>  <?=getContentLanguageSelected('COMPANY_QUESTION_LIST',defaultSelectedLanguage())?></a>  
                  </div>
               </div>
               <div class="panel-body">
                  <form  method="post" enctype="multipart/form-data">
                     <div class="col-md-6" >
                        <div class="form-group">
                           <label><?=getContentLanguageSelected('QUESTION',defaultSelectedLanguage())?><span class="required">*</span></label>
                           <?php $data = 'class="form-control multiselect"';
                              $company = explode(",",$dataCollectionForCompany);
                              echo form_multiselect('question_id[]',getMultipleQuestionOptions('tbl_questionnaries','Select Question',1),set_value("question_id[]",$company),$data);?>
                           <?=form_error('question_id[0]'); ?>
                        </div>
                     </div>
                     <div class="col-sm-6" >
                        <div class="form-group">
                           <label><?=getContentLanguageSelected('COMPANY',defaultSelectedLanguage())?><span class="required">*</span></label>
                           <?php $data = ' class="form-control input" onChange = "getBranchByCompanyId(this.value);" ';
                              $company = $dataCollection->company_id;
                              
                              echo form_dropdown('company_id',getCompanyOptions('tbl_company','Select Company',1),set_value('company_id',isset($company)?$company:""),$data);?>
                           <?=form_error('company_id'); ?>
                        </div>
                        <div class="form-group">
                           <label><?=getContentLanguageSelected('BRANCH',defaultSelectedLanguage())?><span class="required">*</span></label>
                           <?php $data = 'class="form-control " onChange = "getRisqueByBranchId(this.value);" id="branch_by_company"';
                              $branchValue = $dataCollection->branch_id;
                                 echo form_dropdown('branch_id',getBranchByCompanyId($company),set_value('branch_id',isset($branchValue)?$branchValue:""),$data);?>
                           <?=form_error('branch_id'); ?>
                        </div>
                        <div class="form-group">
                           <label><?=getContentLanguageSelected('RISQUE',defaultSelectedLanguage())?><span class="required">*</span></label>
                           <?php $data = 'class="form-control" id="risque_by_branch"';
                              $risqueValue = $dataCollection->risque_id;
                                 echo form_dropdown('risque_id',getRisqueByBranchId($branchValue),set_value("risque_id",isset($risqueValue)?$risqueValue:""),$data);?>
                           <?=form_error('risque_id'); ?>
                        </div>
                     </div>
                     <div class="col-sm-10" >
                        <div class="form-check">
                           <label><?=getContentLanguageSelected('STATUS',defaultSelectedLanguage())?></label><br>
                           <label class="radio-inline">
                           <?php $status=$dataCollection->status ?>
                           <input type="radio" name="status" value="1" <?php if($status==1) { ?>  checked="checked" <?php } ?>><?=getContentLanguageSelected('ACTIVE',defaultSelectedLanguage())?></label>
                           <label class="radio-inline"><input type="radio" name="status" value="0" <?php if($status==0) { ?>  checked="checked" <?php } ?>><?=getContentLanguageSelected('INACTIVE',defaultSelectedLanguage())?></label>
                        </div>
                        <div class="reset-button">
                           <button class="btn btn-success"><?=getContentLanguageSelected('EDIT',defaultSelectedLanguage())?></button>
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