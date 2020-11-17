<section class="insurForm">
   <div class="container">
      <form action="" method="post" id="basic_info_form">
         <input type="hidden" name="user_id" id="user_id" value="<?= $this->session->userdata('user_id');?>">
         <div class="row">
            <div class="col-xs-12">
               <h3 class="title"><?=getContentLanguageSelected('MOTAR_INSURANCE',defaultSelectedLanguage())?></h3>
            </div>
         </div>
                        <?php $upload= $this->session->flashdata('message'); 
                        if(!empty($upload)) { ?>
                        <div class="panel panel-warning">
                          <div class="panel-heading">
                            <?php echo $this->session->flashdata('message'); ?>
                          </div>
                        </div>
                        <?php } ?>
         <div class="formFildes">
            <div class="col-xs-12 col-sm-6">
               <div class="form-group">
                  <label class="required_red"><?=getContentLanguageSelected('SELECT_BRAND',defaultSelectedLanguage())?><span class="required">*</span></label>
                  <?php $data = ' id="make_id" class="form-control input" onChange = "getDesignationById(this.value);"';
                     echo form_dropdown('make_id',getSingleOptions('tbl_vehicle_make',getContentLanguageSelected('SELECT_BRAND',defaultSelectedLanguage()),1),set_value("make_id"),$data);?>
                  <?=form_error('make_id'); ?>
               </div>
               <div class="form-group">
                  <label><?=getContentLanguageSelected('REGISTERATION_DATE',defaultSelectedLanguage())?></label>
                  <input type="text" readonly placeholder="<?=getContentLanguageSelected('REGISTERATION_DATE',defaultSelectedLanguage())?>" name="registeration_date" id="register_date" class="dateIcon registeration_date" value="<?php echo set_value('registeration_date') ?>">
                  <?=form_error('registeration_date'); ?>
               </div>
               <div class="form-group">
                  <label class="required_red"><?=getContentLanguageSelected('RISQUE',defaultSelectedLanguage())?><span class="required">*</span></label>

                  <?php $data = 'class="form-control" id="risque" ';
                     echo form_dropdown('risque',getAutomobileRisque(),set_value("risque"),$data);?>
                  <?=form_error('risque'); ?>
               </div>
               <div class="form-group">
                  <label><?=getContentLanguageSelected('HORSE_POWER',defaultSelectedLanguage())?></label>
                  <input type="text" class="form-control" readonly name="horse_power" id="horse_power" placeholder="<?=getContentLanguageSelected('HORSE_POWER',defaultSelectedLanguage())?>" value="<?php echo set_value('horse_power') ?>">
                  <?=form_error('horse_power'); ?>
               </div>
               <div class="form-group">
                  <label><?=getContentLanguageSelected('NUMBER_OF_SEATS',defaultSelectedLanguage())?></label>
                  <input type="text" class="form-control" name="seats" id="seats" placeholder="<?=getContentLanguageSelected('NUMBER_OF_SEATS',defaultSelectedLanguage())?>" value="<?php echo set_value('seats') ?>">
                  <?=form_error('seats'); ?>
               </div>
               <div class="form-group radioCheck">
                  <p><?=getContentLanguageSelected('IS_THERE_TRAILER_WITH_VEHICLE',defaultSelectedLanguage())?></p>
                  <label><input type="radio" name="trailer"  value="1" ><?=getContentLanguageSelected('YES',defaultSelectedLanguage())?></label>
                  <label><input type="radio" name="trailer"  value="0" checked="checked" ><?=getContentLanguageSelected('NO',defaultSelectedLanguage())?></label>
               </div>
               <div class="form-group inputCheck">
                  <input type="checkbox" name="term_condition" value="1" >
                  <label><?=getContentLanguageSelected('AGREE_TERMS_&_CONDITION',defaultSelectedLanguage())?></label>
                  <?=form_error('term_condition'); ?>
               </div>
            </div>
            <div class="col-xs-12 col-sm-6">
               <div class="form-group">
                  <label class="required_red"><?=getContentLanguageSelected('SELECT_DESIGNATION',defaultSelectedLanguage())?><span class="required">*</span></label>
                  <?php $data = 'class="form-control " id="designation_by_brand" ';
                     echo form_dropdown('designation',getDesignationByBrandId(set_value('make_id')),set_value("designation"),$data);?>
                  <?=form_error('designation'); ?>
               </div>
               <div class="form-group">
                  <label><?=getContentLanguageSelected('FUEL_TYPE',defaultSelectedLanguage())?></label>
                  <?php $data = ' id="fuel_type"  class="form-control input"';
                     echo form_dropdown('fuel_type',getSingleOptions('tbl_fuel_type','Select Fuel Type',1),set_value("fuel_type"),$data);?>
                  <?=form_error('fuel_type'); ?>
               </div>
               <div class="form-group">
                  <label><?=getContentLanguageSelected('USAGE',defaultSelectedLanguage())?></label>
                  <?php $data = 'class="form-control" id="usage" ';
                     echo form_dropdown('usage',getSingleOptions('tbl_usage',getContentLanguageSelected('USAGE',defaultSelectedLanguage()),1),set_value("usage"),$data);?>
                  <?=form_error('usage'); ?>
               </div>
               <div class="form-group">
                  <label><?=getContentLanguageSelected('FISCAL_POWER',defaultSelectedLanguage())?></label>
                  <input type="text" class="form-control" readonly name="fiscal_power" id="fiscal_power" placeholder="<?=getContentLanguageSelected('FISCAL_POWER',defaultSelectedLanguage())?>" value="<?php echo set_value('fiscal_power') ?>">
                  <?=form_error('fiscal_power'); ?>
               </div>
               <div class="form-group radioCheck">
                  <p><?=getContentLanguageSelected('HYBRID',defaultSelectedLanguage())?></p>
                  <label><input type="radio" name="hybrid" value="1" ><?=getContentLanguageSelected('YES',defaultSelectedLanguage())?></label>
                  <label><input type="radio" name="hybrid" value="0" checked="checked" ><?=getContentLanguageSelected('NO',defaultSelectedLanguage())?></label>
               </div>
               <div class="form-group">
                  <input name= "basic_info_submit"  id="basic_info_submit" type="button" value="Submit" class="subBtn">
               </div>
               <div class="clearfix"></div>
            </div>
            <div class="clearfix"></div>
         </div>
      </form>
   </div>
</section>
