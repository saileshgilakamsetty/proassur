<section class="insurForm">
   <div class="container">
      <form action="" method="post" >
         <div class="row">
            <div class="col-xs-12">
               <h3 class="title"><?=getContentLanguageSelected('COMPANY_QUESTIONARIES',defaultSelectedLanguage())?></h3>
            </div>
         </div>
         
         <div class="formFildes">
            <div class="row">
               <div class="col-xs-12 col-sm-6">
                  <?php
                     if(!empty($questionaries_data)) {  
                        $i = 1; foreach ($questionaries_data as $key => $value) { ?>
                           <input type="hidden" name="question_id[]" value="<?= $value->id ?>" >
                           <div class="form-group">
                              <label><?= 'Q.'.$i. ' '.$value->question ?><span class="required">*</span></label>
                              <textarea class="form-control " name="answer[]" id="" placeholder="Give Your Answer" rows="5"><?php echo set_value('description') ?></textarea>
                              <?=form_error('description'); ?>
                           </div>

                           <div class="form-group">
                              <label><?= 'Q.'.$i. ' '.$value->question ?><span class="required">*</span></label>
                              <textarea class="form-control " name="answer[]" id="" placeholder="Give Your Answer" rows="5"><?php echo set_value('description') ?></textarea>
                              <?=form_error('description'); ?>
                           </div>
                           <?php 
                        }
                     } 
                  ?>
               </div>
            </div>

            <div class="col-xs-12">
               <input type="submit" id="" value="<?=getContentLanguageSelected('PROCEED_TO_PAY',defaultSelectedLanguage())?>" class="subBtn">
            </div>
            <div class="clearfix"></div>
         </div>
      </form>
   </div>
</section>
<hr>