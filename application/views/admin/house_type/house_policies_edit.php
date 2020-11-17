<div class="content-wrapper">
   <!-- Content Header (Page header) -->
   <section class="content-header">
      <div class="header-icon">
         <i class="pe-7s-note2"></i>
      </div>
      <div class="header-title">
         <h1><?=getContentLanguageSelected('HOUSE_POLICIES',defaultSelectedLanguage())?></h1>
         <small><?=getContentLanguageSelected('HOUSE_POLICIES_EDIT',defaultSelectedLanguage())?></small>
         <ol class="breadcrumb hidden-xs">
            <li><a href="<?=base_url('admin/dashboard');?>"><i class="pe-7s-home"></i> <?=getContentLanguageSelected('HOME',defaultSelectedLanguage())?></a></li>
            <li class="active"><?=getContentLanguageSelected('HOUSE_POLICIES_EDIT',defaultSelectedLanguage())?></li>
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
                                      <th><?=getContentLanguageSelected('AMOUNT',defaultSelectedLanguage())?></th>
                                      <!-- <th>Action</th> -->
                                  </tr>
                              </thead>
                              <tbody>
                                 <input type="hidden" name="house_tarification_id" id="house_tarification_id" value="">
                                 <?= form_error('house_tarification_id')?>
                                 <input type="hidden" name="insurance_company_amount_house" id="insurance_company_amount_house" value="">
                                 <?php if(!empty($house_insurance_company)){ 
                                 foreach ($house_insurance_company as $data) { 
                                 ?>  
                                    
                                    <tr>
                                       <td><input type="radio" name = "insurance_company_amount" class="house_insurance_company" house_tarification_id="<?=$data['id']?>" value="<?= $data['amount']?>"> 
                                       <?=getCompanyName($data['company_id'])?></td>
                                       <td><?=$data['amount']?></td>
                                    </tr>
                                 <?php }} ?>
                              </tbody>
                          </table>
                        </div>

                        <div class="form-group">
                           <label><?=getContentLanguageSelected('WARRANTIES',defaultSelectedLanguage())?><span class="required">*</span></label>
                           <?php $data = 'class="form-control multiselect"';
                              echo form_multiselect('optional_warranties_house[]',getMultipleOptionalWarranties($company_id,$branch_id,$risque_id,'Select Waranties'),set_value("optional_warranties_house[]",$selected_warranties),$data);?>
                           <?=form_error('optional_warranties_house[0]'); ?>
                        </div>

                        <div class="form-group">
                           <label><?=getContentLanguageSelected('FRANCHISES',defaultSelectedLanguage())?><span class="required">*</span></label>
                           <?php $data = 'class="form-control multiselect"';
                              echo form_multiselect('optional_franchises_house[]',getMultipleOptionalFranchises($company_id,$branch_id,'Select Franchises'),set_value("optional_franchises_house[]",$selected_franchises),$data);?>
                           <?=form_error('optional_franchises_house[0]'); ?>
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