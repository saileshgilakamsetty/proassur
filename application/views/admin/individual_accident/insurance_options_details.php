<div class="content-wrapper">
   <!-- Content Header (Page header) -->




   <section class="content-header">
      <div class="header-icon">
         <i class="pe-7s-note2"></i>
      </div>
      <div class="header-title">
         <h1><?=getContentLanguageSelected('INSURANCE_OPTIONS_DETAILS',defaultSelectedLanguage())?></h1>
         <small><?=getContentLanguageSelected('INSURANCE_OPTIONS_DETAILS',defaultSelectedLanguage())?></small>
         <ol class="breadcrumb hidden-xs">
            <li><a href="<?=base_url('admin/dashboard');?>"><i class="pe-7s-home"></i> Home</a></li>
            <li class="active"><?=getContentLanguageSelected('INSURANCE_OPTIONS_DETAILS',defaultSelectedLanguage())?></li>
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
               <div id ="message"></div>
               <div class="panel-body">
                  <div class="table-responsive">
                     <form method="post" enctype="multipart/form">
                        <div class="form-group">
                           <div class="form-check">
                              <label><?=getContentLanguageSelected('DO_YOU_WANT_THIS_INSURANCE',defaultSelectedLanguage())?></label><br>
                              <label class="radio-inline">
                              <input type="radio" name="individual_accident_insurance_requirement" value="1" checked="checked">Yes</label>
                              <label class="radio-inline"><input type="radio" name="individual_accident_insurance_requirement" value="0" >No</label>
                           </div>
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
                                                <input type="radio" value="<?= $options->id?>" name="accident_insurance_optionid" class="accident_insurance_optionid">
                                                <?= $options->title;?>
                                             </td>
                                             <td>
                                                <input type="hidden" name="amount_to_pay" value = "<?= $options->amount_to_pay;?>">
                                                <?= $options->amount_to_pay;?>
                                             </td> 
                                          </tr>
                                      <?php }
                                    } else {
                                       ?>
                                       <tr>
                                          <td><?=getContentLanguageSelected('NO_RECORD_AVAILABLE',defaultSelectedLanguage())?>
                                          </td>
                                          <td></td>
                                       </tr>
                                       <?php
                                    }
                                 ?>
                              </tbody>
                        </table>

                        <div class="col-md-12" >
                           <div class="reset-button">
                              <button class="btn btn-success" id ="get_individual_accident_insurance_estimation"><?=getContentLanguageSelected('SAVE_AND_PROCEED',defaultSelectedLanguage())?></button>
                           </div>
                        </div>
                     </form>
                     <!-- <form  method="post" enctype="multipart/form-data">
                        <div class="col-md-6" >
                           <input type="hidden" name="individual_accident_quote_id" id="individual_accident_quote_id" value="">
                           <input type="hidden" name="selected_company" id="selected_company" value="">
                        </div>

                        <div class="col-md-12" >
                           <div class="reset-button">
                              <button class="btn btn-success">Save</button>
                           </div>
                        </div>
                     </form> -->
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