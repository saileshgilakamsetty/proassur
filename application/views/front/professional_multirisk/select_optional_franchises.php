<section class="insurForm">
<div class="container">
   <div class="row">
         <div class="col-xs-12">
            <h3 class="title"><?=getContentLanguageSelected('PROFESSIONAL_MULTIRISK_INSURANCE',defaultSelectedLanguage())?></h3>
            </div>
        </div>
   <form action="" method="post">
      <div class="formFildes">
         <div class="col-xs-12">
            <div class="form-group radioCheck">
               <p><?=getContentLanguageSelected('SELECT_OPTIONAL_FRANCHISE',defaultSelectedLanguage())?></p>
               <label><input type="radio" professional_multirisk_quote_id= "<?=$professional_multirisk_quote_id?>" checked name="optional_franchise_want_professional_multirisk" value="1" ><?=getContentLanguageSelected('YES',defaultSelectedLanguage())?></label>
               <label><input type="radio" professional_multirisk_quote_id= "<?=$professional_multirisk_quote_id?>" name="optional_franchise_want_professional_multirisk" value="0" ><?=getContentLanguageSelected('NO',defaultSelectedLanguage())?></label>
               <hr>
            </div>
         </div>
         <div>
            <?=form_error('value_selected_professional_multirisk_franchise'); ?>
            <input type="hidden" id="value_selected_professional_multirisk_franchise" name="value_selected_professional_multirisk_franchise" value="">
         </div>
         <?php
            if (!empty($optional_franchies)) {
               foreach ($optional_franchies as $value) {
                  ?>
         <div class="xs12 col-xs-6 col-md-4 col-lg-3">
            <div class="form-group inputCheck">
               <input type="checkbox" id="<?=$value->id?>" name="optional_franchises_professional_multirisk" value="<?=$value->id?>" >
               <label><?=getFranchiseName($value->franchise_name_id)?></label>
            </div>
         </div>
         <?php }
            }
            ?>
                <div class="col-xs-12">
                  <div class="form-group">
                        <input type="submit" value="<?=getContentLanguageSelected('SAVE_AND_PROCEED',defaultSelectedLanguage())?>" class="subBtn">
                    </div>
                </div>

         <div class="clearfix"></div>
      </div>
   </form>
</div>
</section>