<div class="content-wrapper">
   <!-- Content Header (Page header) -->
   <section class="content-header">
      <div class="header-icon">
         <i class="pe-7s-note2"></i>
      </div>
      <div class="header-title">
         <h1><?=getContentLanguageSelected('COMPANY_QUOTE',defaultSelectedLanguage())?></h1>
         <small><?=getContentLanguageSelected('COMPANY_QUOTE_ADD',defaultSelectedLanguage())?></small>
         <ol class="breadcrumb hidden-xs">
            <li><a href="<?=base_url('admin/dashboard');?>"><i class="pe-7s-home"></i><?=getContentLanguageSelected('HOME',defaultSelectedLanguage())?></a></li>
            <li class="active"><?=getContentLanguageSelected('COMPANY_QUOTE',defaultSelectedLanguage())?></li>
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
            <div class="panel panel-bd">
               <div class="panel-body">
                  <form  method="post" enctype="multipart/form-data">
                     <div class="col-md-6" >
                        <div class="form-group">
                           <label><?=getContentLanguageSelected('SELECT_BRAND',defaultSelectedLanguage())?><span class="required">*</span></label>
                               <?php $data = ' id="make_id" class="form-control input" onChange = "getDesignationById(this.value);"';
                             echo form_dropdown('make_id',getSingleOptions('tbl_vehicle_make','Select Brand',1),set_value("make_id"),$data);?>
                                 <?=form_error('make_id'); ?>
                        </div>

                         <div class="form-group">
                            <label><?=getContentLanguageSelected('SELECT_DESIGNATION',defaultSelectedLanguage())?><span class="required">*</span></label>

                            <?php $data = 'class="form-control " id="designation_by_brand" ';
                               echo form_dropdown('designation',getDesignationByBrandId(set_value('make_id')),set_value("designation"),$data);?>
                            <?=form_error('designation'); ?>
                         </div>

                        <div class="form-group">
                           <label><?=getContentLanguageSelected('IMMATRICULATION',defaultSelectedLanguage())?>/<?=getContentLanguageSelected('PLATE_NUMBER',defaultSelectedLanguage())?><span class="required">*</span></label>
                           <input type="text" class="form-control" name="immatriclulation" id="" placeholder="Immatriclulation" value="<?php echo set_value('immatriclulation') ?>">
                           <?=form_error('immatriclulation'); ?>
                        </div>
                         
                        <div class="form-group">
                           <label><?=getContentLanguageSelected('REGISTERATION_DATE',defaultSelectedLanguage())?><span class="required">*</span></label>
                           <input type="text" class="form-control" name="registeration_date" id="registeration_date" placeholder="Registeration Date" value="<?php echo set_value('registeration_date') ?>">
                           <?=form_error('registeration_date'); ?>
                        </div>

                        <div class="form-group">
                           <label><?=getContentLanguageSelected('FUEL_TYPE',defaultSelectedLanguage())?><span class="required">*</span></label>
                               <?php $data = ' id="fuel_type"  class="form-control input"';
                             echo form_dropdown('fuel_type',getSingleOptions('tbl_fuel_type','Select Fuel Type',1),set_value("fuel_type"),$data);?>
                                 <?=form_error('fuel_type'); ?>
                        </div>
                        <div class="control-group">
                           <label><?=getContentLanguageSelected('HYBRID',defaultSelectedLanguage())?></label><br>
                           <label class="cus_radio">
                           <input type="radio" name="hybrid" value="1" >Yes</label>
                           <label class="cus_radio"><input type="radio" name="hybrid" value="0" checked="checked">No</label>
                        </div>
                        <div class="form-group">
                           <label><?=getContentLanguageSelected('FISCAL_POWER',defaultSelectedLanguage())?><span class="required">*</span></label>
                           <input type="text" class="form-control" name="fiscal_power" id="fiscal_power" placeholder="Fiscal Power" value="<?php echo set_value('fiscal_power') ?>">
                           <?=form_error('fiscal_power'); ?>
                        </div>
                        <div class="form-group">
                           <label><?=getContentLanguageSelected('HORSE_POWER',defaultSelectedLanguage())?><span class="required">*</span></label>
                           <input type="text" class="form-control" name="horse_power" id="horse_power" placeholder="Horse Power" value="<?php echo set_value('horse_power') ?>">
                           <?=form_error('horse_power'); ?>
                        </div>

                        <div class="form-group">
                           <label><?=getContentLanguageSelected('NUMBER_OF_SEATS',defaultSelectedLanguage())?><span class="required">*</span></label>
                           <input type="text" class="form-control" name="seats" id="seats" placeholder="NUMBER_OF_SEATS" value="<?php echo set_value('seats') ?>">
                           <?=form_error('seats'); ?>
                        </div>

                        <div class="form-group">
                          <label><?=getContentLanguageSelected('USAGE',defaultSelectedLanguage())?><span class="required">*</span></label>
                          <?php $data = 'class="form-control" id="usage" ';
                          echo form_dropdown('usage',getSingleOptions('tbl_usage','Select Usage',1),set_value("usage"),$data);?>
                              <?=form_error('usage'); ?>
                      </div>

                      <div class="form-group">
                          <label><?=getContentLanguageSelected('RISQUE',defaultSelectedLanguage())?><span class="required">*</span></label>
                          <?php $data = 'class="form-control" id="risque" ';
                          echo form_dropdown('risque',getAutomobileRisque(),set_value("risque"),$data);?>
                              <?=form_error('risque'); ?>
                      </div>
                      
                        <div class="control-group">
                           <label><?=getContentLanguageSelected('IS_THERE_TRAILER_WITH_VEHICLE',defaultSelectedLanguage())?></label><br>
                           <label class="cus_radio">
                           <input type="radio" name="trailer" value="1">Yes</label>
                           <label class="cus_radio"><input type="radio" name="trailer" value="0" checked="checked">No</label>
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
