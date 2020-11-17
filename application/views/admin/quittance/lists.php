<div class="content-wrapper">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <div class="header-icon">
                        <i class="pe-7s-box1"></i>
                    </div>
                    <div class="header-title">
                         
                        <h1><?=getContentLanguageSelected('QUITTANCE',defaultSelectedLanguage())?></h1>
                        <small><?=getContentLanguageSelected('QUITTANCE_LIST',defaultSelectedLanguage())?></small>
                        <ol class="breadcrumb hidden-xs">
                            <li><a href="<?=base_url('admin/dashboard');?>"><i class="pe-7s-home"></i> <?=getContentLanguageSelected('HOME',defaultSelectedLanguage())?></a></li>
                            <li class="active"><?=getContentLanguageSelected('QUITTANCE',defaultSelectedLanguage())?></li>
                        </ol>
                    </div>
                </section>
                <!-- Main content -->
                <section class="content">
                    <div class="row">

                        <div class="col-sm-12">
                        <?php $success= $this->session->flashdata('message'); 
                        if(!empty($success)) { ?>
                        <div class="panel panel-success">
                          <div class="panel-heading">
                            <?php echo $this->session->flashdata('message'); ?>
                          </div>
                        </div>
                        <?php } ?>
                        <input type="hidden" id="current_link" name="current_link" value="<?=$current_link?>">
                        <div class="panel panel-bd">
                            <div class="panel-heading addQuitance">

                                <div class="row">
                                    <div class="col-md-2 form-group"> 
                                        <a class="btn btn-success" href="<?=base_url('admin/quittance/add')?>"> <i class="fa fa-plus"></i>  <?=getContentLanguageSelected('ADD_QUITTANCE',defaultSelectedLanguage())?></a>  
                                    </div>
                                </div>
								
								
								<hr>
								<div class="row">
									<div class="col-md-12"><h3 class="space20"><?=getContentLanguageSelected('GET_QUITTANCE_OF_MONTH',defaultSelectedLanguage())?></h3></div>
									<div class="col-md-12">
										<div class="row">
											<div class="form-group col-md-3">
										<?php $data = ' class="form-control input" id="role"';
										echo form_dropdown('role',getUserRoleOptionForQuittance('tbl_user_role','Select',1),set_value("role"),$data);?>
										</div>

										</div>    
									</div>

									<div id="quittance_by_partner" style="display: none;">
										<div class="col-md-3">
											<div class="form-group">
												<?php $data = ' class="form-control input" id="user_id" ';
												echo form_dropdown('user_id',getPartnerUserOptions('tbl_users','Select Partner',1),set_value("user_id"),$data);?>
											</div>
										</div>
									</div>
								</div>

								<div class="row">
									<div  id="quittance_by_company" style="display: none;">
										<div class="col-md-3">
											<div class="form-group">
												<?php $data = ' class="form-control input" id="company_id" onChange = "getBranchByCompanyId(this.value);" ';
												echo form_dropdown('company_id',getCompanyOptions('tbl_company','Select Company',1),set_value("company_id"),$data);?>
											</div>
										</div>

										<div class="col-md-3">
											<div class="form-group">
												<?php $data = 'class="form-control " id="branch_by_company" onChange = "getRisqueByBranchId(this.value);"';
												echo form_dropdown('branch_id',getBranchByCompanyId(set_value('company_id')),set_value("branch_id"),$data);?>
											</div>
										</div>
										<div class="col-md-3">
											<div class="form-group">
												<?php $data = 'class="form-control " id="risque_by_branch"';
												echo form_dropdown('risque_id',getRisqueByBranchId(set_value('branch_id')),set_value("risque_id"),$data);?>
											</div>
										</div>
									</div>
								</div>

								
								<div class="row">
									<div class="col-md-3">
										<div class="form-group">
											<label><?=getContentLanguageSelected('START_DATE',defaultSelectedLanguage())?><span class="required">*</span></label>
											<input class="form-control" type="text" name="quittance_start_date" id="quittance_start_date" placeholder="Start Date" value="<?php echo set_value('quittance_start_date') ?>">
											<?=form_error('quittance_start_date'); ?>
										</div>
									</div>

									<div class="col-md-3">
										<div class="form-group">
											<label><?=getContentLanguageSelected('END_DATE',defaultSelectedLanguage())?><span class="required">*</span></label>
							   
											<input class="form-control" type="text" name="quittance_end_date" id="quittance_end_date" placeholder="End Date" value="<?php echo set_value('quittance_end_date') ?>">
											<?=form_error('quittance_end_date'); ?>
										</div>
									</div>
								</div>


								<div class="btn-group"> 
									<a class="btn btn-success" href="javascript:void(0)" id="get_quittance_of_month" >
										<!-- data-toggle="modal" data-target="#quittance_of_month" -->
										<i class="fa fa-eye"></i>  <?=getContentLanguageSelected('GET_QUITTANCE_OF_MONTH',defaultSelectedLanguage())?> 
									</a> 
								</div>
								<hr>
								
								
								
								
								
								
								
								
								
                                <div class="row">
                                    <div class="col-md-12"><h3 class="space20"><?=getContentLanguageSelected('FILTER_QUITTANCE',defaultSelectedLanguage())?></h3></div>
                                    <!--form method="get" action=""-->
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label><?=getContentLanguageSelected('FILTER_BY_COMPANY',defaultSelectedLanguage())?></label>
                                                <?php $data = ' class="form-control input company_quittance_filter" id="company_id" onChange = "getBranchByCompanyId(this.value);" name="company_id" required ';
                                                echo form_dropdown('company_id',getCompanyOptions('tbl_company','Select Company',1),set_value("company_id",!empty($this->input->get('company_id'))?$this->input->get("company_id"):''),$data);?>
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label><?=getContentLanguageSelected('FILTER_BY_BRANCH',defaultSelectedLanguage())?></label>
                                                <?php $data = 'class="form-control " id="quittance_branch_filter" onChange = "getRisqueByBranchId(this.value);" name="branch_id" ';
                                                echo form_dropdown('branch_id',getBranchByCompanyId(set_value('company_id',!empty($this->input->get('company_id'))?$this->input->get('company_id'):'')),set_value("branch_id",!empty($this->input->get('branch_id'))?$this->input->get("branch_id"):''),$data);?>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label><?=getContentLanguageSelected('FILTER_BY_RISQUE',defaultSelectedLanguage())?></label>
                                                <?php $data = 'class="form-control " id="quittance_risque_filter" name="risque_id" ';
                                                echo form_dropdown('risque_id',getRisqueByBranchId(set_value('branch_id',!empty($this->input->get('branch_id'))?$this->input->get('branch_id'):'')),set_value("risque_id",!empty($this->input->get('risque_id'))?$this->input->get("risque_id"):''),$data);?>
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label><?=getContentLanguageSelected('FILTER_BY_STATUS',defaultSelectedLanguage())?></label>
                                                <?php $data = ' class="form-control input " id="quittance_status_filter"  name="quittance_status" ';
                                                echo form_dropdown('quittance_status',getQuittanceStatusOptions('Select Status'),set_value("quittance_status",!empty($this->input->get('quittance_status'))?$this->input->get("quittance_status"):''),$data);?>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label><?=getContentLanguageSelected('FILTER_BY_POLICY_NUMBER',defaultSelectedLanguage())?></label>
                                                <?php $data = ' class="form-control input " id="quittance_policy_filter"  name="quittance_policy_number" ';
                                                echo form_dropdown('quittance_policy_number',getPolicyNumberOptions('tbl_payment','Select Policy Number'),set_value("quittance_policy_number",!empty($this->input->get('quittance_policy_number'))?$this->input->get("quittance_policy_number"):''),$data);?>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label><?=getContentLanguageSelected('FILTER_BY_CLIENT',defaultSelectedLanguage())?></label>
                                                <?php $data = ' class="form-control input " id="quittance_user_id_filter"  name="quittance_user_id" ';
                                                echo form_dropdown('quittance_user_id',getEndUserOptions('tbl_users','Select User'),set_value("quittance_user_id",!empty($this->input->get('quittance_user_id'))?$this->input->get("quittance_user_id"):''),$data);?>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label><?=getContentLanguageSelected('FILTER_BY_QUITTANCE_NUMBER',defaultSelectedLanguage())?></label>
                                                <?php $data = ' class="form-control input " id="quittance_number_filter"  name="quittance_number" ';
                                                echo form_dropdown('quittance_number',getQuittanceNumberOptions('Select Quittance Number'),set_value("quittance_number",!empty($this->input->get('quittance_number'))?$this->input->get("quittance_number"):''),$data);?>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label><?=getContentLanguageSelected('FILTER_BY_MOBILE',defaultSelectedLanguage())?></label>
                                                <input class="form-control" type="number" name="mobile" id="mobile_quittance" placeholder="Mobile Number" value="<?php echo $this->input->get('mobile') ?>">
                                                <?=form_error('mobile'); ?>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label><?=getContentLanguageSelected('FILTER_BY_START_DATE',defaultSelectedLanguage())?></label>
                                                <input class="form-control" type="text" name="policy_start_date" id="start_date_quittance" placeholder="Start Date" value="<?php echo $this->input->get('policy_start_date') ?>">
                                                <?=form_error('policy_start_date'); ?>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label><?=getContentLanguageSelected('FILTER_BY_END_DATE',defaultSelectedLanguage())?></label>
                                   
                                                <input class="form-control" type="text" name="policy_end_date" id="end_date_quittance" placeholder="End Date" value="<?php echo $this->input->get('policy_end_date') ?>">
                                                <?=form_error('policy_end_date'); ?>
                                            </div>
                                        </div>

                                        <div class="col-md-6 ">
                                            <div class="form-group">
												<button id="filter_clear" class="btn btn-success"><?=getContentLanguageSelected('CLEAR_FILTER',defaultSelectedLanguage())?></button>
											</div>
                                        </div>
                                    <!--/form-->

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <a href="<?= base_url('admin/quittance/preview_quittances?company_id='.$_GET['company_id'].'&branch_id='.$_GET['branch_id'].'&risque_id='.$_GET['risque_id'].'&quittance_status='.$_GET['quittance_status'].'&policy_start_date='.$_GET['policy_start_date'].'&policy_end_date='.$_GET['policy_end_date'])?>" target="_blank" id ="" class="btn btn-success"><i class="fa fa-eye"></i> <?= getContentLanguageSelected('PREVIEW_QUITTANCES_REPORT',defaultSelectedLanguage()) ?></a>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="panel-body">
                                   
                          <div class="table-responsive">
                            <table id="example2" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th><?=getContentLanguageSelected('QUITTANCE_NUMBER',defaultSelectedLanguage())?></th>
                                        <th><?=getContentLanguageSelected('COMPANY',defaultSelectedLanguage())?></th>
                                        <th><?=getContentLanguageSelected('POLICY',defaultSelectedLanguage())?></th>
                                        <th><?=getContentLanguageSelected('CLIENT',defaultSelectedLanguage())?></th>
                                        <th><?=getContentLanguageSelected('BRANCH',defaultSelectedLanguage())?></th>
                                        <th><?=getContentLanguageSelected('RISQUE',defaultSelectedLanguage())?></th>
                                        <th><?=getContentLanguageSelected('NET',defaultSelectedLanguage())?></th>
                                        <th><?=getContentLanguageSelected('ACCESSORIES',defaultSelectedLanguage())?></th>
                                        <th><?=getContentLanguageSelected('POLICY_START_DATE',defaultSelectedLanguage())?></th>
                                        <th><?=getContentLanguageSelected('POLICY_END_DATE',defaultSelectedLanguage())?></th>
                                        <th><?=getContentLanguageSelected('POLICY_CREATION_DATE',defaultSelectedLanguage())?></th>
                                        <th><?=getContentLanguageSelected('ADMIN_POLICY_COMMISSION',defaultSelectedLanguage())?></th>
                                        <th><?=getContentLanguageSelected('TAX',defaultSelectedLanguage())?></th>
                                        <th><?=getContentLanguageSelected('TOTAL',defaultSelectedLanguage())?></th>
                                        <th><?=getContentLanguageSelected('STATUS',defaultSelectedLanguage())?></th>
                                        <th><?=getContentLanguageSelected('ACTION',defaultSelectedLanguage())?></th>
                                        <th><?=getContentLanguageSelected('PREVIEW/DOWNLOAD',defaultSelectedLanguage())?></th>
                                    </tr>
                                </thead>
                                <tbody>
                          <?php if(!empty($dataCollection)){ 
                        
                          foreach ($dataCollection as $data) { 
                            $payment_data = getPaymentDataFromPolicyNumber($data->policy_number);

                            ?>
                            <tr >
                                 
                                <?php
                                    if(($data->policy_start_date == '0000-00-00 00:00:00') || ($data->policy_start_date == '')) {
                                        $policy_start_date = '';
                                    } else {
                                        $policy_start_date = $data->policy_start_date;
                                    }


                                    if(($data->policy_creation_date == '0000-00-00 00:00:00') || ($data->policy_creation_date == '')) {
                                        $policy_creation_date = '';
                                    } else {
                                        $policy_creation_date = $data->policy_creation_date;
                                    }


                                    if(($data->policy_end_date == '0000-00-00 00:00:00') || ($data->policy_end_date == '')) {
                                        $policy_end_date = '';
                                    } else {
                                        $policy_end_date = $data->policy_end_date;
                                    }
                                ?>



                                <td><?= $data->id?></td>   
                                <td><?=getCompanyName($data->company_id)?></td> 
                                <td><?=$data->policy_number?></td> 
                                <td><?=getUserName($data->user_id)?></td> 
                                <td><?=getBranchName($data->branch_id)?></td> 
                                <td><?=getRisqueName($data->risque_id)?></td> 
                                <td><?=$data->amount?></td> 
                                <td><?=$data->accessories?></td> 
                                <td><?= $policy_start_date?></td> 
                                <td><?= $policy_end_date?></td> 
                                <td><?= $policy_creation_date?></td> 
                                <td><?=$data->admin_policy_commission?></td> 
                                <td><?=$data->tax?></td> 
                                <td><?=$data->total_amount?></td> 



                                <?php if($data->status==1){ ?>
                                    <td><a title="Click to Active" href="<?=base_url('admin/quittance/status/'.$data->id.'/0')?>"  data-toggle="tooltip" data-placement="left" class="label-default label label-danger">Inactive</a></td>
                                <?php } else { ?>
                                <!-- <td width="70"><a title="Click to Active" href="<?=base_url('admin/quittance/status/'.$data->id.'/1')?>"  data-toggle="tooltip" data-placement="left" class="label-default label label-success">Active</a></td> -->

                                <td ><a title="Click to Refresh" href=""  data-toggle="tooltip" data-placement="left" class="label-default label label-success">Active</a></td>
                                <?php } ?>
                                <td  >
                                    <a href="<?=base_url('admin/quittance/edit/'.$data->id)?>" class="label-default label label-success" data-toggle="tooltip" data-placement="left" title="Edit"><i class="fa fa-pencil" aria-hidden="true"></i></a>
                                    <a  onclick="return confirm('Sure you want to delete')" href="<?=base_url('admin/quittance/delete/'.$data->id)?>" class="label-default label label-danger" data-toggle="tooltip" data-placement="right" title="Delete "><i class="fa fa-trash-o" aria-hidden="true"></i></a>
                                </td>
                                <td>
                                    <a href="<?=base_url('admin/quittance/report/'.$payment_data->insurance_type_id.'/'.$payment_data->insured_id.'/'.$data->id)?>" target="_blank" class="label-default label label-warning" data-toggle="tooltip" data-placement="right" title="Preview Report "><i class="fa fa-edit" aria-hidden="true"></i></a>
                                    <a href="<?=base_url('admin/quittance/downloadReport/'.$payment_data->insurance_type_id.'/'.$payment_data->insured_id.'/'.$data->id)?>" target="_blank" class="label-default label label-danger" data-toggle="tooltip" data-placement="right" title="Print/Download Report "><i class="fa fa-download" aria-hidden="true"></i></a>
                                </td>
                            </tr>
                            <?php }} ?>
                            
</tbody>
</table>
</div>
<div class="page-nation text-right">
    <?=$pagination?>
    <!-- <ul class="pagination pagination-large">
        <li class="disabled"><span>«</span></li>
        <li class="active"><span>1</span></li>
        <li><a href="#">2</a></li>
        <li class="disabled"><span>...</span></li><li>
        <li><a rel="next" href="#">Next</a></li>
    </ul> -->
</div>
</div>
</div>
</div>
</div>
</section> <!-- /.content -->
</div>


<div id="manage_cheque_payment" class="modal fade" role="dialog">

    <div class="modal-dialog">
        <!-- Modal content-->
        <form enctype="multipart/form-data" method="post" action="">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4  class="modal-title" style="text-align-last: center"><?=getContentLanguageSelected('UPLOAD_CHEQUE',defaultSelectedLanguage())?></h4>
                </div>
                <div id="loading-image_check"  style="display:none;"></div>
                <div class="modal-body">

                    <div class="form-group">
                        <label><?=getContentLanguageSelected('CHEQUE',defaultSelectedLanguage())?><span class="required">*</label>
                        <input type="file"  name="image" id="image"/>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" id="" class="btn btn-success"><?=getContentLanguageSelected('SEND',defaultSelectedLanguage())?></button>
                    <button type="button" class="btn btn-default" data-dismiss="modal"><?=getContentLanguageSelected('CLOSE',defaultSelectedLanguage())?></button>
                </div>
            </div>
        </form>
    </div>
</div>


<div id="quittance_of_month" class="modal fade in" role="dialog" style="padding-right: 15px;">
    <div class="modal-dialog">
        <!-- Modal content-->
        <form method="post" action="" enctype="multipart/form-data">
            <div class="modal-content modal_width">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">×</button>
                    <h4 class="modal-title" style="text-align-last: center"><?=getContentLanguageSelected('QUITTANCE_OF_MONTH',defaultSelectedLanguage())?></h4>
                </div>
                <div id="loading-image" style="display:none;"></div>
                <div class="modal-body">
                    <input type="hidden" id="quittances_start_interval" value="">
                    <input type="hidden" id="user_role" value="">
                    <input type="hidden" id="policy_creater" value="">
                    <input type="hidden" id="quittances_end_interval" value="">
                    <input type="hidden" id="selected_branch" value="">
                    <input type="hidden" id="selected_company" value="">
                    <input type="hidden" id="policy_number_selected" value="">
                    <input type="hidden" id="company_policy_selected" value="">
                    <div id="quittance_of_month_record"></div>
                </div>
                <div class="modal-footer">

                    <div id="policy_selected_total_amount"> Total Amount : 0</div>
                    <input type="file" name="images" id="images" value="">

                    <button type="button" id="send_month_quittance_company" class="btn btn-success">SEND</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">CLOSE</button>
                </div>
            </div>
        </form>
    </div>
</div>



<script>
  $(document).ready(function () {  
    if($('.company_quittance_filter').val() != "" ) {
      getBranchByCompanyId($('.company_quittance_filter').val());
    }

    if($('#quittance_branch_filter').val() != "") {
      getRisqueByBranchId($('#quittance_branch_filter').val());
    }
  });
</script>

