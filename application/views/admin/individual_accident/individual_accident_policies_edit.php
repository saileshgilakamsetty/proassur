<div class="content-wrapper">
   <!-- Content Header (Page header) -->
   <section class="content-header">
      <div class="header-icon">
         <i class="pe-7s-note2"></i>
      </div>
      <div class="header-title">
         <h1><?=getContentLanguageSelected('INDIVIDUAL_ACCIDENT_POLICIES',defaultSelectedLanguage())?></h1>
         <small><?=getContentLanguageSelected('INDIVIDUAL_ACCIDENT_POLICIES_EDIT',defaultSelectedLanguage())?></small>
         <ol class="breadcrumb hidden-xs">
            <li><a href="<?=base_url('admin/dashboard');?>"><i class="pe-7s-home"></i> <?=getContentLanguageSelected('HOME',defaultSelectedLanguage())?></a></li>
            <li class="active"><?=getContentLanguageSelected('INDIVIDUAL_ACCIDENT_POLICIES_EDIT',defaultSelectedLanguage())?></li>
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

                        
                        <table id="example2" class="table table-bordered table-hover">
                             <thead>
                                 <tr>  
                                    <th><?=getContentLanguageSelected('OPTIONS',defaultSelectedLanguage())?></th>
                                    <th><?=getContentLanguageSelected('AMOUNT',defaultSelectedLanguage())?></th>
                                 </tr>
                              </thead>
                              <tbody>
                                 
                                 <?php
                                    if($insurance_options) {
                                       foreach ($insurance_options as $key => $options) { ?>
                                          <tr>
                                             <td>
                                                <input type="radio" value="<?= $options->id?>" <?= ($insurance_options_id == $options->id)?'checked':'';?> name="accident_insurance_optionid" class="accident_insurance_optionid">
                                                <?= $options->title;?>
                                             </td>
                                             <td>
                                                <input type="hidden" name="amount_to_pay" value = "<?= $options->amount_to_pay;?>">
                                                <?= $options->amount_to_pay;?>
                                             </td> 
                                          </tr>
                                      <?php }
                                    } 
                                 ?>
                              </tbody>
                        </table>
                        

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