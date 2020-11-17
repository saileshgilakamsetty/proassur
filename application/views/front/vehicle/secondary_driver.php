<section class="insurForm">
	<div class="container">
    	<div class="row">
        	<div class="col-xs-12">
        		<h3 class="title"><?=getContentLanguageSelected('MOTAR_INSURANCE',defaultSelectedLanguage())?></h3>
            </div>
         </div>
         
         <div class="formFildes">
            <form method="post" action="" >   
                <div class="col-xs-12">
                	<div class="form-group radioCheck">
                    	<p><?=getContentLanguageSelected('DECLARE_SECONDARY_DRIVER ?',defaultSelectedLanguage())?></p>
                        <label><input type="radio" name="sec_driver" vehicle_detail_id= "<?=$vehicle_detail_id?>" value="1" checked="checked"><?=getContentLanguageSelected('YES',defaultSelectedLanguage())?></label>
                        <label><input type="radio" name="sec_driver" vehicle_detail_id= "<?=$vehicle_detail_id?>" value="0" ><?=getContentLanguageSelected('NO',defaultSelectedLanguage())?></label>
                    </div>
                </div>
                
                <div class="col-xs-12 col-sm-6">
                        <div class="form-group">
               
                         <label><?=getContentLanguageSelected('NAME_VEHICLE_DRIVER',defaultSelectedLanguage())?><span class="required">*</span></label>

                         <input type="text" class="form-control" name="name" id="name" placeholder="Name" value="<?php echo set_value('name') ?>">
                           <?=form_error('name'); ?>
                                  
                        </div>


                        <div class="form-group">
                           <label><?=getContentLanguageSelected('ISSUE_DATE_LICENSE',defaultSelectedLanguage())?><span class="required">*</span></label>
                           <input type="text" readonly class="form-control dateIcon example1" name="issue_date_license" id="issue_date_license" placeholder="<?=getContentLanguageSelected('ISSUE_DATE_LICENSE',defaultSelectedLanguage())?>" value="<?php echo set_value('issue_date_license') ?>">
                           <?=form_error('issue_date_license'); ?>
                        </div>


                        <div class="form-group">
                           <label><?=getContentLanguageSelected('YEARS_FOR_LICENSE_EXPIRE',defaultSelectedLanguage())?><span class="required">*</span></label>
                           <input type="text" class="form-control" name="year_license_expire" id="year_license_expire" placeholder="<?=getContentLanguageSelected('YEARS_FOR_LICENSE_EXPIRE',defaultSelectedLanguage())?>" value="<?php echo set_value('year_license_expire') ?>">
                           <?=form_error('year_license_expire'); ?>
                        </div>
                </div>
                
                <div class="col-xs-12 col-sm-6">
                        <div class="form-group">
                           <label><?=getContentLanguageSelected('LICENSE_NUMBER',defaultSelectedLanguage())?><span class="required">*</span></label>
                           <input type="text" class="form-control" name="license_number" id="license_number" placeholder="<?=getContentLanguageSelected('LICENSE_NUMBER',defaultSelectedLanguage())?>" value="<?php echo set_value('license_number') ?>">
                           <?=form_error('license_number'); ?>
                        </div>

                          <div class="form-group">
                           <label><?=getContentLanguageSelected('PERMIT',defaultSelectedLanguage())?><span class="required">*</span></label>

                          <?php $data = 'class="form-control" id="permit_id" ';
                          echo form_dropdown('permit_id',getVehiclePermitOption('tbl_vehicle_permit','Select Permit',1),set_value("permit_id"),$data);?>
                              <?=form_error('permit_id'); ?>
                        </div>


                	<div class="form-group radioCheck">
                    	<p><?=getContentLanguageSelected('DOUBLE_COMMAND',defaultSelectedLanguage())?></p>
                        <label><input type="radio" name="double_command"  value="no" ><?=getContentLanguageSelected('YES',defaultSelectedLanguage())?></label>
                        <label><input type="radio" name="double_command" checked="true" value="no" ><?=getContentLanguageSelected('NO',defaultSelectedLanguage())?></label>
                    </div>
                </div>
                
                <div class="col-xs-12">
                	<div class="form-group">
                        <input type="submit" value="Save And Proceed" class="subBtn">
                    </div>
                </div>
                
                <div class="clearfix"></div>
                </form>
        </div>
        
    </div>
</section>

<hr>
