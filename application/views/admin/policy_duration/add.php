<div class="content-wrapper">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <div class="header-icon">
                        <i class="pe-7s-note2"></i>
                    </div>
                    <div class="header-title">
                         
                        <h1><?=getContentLanguageSelected('POLICY_DURATION',defaultSelectedLanguage())?></h1>
                        <small><?=getContentLanguageSelected('POLICY_DURATION_ADD',defaultSelectedLanguage())?></small>
                        <ol class="breadcrumb hidden-xs">
                            <li><a href="<?=base_url('admin/dashboard');?>"><i class="pe-7s-home"></i> <?=getContentLanguageSelected('HOME',defaultSelectedLanguage())?></a></li>
                            <li class="active"><?=getContentLanguageSelected('POLICY_DURATION',defaultSelectedLanguage())?></li>
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
                                        <a class="btn btn-primary" href="<?=base_url('admin/policy-duration/lists')?>"> <i class="fa fa-list"></i>  <?=getContentLanguageSelected('POLICY_DURATION_LIST',defaultSelectedLanguage())?></a>  
                                    </div>
                                </div>
                                <div class="panel-body">
                                    <form  method="post" enctype="multipart/form-data">
                                    <div class="col-sm-6" >
                                        <div class="form-group">
                                            <label><?=getContentLanguageSelected('DAYS_MIN',defaultSelectedLanguage())?><span class="required">*</span></label>
                                            <input type="number" class="form-control" name="min_days" id="min_days" placeholder="Days Min" value="<?php echo set_value('min_days') ?>" >
                                             <?=form_error('min_days'); ?>
                                        </div>

                                        <div class="form-group">
                                            <label><?=getContentLanguageSelected('DAYS_MAX',defaultSelectedLanguage())?><span class="required">*</span></label>
                                            <input type="number" class="form-control" name="max_days" id="max_days" placeholder="Days Max" value="<?php echo set_value('max_days') ?>" >
                                             <?=form_error('max_days'); ?>
                                        </div>


   

                                    </div> 
                                    <div class="col-sm-6" >

                                    <div class="form-group">
                                     <label><?=getContentLanguageSelected('COMPANY',defaultSelectedLanguage())?><span class="required">*</span></label>

                                     <?php $data = 'class="form-control multiselect"';
                              echo form_multiselect('company_id[]',getMultipleOptions('tbl_company','Select Company',1),set_value("company_id[]"),$data);?>
                           <?=form_error('company_id[0]'); ?>
                                  </div>

                                        <div class="form-group">
                                            <label><?=getContentLanguageSelected('PREMIUM_RATE',defaultSelectedLanguage())?><span class="required">*</span></label>
                                            <input type="text" class="form-control" name="premium_rate" id="premium_rate" placeholder="Premium Rate" value="<?php echo set_value('premium_rate') ?>" >
                                             <?=form_error('premium_rate'); ?>
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

