<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="header-icon">
            <i class="pe-7s-box1"></i>
        </div>
        <div class="header-title">
             
            <h1><?=getContentLanguageSelected('HOSPITALIZATION',defaultSelectedLanguage())?></h1>
            <small><?=getContentLanguageSelected('HOSPITALIZATION_LIST',defaultSelectedLanguage())?></small>
            <ol class="breadcrumb hidden-xs">
                <li><a href="<?=base_url('admin/dashboard');?>"><i class="pe-7s-home"></i> <?=getContentLanguageSelected('HOME',defaultSelectedLanguage())?></a></li>
                <li class="active"><?=getContentLanguageSelected('HOSPITALIZATION',defaultSelectedLanguage())?></li>
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
                    <div class="panel-heading">

                        <div class="btn-group"> 
                            <a class="btn btn-success" href="<?=base_url('admin/hospitalization/add')?>"> <i class="fa fa-plus"></i>  <?=getContentLanguageSelected('ADD_HOSPITALIZATION',defaultSelectedLanguage())?></a>  
                        </div>
                    </div>
                    <div class="panel-body">
                               
                        <div class="table-responsive">
                            <table id="example2" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        
                                        <th><?=getContentLanguageSelected('POLICY_HOLDER_NAME',defaultSelectedLanguage())?></th>
                                        <th><?=getContentLanguageSelected('POLICY_NUMBER',defaultSelectedLanguage())?></th>
                                        <th><?=getContentLanguageSelected('INSURANCE_COMPANY',defaultSelectedLanguage())?></th>
                                        <th><?=getContentLanguageSelected('THE_PATIENT_NAME',defaultSelectedLanguage())?><th><?=getContentLanguageSelected('HEALTHCARE_PROVIDER_NAME',defaultSelectedLanguage())?></th>
                                        <th><?=getContentLanguageSelected('STATUS',defaultSelectedLanguage())?></th>
                                        <th><?=getContentLanguageSelected('APPROVED_STATUS',defaultSelectedLanguage())?></th>
                                        <th><?=getContentLanguageSelected('ACTION',defaultSelectedLanguage())?></th>
                                    </tr>
                                </thead>

                                <tbody>
                                    <?php if(!empty($dataCollection)){ 
                                    foreach ($dataCollection as $data) { 
                                        $policy_holder_data = getPolicyHolderData($data->policy_holder_name_id); ?>
                                        <tr >
                                       
                                            <td><?= getusername($policy_holder_data->user_id);?></td>
                                            <td><?= $policy_holder_data->policy_number;?></td>
                                            <td><?=getCompanyName($data->insurance_company_id)?></td>
                                            <td><?=$data->the_patient_name?></td>
                                            <td><?=getHealthcareProviderName($data->healthcareprovider_name_id)?></td>

                                            <?php if($data->status==1){ ?>
                                                <td width="70"><a title="Click to Inactive" href="<?=base_url('admin/hospitalization/status/'.$data->id.'/0')?>"  data-toggle="tooltip" data-placement="left" class="label-default label label-success">active</a></td>
                                            <?php } else { ?>
                                                <td width="70"><a title="Click to Active" href="<?=base_url('admin/hospitalization/status/'.$data->id.'/1')?>"  data-toggle="tooltip" data-placement="left" class="label-default label label-danger">Inactive</a></td>
                                            <?php } ?>
                                            <td><?= ($data->approved_status == 0)?'Not Approved':'Approved';?></td>
                                            <td width="10%" >
                                                <!-- <a href="<?=base_url('admin/hospitalization/edit/'.$data->id)?>" class="label-default label label-success" data-toggle="tooltip" data-placement="left" title="Edit"><i class="fa fa-pencil" aria-hidden="true"></i></a> -->
                                                <a  onclick="return confirm('Sure you want to delete')" href="<?=base_url('admin/hospitalization/delete/'.$data->id)?>" class="label-default label label-danger" data-toggle="tooltip" data-placement="right" title="Delete "><i class="fa fa-trash-o" aria-hidden="true"></i></a>
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