<div class="content-wrapper">
   <!-- Content Header (Page header) -->
   <section class="content-header">
      <div class="header-icon">
         <i class="pe-7s-note2"></i>
      </div>
      <div class="header-title">
         <h1><?=getContentLanguageSelected('RATE_CALCULATION',defaultSelectedLanguage())?> </h1>
         <small><?=getContentLanguageSelected('RATE_CALCULATION',defaultSelectedLanguage())?></small>
         <ol class="breadcrumb hidden-xs">
            <li><a href="<?=base_url('admin/dashboard');?>"><i class="pe-7s-home"></i> <?=getContentLanguageSelected('HOME',defaultSelectedLanguage())?></a></li>
            <li class="active"><?=getContentLanguageSelected('RATE_CALCULATION',defaultSelectedLanguage())?></li>
         </ol>
      </div>
      <?php // print_r(getCompanyIdsByBranch(getHousingBranchId()));?>
   </section>
   <!-- Main content -->
   <section class="content">
      <div class="row">
         <!-- Form controls -->
         <div class="col-sm-12">
            <div class="panel panel-bd">
               <div class="panel-heading">
                  <div class="btn-group"> 
                     <h3> <?=getContentLanguageSelected('RATE_CALCULATION',defaultSelectedLanguage())?> </h3>
                  </div>
               </div>
               <div class="panel-body">
                  <form  method="post" enctype="multipart/form-data">
                     <div class="col-sm-6" >
                        <div class="form-check">
                           <label class="radio-inline">
                           <input type="radio" name="calculation_type" credit_detail_id = "<?= $credit_detail_id?>" id="calculation_type" value="0" ><?=getContentLanguageSelected('FIXED_CALCULATION',defaultSelectedLanguage())?></label>
                           <label class="radio-inline"><input type="radio" name="calculation_type" credit_detail_id = "<?= $credit_detail_id?>"  id= "calculation_type" value="1" ><?=getContentLanguageSelected('VARIABLE_CALCULATION',defaultSelectedLanguage())?></label>
                        </div>
                     </div>
                     <!-- <div class="col-sm-10" >
                        <div class="reset-button">
                           <button class="btn btn-success"><?=getContentLanguageSelected('SAVE',defaultSelectedLanguage())?></button>
                        </div>
                     </div> -->
                  </form>
               </div>
            </div>
         </div>
      </div>
   </section>
   <!-- /.content -->
</div>