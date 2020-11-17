<div class="content-wrapper">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <div class="header-icon">
                        <i class="pe-7s-note2"></i>
                    </div>
                    <div class="header-title">
                          
                        <h1><?=getContentLanguageSelected('ACCESSORIES',defaultSelectedLanguage())?> </h1>
                        <small><?=getContentLanguageSelected('ACCESSORIES_EDIT',defaultSelectedLanguage())?></small>
                        <ol class="breadcrumb hidden-xs">
                            <li><a href="<?=base_url('admin/dashboard');?>"><i class="pe-7s-home"></i> <?=getContentLanguageSelected('HOME',defaultSelectedLanguage())?></a></li>
                            <li class="active"><?=getContentLanguageSelected('ACCESSORIES',defaultSelectedLanguage())?></li>
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
                                        <a class="btn btn-primary" href="<?=base_url('admin/accessories/lists')?>"> <i class="fa fa-list"></i>  <?=getContentLanguageSelected('ACCESSORIES_LIST',defaultSelectedLanguage())?></a>  
                                    </div>
                                </div>
                                <div class="panel-body">
                                    <form  method="post" enctype="multipart/form-data">
                                    <div class="col-sm-6" >

                        <div class="form-group">
                           <label><?=getContentLanguageSelected('NAME',defaultSelectedLanguage())?><span class="required">*</span></label>
                           <input type="text" class="form-control" name="name" id="name" placeholder="Name" value="<?=set_value('name', isset($dataCollection->name)?$dataCollection->name:""); ?>" >
                           <?=form_error('name'); ?>
                        </div>
                        <div class="form-group">
                           <label><?=getContentLanguageSelected('MINIMUM_PREMIUM',defaultSelectedLanguage())?><span class="required">*</span></label>
                           <input type="text" class="form-control" name="minimum_premium" id="minimum_premium" placeholder="Minimum Premium" value="<?=set_value('minimum_premium', isset($dataCollection->minimum_premium)?$dataCollection->minimum_premium:""); ?>" >
                           <?=form_error('minimum_premium'); ?>
                        </div>

                        <div class="form-group">
                           <label><?=getContentLanguageSelected('MAXIMUM_PREMIUM',defaultSelectedLanguage())?><span class="required">*</span></label>
                           <input type="text" class="form-control" name="maximum_premium" id="maximum_premium" placeholder="Maximum Premium" value="<?=set_value('maximum_premium', isset($dataCollection->maximum_premium)?$dataCollection->maximum_premium:""); ?>" >
                           <?=form_error('maximum_premium'); ?>
                        </div>
                        <div class="form-group">
                           <label><?=getContentLanguageSelected('AMOUNT',defaultSelectedLanguage())?><span class="required">*</span></label>
                           <input type="text" class="form-control" name="amount" id="amount" placeholder="Amount" value="<?=set_value('amount', isset($dataCollection->amount)?$dataCollection->amount:""); ?>" >
                           <?=form_error('amount'); ?>
                        </div>

                        <div class="form-group">
                           <label><?=getContentLanguageSelected('ADMIN_SHARE_IN_PERCENT',defaultSelectedLanguage())?><span class="required">*</span></label>
                           <input type="text" class="form-control amount_share" name="admin_share" id="admin_share" placeholder="Admin Share" value="<?=set_value('admin_share', isset($dataCollection->admin_share)?$dataCollection->admin_share:""); ?>" >
                           <?=form_error('admin_share'); ?>
                        </div>

                        <div class="form-group">
                           <label><?=getContentLanguageSelected('COMPANY_SHARE_IN_PERCENT',defaultSelectedLanguage())?><span class="required">*</span></label>
                           <input type="text" class="form-control amount_share" name="company_share" id="company_share" placeholder="Company Share" value="<?=set_value('company_share', isset($dataCollection->company_share)?$dataCollection->company_share:""); ?>" >
                           <?=form_error('company_share'); ?>
                        </div>

                        <div class="form-group">
                           <label><?=getContentLanguageSelected('ADMIN_POLICY_COMMISSION',defaultSelectedLanguage())?><span class="required">*</span></label>
                           <input type="text" class="form-control " name="admin_policy_share" id="admin_policy_share" placeholder="Admin policy Commission" value="<?=set_value('admin_policy_share', isset($dataCollection->admin_policy_share)?$dataCollection->admin_policy_share:""); ?>" >
                           <?=form_error('admin_policy_share'); ?>
                        </div>
                        <div class="form-group">
                           <label><?=getContentLanguageSelected('TAX_PERCENT',defaultSelectedLanguage())?><span class="required">*</span></label>

                            <input type="text" class="form-control " name="tax_percent" id="tax_percent" placeholder=" Tax Percentage" value="<?=set_value('admin_policy_share', isset($dataCollection->tax_percent)?$dataCollection->tax_percent:""); ?>">

                           <?=form_error('tax_percent'); ?>
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

                                     <?php $data = 'class="form-control" id="risque_by_branch"';
                                     $risqueValue = $dataCollection->risque_id;
                                        echo form_dropdown('risque_id',getRisqueByBranchId($branchValue),set_value("risque_id",isset($risqueValue)?$risqueValue:""),$data);?>
                                     <?=form_error('risque_id'); ?>
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

