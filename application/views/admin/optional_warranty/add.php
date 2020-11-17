<div class="content-wrapper">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <div class="header-icon">
                        <i class="pe-7s-note2"></i>
                    </div>
                    <div class="header-title">     
                        <h1>Optional Warranty</h1>
                        <small>Optional Warranty</small>
                        <ol class="breadcrumb hidden-xs">
                            <li><a href="<?=base_url('admin/dashboard');?>"><i class="pe-7s-home"></i> Home</a></li>
                            <li class="active">Optional Warranty</li>
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
                                        <a class="btn btn-primary" href="<?=base_url('admin/optional-warranty/lists')?>"> <i class="fa fa-list"></i>  Optional Warranty List</a>  
                                    </div>
                                </div>
                                <div class="panel-body">
                                    <form method="post" id="add_company_question">
                                    <div class="col-sm-10" >
                                      <div class="form-group">
                                         <label>Name<span class="required">*</span></label>
                                         <input type="text" class="form-control" name="name" id="name" placeholder="Warranty Name" value="<?php echo set_value('name') ?>">
                                         <?=form_error('name'); ?>
                                      </div>
                                        <div class="form-group">
                                            <label>Company With Insurance For<span class="required">*</span></label><br>
                                        <?php 
                                        if (!empty($companyProvidingInsurance)) {
                                          foreach ($companyProvidingInsurance as $value) {?>
                                              <div class="col-md-6" >
                                                <input type="checkbox" name="company_id[<?=$value->company_id?>]" value="<?=$value->company_id?>" class="company_checkbox" id="<?='company_'.$value->company_id?>" > 
                                                <label >   
                                                <span class="company_providing_insurance" >
                                                <?=getCompanyName($value->company_id)?>
                                                </span>
                                                </label>
                                                <?php 
                                                  $insurance_type = getCompanyProvidingInsurance($value->company_id);
                                                    foreach ($insurance_type as  $insurance_type_id) {?>
                                                    <div class="company_insurance_admin">
                                                    <input type="checkbox" name="company_id[<?=$value->company_id?>][<?=$insurance_type_id?>]" class="insurance_type_checkbox" of_company="<?=$value->company_id?>" value="<?=$insurance_type_id?>" id="insurance_type_<?=$insurance_type_id?>" > 
                                                    <span>
                                                      <?=getName($insurance_type_id,'tbl_insurance_type')?>
                                                    </span>
                                                      </div>
                                                    <?php }?>
                                              </div>
                                          <?php }
                                        }
                                        ?>    
                                        </div>
                                    </div> 
                                    <div class="col-sm-10" >
                                        <div class="form-check">
                                          <label>Status</label><br>
                                          <label class="radio-inline">
                                              <input type="radio" name="status" value="1" checked="checked">Active</label>
                                              <label class="radio-inline"><input type="radio" name="status" value="0" >Inctive</label>
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

