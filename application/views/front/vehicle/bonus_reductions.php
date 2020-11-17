<div class="container">

      <form method="post" enctype="multipart/form-data">

            <?=form_error('value_selected_bounus_option'); ?>


                        <?php $upload= $this->session->flashdata('do_upload'); 
                        if(!empty($upload)) { ?>
                        <div class="panel panel-warning">
                          <div class="panel-heading">
                            <?php echo $this->session->flashdata('do_upload'); ?>
                          </div>
                        </div>
                        <?php } ?>

               <input type="hidden" name="value_selected_bounus_option" id="value_selected_bounus_option" value="">
         <div class="formFildes">

         <?php
            if(!empty($discount_year)) {
               foreach ($discount_year as $value) { ?>
                  
            <div class="xs12 col-xs-6 col-md-4">
               <div class="form-group inputCheck">
                  <input type="radio" name="selected_bounus_option" vehicle_detail_id="<?=$vehicle_detail_id?>" id="selected_bounus_option_<?=$value->id?>" value="<?=$value->id?>" >
                  <label><?=$value->year?> Year  : Discount <?=$value->discount?>%</label>
               </div>
            </div>
         <?php  } } ?>

            <div class="col-xs-12 col-sm-5">
               <div class="form-group">
                  <label><?=getContentLanguageSelected('INSURANCE_COMPANY_CERTIFICATE',defaultSelectedLanguage())?></label>
                  <div class="selectFile">
                     <input type="file" placeholder="Choose File" name="image" id="image">
                     <p class="placeHolder">Choose File</p>
                  </div>
               </div>
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