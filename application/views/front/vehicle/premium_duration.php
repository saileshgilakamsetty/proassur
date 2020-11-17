<div class="container">
                        <?php $upload= $this->session->flashdata('message'); 
                        if(!empty($upload)) { ?>
                        <div class="panel panel-warning">
                          <div class="panel-heading">
                            <?php echo $this->session->flashdata('message'); ?>
                          </div>
                        </div>
                        <?php } ?>
   <form action="" method="post">
      <div class="formFildes">
         <div class="col-xs-12">
            <h3 class="carOwner"><?=getContentLanguageSelected('SELECT_PREMIUM_DURATION',defaultSelectedLanguage())?></h3>
         </div>
         <div class="col-xs-12 col-sm-6">
            <div class="form-group">
               <label><?=getContentLanguageSelected('DURATION_OF_THE_PREMIUM',defaultSelectedLanguage())?></label>
               <input type="text" name="from" id="from" placeholder="From" value="<?php echo set_value('from') ?>" class="dateIcon example1">
                           <?=form_error('from'); ?>

            </div>
         </div>
         <div class="col-xs-12 col-sm-6">
            <div class="form-group">
               <label>&nbsp;</label>
               <input type="text" name="to" id="to" placeholder="To" value="<?php echo set_value('to') ?>" class="dateIcon example1">
                           <?=form_error('to'); ?>

            </div>
         </div>
         <div class="col-xs-12">
            <div class="form-group radioCheck">
               <p><?=getContentLanguageSelected('TACIT_POLICY',defaultSelectedLanguage())?></p>
               <label><input type="radio" name="tacit_policy" value="1"  >Yes</label>
               <label><input type="radio" name="tacit_policy" value="0" checked="checked">No</label>
                           <?=form_error('tacit_policy'); ?>

            </div>
         </div>
         <div class="col-xs-12">
            <input type="submit" value="Save And Proceed" class="subBtn">
         </div>
         <div class="clearfix"></div>
      </div>
   </form>
</div>
</section>
<hr>