<div class="content-wrapper">
  <!-- Content Header (Page header) -->

  <section class="content-header">
    <div class="header-icon">
      <i class="pe-7s-box1"></i>
    </div>
    <div class="header-title">          
      <h1><?=getContentLanguageSelected('POLICY',defaultSelectedLanguage())?></h1>
      <small><?=getContentLanguageSelected('POLICY_LIST',defaultSelectedLanguage())?></small>
      <ol class="breadcrumb hidden-xs">
        <li><a href="<?=base_url('admin/dashboard');?>"><i class="pe-7s-home"></i> <?=getContentLanguageSelected('HOME',defaultSelectedLanguage())?></a></li>
        <li class="active"><?=getContentLanguageSelected('POLICY',defaultSelectedLanguage())?></li>
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
        <div class="panel panel-bd">
          <div class="panel panel-heading">
            <form method="get" action="">
              <div class="row usList">
                <div class="col-sm-4">       
                  <span ><?=getContentLanguageSelected('FILTER_BY_USERNAME',defaultSelectedLanguage())?>:</span>
                  <?php
                    $data = 'class="filter_by_userdata" ';
                    echo form_dropdown('user_id', getEndUserOptions('tbl_users','Select User',1) ,set_value('user_id', (isset($_GET['user_id'])) ? $_GET['user_id'] : '' ),$data); 
                  ?>
                </div> 
                <div class="col-sm-4">    
                  <?php $admin_role = $this->session->userdata("admin_role"); ?>
                  <span ><?=getContentLanguageSelected('FILTER_BY_INSURANCE_TYPE',defaultSelectedLanguage())?>:</span>
                  <?php
                    $selected          = !empty($this->input->get('insurance_type_id'))?$this->input->get('insurance_type_id'):'';
                    $insurance_type_id = array('' => 'Select Insurance Type');
                    $data              = $this->db->get_where('tbl_insurance_type', ['status' => '1'])->result();
                    foreach ($data as $val) {
                      $insurance_type_id[$val->id] = $val->type;
                    }
                    echo form_dropdown('insurance_type_id', $insurance_type_id, $selected, array('class' => 'form-control'));
                  ?>
                </div> 
                <div class="col-sm-4">
                  <span ><?=getContentLanguageSelected('FILTER_BY_COMPANY',defaultSelectedLanguage())?>:</span>
                  <?php
                    $data = 'class="filter_by_company" ';
                    echo form_dropdown('company_id', getCompanyOptions('tbl_company','Select Company',1) ,set_value('company_id', (!empty($_GET['company_id'])) ? $_GET['company_id'] : '' ),$data); 
                  ?>
                </div> 
              </div>
              <div class="row usList">
                <div class="col-sm-4">
                  <span ><?=getContentLanguageSelected('FILTER_BY_POLICY_NUMBER',defaultSelectedLanguage())?>:</span>
                  <?php
                    $data = 'class="filter_by_policy_number" id="policy_number_filter"';
                    echo form_dropdown('policy_number', getPolicyNumberOptions('tbl_payment','Select Policy Number') ,set_value('', (isset($_GET['policy_number'])) ? $_GET['policy_number'] : '' ),$data); 
                  ?>
                </div> 
                <div class="col-sm-4">
                  <span ><?=getContentLanguageSelected('FILTER_BY_CREATION_DATE',defaultSelectedLanguage())?>:</span>
                  <input name="policy_creation_date" class="form-control" id="policy_creation_date" placeholder="Date" value="<?php echo set_value('policy_creation_date',isset($_GET['policy_creation_date'])?$_GET['policy_creation_date']:'');?>">
                </div> 
              </div>
              <div class="row usList">
                <div class="col-sm-6">  
                  <button id="" type="submit" name="submit" class="btn btn-success"><?=getContentLanguageSelected('FILTER_POLICIES',defaultSelectedLanguage())?> </button>
                </div>
              <!-- </div> -->
            </form>
            <!-- <div class="row usList"> -->
              <div class="col-sm-6">  
                <button id="clear_filter_view_policies" type="button" class="btn btn-success"><?=getContentLanguageSelected('CLEAR_FILTER',defaultSelectedLanguage())?> </button>
              </div>
            </div>
          </div>
        </div>
        <div class="panel-body">                         
          <div class="table-responsive">
            <table id="example2" class="table table-bordered table-hover">
              <thead>
                <tr>  
                  <th><?=getContentLanguageSelected('USER',defaultSelectedLanguage())?></th>
                  <th><?=getContentLanguageSelected('INSURANCE_TYPE',defaultSelectedLanguage())?></th>
                  <th><?=getContentLanguageSelected('COMPANY',defaultSelectedLanguage())?></th>
                  <th><?=getContentLanguageSelected('AMOUNT',defaultSelectedLanguage())?></th>
                  <th><?=getContentLanguageSelected('STATUS',defaultSelectedLanguage())?></th>
                  <th><?=getContentLanguageSelected('ACTION',defaultSelectedLanguage())?></th>
                </tr>
              </thead>
              <tbody>
                <?php 
                  if(!empty($dataCollection)) { 
                     
                    foreach ($dataCollection as $data) { ?>
                      <tr>
                        <td><?=getUserName($data['user_id'])?></td>
                        <td><?=getInsuranceTypeName($data['insurance_type_id'])?></td>
                        <td><?=$data['company_name']?></td>
                        <td><?=$data['amount']?></td>
                        <?php if($data['payment_status']==0 || $data['payment_status']==1){ ?>
                          <td width="80">
                            <?php if($this->session->userdata("admin_role") == "1") {
                                $payment_method = getPaymentModeById($data['id']);
                                if($data['payment_method'] == 4) { ?>
                                  <a title="Click to Pay" href="<?=base_url('admin/settings/pay_by_cheque/'.$data['id'])?>"  data-toggle="tooltip" data-placement="left" class="label-default label label-danger"><?=getContentLanguageSelected('PAY_BY_CHEQUE',defaultSelectedLanguage())?></a>
                                <?php } else { ?>
                                  <a title="Click to Pay" href="<?=base_url('admin/settings/pay_cash/'.$data['id'])?>"  data-toggle="tooltip" data-placement="left" class="label-default label label-danger"><?=getContentLanguageSelected('PAY_CASH',defaultSelectedLanguage())?></a>
                                <?php }
                              } else { ?>
                                <a href="javascript:void(0)"  data-toggle="tooltip" data-placement="left" class="label-default label label-danger">Need a Payment</a>
                              <?php } 
                            ?>
                          </td>
                        <?php } else if($data['payment_status']==2) { ?>
                          <td width="80"><a title="Enjoy your Service" href=""  data-toggle="tooltip" data-placement="left" class="label-default label label-success">PAID</a></td>
                        <?php } else if($data['payment_status'] == 3) { ?>
                          <td width="80"><a title="Expired Policy" href="" data-toggle="tooltip" data-placement="left" class="label-default label label-info" ><?=getContentLanguageSelected('EXPIRED',defaultSelectedLanguage())?></td> <?php 
                        } 
                        if($data['payment_status'] == 2) {
                          if($data['payment_method'] == 4) { ?>
                            <td>
                              <a href="<?= base_url();?>admin/settings/download_file?file=<?= $data['policy_cheque']?>" data-toggle="tooltip" title="" class="btn btn-primary btn-xs" data-original-title="Download Cheque"><i class="fa fa-download" aria-hidden="true"></i></a>

                              <a href="<?= base_url('admin/settings/download_payment_receipt/'.$data['id']);?>" data-toggle="tooltip" title="" class="btn btn-primary btn-xs" data-original-title="Download Receipt"><i class="fa fa-download" aria-hidden="true"></i></a>

                              <a  onclick="return confirm('Sure you want to delete')" href="<?=base_url('admin/settings/delete_policy/'.$data['id'])?>" class="label-default label label-danger" data-toggle="tooltip" data-placement="right" title="Delete "><i class="fa fa-trash-o" aria-hidden="true"></i></a>
                            </td>
                          <?php } else { ?>
                            <td>
                              <a href="<?= base_url('admin/settings/download_payment_receipt/'.$data['id']);?>" data-toggle="tooltip" title="" class="btn btn-primary btn-xs" data-original-title="Download Receipt"><i class="fa fa-download" aria-hidden="true"></i></a>
                              <a  onclick="return confirm('Sure you want to delete')" href="<?=base_url('admin/settings/delete_policy/'.$data['id'])?>" class="label-default label label-danger" data-toggle="tooltip" data-placement="right" title="Delete "><i class="fa fa-trash-o" aria-hidden="true"></i></a>
                            </td>
                          <?php }
                        } else if($data['payment_status'] == 3) { ?>
                            <td>
                              <a title="Renew Your Policy" href="<?=base_url('admin/payment/proceed-to-pay/'.$data['id'])?>"  data-toggle="tooltip" data-placement="left" class="label-default label label-warning"><?=getContentLanguageSelected('RENEW_POLICY',defaultSelectedLanguage())?></a>
                              <a  onclick="return confirm('Sure you want to delete')" href="<?=base_url('admin/settings/delete_policy/'.$data['id'])?>" class="label-default label label-danger" data-toggle="tooltip" data-placement="right" title="Delete "><i class="fa fa-trash-o" aria-hidden="true"></i></a>
                            </td> <?php 
                          } else { ?>
                            <td><a  onclick="return confirm('Sure you want to delete')" href="<?=base_url('admin/settings/delete_policy/'.$data['id'])?>" class="label-default label label-danger" data-toggle="tooltip" data-placement="right" title="Delete "><i class="fa fa-trash-o" aria-hidden="true"></i></a></td>  
                          <?php }
                       ?>           
                      </tr> <?php 
                    }
                  } 
                ?>                
              </tbody>
            </table>
          </div>
          <div class="page-nation text-right">
            <?=$pagination?>
          </div>
        </div>
      </div>
    </div>
    </div>
  </section> <!-- /.content -->
</div>
