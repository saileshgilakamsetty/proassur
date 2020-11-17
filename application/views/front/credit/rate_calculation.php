<section class="insurForm">
   <div class="container">
      <div class="row">
         <div class="col-xs-12">
            <h3 class="title"><?=getContentLanguageSelected('CREDIT_INSURANCE',defaultSelectedLanguage())?></h3>
            </div>
         </div>
         <form action="" method="post" >
            <div class="formFildes">

               <div class="form-group radioCheck">
                     <p><?=getContentLanguageSelected('SELECT_CALCULATION_TYPE',defaultSelectedLanguage())?></p>
                     <label><input type="radio" name="calculation_type" credit_detail_id = "<?= $credit_detail_id?>" id="calculation_type" value="0" ><?=getContentLanguageSelected('FIXED_CALCULATION',defaultSelectedLanguage())?></label>
                     <label><input type="radio" name="calculation_type" credit_detail_id = "<?= $credit_detail_id?>"  id= "calculation_type" value="1" ><?=getContentLanguageSelected('VARIABLE_CALCULATION',defaultSelectedLanguage())?></label>
                     <hr>
               </div>

               <!-- <div class="col-xs-12">
                  <div class="form-group">
                     <input type="submit" value="<?=getContentLanguageSelected('SAVE_AND_PROCEED',defaultSelectedLanguage())?>" class="subBtn">
                  </div>
               </div> -->
               <div class="clearfix"></div>
            </div>
         </form>
   </div>
</section>