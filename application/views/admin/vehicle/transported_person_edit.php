<div class="content-wrapper">
   <section class="content-header">
      <div class="header-icon">
         <i class="pe-7s-note2"></i>
      </div>
      <div class="header-title">
         <h1><?=getContentLanguageSelected('TRANSPORTED_PERSON',defaultSelectedLanguage())?></h1>
         <small><?=getContentLanguageSelected('TRANSPORTED_PERSON_EDIT',defaultSelectedLanguage())?></small>
         <ol class="breadcrumb hidden-xs">
            <li><a href="<?=base_url('admin/dashboard');?>"><i class="pe-7s-home"></i> <?=getContentLanguageSelected('HOME',defaultSelectedLanguage())?></a></li>
            <li class="active"><?=getContentLanguageSelected('TRANSPORTED_PERSON',defaultSelectedLanguage())?></li>
         </ol>
      </div>
   </section>
   <section class="content">
      <div class="row">
         <div class="col-sm-12">
            <div class="panel panel-bd">
               <div class="panel-heading">
                  <div class="btn-group"> 
                     <a class="btn btn-primary" href="<?=base_url('admin/vehicle/bodywork')?>"> <i class="fa fa-list"></i> <?=getContentLanguageSelected('TRANSPORTED_PERSON_LIST',defaultSelectedLanguage())?></a>  
                  </div>
               </div>
               <div class="panel-body">
                  <form  method="post" enctype="multipart/form-data">
                     <div class="col-md-6" >

                        <div class="form-group">
                           <label><?=getContentLanguageSelected('COMPANY',defaultSelectedLanguage())?><span class="required">*</span></label>
                           <?php $data = 'class="form-control" onChange = "getBranchByCompanyId(this.value);" ';
                              $company = $dataCollection->company_id;
                              
                              echo form_dropdown('company_id',getMultipleOptions('tbl_company','Select Company',1),set_value('company_id',isset($company)?$company:""),$data);?>
                           <?=form_error('company_id'); ?>
                        </div>
                        
                        <div class="form-group">
                           <label><?=getContentLanguageSelected('TITLE',defaultSelectedLanguage())?><span class="required">*</span></label>
                           <input type="text" class="form-control" name="title" id="title" placeholder=" Name" value="<?=set_value('title', isset($dataCollection->title)?$dataCollection->title:""); ?>" >
                           <?=form_error('title'); ?>
                        </div>  

                        <div class="form-group">
                           <label><?=getContentLanguageSelected('AMOUNT_TO_PAY',defaultSelectedLanguage())?><span class="required">*</span></label>
                           <input type="text" class="form-control" name="amount_to_pay" id="amount_to_pay" placeholder=" Amount To Pay" value="<?=set_value('amount_to_pay', isset($dataCollection->amount_to_pay)?$dataCollection->amount_to_pay:""); ?>" >
                           <?=form_error('amount_to_pay'); ?>
                        </div>  
                        <div class="form-group">
                           <label><?=getContentLanguageSelected('DEATH',defaultSelectedLanguage())?><span class="required">*</span></label>
                           <input type="text" class="form-control" name="death" id="death" placeholder=" Death" value="<?=set_value('death', isset($dataCollection->death)?$dataCollection->death:""); ?>" >
                           <?=form_error('death'); ?>
                        </div> 

                        <div class="form-group">
                           <label><?=getContentLanguageSelected('DISABILITY',defaultSelectedLanguage())?><span class="required">*</span></label>
                           <input type="text" class="form-control" name="disability" id="disability" placeholder=" Disability" value="<?=set_value('disability', isset($dataCollection->disability)?$dataCollection->disability:""); ?>" >
                           <?=form_error('disability'); ?>
                        </div> 

                        <div class="form-group">
                           <label><?=getContentLanguageSelected('MEDICAL_FEES',defaultSelectedLanguage())?><span class="required">*</span></label>
                           <input type="text" class="form-control" name="medical_fees" id="medical_fees" placeholder=" Medical Fees" value="<?=set_value('medical_fees', isset($dataCollection->medical_fees)?$dataCollection->medical_fees:""); ?>" >
                           <?=form_error('medical_fees'); ?>
                        </div>                        

                        
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
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script> 
<script>
   var ckbox = $('#checkbox');
   $('input').click(function () {
       if (ckbox.is(':checked')) {
           $('#password').show();
           $('#re_password').show();
           $('#checked_password').attr('value',1);
   
       } else {
           $('#password').hide();
           $('#re_password').hide();
           $('#checked_password').attr('value',0); 
       }
   });
</script>