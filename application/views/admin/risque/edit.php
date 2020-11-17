<div class="content-wrapper">
   <section class="content-header">
      <div class="header-icon">
         <i class="pe-7s-note2"></i>
      </div>
      <div class="header-title">
      <h1><?=getContentLanguageSelected('RISQUE',defaultSelectedLanguage())?></h1>
      <small><?=getContentLanguageSelected('RISQUE_EDIT',defaultSelectedLanguage())?></small>
         <ol class="breadcrumb hidden-xs">
            <li><a href="<?=base_url('admin/dashboard');?>"><i class="pe-7s-home"></i> </a></li>
            <li class="active"><?=getContentLanguageSelected('RISQUE',defaultSelectedLanguage())?></li>
         </ol>
      </div>
   </section>
   <section class="content">
      <div class="row">
         <div class="col-sm-12">
            <div class="panel panel-bd">
               <div class="panel-heading">
                  <div class="btn-group"> 
                     <a class="btn btn-primary" href="<?=base_url('admin/risque/lists')?>"> <i class="fa fa-list"></i>  <?=getContentLanguageSelected('RISQUE_LIST',defaultSelectedLanguage())?></a>  
                  </div>
               </div>
               <div class="panel-body">
                  <form  method="post" enctype="multipart/form-data">
                     <div class="col-md-6" >
                        <div class="form-group">
                           <label> <?=getContentLanguageSelected('NAME',defaultSelectedLanguage())?><span class="required">*</span></label>
                           <input type="text" class="form-control" name="name" id="name" placeholder="Name" value="<?=set_value('name', isset($dataCollection->name)?$dataCollection->name:""); ?>" >
                           <?=form_error('name'); ?>
                        </div>

                     </div>
                     <div class="col-md-6" >
                        <div class="form-group">
                           <label><?=getContentLanguageSelected('COMPANY',defaultSelectedLanguage())?><span class="required">*</span></label>
                           <?php $data = 'class="form-control" onChange = "getBranchByCompanyId(this.value);" ';
                              $company = $dataCollection->company_id;
                              
                              echo form_dropdown('company_id',getMultipleOptions('tbl_company','Select Company',1),set_value('company_id',isset($company)?$company:""),$data);?>
                           <?=form_error('company_id'); ?>
                        </div>
                        <div class="form-group">
                           <label>Branch<span class="required">*</span></label>
                           <?php $data = 'class="form-control " id="branch_by_company"';
                              $branchValue = $dataCollection->branch_id;
                              
                              echo form_dropdown('branch_id',getBranchByCompanyId($company),set_value("branch_id",isset($branchValue)?$branchValue:""),$data);?>
                           <?=form_error('branch_id'); ?>
                        </div>
                     </div>
                     <div class="col-sm-12">
                        <div class="form-group">
                           <label><?=getContentLanguageSelected('DESCRIPTION',defaultSelectedLanguage())?></label>
                           <textarea class="form-control" name="description" placeholder="Description" id="description"  rows="10"><?=set_value('description', isset($dataCollection->description)?$dataCollection->description:""); ?></textarea>
                           <?=form_error('description'); ?>
                        </div>
                     </div>
                     <div class="col-sm-12">
                        <div class="form-check">
                           <label><?=getContentLanguageSelected('STATUS',defaultSelectedLanguage())?></label><br>
                           <label class="radio-inline">
                           <?php $status=$dataCollection->status ?>
                           <input type="radio" name="status" value="1" <?php if($status==1) { ?>  checked="checked" <?php } ?>><?=getContentLanguageSelected('ACTIVE',defaultSelectedLanguage())?></label>
                           <label class="radio-inline"><input type="radio" name="status" value="0" <?php if($status==0) { ?>  checked="checked" <?php } ?>><?=getContentLanguageSelected('INACTIVE',defaultSelectedLanguage())?></label>
                        </div>
                     </div>
                     <div class="col-sm-10" >
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
</div>