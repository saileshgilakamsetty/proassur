                        <div class="col-sm-12">
                        <?php $success= $this->session->flashdata('message'); 
                        if(!empty($success)) { ?>
                        <div class="panel panel-warning">
                          <div class="panel-heading">
                            <?php echo $this->session->flashdata('message'); ?>
                          </div>
                        </div>
                        <?php } ?>

<div class="container">
   <form action="" method="post">
      <div class="formFildes">

  <div class="col-xs-12 col-sm-6">
            <input type="hidden" name="company_vehicle_quote_id" id="company_vehicle_quote_id" value="">
            <input type="hidden" name="tvv" id="tvv" value="">
            <input type="hidden" name="risque_id" id="risque_id" value="">
            <input type="hidden" name="insurance_registeration_date" id="insurance_registeration_date" value="">
            <input type="hidden" name="vehicle_basic_info_id" id="vehicle_basic_info_id" value="">

            <div class="form-group">
               <label class="required_red"><?=getContentLanguageSelected('VEHICLE_REGISTERATION_NUMBER',defaultSelectedLanguage())?><span class="required">*</span></label>
               <input type="text" id="registeration_number" name="registeration_number" value="<?=set_value('registeration_number', isset($dataCollection->registeration_number)?$dataCollection->registeration_number:""); ?>"  placeholder="<?=getContentLanguageSelected('VEHICLE_REGISTERATION_NUMBER',defaultSelectedLanguage())?>">
               <?=form_error('registeration_number'); ?>
            </div>
            <div class="form-group">
               <label><?=getContentLanguageSelected('REGISTERATION_DATE',defaultSelectedLanguage())?></label>
               <input type="text" id="registeration_date" name="registeration_date" readonly value="<?=set_value('registeration_date', isset($dataCollection->registeration_date)?$dataCollection->registeration_date:""); ?>"  placeholder="<?=getContentLanguageSelected('REGISTERATION_DATE',defaultSelectedLanguage())?>"  class="dateIcon example1">
               <?=form_error('registeration_date'); ?>
            </div>
            <div class="form-group">
               <label class="required_red"><?=getContentLanguageSelected('CURRENT_VALUE_OF_VEHICLE',defaultSelectedLanguage())?><span class="required">*</span></label>
               <input type="text" id="current_value" value="<?=set_value('current_value', isset($dataCollection->current_value)?$dataCollection->current_value:""); ?>" name="current_value" placeholder="<?=getContentLanguageSelected('CURRENT_VALUE_OF_VEHICLE',defaultSelectedLanguage())?>">
               <?=form_error('current_value'); ?>
            </div>
            <div class="form-group">
               <label class="required_red"><?=getContentLanguageSelected('PREVIOUS_VEHICLE_IDENTIFICATION_NUMBER_REGISTERATION_DATE',defaultSelectedLanguage())?><span class="required"></span></label>
               <input id="previous_register_date" readonly name="previous_register_date" type="text" value="<?=set_value('previous_register_date', isset($dataCollection->previous_register_date)?$dataCollection->previous_register_date:""); ?>" placeholder="<?=getContentLanguageSelected('PREVIOUS_VEHICLE_IDENTIFICATION_NUMBER_REGISTERATION_DATE',defaultSelectedLanguage())?>"  class="dateIcon example1">
               <?=form_error('previous_register_date'); ?>
            </div>
            <div class="form-group">
               <label><?=getContentLanguageSelected('DATE_OF_FIRST_RELEASE',defaultSelectedLanguage())?></label>
               <input readonly type="text" id="date_first_release" name="date_first_release" value="<?=set_value('date_first_release', isset($dataCollection->date_first_release)?$dataCollection->date_first_release:""); ?>" placeholder="<?=getContentLanguageSelected('DATE_OF_FIRST_RELEASE',defaultSelectedLanguage())?>"  class="dateIcon example1">
               <?=form_error('date_first_release'); ?>
            </div>
            <div class="form-group">
               <label><?=getContentLanguageSelected('ENGINE_NUMBER',defaultSelectedLanguage())?></label>
               <input type="text" value="<?=set_value('engine_number', isset($dataCollection->engine_number)?$dataCollection->engine_number:""); ?>" id="engine_number" name="engine_number" placeholder="<?=getContentLanguageSelected('ENGINE_NUMBER',defaultSelectedLanguage())?>">
               <?=form_error('engine_number'); ?>
            </div>
            <div class="form-group">
               <label><?=getContentLanguageSelected('CHASIS_NUMBER',defaultSelectedLanguage())?></label>
               <input type="text" value="<?=set_value('chasis_number', isset($dataCollection->chasis_number)?$dataCollection->chasis_number:""); ?>" id="chasis_number" name="chasis_number" placeholder="<?=getContentLanguageSelected('CHASIS_NUMBER',defaultSelectedLanguage())?>">
               <?=form_error('chasis_number'); ?>
            </div>


  
                                  
            <div class="form-group">
               <label><?=getContentLanguageSelected('BODY_WORK',defaultSelectedLanguage())?></label>
               <?php $data = ' class="form-control input"';
                                        $body_work = $dataCollection->body_work;
                  echo form_dropdown('body_work',getBodyWorkOptions('tbl_body_work','Select Body',1),set_value('body_work',isset($body_work)?$body_work:""),$data);?>
               <?=form_error('body_work'); ?>
            </div>
            <div class="form-group">
               <label><?=getContentLanguageSelected('AUTHROISE_WEIGHT',defaultSelectedLanguage())?></label>
               <input type="text" class="form-control" name="authroise_weight" id="authroise_weight" placeholder="Authroise Weight" value="<?=set_value('authroise_weight', isset($dataCollection->authroise_weight)?$dataCollection->authroise_weight:""); ?>">
               <?=form_error('authroise_weight'); ?>
            </div>


            
            <div class="form-group">
               <label><?=getContentLanguageSelected('VEHICLE_TYPE',defaultSelectedLanguage())?>/<?=getContentLanguageSelected('TERIF',defaultSelectedLanguage())?></label>
               <?php $data = 'class="form-control" id="vehicle_type" ';
                                        $vehicle_type = $dataCollection->vehicle_type;
                  echo form_dropdown('vehicle_type',getSingleOptions('tbl_vehicle_type','Select Terif',1),set_value('vehicle_type',isset($vehicle_type)?$vehicle_type:""),$data);?>
               <?=form_error('vehicle_type'); ?>
            </div>
            <div class="form-group">
               <label><?=getContentLanguageSelected('GEAR_BOX',defaultSelectedLanguage())?></label>
               <input id="gear_box" name="gear_box" value="<?=set_value('gear_box', isset($dataCollection->gear_box)?$dataCollection->gear_box:""); ?>"  type="text" placeholder="<?=getContentLanguageSelected('GEAR_BOX',defaultSelectedLanguage())?>">
               <?=form_error('gear_box'); ?>
            </div>

<!--             <div class="form-group">
               <label><?=getContentLanguageSelected('BODY_WORK',defaultSelectedLanguage())?></label>
               <?php $data = ' class="form-control input"';
                                        $body_work = $dataCollection->body_work;
                  echo form_dropdown('body_work',getBodyWorkOptions('tbl_body_work','Select Body',1),set_value('body_work',isset($body_work)?$body_work:""),$data);?>
               <?=form_error('body_work'); ?>
            </div> -->

         </div>
         <div class="col-xs-12 col-sm-6">
            <div class="form-group">
               <label class="required_red"><?=getContentLanguageSelected('IMMATRICULATION',defaultSelectedLanguage())?>/<?=getContentLanguageSelected('PALTE_NUMBER',defaultSelectedLanguage())?><span class="required">*</span></label>
               <input type="text" class="form-control" name="immatriclulation" id="immatriclulation" value="<?=set_value('immatriclulation', isset($dataCollection->immatriclulation)?$dataCollection->immatriclulation:""); ?>"  placeholder="Immatriclulation" value="<?php echo set_value('immatriclulation') ?>">
               <?=form_error('immatriclulation'); ?>
            </div>
            <div class="form-group">
               <label class="required_red"><?=getContentLanguageSelected('CATALOGUE_VALUE_OF_VEHICLE',defaultSelectedLanguage())?><span class="required">*</span></label>
               <input id="catalogue_value" value="<?=set_value('catalogue_value', isset($dataCollection->catalogue_value)?$dataCollection->catalogue_value:""); ?>" name="catalogue_value" type="text" placeholder="<?=getContentLanguageSelected('CATALOGUE_VALUE_OF_VEHICLE',defaultSelectedLanguage())?>">
               <?=form_error('catalogue_value'); ?>
            </div>
            <div class="form-group">
               <label class="required_red"><?=getContentLanguageSelected('PREVIOUS_VEHICLE_IDENTIFICATION_NUMBER',defaultSelectedLanguage())?><span class="required">*</span></label>
               <input id="vehicle_identification" name="vehicle_identification" type="text" value="<?=set_value('vehicle_identification', isset($dataCollection->vehicle_identification)?$dataCollection->vehicle_identification:""); ?>" placeholder="<?=getContentLanguageSelected('PREVIOUS_VEHICLE_IDENTIFICATION_NUMBER',defaultSelectedLanguage())?>">
               <?=form_error('vehicle_identification'); ?>
            </div>
            <div class="form-group">
               <label><?=getContentLanguageSelected('DATE_OF_RELEASE_VEHICLE_CERTIFICATE',defaultSelectedLanguage())?></label>
               <input readonly id="date_release_certificate" name="date_release_certificate" type="text" value="<?=set_value('date_release_certificate', isset($dataCollection->date_release_certificate)?$dataCollection->date_release_certificate:""); ?>" placeholder="<?=getContentLanguageSelected('DATE_OF_RELEASE_VEHICLE_CERTIFICATE',defaultSelectedLanguage())?>"  class="dateIcon example1">
               <?=form_error('date_release_certificate'); ?>
            </div>
            <div class="form-group">
               <label><?=getContentLanguageSelected('ENGINE_DISPLACEMENT',defaultSelectedLanguage())?></label>
               <input type="text" id="engine_displacement" name="engine_displacement"  value="<?=set_value('engine_displacement', isset($dataCollection->engine_displacement)?$dataCollection->engine_displacement:""); ?>"  placeholder="<?=getContentLanguageSelected('ENGINE_DISPLACEMENT',defaultSelectedLanguage())?>">
               <?=form_error('engine_displacement'); ?>
            </div>



            
            <div class="form-group">
               <label><?=getContentLanguageSelected('RISQUE',defaultSelectedLanguage())?>/<?=getContentLanguageSelected('VEHICLE_CATEGORY',defaultSelectedLanguage())?></label>
               <?php $data = 'class="form-control" id="vehicle_category" ';
                                        $vehicle_category = $dataCollection->vehicle_category;
                  echo form_dropdown('vehicle_category',getSingleOptions('tbl_risque','Select Risque',1),set_value("vehicle_category"),set_value('vehicle_category',isset($vehicle_category)?$vehicle_category:""),$data);?>
               <?=form_error('vehicle_category'); ?>
            </div>



            
            <div class="form-group">
               <label><?=getContentLanguageSelected('USAGE',defaultSelectedLanguage())?></label>
               <?php $data = 'class="form-control" id="usage" ';
                                        $usage = $dataCollection->usage;
                  echo form_dropdown('usage',getSingleOptions('tbl_usage','Select Usage',1),set_value("usage",isset($usage)?$usage:""),$data);?>
               <?=form_error('usage'); ?>
            </div>
            <div class="form-group">
               <label><?=getContentLanguageSelected('LOAD_WEIGHT',defaultSelectedLanguage())?></label>
               <input id="load_weight" name="load_weight" value="<?=set_value('load_weight', isset($dataCollection->load_weight)?$dataCollection->load_weight:""); ?>" type="text" placeholder="<?=getContentLanguageSelected('LOAD_WEIGHT',defaultSelectedLanguage())?>">
               <?=form_error('load_weight'); ?>
            </div>
            <div class="form-group">
               <label><?=getContentLanguageSelected('TARIFF_CODE',defaultSelectedLanguage())?></label>
               <input type="text" value="<?=set_value('tariff_code', isset($dataCollection->tariff_code)?$dataCollection->tariff_code:""); ?>" id="tariff_code" name="tariff_code" placeholder="<?=getContentLanguageSelected('TARIFF_CODE',defaultSelectedLanguage())?>">
               <?=form_error('tariff_code'); ?>
            </div>
            <div class="form-group">
               <label><?=getContentLanguageSelected('SEATING_CAPACITY',defaultSelectedLanguage())?></label>
               <input name="seating_capacity" readonly value="<?=set_value('seating_capacity', isset($dataCollection->seating_capacity)?$dataCollection->seating_capacity:""); ?>" id="seating_capacity" type="text" placeholder="<?=getContentLanguageSelected('SEATING_CAPACITY',defaultSelectedLanguage())?>">
               <?=form_error('seating_capacity'); ?>
            </div>
            <div class="form-group">
               <label><?=getContentLanguageSelected('TAX_BONUS',defaultSelectedLanguage())?></label>
               <input type="text" class="form-control" value="<?=set_value('tax_bonus', isset($dataCollection->tax_bonus)?$dataCollection->tax_bonus:""); ?>" name="tax_bonus" id="tax_bonus" placeholder="Tax Bonus" value="<?php echo set_value('tax_bonus',15) ?>">
               <?=form_error('tax_bonus'); ?>
            </div>
         </div>
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