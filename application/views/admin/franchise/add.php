<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
      <div class="header-icon">
          <i class="pe-7s-note2"></i>
      </div>
      <div class="header-title"> 
          <h1><?=getContentLanguageSelected('FRANCHISE',defaultSelectedLanguage())?> </h1>
          <small><?=getContentLanguageSelected('FRANCHISE_ADD',defaultSelectedLanguage())?></small>
          <ol class="breadcrumb hidden-xs">
              <li><a href="<?=base_url('admin/dashboard');?>"><i class="pe-7s-home"></i> <?=getContentLanguageSelected('HOME',defaultSelectedLanguage())?></a></li>
              <li class="active"><?=getContentLanguageSelected('FRANCHISE',defaultSelectedLanguage())?></li>
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
                      <a class="btn btn-primary" href="<?=base_url('admin/franchise/lists')?>"> <i class="fa fa-list"></i>  <?=getContentLanguageSelected('FRANCHISE_LIST',defaultSelectedLanguage())?></a>  
                    </div>
                  </div>
                  <div class="panel-body">
                    <form  method="post" enctype="multipart/form-data">
                      <div class="col-sm-6" >
                        <div class="form-group">
                          <label><?=getContentLanguageSelected('FRANCHISE_NAME',defaultSelectedLanguage())?><span class="required">*</span></label>

                          <?php $data = ' class="form-control input" ';
                            echo form_dropdown('franchise_name_id',getCompanyOptions('tbl_franchise_name','Select Franchise',1),set_value("franchise_name_id"),$data);?>
                          <?=form_error('franchise_name_id'); ?>
                        </div>
                        <div class="form-check">
                          <label><?=getContentLanguageSelected('AMOUNT_MODE',defaultSelectedLanguage())?></label><br>
                          <label class="radio-inline">
                          <input type="radio" name="fixed" id="percent_div_show" value="0"<?php echo set_radio('fixed',0); ?>><?=getContentLanguageSelected('ACTUAL',defaultSelectedLanguage())?>/<?=getContentLanguageSelected('CATALOGUE',defaultSelectedLanguage())?></label>
                          <label class="radio-inline">
                          <input type="radio" name="fixed" id="fixed_value_div_show" value="1"<?php echo set_radio('fixed', 1); ?> ><?=getContentLanguageSelected('FIXED_VALUE',defaultSelectedLanguage())?></label>
                        </div>
                        <?=form_error('fixed'); ?>

                        <div class="percent_div" style="display: none;">
                          <div class="form-group">
                            <label><?=getContentLanguageSelected('TYPE_VALUE_OF_VEHICLE',defaultSelectedLanguage())?><span class="required">*</span></label>
                            <?php $data = ' class="form-control input" id="type_value_vehicle"';
                            $type_value_vehicle = $dataCollection->type_value_vehicle;

                            echo form_dropdown('type_value_vehicle',TypeValueVehicleOptions('Select ValueType'),set_value('type_value_vehicle',isset($type_value_vehicle)?$type_value_vehicle:""),$data);?>
                            <?=form_error('type_value_vehicle'); ?>
                          </div>
                          <div class="form-group">
                              <label><?=getContentLanguageSelected('PERCENT',defaultSelectedLanguage())?><span class="required">*</span></label>
                              <input type="text" class="form-control" name="percent" id="percent" placeholder="Percent" value="<?php echo set_value('percent') ?>" >
                               <?=form_error('percent'); ?>
                          </div>

                          <div class="form-group">
                              <label><?=getContentLanguageSelected('MIN_PERCENT',defaultSelectedLanguage())?><span class="required">*</span></label>
                              <input type="text" class="form-control" name="min_percent" id="min_percent" placeholder="Minimum Value" value="<?php echo set_value('min_percent') ?>" >
                               <?=form_error('min_percent'); ?>
                          </div>

                          <div class="form-group">
                              <label><?=getContentLanguageSelected('MAX_PERCENT',defaultSelectedLanguage())?><span class="required">*</span></label>
                              <input type="text" class="form-control" name="max_percent" id="max_percent" placeholder="Maximum Value" value="<?php echo set_value('max_percent') ?>" >
                               <?=form_error('max_percent'); ?>
                          </div>
                        </div>
                        
                        <div class="quote_div" style="display: none;">
                          <div class="form-group">
                              <label><?=getContentLanguageSelected('FIXED_VALUE',defaultSelectedLanguage())?><span class="required">*</span></label>
                              <input type="text" class="form-control" name="fixed_value" id="fixed_value" placeholder=" value" value="<?php echo set_value('fixed_value') ?>" >
                               <?=form_error('fixed_value'); ?>
                          </div>

                          <div class="form-group">
                              <label><?=getContentLanguageSelected('MIN_FIXED_VALUE',defaultSelectedLanguage())?><span class="required">*</span></label>
                              <input type="text" class="form-control" name="min_fixed_value" id="min_fixed_value" placeholder=" Minimum value" value="<?php echo set_value('min_fixed_value') ?>" >
                               <?=form_error('min_fixed_value'); ?>
                          </div>

                          <div class="form-group">
                              <label><?=getContentLanguageSelected('MAX_FIXED_VALUE',defaultSelectedLanguage())?><span class="required">*</span></label>
                              <input type="text" class="form-control" name="max_fixed_value" id="max_fixed_value" placeholder=" Maximum value" value="<?php echo set_value('max_fixed_value') ?>" >
                               <?=form_error('max_fixed_value'); ?>
                          </div>
                        </div>
                      </div> 
                      <div class="col-sm-6" >

                        <div class="form-group">
                           <label><?=getContentLanguageSelected('COMPANY',defaultSelectedLanguage())?><span class="required">*</span></label>

                           <?php $data = ' class="form-control input" onChange = "getBranchByCompanyId(this.value);" ';
                              echo form_dropdown('company_id',getCompanyOptions('tbl_company','Select Company',1),set_value("company_id"),$data);?>
                           <?=form_error('company_id'); ?>
                        </div>
                        <div class="form-group">
                           <label><?=getContentLanguageSelected('BRANCH',defaultSelectedLanguage())?><span class="required">*</span></label>

                           <?php $data = 'class="form-control " id="branch_by_company" onChange = "getRisqueByBranchId(this.value);"';
                              echo form_dropdown('branch_id',getBranchByCompanyId(set_value('company_id')),set_value("branch_id"),$data);?>
                           <?=form_error('branch_id'); ?>
                        </div>


                        <div class="form-group">
                           <label><?=getContentLanguageSelected('RISQUE',defaultSelectedLanguage())?><span class="required">*</span></label>

                           <?php $data = 'class="form-control " id="risque_by_branch"';
                              echo form_dropdown('risque_id',getRisqueByBranchId(set_value('branch_id')),set_value("risque_id"),$data);?>
                           <?=form_error('risque_id'); ?>
                        </div>

                        <div class="form-group">
                           <label><?=getContentLanguageSelected('WARRANTY',defaultSelectedLanguage())?><span class="required">*</span></label>

                           <?php $data = 'class="form-control " ';
                              echo form_dropdown('warranty_id',getWarrantyOptions('tbl_warranty','Select Warranty', 1),set_value("warranty_id"),$data);?>
                           <?=form_error('warranty_id'); ?>
                        </div>
                      </div>
                      <div class="col-sm-10">
                          <div class="form-group">
                              <label><?=getContentLanguageSelected('DESCRIPTION',defaultSelectedLanguage())?><span class="required">*</span></label>
                              <textarea class="form-control " name="description" id="description" placeholder="Description" rows="10"><?php echo set_value('description') ?></textarea>
                               <?=form_error('description'); ?>
                          </div>
                      </div>


                      <div class="col-sm-10" >
                          <div class="form-check">
                            <label><?=getContentLanguageSelected('STATUS',defaultSelectedLanguage())?></label><br>
                            <label class="radio-inline">
                                <input type="radio" name="status" value="1" checked="checked"><?=getContentLanguageSelected('ACTIVE',defaultSelectedLanguage())?></label>
                                <label class="radio-inline"><input type="radio" name="status" value="0" ><?=getContentLanguageSelected('INACTIVE',defaultSelectedLanguage())?></label>
                            </div>                                                 
                            <div class="reset-button">
                             <button class="btn btn-success"><?=getContentLanguageSelected('SAVE',defaultSelectedLanguage())?></button>
                         </div>
                      </div>
                    </form>
                 </div>
             </div>
         </div>
     </div>
 </section> <!-- /.content -->
</div>

