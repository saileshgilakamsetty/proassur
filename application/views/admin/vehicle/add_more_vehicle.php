<style>
  .breadcrumb{ max-width: none !important; }
  </style>
<div class="content-wrapper">
   <!-- Content Header (Page header) -->
   <section class="content-header">
      <div class="header-icon">
         <i class="pe-7s-note2"></i>
      </div>
      <div class="header-title">
         <h1><?=getContentLanguageSelected('VEHICLE_DETAILS',defaultSelectedLanguage())?></h1>
         <small><?=getContentLanguageSelected('VEHICLE_DETAILS',defaultSelectedLanguage())?></small>
         <ol class="breadcrumb hidden-xs">
            <li><a href="<?=base_url('admin/dashboard');?>"><i class="pe-7s-home"></i><?=getContentLanguageSelected('HOME',defaultSelectedLanguage())?></a></li>
            <li><a href="<?=base_url('admin/vehicle/vehicle-policies-edit/'.$policy_number.'/'.$vehicle_detail_id);?>"><?=getContentLanguageSelected('VEHICLE_POLICIES_EDIT',defaultSelectedLanguage())?></a></li>
            <li class="active"><?=getContentLanguageSelected('VEHICLE_DETAILS',defaultSelectedLanguage())?></li>
         </ol>
      </div>
   </section>

   <?php $success= $this->session->flashdata('message'); 
   if(!empty($success)) { ?>
<div class="panel panel-success">
   <div class="panel-heading">
      <?php echo $this->session->flashdata('message'); ?>
   </div>
</div>
<?php } ?>

   <!-- Main content -->
   <section class="content">
      <div class="row">
         <!-- Form controls -->
         <div class="col-sm-12">
          <form  method="post" enctype="multipart/form-data" autocomplete="off">
            <div class="panel panel-bd">
               <div class="panel-body">
                      <div class="col-md-6" >
                        <div class="form-group">
                           <label><?=getContentLanguageSelected('SELECT_BRAND',defaultSelectedLanguage())?><span class="required">*</span></label>
                               <?php $data = ' id="make_id" class="form-control input" onChange = "getDesignationById(this.value);"';
                             echo form_dropdown('make_id',getSingleOptions('tbl_vehicle_make','Select Brand',1),set_value("make_id"),$data);?>
                                 <?=form_error('make_id'); ?>
                        </div>
                      </div>
                      <div class="col-md-6" >
                         <div class="form-group">
                            <label><?=getContentLanguageSelected('SELECT_DESIGNATION',defaultSelectedLanguage())?><span class="required">*</span></label>

                            <?php $data = 'class="form-control " id="designation_by_brand" ';
                               echo form_dropdown('designation',getDesignationByBrandId(set_value('make_id')),set_value("designation"),$data);?>
                            <?=form_error('designation'); ?>
                         </div>
                      </div>
                      <div class="col-md-6" >
                        <div class="form-group">
                           <label><?=getContentLanguageSelected('INSURANCE_REGISTERATION_DATE',defaultSelectedLanguage())?><span class="required">*</span></label>
                           <input type="text" class="form-control" name="insurance_registeration_date" id="insurance_registeration_date" placeholder="Insurance Registeration Date" value="<?php echo set_value('insurance_registeration_date') ?>" readonly="readonly">
                           <?=form_error('insurance_registeration_date'); ?>
                        </div>
                      </div>
                      <div class="col-md-6" >
                        <div class="form-group">
                           <label><?=getContentLanguageSelected('FUEL_TYPE',defaultSelectedLanguage())?><span class="required">*</span></label>
                               <?php $data = ' id="fuel_type"  class="form-control input"';
                             echo form_dropdown('fuel_type',getSingleOptions('tbl_fuel_type','Select Fuel Type',1),set_value("fuel_type"),$data);?>
                                 <?=form_error('fuel_type'); ?>
                        </div>
                      </div>
                      <div class="col-md-6" >
                        <div class="control-group">
                           <label><?=getContentLanguageSelected('HYBRID',defaultSelectedLanguage())?></label><br>
                           <label class="cus_radio"><input type="radio" name="hybrid" value="1">Yes</label>
                           <label class="cus_radio"><input type="radio" name="hybrid" value="0" checked="checked">No</label>
                        </div>
                      </div>
                      <div class="col-md-6" >
                        <div class="form-group">
                           <label><?=getContentLanguageSelected('FISCAL_POWER',defaultSelectedLanguage())?><span class="required">*</span></label>
                           <input type="text" class="form-control" name="fiscal_power" id="fiscal_power" placeholder="Fiscal Power" value="<?php echo set_value('fiscal_power') ?>">
                           <?=form_error('fiscal_power'); ?>
                        </div>
                      </div>
                      <div class="col-md-6" >
                        <div class="form-group">
                           <label><?=getContentLanguageSelected('HORSE_POWER',defaultSelectedLanguage())?><span class="required">*</span></label>
                           <input type="text" class="form-control" name="horse_power" id="horse_power" placeholder="Horse Power" value="<?php echo set_value('horse_power') ?>">
                           <?=form_error('horse_power'); ?>
                        </div>
                      </div>
                      <div class="col-md-6" >
                        <div class="form-group">
                           <label><?=getContentLanguageSelected('NUMBER_OF_SEATS',defaultSelectedLanguage())?><span class="required">*</span></label>
                           <input type="text" class="form-control" name="seats" id="seats" placeholder="NUMBER_OF_SEATS" value="<?php echo set_value('seats') ?>">
                           <?=form_error('seats'); ?>
                        </div>
                      </div>
                      <div class="col-md-6" >
                        <div class="form-group">
                          <label><?=getContentLanguageSelected('USAGE',defaultSelectedLanguage())?><span class="required">*</span></label>
                          <?php $data = 'class="form-control" id="usage" ';
                          echo form_dropdown('usage',getSingleOptions('tbl_usage','Select Usage',1),set_value("usage"),$data);?>
                              <?=form_error('usage'); ?>
                        </div>
                      </div>
                      <div class="col-md-6" >
                        <div class="form-group">
                          <label><?=getContentLanguageSelected('RISQUE',defaultSelectedLanguage())?><span class="required">*</span></label>
                          <?php $data = 'class="form-control" id="risque" ';
                          echo form_dropdown('risque',getAutomobileRisque(),set_value("risque"),$data);?>
                              <?=form_error('risque'); ?>
                        </div>
                      </div>
                      <div class="col-md-6" >
                        <div class="control-group">
                           <label><?=getContentLanguageSelected('IS_THERE_TRAILER_WITH_VEHICLE',defaultSelectedLanguage())?></label><br>
                           <label class="cus_radio"><input type="radio" name="trailer" value="1">Yes</label>
                           <label class="cus_radio"><input type="radio" name="trailer" value="0" checked="checked">No</label>
                        </div>
                      </div>

               </div>
            </div>
            <div class="panel panel-bd">
               <div class="panel-body">
                <div class="col-md-6" >
                     <input type="hidden" name="tvv" id="tvv" value="">
                        <div class="form-group">
                           <label><?=getContentLanguageSelected('VEHICLE_REGISTRATION_NUMBER',defaultSelectedLanguage())?><span class="required">*</span></label>
                           <input type="text" class="form-control" name="registeration_number" id="registeration_number" placeholder="Registeration Number" value="<?php echo set_value('registeration_number') ?>" >
                           <?=form_error('registeration_number'); ?>
                        </div>
                        <div class="form-group">
                           <label><?=getContentLanguageSelected('CATALOGUE_VALUE',defaultSelectedLanguage())?><span class="required">*</span></label>
                           <input type="text" class="form-control" name="catalogue_value" id="catalogue_value" placeholder="Catalogue Value" value="<?php echo set_value('catalogue_value') ?>">
                           <?=form_error('catalogue_value'); ?>
                        </div>

                        <div class="form-group">
                           <label><?=getContentLanguageSelected('PREVIOUS_VEHICLE_IDENTIFICATION',defaultSelectedLanguage())?><span class="required">*</span></label>
                           <input type="text" class="form-control" name="vehicle_identification" id="vehicle_identification" placeholder="Vehicle Identification" value="<?php echo set_value('vehicle_identification') ?>">
                           <?=form_error('vehicle_identification'); ?>
                        </div>

                        <div class="form-group">
                           <label><?=getContentLanguageSelected('DATE_RELEASE_VEHICLE_CERTIFICATE',defaultSelectedLanguage())?><span class="required">*</span></label>
                           <input type="text" class="form-control" name="date_release_certificate" id="date_release_certificate" placeholder="Date Release Vehicle Certificate" value="<?php echo set_value('date_release_certificate') ?>" readonly="readonly">
                           <?=form_error('date_release_certificate'); ?>
                        </div>

                        <div class="form-group">
                           <label><?=getContentLanguageSelected('ENGINE_DISPLACEMENT',defaultSelectedLanguage())?><span class="required">*</span></label>
                           <input type="text" class="form-control" name="engine_displacement" id="engine_displacement" placeholder="Engine Displacement" value="<?php echo set_value('engine_displacement') ?>">
                           <?=form_error('engine_displacement'); ?>
                        </div>


                      <div class="form-group">
                          <label><?=getContentLanguageSelected('RISQUE',defaultSelectedLanguage())?>/<?=getContentLanguageSelected('VEHICLE_CATEGORY',defaultSelectedLanguage())?><span class="required">*</span></label>
                          <?php $data = 'class="form-control" id="vehicle_category" ';
                          echo form_dropdown('vehicle_category',getSingleOptions('tbl_risque','Select Risque',1),set_value("vehicle_category"),$data);?>
                              <?=form_error('vehicle_category'); ?>
                      </div>


                        <div class="form-group">
                           <label><?=getContentLanguageSelected('CHASIS_NUMBER',defaultSelectedLanguage())?><span class="required">*</span></label>
                           <input type="text" class="form-control" name="chasis_number" id="chasis_number" placeholder="Chasis Number" value="<?php echo set_value('chasis_number') ?>">
                           <?=form_error('chasis_number'); ?>
                        </div>

                        <div class="form-group">
                           <label><?=getContentLanguageSelected('AUTHORISE_WEIGHT',defaultSelectedLanguage())?><span class="required">*</span></label>
                           <input type="text" class="form-control" name="authorise_weight" id="authorise_weight" placeholder="Authorise Weight" value="<?php echo set_value('authorise_weight') ?>">
                           <?=form_error('authorise_weight'); ?>
                        </div>


                      <div class="form-group">
                          <label><?=getContentLanguageSelected('VEHICLE_TYPE',defaultSelectedLanguage())?>/<?=getContentLanguageSelected('TERIF',defaultSelectedLanguage())?><span class="required">*</span></label>
                          <?php $data = 'class="form-control" id="vehicle_type" ';
                          echo form_dropdown('vehicle_type',getSingleOptions('tbl_vehicle_type','Select Terif',1),set_value("vehicle_type"),$data);?>
                              <?=form_error('vehicle_type'); ?>
                      </div>

                        <div class="form-group">
                           <label><?=getContentLanguageSelected('GEAR_BOX',defaultSelectedLanguage())?><span class="required">*</span></label>
                           <input type="text" class="form-control" name="gear_box" id="gear_box" placeholder="Gear Box" value="<?php echo set_value('gear_box') ?>">
                           <?=form_error('gear_box'); ?>
                        </div>

                        <div class="form-group">
                           <label><?=getContentLanguageSelected('TAX_BONUS',defaultSelectedLanguage())?><span class="required">*</span></label>
                           <input type="text" class="form-control" name="tax_bonus" id="tax_bonus" placeholder="Tax Bonus" value="<?php echo set_value('tax_bonus',15) ?>">
                           <?=form_error('tax_bonus'); ?>
                        </div>
                     
                        <!-- <div class="form-group">
                           <label>Description</label>
                           <textarea class="form-control" name="description" placeholder="Description" id="description"  rows="10"><?=set_value('description', isset($dataCollection->notes)?$dataCollection->notes:""); ?></textarea>
                           <?=form_error('description'); ?>
                        </div>
                     
                        <div class="control-group">
                           <label>Status</label><br>
                           <label class="cus_radio">
                           <input type="radio" name="status" value="1" checked="checked">Active</label>
                           <label class="cus_radio"><input type="radio" name="status" value="0" >InActive</label>
                        </div> -->
                     </div>    
                     <div class="col-md-6" >
                        <div class="form-group">
                           <label><?=getContentLanguageSelected('IMMATRICULATION',defaultSelectedLanguage())?>/<?=getContentLanguageSelected('PALTE_NUMBER',defaultSelectedLanguage())?><span class="required">*</span></label>
                           <input type="text" class="form-control" name="immatriclulation" id="immatriclulation" placeholder="Immatriclulation" value="<?php echo set_value('immatriclulation') ?>">
                           <?=form_error('immatriclulation'); ?>
                        </div>

                        <div class="form-group">
                           <label><?=getContentLanguageSelected('REGISTERATION_DATE',defaultSelectedLanguage())?><span class="required">*</span></label>
                           <input type="text" class="form-control" name="registeration_date" id="registeration_date" placeholder="Registeration Date" value="<?php echo set_value('registeration_date') ?>" readonly="readonly">
                           <?=form_error('registeration_date'); ?>
                        </div>
                        <div class="form-group">
                           <label><?=getContentLanguageSelected('CURRENT_VELICLE_VALUE',defaultSelectedLanguage())?><span class="required">*</span></label>
                           <input type="text" class="form-control" name="current_value" id="current_value" placeholder="Current Value" value="<?php echo set_value('current_value') ?>">
                           <?=form_error('current_value'); ?>
                        </div>

                        <div class="form-group">
                           <label><?=getContentLanguageSelected('PREVIOUS_VEHICLE_IDENTIFICATION_REGISTER_DATE',defaultSelectedLanguage())?><span class="required">*</span></label>
                           <input type="text" class="form-control" name="previous_register_date" id="previous_register_date" placeholder="Previous vehicle identification register date" value="<?php echo set_value('previous_register_date') ?>" readonly="readonly">
                           <?=form_error('previous_register_date'); ?>
                        </div>

                        <div class="form-group">
                           <label><?=getContentLanguageSelected('DATE_FIRST_RELEASE',defaultSelectedLanguage())?><span class="required">*</span></label>
                           <input type="text" class="form-control" name="date_first_release" id="date_first_release" placeholder="Date First Release" value="<?php echo set_value('date_first_release') ?>" readonly="readonly">
                           <?=form_error('date_first_release'); ?>
                        </div>

                        <div class="form-group">
                           <label><?=getContentLanguageSelected('ENGINE_NUMBER',defaultSelectedLanguage())?><span class="required">*</span></label>
                           <input type="text" class="form-control" name="engine_number" id="engine_number" placeholder="Engine Number" value="<?php echo set_value('engine_number') ?>">
                           <?=form_error('engine_number'); ?>
                        </div>

<!--                         <div class="form-group">
                           <label><?=getContentLanguageSelected('USAGE_AREA',defaultSelectedLanguage())?><span class="required">*</span></label>
                           <?php $data = ' class="form-control input"';
                              echo form_dropdown('usage_area',getUsageAreaOptions('tbl_usage_area','Select Usage Area',1),set_value("usage_area"),$data);?>
                           <?=form_error('usage_area'); ?>
                        </div> -->
<?php /*
                        <div class="form-group">
                          <label><?=getContentLanguageSelected('USAGE',defaultSelectedLanguage())?><span class="required">*</span></label>
                          <?php $data = 'class="form-control" id="usage" ';
                          echo form_dropdown('usage',getSingleOptions('tbl_usage','Select Usage',1),set_value("usage"),$data);?>
                              <?=form_error('usage'); ?>
                      </div>
*/ ?>
                        <div class="form-group">
                           <label><?=getContentLanguageSelected('BODY_WORK',defaultSelectedLanguage())?><span class="required">*</span></label>
                              <?php $data = ' class="form-control input"';
                              echo form_dropdown('body_work',getBodyWorkOptions('tbl_body_work','Select Body',1),set_value("body_work"),$data);?>
                           <?=form_error('body_work'); ?>
                        </div>

                        <div class="form-group">
                           <label><?=getContentLanguageSelected('LOAD_WEIGHT  ',defaultSelectedLanguage())?><span class="required">*</span></label>
                           <input type="text" class="form-control" name="load_weight" id="load_weight" placeholder="Load Weight" value="<?php echo set_value('load_weight') ?>">
                           <?=form_error('load_weight'); ?>
                        </div>

                        <div class="form-group">
                           <label><?=getContentLanguageSelected('TARIFF_CODE',defaultSelectedLanguage())?><span class="required">*</span></label>
                           <input type="text" class="form-control" name="tariff_code" id="tariff_code" placeholder="Tariff Code" value="<?php echo set_value('tariff_code') ?>">
                           <?=form_error('tariff_code'); ?>
                        </div>

                        <div class="form-group">
                           <label><?=getContentLanguageSelected('SEATING_CAPACITY',defaultSelectedLanguage())?><span class="required">*</span></label>
                           <input type="text" class="form-control" name="seating_capacity" id="seating_capacity" placeholder="Seating Capacity" value="<?php echo set_value('seating_capacity') ?>">
                           <?=form_error('seating_capacity'); ?>
                        </div>
                     </div>                 

               </div>
            </div>

                       <div class="col-md-12" >
                          <div class="reset-button">
                             <button class="btn btn-success"><?=getContentLanguageSelected('SAVE',defaultSelectedLanguage())?></button>
                          </div>
                       </div>
                  </form>
         </div>
      </div>
   </section>
   <!-- /.content -->
</div>
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>

<style type="text/css">
   .inlineinput div {
    display: inline;
}
</style>