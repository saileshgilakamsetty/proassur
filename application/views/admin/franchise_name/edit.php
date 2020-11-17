<div class="content-wrapper">
   <?php //print_r($dataCollection); ?>
   <section class="content-header">
      <div class="header-icon">
         <i class="pe-7s-note2"></i>
      </div>
      <div class="header-title">
         <h1><?=getContentLanguageSelected('FRANCHISE_NAME',defaultSelectedLanguage())?></h1>
         <small><?=getContentLanguageSelected('FRANCHISE_NAME_ADD',defaultSelectedLanguage())?></small>
         <ol class="breadcrumb hidden-xs">
            <li><a href="<?=base_url('admin/dashboard');?>"><i class="pe-7s-home"></i> <?=getContentLanguageSelected('HOME',defaultSelectedLanguage())?></a></li>
            <li class="active"><?=getContentLanguageSelected('FRANCHISE_NAME',defaultSelectedLanguage())?></li>
         </ol>
      </div>
   </section>
   <section class="content">
      <div class="row">
         <div class="col-sm-12">
            <div class="panel panel-bd">
               <div class="panel-heading">
                  <div class="btn-group"> 
                     <a class="btn btn-primary" href="<?=base_url('admin/warranty-name/lists')?>"> <i class="fa fa-list"></i> <?=getContentLanguageSelected('FRANCHISE_NAME_LIST',defaultSelectedLanguage())?></a>  
                  </div>
               </div>
               <div class="panel-body">
                  <form  method="post" enctype="multipart/form-data">

                     <div class="col-md-6" >
                        <div class="form-group">
                           <label><?=getContentLanguageSelected('NAME',defaultSelectedLanguage())?><span class="required">*</span></label>
                           <input type="text" class="form-control" name="name" id="name" placeholder="Warranty Name" value="<?=set_value('name', isset($dataCollection->name)?$dataCollection->name:""); ?>" >
                           <?=form_error('name'); ?>
                        </div>
                        <div class="form-check">
                           <label><?=getContentLanguageSelected('STATUS',defaultSelectedLanguage())?></label><br>
                           <label class="radio-inline">
                           <?php $status=$dataCollection->status ?>
                           <input type="radio" name="status" value="1" <?php if($status==1) { ?>  checked="checked" <?php } ?>><?=getContentLanguageSelected('ACTIVE',defaultSelectedLanguage())?></label>
                           <label class="radio-inline"><input type="radio" name="status" value="0" <?php if($status==0) { ?>  checked="checked" <?php } ?>><?=getContentLanguageSelected('INACTIVE',defaultSelectedLanguage())?></label>
                        </div>
                     </div>
                     <div class="col-md-6" >

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