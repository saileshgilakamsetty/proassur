<div class="content-wrapper">
   <!-- Content Header (Page header) -->
   <section class="content-header">
      <div class="header-icon">
         <i class="pe-7s-note2"></i>
      </div>
      <div class="header-title">
         <h1><?=getContentLanguageSelected('CREDIT_POLICIES',defaultSelectedLanguage())?></h1>
         <small><?=getContentLanguageSelected('CREDIT_POLICIES_EDIT',defaultSelectedLanguage())?></small>
         <ol class="breadcrumb hidden-xs">
            <li><a href="<?=base_url('admin/dashboard');?>"><i class="pe-7s-home"></i> <?=getContentLanguageSelected('HOME',defaultSelectedLanguage())?></a></li>
            <li class="active"><?=getContentLanguageSelected('CREDIT_POLICIES_EDIT',defaultSelectedLanguage())?></li>
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

                        <div class="table-responsive">
                           <table id="example2" class="table table-bordered table-hover">
                              <thead>
                                 <tr>  
                                    <th><?=getContentLanguageSelected('COMPANY_NAME',defaultSelectedLanguage())?></th>
                                    <th><?=getContentLanguageSelected('INSURANCE_RATE',defaultSelectedLanguage())?></th>
                                    <!-- <th>Action</th> -->
                                 </tr>
                              </thead>
                              <tbody>
                                 <input type="hidden" name="credit_tarification_id" id="credit_tarification_id" value="">
                                 <?= form_error('credit_tarification_id')?>
                                 <input type="hidden" name="insurance_company_rate_credit" id="insurance_company_rate_credit" value="">
                                 <?php if(!empty($credit_insurance_company)){ 
                                 foreach ($credit_insurance_company as $data) { 
                                 ?>  
                                    
                                    <tr>
                                       <td><input type="radio" name = "insurance_company_rate" class="credit_insurance_company" credit_tarification_id="<?=$data['id']?>" value="<?= $data['insurance_rate']?>"> 
                                       <?=getCompanyName($data['company_id'])?></td>
                                       <td><?=$data['insurance_rate']?></td>
                                    </tr>
                                 <?php }} ?>
                              </tbody>
                          </table>
                        </div>

                        <div class="table-responsive">
                           <table id="example2" class="table table-bordered table-hover">
                              <thead>
                                 <tr>  
                                    <th><?=getContentLanguageSelected('RATE_CALCULATION',defaultSelectedLanguage())?></th>
                                    <th></th>
                                 </tr>
                              </thead>

                              <tbody>
                                 <tr>
                                    <td>
                                       <label class="radio-inline">
                                       <input type="radio" name="calculation_type_edit" credit_detail_id = "<?= $credit_detail_id?>" id="calculation_type_edit" value="0" <?=($credit_rate_calculation_type == 0)?'checked':''?> ><?=getContentLanguageSelected('FIXED_CALCULATION',defaultSelectedLanguage())?></label>
                                    </td>
                                    <td>
                                       <label class="radio-inline"><input type="radio" name="calculation_type_edit" credit_detail_id = "<?= $credit_detail_id?>"  id= "calculation_type_edit" value="1" <?= ($credit_rate_calculation_type == 1)?'checked':''?> ><?=getContentLanguageSelected('VARIABLE_CALCULATION',defaultSelectedLanguage())?></label>
                                    </td>
                                 </tr>
                              </tbody>
                           </table>
                        </div>
                        <?php
                           foreach ($selected_warranties as $key => $value) {
                              $selected_warranties_id[$key]      = $value['warranty_id'];
                              $selected_warranties_type[$key]    = $value['type_of_warranties_id'];
                           }
                        ?>

                        <div class="form-group">
                           <input type="hidden" id="value_selected_credit_warranty" name="value_selected_credit_warranty" value="">
                           <label><?=getContentLanguageSelected('WARRANTIES',defaultSelectedLanguage())?><span class="required">*</span></label>
                           <?php $data = 'class="form-control multiselect"';
                              echo form_multiselect('optional_warranties_credit[]',getMultipleOptionalWarranties($company_id,$branch_id,$risque_id,'Select Waranties'),set_value("optional_warranties_credit[]",$selected_warranties_id),$data);?>
                           <?=form_error('optional_warranties_credit[0]'); ?>
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