<style type="text/css">
   td.make_bold {
    font-weight: bold;
}
</style>


<div class="content-wrapper">
   
   <section class="content-header">
      <div class="header-icon">
         <i class="pe-7s-box1"></i>
      </div>
      <div class="header-title">
         <h1><?=getContentLanguageSelected('GET_HEALTH_INSURANCE_ESTIMATION',defaultSelectedLanguage())?></h1>
         <small><?=getContentLanguageSelected('GET_HEALTH_INSURANCE_ESTIMATION',defaultSelectedLanguage())?></small>
         <ol class="breadcrumb hidden-xs">
            <li><a href="<?=base_url('admin/dashboard');?>"><i class="pe-7s-home"></i><?=getContentLanguageSelected('HOME',defaultSelectedLanguage())?></a></li>
            <li class="active"><?=getContentLanguageSelected('GET_HEALTH_INSURANCE_ESTIMATION',defaultSelectedLanguage())?></li>
         </ol>
      </div>
   </section>
  
   <section class="content">
      <div class="row">
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
            <div id="message"></div>
            <div>
               <input type="hidden" name="health_insurance_id" id="health_insurance_id" value="<?=$health_insurance_id?>">
            </div>

               <?php print_r($claim_reimbursement_rate_array); ?>

               <?php print_r($qwerty); ?>

               <div class="reset-button">
                  <button class="btn btn-success" id="finalize_company_health_insurance"><?=getContentLanguageSelected('FINALIZE_COMPANY',defaultSelectedLanguage())?></button>
               </div> 
            </div>
         </div>
      </div>
   </section>
</div>