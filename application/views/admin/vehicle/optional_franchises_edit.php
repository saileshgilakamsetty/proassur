<div class="content-wrapper">
   <section class="content-header">
      <div class="header-icon">
         <i class="pe-7s-note2"></i>
      </div>
      <div class="header-title">
         <h1><?=getContentLanguageSelected('OPTIONAL_FRANCHISE',defaultSelectedLanguage())?> </h1>
         <small></small>
         <ol class="breadcrumb hidden-xs">
            <li><a href="<?=base_url('admin/dashboard');?>"><i class="pe-7s-home"></i> <?=getContentLanguageSelected('HOME',defaultSelectedLanguage())?></a></li>
            <li class="active"><?=getContentLanguageSelected('OPTIONAL_FRANCHISE',defaultSelectedLanguage())?></li>
         </ol>
      </div>
   </section>
   <section class="content">
      <div class="row">
         <div class="col-sm-12">
            <div class="panel panel-bd">
               <div class="panel-heading">
                  <div class="btn-group"> 
                     <a class="btn btn-primary" href="<?=base_url('admin/vehicle/optional-franchise')?>"> <i class="fa fa-list"></i> <?=getContentLanguageSelected('OPTIONAL_FRANCHISE_LIST',defaultSelectedLanguage())?></a>  
                  </div>
               </div>
               <div class="panel-body">
                  <form  method="post" enctype="multipart/form-data">
                     <div class="col-md-6" >

                        <div class="form-group">
                           <label><?=getContentLanguageSelected('Title',defaultSelectedLanguage())?><span class="required">*</span></label>
                           <input type="text" class="form-control" name="title" id="title" placeholder="Title" value="<?=set_value('title', isset($dataCollection->title)?$dataCollection->title:""); ?>" >
                           <?=form_error('title'); ?>
                        </div>

                        <div class="form-group">
                           <label><?=getContentLanguageSelected('DEDUCTIBLE',defaultSelectedLanguage())?><span class="required">*</span></label>
                           <input type="text" class="form-control" name="deductible" id="deductible" placeholder="Deductible" value="<?=set_value('deductible', isset($dataCollection->deductible)?$dataCollection->deductible:""); ?>" >
                           <?=form_error('deductible'); ?>
                        </div> 

                        <div class="form-group">
                           <label><?=getContentLanguageSelected('RATE',defaultSelectedLanguage())?><span class="required">*</span></label>
                           <input type="text" class="form-control" name="rate" id="rate" placeholder="rate" value="<?=set_value('rate', isset($dataCollection->rate)?$dataCollection->rate:""); ?>" >
                           <?=form_error('rate'); ?>
                        </div>  

                        <div class="form-group">
                           <label><?=getContentLanguageSelected('AMOUNT',defaultSelectedLanguage())?><span class="required">*</span></label>
                           <input type="text" class="form-control" name="amount" id="amount" placeholder="amount" value="<?=set_value('amount', isset($dataCollection->amount)?$dataCollection->amount:""); ?>" >
                           <?=form_error('amount'); ?>
                        </div> 

                         <div class="form-group">
                           <label><?=getContentLanguageSelected('REFERENT_VALUE',defaultSelectedLanguage())?><span class="required">*</span></label>
                           <input type="text" class="form-control" name="referent_value" id="referent_value" placeholder="referent_value" value="<?=set_value('referent_value', isset($dataCollection->referent_value)?$dataCollection->referent_value:""); ?>" >
                           <?=form_error('referent_value'); ?>
                        </div>  


                        <div class="form-group">
                           <label><?=getContentLanguageSelected('MINIMUM',defaultSelectedLanguage())?><span class="required">*</span></label>
                           <input type="text" class="form-control" name="minimum" id="minimum" placeholder="minimum" value="<?=set_value('minimum', isset($dataCollection->minimum)?$dataCollection->minimum:""); ?>" >
                           <?=form_error('minimum'); ?>
                        </div>  

                        <div class="form-group">
                           <label><?=getContentLanguageSelected('MAXIMUM',defaultSelectedLanguage())?><span class="required">*</span></label>
                           <input type="text" class="form-control" name="maximum" id="maximum" placeholder="maximum" value="<?=set_value('maximum', isset($dataCollection->maximum)?$dataCollection->maximum:""); ?>" >
                           <?=form_error('maximum'); ?>
                        </div>                        


                        <div class="form-check">
                           <label>Status</label><br>
                           <label class="radio-inline">
                           <?php $status=$dataCollection->status ?>
                           <input type="radio" name="status" value="1" <?php if($status==1) { ?>  checked="checked" <?php } ?>>Active</label>
                           <label class="radio-inline"><input type="radio" name="status" value="0" <?php if($status==0) { ?>  checked="checked" <?php } ?>>Inctive</label>
                        </div>
                     </div>
                     <div class="col-sm-10" >
                        <div class="reset-button">
                           <button class="btn btn-success">Update</button>
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