<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
      <div class="header-icon">
          <i class="pe-7s-box1"></i>
      </div>
      <div class="header-title">
          <input type="hidden" id="current_link" name="current_link" value="<?=$current_link?>">  
          <h1><?=getContentLanguageSelected('POLICY_DURATION',defaultSelectedLanguage())?></h1>
          <small><?=getContentLanguageSelected('POLICY_DURATION_LIST',defaultSelectedLanguage())?></small>
          <ol class="breadcrumb hidden-xs">
              <li><a href="<?=base_url('admin/dashboard');?>"><i class="pe-7s-home"></i> <?=getContentLanguageSelected('HOME',defaultSelectedLanguage())?></a></li>
              <li class="active"><?=getContentLanguageSelected('POLICY_DURATION',defaultSelectedLanguage())?></li>
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
                            <a class="btn btn-success" href="<?=base_url('admin/policy-duration/add')?>"> <i class="fa fa-plus"></i>  <?=getContentLanguageSelected('ADD_POLICY_DURATION',defaultSelectedLanguage())?></a>  
                        </div>
                        <div class="row usList">  
                          <div class="col-sm-4">      
                            <span >Filter by Company Name:</span>
                            <?php
                              $data = 'class="filter_by_companyname" id="company_id_filter"';
                              echo form_dropdown('company_id', getSingleOptions('tbl_company','Select Company',1) ,set_value('company_id', (isset($_GET['company_id'])) ? $_GET['company_id'] : '' ),$data); 
                            ?> 
                          </div>

                          <div class="col-sm-4">
                            <span >Filter by MIN_DAYS:</span>
                            <?php
                              $data = 'class="filter_by_companyname" id="min_days_filter"';
                              echo form_dropdown('min_days', getMinDaysOptions('tbl_policy_duration','Select Min Days',0) ,set_value('min_days', (isset($_GET['min_days'])) ? $_GET['min_days'] : '' ),$data); 
                            ?> 
                          </div>

                          <div class="col-sm-4">
                            <span >Filter by MAX_DAYS:</span>
                            <?php
                              $data = 'class="filter_by_companyname" id="max_days_filter"';
                              echo form_dropdown('max_days', getMaxDaysOptions('tbl_policy_duration','Select Max Days',0) ,set_value('max_days', (isset($_GET['max_days'])) ? $_GET['max_days'] : '' ),$data); 
                            ?>  
                          </div>

                          <div class="col-sm-12">
                            <button id="filter_clear" class="btn btn-success">clear Filter</button> 
                          </div>
                        </div>
                    </div>
            <div class="panel-body">
                       
              <div class="table-responsive">
                <table id="example2" class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            
                            <th><?=getContentLanguageSelected('MIN_DAYS',defaultSelectedLanguage())?></th>
                            <th><?=getContentLanguageSelected('MAX_DAYS',defaultSelectedLanguage())?></th>
                            <th><?=getContentLanguageSelected('COMPANY_NAME',defaultSelectedLanguage())?></th>
                            <th><?=getContentLanguageSelected('PREMIUM_RATE',defaultSelectedLanguage())?></th>
                            <th><?=getContentLanguageSelected('STATUS',defaultSelectedLanguage())?></th>
                            <th><?=getContentLanguageSelected('ACTION',defaultSelectedLanguage())?></th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php if(!empty($dataCollection)){ 
                      foreach ($dataCollection as $data) { ?>
                    <tr >
                       
                       <!-- <td><?=$data->question?></td> -->
                       <td><?=$data->min_days?></td>
                       <td><?=$data->max_days?></td>
                       <td><?=getCompanyName($data->company_id)?></td>
                       <td><?=$data->premium_rate?>%</td>

                       <?php if($data->status==1){ ?>
                       <td width="70"><a title="Click to Inactive" href="<?=base_url('admin/policyduration/status/'.$data->id.'/0')?>"  data-toggle="tooltip" data-placement="left" class="label-default label label-success">Active</a></td>
                       <?php } else { ?>
                       <td width="70"><a title="Click to Active" href="<?=base_url('admin/policyduration/status/'.$data->id.'/1')?>"  data-toggle="tooltip" data-placement="left" class="label-default label label-danger">Inactive</a></td>
                       <?php } ?>
                       <td width="10%" >
                        <a href="<?=base_url('admin/policy-duration/edit/'.$data->id)?>" class="label-default label label-success" data-toggle="tooltip" data-placement="left" title="Edit"><i class="fa fa-pencil" aria-hidden="true"></i></a>
                        <a  onclick="return confirm('Sure you want to delete')" href="<?=base_url('admin/policyduration/delete/'.$data->id)?>" class="label-default label label-danger" data-toggle="tooltip" data-placement="right" title="Delete "><i class="fa fa-trash-o" aria-hidden="true"></i></a>
                    </td>
                    </tr>
                  <?php }} ?>             
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