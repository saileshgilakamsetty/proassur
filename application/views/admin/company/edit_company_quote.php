<div class="content-wrapper">
   <!-- Content Header (Page header) -->
   <section class="content-header">
      <div class="header-icon">
         <i class="pe-7s-note2"></i>
      </div>
      <div class="header-title">
         <h1><?=getContentLanguageSelected('COMPANY_QUOTE',defaultSelectedLanguage())?></h1>
         <small><?=getContentLanguageSelected('COMPANY_QUOTE_EDIT',defaultSelectedLanguage())?></small>
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
                             $company_id = $dataCollection->company_id;
                             echo form_dropdown('company_id',getSingleOptions('tbl_company','Select Company',1),set_value("company_id",isset($company_id)?$company_id:""),$data);?>
                                 <?=form_error('company_id'); ?>
                         </div>




                        <div class="form-group">
                           <label><?=getContentLanguageSelected('FISCAL_POWER',defaultSelectedLanguage())?><span class="required">*</span></label>
                           <input type="text" class="form-control" name="fiscal_power" id="fiscal_power" placeholder="fiscal power" value="<?=set_value('name', isset($dataCollection->fiscal_power)?$dataCollection->fiscal_power:""); ?>" >
                           <?=form_error('fiscal_power'); ?>
                        </div>

                        <div class="form-group">
                           <label><?=getContentLanguageSelected('FUEL_TYPE',defaultSelectedLanguage())?><span class="required">*</span></label>
                           <?php $data = 'class="form-control" id="fuel_type" ';
                           $fuel_type = $dataCollection->fuel_type;
                             echo form_dropdown('fuel_type',getSingleOptions('tbl_fuel_type','Select Fuel Type',1),set_value("fuel_type",isset($fuel_type)?$fuel_type:""),$data);?>
                                 <?=form_error('fuel_type'); ?>


        
                        </div>


                        <div class="form-group">
                          <label><?=getContentLanguageSelected('USAGE',defaultSelectedLanguage())?><span class="required">*</span></label>
                         <?php $data = 'class="form-control" id="usage" ';
                           $usage = $dataCollection->usage;
                             echo form_dropdown('usage',getSingleOptions('tbl_usage','Select Usage',1),set_value("usage",isset($usage)?$usage:""),$data);?>
                              <?=form_error('usage'); ?>
                      </div>

                           

                        <div class="form-group">
                           <label><?=getContentLanguageSelected('TRAILER',defaultSelectedLanguage())?><span class="required">*</span></label><br>

        

                            <?php $trailer=$dataCollection->trailer ?>

                           <label class="cus_radio">
                           <input type="radio" name="trailer" id="trailer" value="1"<?php if($trailer==1) { ?>  checked="checked" <?php } ?> ><?= getContentLanguageSelected('YES', defaultSelectedLanguage()) ?>
                           </label>
                           <label class="cus_radio">
                           <input type="radio" name="trailer" id="trailer" value="0" <?php if($trailer==0) { ?>  checked="checked" <?php } ?>><?= getContentLanguageSelected('NO', defaultSelectedLanguage()) ?>
                           </label>
                           <?=form_error('trailer'); ?>
                        </div>
                        
                        <div class="form-group">
                           <label><?=getContentLanguageSelected('AMOUNT_QUOTE',defaultSelectedLanguage())?><span class="required">*</span></label>
                           <input type="text" class="form-control" name="amount" id="amount" placeholder="Amount" value="<?=set_value('name', isset($dataCollection->amount)?$dataCollection->amount:""); ?>">
                           <?=form_error('amount'); ?>
                        </div>

                        <div class="form-group">
                           <label><?=getContentLanguageSelected('NO_OF_SEATS',defaultSelectedLanguage())?></label>
                           <!-- $seats = $dataCollection->seats; -->
                           <?php $data = 'class="form-control" id="seats" ';
                     $seats = $dataCollection->seats;
                          echo form_dropdown('seats',getSeatsOptions(),set_value("seats",isset($seats)?$seats:""),$data);?>
                              <?=form_error('seats'); ?>

                  
                        </div>

<!--                         <div class="form-group">
                           <label><?=getContentLanguageSelected('TARIFF',defaultSelectedLanguage())?><span class="required">*</span></label>
                          <?php $data = 'class="form-control" id="tariff_id" ';
                     $tariff_code = $dataCollection->tariff_code;
                 /*    print_r($tariff_code);
                     die();*/

                          echo form_dropdown('tariff_id',getSingleOptions('tbl_vehicle_type','Select Tariff',1),set_value("tariff_id",isset($tariff_code)?$tariff_code:""),$data);?>


                              <?=form_error('tariff_id'); ?>
                        </div> -->

                        <div class="form-group">
                           <label><?=getContentLanguageSelected('RISQUE',defaultSelectedLanguage())?><span class="required">*</span></label>
                          <?php $data = 'class="form-control" id="" ';
                     $risque_id = $dataCollection->risque_id;

                          echo form_dropdown('risque_id',getSingleOptions('tbl_risque','Select Risque',1),set_value("risque_id",isset($risque_id)?$risque_id:""),$data);?>


                              <?=form_error('risque_id'); ?>
                        </div>


                        <div class="form-check">
                           <label><?= getContentLanguageSelected('STATUS', defaultSelectedLanguage()) ?></label><br>
                           <label class="radio-inline">
                           <?php $status=$dataCollection->status ?>
                           <input type="radio" name="status" value="1" <?php if($status==1) { ?>  checked="checked" <?php } ?>><?= getContentLanguageSelected('ACTIVE', defaultSelectedLanguage()) ?></label>
                           <label class="radio-inline"><input type="radio" name="status" value="0" <?php if($status==0) { ?>  checked="checked" <?php } ?>><?= getContentLanguageSelected('INACTIVE', defaultSelectedLanguage()) ?></label>
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