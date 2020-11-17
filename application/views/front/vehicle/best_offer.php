<section class="insurForm">
   <div class="container">
      <form action="" method="post">
      <div class="row">
         <div class="col-xs-12">
            <h3 class="title"><?=getContentLanguageSelected('MOTOR_INSURANCE',defaultSelectedLanguage())?></h3>
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
                    <label><input type="radio" class="select_company" vehicle_basic_info_id="<?=$vehicle_basic_info_id?>" name="select_company"  company_vehicle_quote_id="<?=$value['id']?>" value="<?=$value['company_id']?>" >
                     <h3><?=$value['amount']?></h3>
                        <p class="planName"><?=getCompanyName($value['company_id'])?></p>
                    </label>
                </div>
            </div>
                <?php }
            ?>
            <div class="col-xs-12">
            <div id="selected_company_message"></div>
            <input type="hidden" name="selected_company" id="selected_company">
            <input type="hidden" name="company_vehicle_quote_id" id="company_vehicle_quote_id">
               <input type="button" id="get_selected_company" value="DONE" class="subBtn">
            </div> 
            <div class="clearfix"></div>
         </div>
        </form>
    </div>
</section>
<hr>


