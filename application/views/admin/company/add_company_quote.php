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
   <!-- Main content -->
   <section class="content">
      <div class="row"> 
         <!-- Form controls -->
         <div class="col-sm-12">
            <div class="panel panel-bd">
               <div class="panel-heading">
                  <div class="btn-group"> 
                     <a class="btn btn-primary" href="<?=base_url('admin/company/company-quote')?>"> <i class="fa fa-list"></i> <?=getContentLanguageSelected('COMPANY_QUOTE_LIST',defaultSelectedLanguage())?></a>  
                  </div>
               </div>
               <div class="panel-body">
                  <form  method="post" enctype="multipart/form-data">
                     <div class="col-md-6" >
                         <div class="form-group">
                             <label><?=getContentLanguageSelected('COMPANY_NAME',defaultSelectedLanguage())?><span class="required">*</span></label>
                             <?php $data = 'class="form-control" id="company_id" ';
                             echo form_dropdown('company_id',getSingleOptions('tbl_company','Select Company',1),set_value("company_id"),$data);?>
                                 <?=form_error('company_id'); ?>
                         </div>

                        <div class="form-group">
                           <label><?=getContentLanguageSelected('FISCAL_POWER',defaultSelectedLanguage())?><span class="required">*</span></label>
                           <input type="text" class="form-control" name="fiscal_power" id="fiscal_power" placeholder="fiscal power" value="<?php echo set_value('fiscal_power') ?>">
                           <?=form_error('fiscal_power'); ?>
                        </div>

                        <div class="form-group">
                           <label><?=getContentLanguageSelected('FUEL_TYPE',defaultSelectedLanguage())?><span class="required">*</span></label>
                           <?php $data = 'class="form-control" id="fuel_type" ';
                             echo form_dropdown('fuel_type',getSingleOptions('tbl_fuel_type','Select Fuel Type',1),set_value("fuel_type"),$data);?>
                                 <?=form_error('fuel_type'); ?>


                           <!-- <input type="text" class="form-control" name="fuel_type" id="fuel_type" placeholder="Fuel Type" value="<?php echo set_value('fuel_type') ?>">
                           <?=form_error('fuel_type'); ?> -->
                        </div>


                        <div class="form-group">
                          <label><?=getContentLanguageSelected('USAGE',defaultSelectedLanguage())?><span class="required">*</span></label>
                          <?php $data = 'class="form-control" id="usage" ';
                          echo form_dropdown('usage',getSingleOptions('tbl_usage','Select Usage',1),set_value("usage"),$data);?>
                              <?=form_error('usage'); ?>
                      </div>



                        <div class="form-group">
                           <label><?=getContentLanguageSelected('TRAILER',defaultSelectedLanguage())?><span class="required">*</span></label><br>
                           <label class="cus_radio">
                           <input type="radio" name="trailer" id="trailer" value="1" checked="checked">Yes
                           </label>
                           <label class="cus_radio">
                           <input type="radio" name="trailer" id="trailer" value="0">No
                           </label>
                           <?=form_error('trailer'); ?>
                        </div>
                        
                        <div class="form-group">
                           <label><?=getContentLanguageSelected('AMOUNT_QUOTE',defaultSelectedLanguage())?><span class="required">*</span></label>
                           <input type="text" class="form-control" name="amount" id="amount" placeholder="Amount" value="<?php echo set_value('amount') ?>">
                           <?=form_error('amount'); ?>
                        </div>

                        <div class="form-group">
                           <label><?=getContentLanguageSelected('NO_OF_SEATS',defaultSelectedLanguage())?></label>

                           <?php $data = 'class="form-control" id="seats" ';
                          echo form_dropdown('seats',getSeatsOptions(),set_value("seats"),$data);?>
                              <?=form_error('seats'); ?>


                           <!-- <input type="text" class="form-control" name="seats" id="seats" placeholder="Amount" value="<?php echo set_value('seats') ?>">
                           <?=form_error('seats'); ?> -->
                        </div>

<!-- client asked to remove thw Tariff and replace it by Risque (done by utkarsh after client discussion) -->

                        <!-- <div class="form-group">
                           <label><?=getContentLanguageSelected('TARIFF',defaultSelectedLanguage())?><span class="required">*</span></label>
                          <?php $data = 'class="form-control" id="tariff_id" ';
                          echo form_dropdown('tariff_id',getSingleOptions('tbl_vehicle_type','Select Tariff',1),set_value("tariff_id"),$data);?>
                              <?=form_error('tariff_id'); ?>
                        </div> -->


                        <div class="form-group">
                           <label><?=getContentLanguageSelected('RISQUE',defaultSelectedLanguage())?><span class="required">*</span></label>
                          <?php $data = 'class="form-control" id="" ';
                          echo form_dropdown('risque_id',getSingleOptions('tbl_risque','Select Risque',1),set_value("risque_id"),$data);?>
                              <?=form_error('risque_id'); ?>
                        </div>


                        <div class="control-group">
                           <label><?= getContentLanguageSelected('STATUS', defaultSelectedLanguage()) ?></label><br>
                           <label class="cus_radio">
                           <input type="radio" name="status" value="1" checked="checked"><?= getContentLanguageSelected('ACTIVE', defaultSelectedLanguage()) ?></label>
                           <label class="cus_radio"><input type="radio" name="status" value="0" ><?= getContentLanguageSelected('INACTIVE', defaultSelectedLanguage()) ?></label>
                        </div>


                     </div>




                     <div class="col-md-12" >
                        <div class="reset-button">
                           <button class="btn btn-success"><?= getContentLanguageSelected('SAVE', defaultSelectedLanguage()) ?></button>
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