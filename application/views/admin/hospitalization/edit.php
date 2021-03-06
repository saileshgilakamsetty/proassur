<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
      <div class="header-icon">
          <i class="pe-7s-note2"></i>
      </div>
      <div class="header-title">
            
          <h1><?=getContentLanguageSelected('HOSPITALIZATION',defaultSelectedLanguage())?> </h1>
          <small><?=getContentLanguageSelected('HOSPITALIZATION',defaultSelectedLanguage())?></small>
          <ol class="breadcrumb hidden-xs">
              <li><a href="<?=base_url('admin/dashboard');?>"><i class="pe-7s-home"></i> <?=getContentLanguageSelected('HOME',defaultSelectedLanguage())?></a></li>
              <li class="active"><?=getContentLanguageSelected('HOSPITALIZATION',defaultSelectedLanguage())?></li>
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
                          <a class="btn btn-primary" href="<?=base_url('admin/hospitalization/lists')?>"> <i class="fa fa-list"></i>  <?=getContentLanguageSelected('HOSPITALIZATION_LIST',defaultSelectedLanguage())?></a>  
                      </div>
                  </div>
                  <div class="panel-body">
                      <form  method="post" enctype="multipart/form-data">
                      <div class="col-sm-6" >

                      <div class="form-group">
                        <label><?=getContentLanguageSelected('POLICY_HOLDER_NAME',defaultSelectedLanguage())?><span class="required">*</span></label>

                        <input type="text" class="form-control" name="policy_holder_name" id="policy_holder_name" placeholder="Policy Holder Name" value="<?php echo set_value('policy_holder_name',
                        isset($dataCollection->policy_holder_name)?$dataCollection->policy_holder_name:''
                        ); ?>" >
                           <?=form_error('policy_holder_name'); ?>
                      </div>

                      <div class="form-group">
                        <label><?=getContentLanguageSelected('THE_PATIENT_NAME',defaultSelectedLanguage())?><span class="required">*</span></label>
                        <input type="text" class="form-control" name="the_patient_name" id="the_patient_name" placeholder="The Patient Name" value="<?php echo set_value('the_patient_name',
                        isset($dataCollection->the_patient_name)?$dataCollection->the_patient_name:''
                        ); ?>" >
                           <?=form_error('the_patient_name'); ?>
                      </div>

                      <div class="form-group">
                         <label><?=getContentLanguageSelected('HEALTHCARE_PROVIDER_NAME',defaultSelectedLanguage())?><span class="required">*</span></label>

                         <?php $data = ' class="form-control input" ';
                            echo form_dropdown('healthcareprovider_name_id',getCompanyOptions('tbl_healthcareprovider_name','Select Healthcare Provider',1),set_value("healthcareprovider_name_id",
                              isset($dataCollection->healthcareprovider_name_id)?$dataCollection->healthcareprovider_name_id:''
                          ),$data);?>
                         <?=form_error('healthcareprovider_name_id'); ?>
                      </div>

                        <div class="form-group">
                              <label><?=getContentLanguageSelected('PROVIDER_CONTACT_NUMBER',defaultSelectedLanguage())?><span class="required">*</span></label>

                              <div>
                              <input type="text" class="form-control" name="dial_code" id="dial_code" placeholder="Dial Code" readonly value="<?=getAreaCode() ?>"  style='display: inline; width: 17%;'>
                              <input type="text" class="form-control" name="provider_contact_number" id="provider_contact_number" placeholder="Provider Contact Number" value="<?php echo set_value('provider_contact_number',
                              isset($dataCollection->provider_contact_number)?$dataCollection->provider_contact_number:''
                              ); ?>"  style='display: inline; width: 82%;'>
                              <?=form_error('dial_code'); ?>
                              <?=form_error('provider_contact_number'); ?>
                           </div>
                          </div>


                          <div class="form-group">
                            <label><?=getContentLanguageSelected('DESCRIPTION',defaultSelectedLanguage())?><span class="required">*</span></label>
                            <textarea class="form-control " name="description" id="description" placeholder="Description" rows="10"><?php echo set_value('description',
                              isset($dataCollection->description)?$dataCollection->description:''
                            ); ?></textarea>
                             <?=form_error('description'); ?>
                          </div>
                      
                      </div> 
                      <div class="col-sm-6" >

                      <div class="form-group">
                         <label><?=getContentLanguageSelected('INSURANCE_COMPANY',defaultSelectedLanguage())?><span class="required">*</span></label>

                         <?php $data = ' class="form-control input" ';
                            echo form_dropdown('insurance_company_id',getCompanyOptions('tbl_company','Select Insurance Company',1),set_value("insurance_company_id",
                              isset($dataCollection->insurance_company_id)?$dataCollection->insurance_company_id:''
                          ),$data);?>
                         <?=form_error('insurance_company_id'); ?>
                      </div>


                      <div class="form-group">
                        <label><?=getContentLanguageSelected('CONTACT_NUMBER',defaultSelectedLanguage())?><span class="required">*</span></label>

                        <div>
                          <input type="text" class="form-control" name="contact_dial_code" id="contact_dial_code" placeholder="Contact Number" readonly value="<?=getAreaCode() ?>"  style='display: inline; width: 17%;'>
                          <input type="text" class="form-control" name="contact_number" id="contact_number" placeholder="Contact Number" value="<?php echo set_value('contact_number',
                          isset($dataCollection->contact_number)?$dataCollection->contact_number:''
                          ); ?>"  style='display: inline; width: 82%;'>
                          <?=form_error('contact_dial_code'); ?>
                          <?=form_error('contact_number'); ?>
                        </div>
                      </div>

                      <div class="form-group">
                              <label><?=getContentLanguageSelected('PROVIDER_CONTACT_PERSON_NAME',defaultSelectedLanguage())?><span class="required">*</span></label>
                              <input type="text" class="form-control" name="provider_person_name" id="provider_person_name" placeholder="Provider Contact Person Name" value="<?php echo set_value('provider_person_name',
                              isset($dataCollection->provider_person_name)?$dataCollection->provider_person_name:''); ?>" >
                               <?=form_error('provider_person_name'); ?>
                          </div>



                          <div class="form-group">
                              <label><?=getContentLanguageSelected('PROVIDER_ADDRESS',defaultSelectedLanguage())?><span class="required">*</span></label>

                              <input type="text" class="form-control" id="site_location" name="provider_address" value="<?=set_value('provider_address', isset($dataCollection->provider_address)?$dataCollection->provider_address:""); ?>">
                              <?=form_error('provider_address'); ?>
                          </div>

                          <div class="form-group">
                            <div class="control-group">
                              <label><?=getContentLanguageSelected('ATTACH_DOCUMENTS',defaultSelectedLanguage())?><span class="required">*</span></label>
                              <input type="file"  name="attach_document" id="attach_document"/>
                              <div class="pull-right"> 
                                <?php echo getHospitalizationImage($dataCollection->id); ?>
                              </div>
                            </div>
                         </div>

                      </div>
                     
                      <div class="col-sm-10" >
                          <div class="form-check">
                            <label><?=getContentLanguageSelected('STATUS',defaultSelectedLanguage())?></label><br>
                            <label class="radio-inline">
                                <input type="radio" name="status" value="1" checked="checked">Active</label>
                                <label class="radio-inline"><input type="radio" name="status" value="0" >Inctive</label>
                            </div>        

                            <div id="address">
                              <input type="hidden" name="country" id="country" value="<?=(isset($dataCollection->country))?$dataCollection->country:'';?>" disabled="true">
                              <input type="hidden" name="state" id="administrative_area_level_1" value="<?=(isset($dataCollection->state))?$dataCollection->state:'';?>" disabled="true">
                              <input type="hidden" name="city" id="locality" value="<?=(isset($dataCollection->city))?$dataCollection->city:'';?>" disabled="true">
                              <input type="hidden" name="postal_code" id="postal_code" value="<?=(isset($dataCollection->postal_code))?$dataCollection->postal_code:'';?>" disabled="true">
                              <input type="hidden" id="street_number" disabled="true">
                              <input type="hidden" id="route" disabled="true">                
                              <input type="hidden" id="latitude" name="latitude" value="<?php echo set_value('latitude',isset($dataCollection->latitude)?$dataCollection->latitude:''); ?>">
                              <input type="hidden" id="longitude" name="longitude" value="<?php echo set_value('longitude',isset($dataCollection->longitude)?$dataCollection->longitude:''); ?>">
                           </div>


                            <div class="reset-button">
                             <button class="btn btn-success">Save</button>
                         </div>
                     </div>
                     </form>
                 </div>
             </div>
         </div>
     </div>
  </section> <!-- /.content -->
</div>
