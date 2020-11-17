<div class="content-wrapper">
   <!-- Content Header (Page header) -->
   <section class="content-header">
      <div class="header-icon">
         <i class="pe-7s-note2"></i>
      </div>
      <div class="header-title">
         <h1><?=getContentLanguageSelected('PROFFESIONAL_MULTI_RISK_POLICIES',defaultSelectedLanguage())?></h1>
         <small><?=getContentLanguageSelected('PROFFESIONAL_MULTI_RISK_POLICIES_EDIT',defaultSelectedLanguage())?></small>
         <ol class="breadcrumb hidden-xs">
            <li><a href="<?=base_url('admin/dashboard');?>"><i class="pe-7s-home"></i> <?=getContentLanguageSelected('HOME',defaultSelectedLanguage())?></a></li>
            <li class="active"><?=getContentLanguageSelected('PROFFESIONAL_MULTI_RISK_POLICIES_EDIT',defaultSelectedLanguage())?></li>
         </ol>
      </div>
   </section>
   <!-- Main content -->
   <section class="content">
      <div class="row">
         <!-- Form controls -->
         <div class="col-sm-12">
            <?php $success= $this->session->flashdata('message'); 
               if(!empty($success)) { ?>
               <div class="panel panel-success">
                  <div class="panel-heading">
                     <?php echo $this->session->flashdata('message'); ?>
                  </div>
               </div>
            <?php } ?>
            
            <div class="panel panel-bd">
               <div class="panel-body">
                  <form  method="post" enctype="multipart/form-data">
                     <div class="col-md-6" >

                        <div class="form-group">
                           <label><?=getContentLanguageSelected('POLICY_NUMBER',defaultSelectedLanguage())?><span class="required">*</span></label>
                           <input type="text" class="form-control" id="policy_number" name="policy_number" placeholder="Policy Number" value="<?=set_value('policy_number',isset($policy_number)?$policy_number:''); ?>">
                           <?=form_error('policy_number'); ?>
                        </div>

                        <div class="form-group">
                           <label><?=getContentLanguageSelected('CAPITAL_INSURED',defaultSelectedLanguage())?><span class="required">*</span></label>
                           <?php
                              $capital_insured = $proffesional_multirisk_detail->capital_insured;
                           ?>
                           <input type="text" class="form-control" id="capital_insured" name="capital_insured" placeholder="Capital Insured" value="<?=set_value('capital_insured',isset($capital_insured)?$capital_insured:''); ?>">
                           <?=form_error('capital_insured'); ?>
                        </div>

                        <div class="form-group">
                           <label><?=getContentLanguageSelected('WARRANTIES',defaultSelectedLanguage())?><span class="required">*</span></label>
                           <?php $data = 'class="form-control multiselect"';
                              echo form_multiselect('optional_warranties_proffesional_multirisk[]',getMultipleOptionalWarranties($company_id,$branch_id,$risque_id,'Select Waranties'),set_value("optional_warranties_proffesional_multirisk[]",$selected_warranties),$data);?>
                           <?=form_error('optional_warranties_proffesional_multirisk[0]'); ?>
                        </div>

                        <div class="form-group">
                           <label><?=getContentLanguageSelected('FRANCHISES',defaultSelectedLanguage())?><span class="required">*</span></label>
                           <?php $data = 'class="form-control multiselect"';
                              echo form_multiselect('optional_franchises_proffesional_multirisk[]',getMultipleOptionalFranchises($company_id,$branch_id,'Select Franchises'),set_value("optional_franchises_proffesional_multirisk[]",$selected_franchises),$data);?>
                           <?=form_error('optional_franchises_proffesional_multirisk[0]'); ?>
                        </div>

                     </div>                     

                     <div class="col-md-12" >
                        <div class="reset-button">
                           <button class="btn btn-success" onclick="return confirm('If you update this policy without changing your policy number, your old data will be lost. Do You want to Update This Policy? ')"><?=getContentLanguageSelected('SAVE',defaultSelectedLanguage())?></button>
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