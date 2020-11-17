<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="header-icon">
            <i class="pe-7s-note2"></i>
        </div>
        <div class="header-title">
              
            <h1><?=getContentLanguageSelected('WARRANTY',defaultSelectedLanguage())?> </h1>
            <small><?=getContentLanguageSelected('WARRANTY',defaultSelectedLanguage())?></small>
            <ol class="breadcrumb hidden-xs">
                <li><a href="<?=base_url('admin/dashboard');?>"><i class="pe-7s-home"></i> <?=getContentLanguageSelected('HOME',defaultSelectedLanguage())?></a></li>
                <li class="active"><?=getContentLanguageSelected('WARRANTY',defaultSelectedLanguage())?></li>
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
                            <a class="btn btn-primary" href="<?=base_url('admin/warranty/lists')?>"> <i class="fa fa-list"></i>  <?=getContentLanguageSelected('WARRANTY_LIST',defaultSelectedLanguage())?></a>  
                        </div>
                    </div>
                    <div class="panel-body">
                        <form  method="post" enctype="multipart/form-data">
                            <div class="col-sm-6" >
                                <div class="form-group">
                                    <label><?=getContentLanguageSelected('WARRANTY_NAME',defaultSelectedLanguage())?><span class="required">*</span></label>

                                    <?php $data = ' class="form-control input" ';
                                    $warranty_name = $dataCollection->warranty_name_id;

                                    echo form_dropdown('warranty_name_id',getCompanyOptions('tbl_warranty_name','Select Warranty Name',1),set_value('warranty_name_id',isset($warranty_name)?$warranty_name:""),$data);?>
                                 <?=form_error('warranty_name_id'); ?>
                                </div>

                                <div class="form-check">
                                    <label><?=getContentLanguageSelected('AMOUNT_MODE',defaultSelectedLanguage())?></label><br>
                                    <label class="radio-inline">
                                        <?php $fixed=$dataCollection->fixed ?>
                                        <?php $actual_catalogue=$dataCollection->actual_catalogue ?><input type="radio" name="fixed" id="percent_div_show" value="0"<?php if($fixed==0 && $actual_catalogue==1) { ?>  checked="checked" <?php } ?>>Actual/Catalogue</label>
                                    <label class="radio-inline">
                                    <input type="radio" name="fixed" id="fixed_value_div_show" value="1"<?php if($actual_catalogue==0 && $fixed==1) { ?>  checked="checked" <?php } ?> >Fixed Value</label>
                                </div>
                                <?=form_error('fixed'); ?>

                                <div class="percent_div" style="display: none;">
                                    <div class="form-group type_value_vehicle_div" style="display: none;">
                                        <label><?=getContentLanguageSelected('TYPE_VALUE_OF_VEHICLE',defaultSelectedLanguage())?><span class="required">*</span></label>
                                        <?php $data = ' class="form-control input" id="type_value_vehicle"';
                                        $type_value_vehicle = $dataCollection->type_value_vehicle;

                                        echo form_dropdown('type_value_vehicle',TypeValueVehicleOptions('Select ValueType'),set_value('type_value_vehicle',isset($type_value_vehicle)?$type_value_vehicle:""),$data);?>
                                        <?=form_error('type_value_vehicle'); ?>
                                    </div>

                                    <div class="form-group">
                                        <label><?=getContentLanguageSelected('PERCENT',defaultSelectedLanguage())?><span class="required">*</span></label>
                                        <input type="text" class="form-control" name="percent" id="percent" placeholder="Percent" value="<?=set_value('percent', isset($dataCollection->percent)?$dataCollection->percent:""); ?>" >
                                        <?=form_error('percent'); ?>
                                    </div>

                                    <div class="form-group">
                                        <label><?=getContentLanguageSelected('MIN_PERCENT',defaultSelectedLanguage())?><span class="required">*</span></label>
                                        <input type="text" class="form-control" name="min_percent" id="min_percent" placeholder="Minimum Value" value="<?=set_value('min_percent', isset($dataCollection->min_percent)?$dataCollection->min_percent:""); ?>" >
                                        <?=form_error('min_percent'); ?>
                                    </div>

                                    <div class="form-group">
                                        <label><?=getContentLanguageSelected('MAX_PERCENT',defaultSelectedLanguage())?><span class="required">*</span></label>
                                        <input type="text" class="form-control" name="max_percent" id="max_percent" placeholder="Maximum Value" value="<?=set_value('max_percent', isset($dataCollection->max_percent)?$dataCollection->max_percent:""); ?>" >
                                        <?=form_error('max_percent'); ?>
                                    </div>
                                </div>

                                <div class="quote_div" style="display: none;">
                                    <div class="form-group">
                                        <label><?=getContentLanguageSelected('FIXED_VALUE',defaultSelectedLanguage())?><span class="required">*</span></label>
                                        <input type="text" class="form-control" name="fixed_value" id="fixed_value" placeholder=" value" value="<?=set_value('fixed_value', isset($dataCollection->fixed_value)?$dataCollection->fixed_value:""); ?>" >
                                        <?=form_error('fixed_value'); ?>
                                    </div>

                                    <div class="form-group">
                                        <label><?=getContentLanguageSelected('MIN_FIXED_VALUE',defaultSelectedLanguage())?><span class="required">*</span></label>
                                        <input type="text" class="form-control" name="min_fixed_value" id="min_fixed_value" placeholder=" Minimum value" value="<?=set_value('min_fixed_value', isset($dataCollection->min_fixed_value)?$dataCollection->min_fixed_value:""); ?>" >
                                        <?=form_error('min_fixed_value'); ?>
                                    </div>

                                    <div class="form-group">
                                        <label><?=getContentLanguageSelected('MAX_FIXED_VALUE',defaultSelectedLanguage())?><span class="required">*</span></label>
                                        <input type="text" class="form-control" name="max_fixed_value" id="max_fixed_value" placeholder=" Maximum value" value="<?=set_value('max_fixed_value', isset($dataCollection->max_fixed_value)?$dataCollection->max_fixed_value:""); ?>" >
                                        <?=form_error('max_fixed_value'); ?>
                                    </div>
                                </div>
                            </div> 

                            <div class="col-sm-6" >
                                <div class="form-group">
                                    <label><?=getContentLanguageSelected('COMPANY',defaultSelectedLanguage())?><span class="required">*</span></label>

                                    <?php $data = ' class="form-control input" onChange = "getBranchByCompanyId(this.value);" ';
                                    $company = $dataCollection->company_id;

                                    echo form_dropdown('company_id',getCompanyOptions('tbl_company','Select Company',1),set_value('company_id',isset($company)?$company:""),$data);?>
                                    <?=form_error('company_id'); ?>
                                </div>

                                <div class="form-group">
                                    <label><?=getContentLanguageSelected('BRANCH',defaultSelectedLanguage())?><span class="required">*</span></label>

                                    <?php $data = 'class="form-control " onChange = "getRisqueByBranchId(this.value);" id="branch_by_company"';
                                    $branchValue = $dataCollection->branch_id;
                                    echo form_dropdown('branch_id',getBranchByCompanyId($company),set_value('branch_id',isset($branchValue)?$branchValue:""),$data);?>
                                    <?=form_error('branch_id'); ?>
                                </div>

                                <div class="form-group">
                                    <label><?=getContentLanguageSelected('RISQUE',defaultSelectedLanguage())?><span class="required">*</span></label>

                                    <?php $data = 'class="form-control" id="risque_for_typeofwarranty"';
                                    $risqueValue = $dataCollection->risque_id;
                                    echo form_dropdown('risque_id',getRisqueByBranchId($branchValue),set_value("risque_id",isset($risqueValue)?$risqueValue:""),$data);?>
                                    <?=form_error('risque_id'); ?>
                                </div>

                                <div id="type_of_warranties_div" style="display: none;">
                                  <div class="form-group">
                                    <label><?=getContentLanguageSelected('TYPE_OF_WARRANTIES',defaultSelectedLanguage())?><span class="required">*</span></label>
                                    <?php $data = ' class="form-control input" ';
                                        $typeofwarrantiesValue = $dataCollection->type_of_warranties_id;
                                        echo form_dropdown('type_of_warranties_id',getTypeOfWarrantiesOptions('Select Type Of Warranty'),set_value("type_of_warranties_id",isset($typeofwarrantiesValue)?$typeofwarrantiesValue:""),$data);?>
                                    <?=form_error('type_of_warranties_id'); ?>
                                  </div>
                                </div>

                            </div>

                            <div class="col-sm-10">
                                <div class="form-group">
                                    <label><?=getContentLanguageSelected('DESCRIPTION',defaultSelectedLanguage())?><span class="required">*</span></label>
                                    <textarea class="form-control " name="description" id="description" placeholder="Description" rows="10"><?=set_value('description', isset($dataCollection->description)?$dataCollection->description:""); ?></textarea>
                                    <?=form_error('description'); ?>
                                </div>
                            </div>

                            <div class="col-sm-12">
                                <div class="form-check">
                                    <label><?=getContentLanguageSelected('STATUS',defaultSelectedLanguage())?></label><br>
                                    <label class="radio-inline">
                                    <?php $status=$dataCollection->status ?>
                                    <input type="radio" name="status" value="1" <?php if($status==1) { ?>  checked="checked" <?php } ?>><?=getContentLanguageSelected('ACTIVE',defaultSelectedLanguage())?></label>
                                    <label class="radio-inline"><input type="radio" name="status" value="0" <?php if($status==0) { ?>  checked="checked" <?php } ?>><?=getContentLanguageSelected('INACTIVE',defaultSelectedLanguage())?></label>
                                </div>
                            </div>        

                            <div class="col-sm-10" >
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
