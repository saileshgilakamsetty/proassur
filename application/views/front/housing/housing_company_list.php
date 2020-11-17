<section class="insurForm">
   <div class="container">
      <form action="" method="post">
      <div class="row">
         <div class="col-xs-12">
            <h3 class="title"><?=getContentLanguageSelected('HOUSE_INSURANCE',defaultSelectedLanguage())?></h3>
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
                    <label><input type="radio" class="select_company_housing" name="select_company_housing" house_detail_id="<?=$house_detail_id?>" house_tarification_id="<?= $value['id']?>" value="<?=$value['company_id']?>" >
                     <h3><?=$value['amount']?></h3>
                        <p class="planName"><?=getCompanyName($value['company_id'])?></p>
                    </label>
                </div>
            </div>
                <?php }
            ?>
            <div class="col-xs-12">
                <div id="selected_housing_company_message"></div>
                <input type="hidden" name="selected_housing_company" id="selected_housing_company">
                <input type="hidden" name="house_detail_id" id="house_detail_id">
                <input type="hidden" name="house_tarification_id" id="house_tarification_id" value="">
                <input type="button" id="get_selected_company_housing" value="DONE" class="subBtn">
            </div> 
            <div class="clearfix"></div>
         </div>
        </form>
    </div>
</section>
<hr>


