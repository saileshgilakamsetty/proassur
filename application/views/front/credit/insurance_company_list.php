<section class="insurForm">
   <div class="container">
      <form action="" method="post">
      <div class="row">
         <div class="col-xs-12">
            <h3 class="title"><?=getContentLanguageSelected('CREDIT_INSURANCE',defaultSelectedLanguage())?></h3>
            </div>
         </div>  
         <div class="formFildes">
            <div class="col-xs-12">
               <h3 class="planTitle"><?=getContentLanguageSelected('SELECT_BEST_OFFER',defaultSelectedLanguage())?></h3>
            </div>
            <?php
                foreach ($dataCollection as $value) { ?>     
            <div class="col-xs-6 col-md-4 xs12">
               <div class="selectPlan">
                    <label><input type="radio" class="select_company_credit" name="select_company_credit" credit_detail_id="<?=$credit_detail_id?>" credit_tarification_id="<?= $value['id']?>" credit_insurance_rate = "<?=$value['insurance_rate']?>" value="<?=$value['company_id']?>" >
                     <h3><?=$value['amount']?></h3>
                        <p class="planName"><?=getCompanyName($value['company_id'])?></p>
                    </label>
                </div>
            </div>
                <?php }
            ?>
            <div class="col-xs-12">
                <div id="selected_credit_company_message"></div>
                <input type="hidden" name="selected_credit_company" id="selected_credit_company">
                <input type="hidden" name="credit_detail_id" id="credit_detail_id">
                <input type="hidden" name="credit_tarification_id" id="credit_tarification_id" value="">
                <input type="hidden" name="credit_insurance_rate" id="credit_insurance_rate" value="">
                <input type="button" id="get_selected_company_credit" value="DONE" class="subBtn">
            </div> 
            <div class="clearfix"></div>
         </div>
        </form>
    </div>
</section>
<hr>


