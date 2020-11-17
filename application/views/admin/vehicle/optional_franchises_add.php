<div class="content-wrapper">
   <!-- Content Header (Page header) -->
   <section class="content-header">
      <div class="header-icon">
         <i class="pe-7s-note2"></i>
      </div>
      <div class="header-title">
         <h1><?=getContentLanguageSelected('OPTIONAL_FRANCHISE',defaultSelectedLanguage())?></h1>
         <small><?=getContentLanguageSelected('ADD_OPTIONAL_FRANCHISE',defaultSelectedLanguage())?></small>
         <ol class="breadcrumb hidden-xs">
            <li><a href="<?=base_url('admin/dashboard');?>"><i class="pe-7s-home"></i> Home</a></li>
            <li class="active"><?=getContentLanguageSelected('OPTIONAL_FRANCHISE',defaultSelectedLanguage())?></li>
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
                     <a class="btn btn-primary" href="<?=base_url('admin/vehicle/optional-franchise')?>"> <i class="fa fa-list"></i><?=getContentLanguageSelected('OPTIONAL_FRANCHISE_LIST',defaultSelectedLanguage())?> </a>  
                  </div>
               </div>
               <div class="panel-body">
                  <form  method="post" enctype="multipart/form-data">
                     <div class="col-md-6" >
                        <div class="form-group">
                           <label><?=getContentLanguageSelected('TITLE',defaultSelectedLanguage())?><span class="required">*</span></label>
                           <input type="text" class="form-control" name="title" id="title" placeholder="Title" value="<?php echo set_value('title') ?>">
                           <?=form_error('title'); ?>
                        </div>

                        <div class="form-group">
                           <label><?=getContentLanguageSelected('DEDUCTIBLE',defaultSelectedLanguage())?><span class="required">*</span></label>
                           <input type="text" class="form-control" name="deductible" id="deductible" placeholder="Deductible" value="<?php echo set_value('deductible') ?>">
                           <?=form_error('deductible'); ?>
                        </div>

                        <div class="form-group">
                           <label><?=getContentLanguageSelected('RATE',defaultSelectedLanguage())?><span class="required">*</span></label>
                           <input type="text" class="form-control" name="rate" id="rate" placeholder="Rate" value="<?php echo set_value('rate') ?>">
                           <?=form_error('rate'); ?>
                        </div>

                        <div class="form-group">
                           <label><?=getContentLanguageSelected('AMOUNT',defaultSelectedLanguage())?><span class="required">*</span></label>
                           <input type="text" class="form-control" name="amount" id="amount" placeholder="Amount" value="<?php echo set_value('amount') ?>">
                           <?=form_error('amount'); ?>
                        </div>

                        <div class="form-group">
                           <label><?=getContentLanguageSelected('REFERENT_VALUE',defaultSelectedLanguage())?><span class="required">*</span></label>
                           <input type="text" class="form-control" name="referent_value" id="referent_value" placeholder="Referent Value" value="<?php echo set_value('referent_value') ?>">
                           <?=form_error('referent_value'); ?>
                        </div>

                        <div class="form-group">
                           <label><?=getContentLanguageSelected('MINIMUM',defaultSelectedLanguage())?><span class="required">*</span></label>
                           <input type="text" class="form-control" name="minimum" id="minimum" placeholder="Minimum" value="<?php echo set_value('minimum') ?>">
                           <?=form_error('minimum'); ?>
                        </div>

                        <div class="form-group">
                           <label><?=getContentLanguageSelected('MAXIMUM',defaultSelectedLanguage())?><span class="required">*</span></label>
                           <input type="text" class="form-control" name="maximum" id="maximum" placeholder="Maximum" value="<?php echo set_value('maximum') ?>">
                           <?=form_error('maximum'); ?>
                        </div>
                     
                        
                     
                        <div class="control-group">
                           <label>Status</label><br>
                           <label class="cus_radio">
                           <input type="radio" name="status" value="1" checked="checked">Active</label>
                           <label class="cus_radio"><input type="radio" name="status" value="0" >InActive</label>
                        </div>
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

<style type="text/css">
   .inlineinput div {
    display: inline;
}
</style>