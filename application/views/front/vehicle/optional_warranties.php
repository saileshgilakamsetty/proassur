<div class="container">
   <form action="" method="post">
      <div class="formFildes">
         <div class="col-xs-12">
            <div class="form-group radioCheck">
               <p><?=getContentLanguageSelected('SELECT_OPTIONAL_WARRANTY',defaultSelectedLanguage())?></p>
               <label><input type="radio" vehicle_detail_id= "<?=$vehicle_detail_id?>" checked name="optional_warranty_want" value="1" ><?=getContentLanguageSelected('YES',defaultSelectedLanguage())?></label>
               <label><input type="radio" vehicle_detail_id= "<?=$vehicle_detail_id?>" name="optional_warranty_want" value="0" ><?=getContentLanguageSelected('NO',defaultSelectedLanguage())?></label>
               <hr>
            </div>
         </div>
         <div>
            <?=form_error('value_selected'); ?>
            <input type="hidden" id="value_selected" name="value_selected" value="">
         </div>
         <?php
            if (!empty($optional_warranties)) {
               foreach ($optional_warranties as $value) {
                  ?>
         <div class="xs12 col-xs-6 col-md-4 col-lg-3">
            <div class="form-group inputCheck">
               <input type="checkbox" id="<?=$value->id?>" name="optional_warranties" value="<?=$value->id?>" >
               <label><?=getWarrantyName($value->warranty_name_id)?></label>
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