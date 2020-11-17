<div class="content-wrapper">
   <!-- Content Header (Page header) -->
   <section class="content-header">
      <div class="header-icon">
         <i class="pe-7s-note2"></i>
      </div>
      <div class="header-title">
         <h1><?=getContentLanguageSelected('PROFFESIONAL_MULTI_RISK_QUOTE',defaultSelectedLanguage())?></h1>
         <small><?=getContentLanguageSelected('PROFFESIONAL_MULTI_RISK_QUOTE_ADD',defaultSelectedLanguage())?></small>
         <ol class="breadcrumb hidden-xs">
            <li><a href="<?=base_url('admin/dashboard');?>"><i class="pe-7s-home"></i> <?=getContentLanguageSelected('HOME',defaultSelectedLanguage())?></a></li>
            <li class="active"><?=getContentLanguageSelected('PROFFESIONAL_MULTI_RISK_QUOTE',defaultSelectedLanguage())?></li>
         </ol>
      </div>
   </section>
   <!-- Main content -->
   <section class="content">
      <div class="row">
         <!-- Form controls -->
         <div class="col-sm-12">
            <div class="panel panel-bd">
               <div class="panel-body">
                  <form  method="post" enctype="multipart/form-data">
                     <div class="col-md-6" >

                        <div class="form-group">
                           <label><?=getContentLanguageSelected('ACTIVITY',defaultSelectedLanguage())?><span class="required">*</span></label>
                            <?php $data = ' class="form-control" input" ';
                              echo form_dropdown('activity_id',getIndividualAccidentActivityOptions('tbl_activity','Select Activity',1),set_value("activity_id"),$data);?>
                           <?=form_error('activity_id'); ?>
                        </div>

                        <div class="form-group">
                           <label><?=getContentLanguageSelected('ENTER_THE_CAPITAL_TO_BE_INSURED',defaultSelectedLanguage())?><span class="required">*</span></label>
                           <input type="text" class="form-control" name="capital_insured" id="capital_insured" placeholder="Enter Capital" value="<?php echo set_value('capital_insured') ?>">
                           <?=form_error('capital_insured'); ?>
                        </div>

                     </div>                     

                     <div class="col-md-12" >
                        <div class="reset-button">
                           <button class="btn btn-success"><?=getContentLanguageSelected('SAVE_AND_PROCEED',defaultSelectedLanguage())?></button>
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