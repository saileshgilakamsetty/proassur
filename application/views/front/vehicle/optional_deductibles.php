<div class="container">
   <form action="" method="post">

   <div class="formFildes">

         <div class="col-xs-12">
            <div class="form-group radioCheck">
               <p><?=getContentLanguageSelected('SELECT_OPTIONAL_FRANCHISE',defaultSelectedLanguage())?></p>
               <label><input type="radio" vehicle_detail_id= "<?=$vehicle_detail_id?>" checked name="optional_franchise_want" value="1" ><?=getContentLanguageSelected('YES',defaultSelectedLanguage())?></label>
               <label><input type="radio" vehicle_detail_id= "<?=$vehicle_detail_id?>" name="optional_franchise_want" value="0" ><?=getContentLanguageSelected('NO',defaultSelectedLanguage())?></label>
               <hr>
            </div>
         </div>
         <div>
            <?=form_error('value_selected_franchise'); ?>
            <input type="hidden" id="value_selected_franchise" name="value_selected_franchise" value="">
         </div>
   <?php
   if(!empty($optional_franchies)) {
      foreach ($optional_franchies as $value) {
       ?>
         <div class="xs12 col-xs-6 col-md-4 col-lg-3">
            <div class="form-group inputCheck">
               <input type="checkbox" id="<?=$value->id?>" name="selected_optional_franchise" value="<?=$value->id?>" >
               <label><?=getFranchiseName($value->franchise_name_id)?></label>
            </div>
         </div>
      <?php }
   }
   ?>

      <div class="col-xs-12">
         <hr>
      </div>
      <div class="col-xs-12">
         <div class="form-group">
            <input type="submit" value="Save And Proceed" class="subBtn">
         </div>
      </div>
      <div class="clearfix"></div>
   </div>
   </form>

</div>
</section>
<hr>