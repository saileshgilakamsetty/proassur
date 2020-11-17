<div class="content-wrapper">
  
  <!-- Content Header (Page header) -->
  <section class="content-header">
      <div class="header-icon">
          <i class="pe-7s-box1"></i>
      </div>
      <div class="header-title">
          
          <h1><?=getContentLanguageSelected('COMPANY_QUOTE',defaultSelectedLanguage())?></h1>
          <small><?=getContentLanguageSelected('COMPANY_QUOTE_LIST',defaultSelectedLanguage())?></small>
          <ol class="breadcrumb hidden-xs">
              <li><a href="<?=base_url('admin/dashboard');?>"><i class="pe-7s-home"></i> <?=getContentLanguageSelected('HOME',defaultSelectedLanguage())?></a></li>
              <li class="active"><?=getContentLanguageSelected('COMPANY_QUOTE',defaultSelectedLanguage())?></li>
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
              <a class="btn btn-success" href="<?=base_url('admin/company/company-quote-add')?>"> <i class="fa fa-plus"></i><?=getContentLanguageSelected('ADD_QUOTE',defaultSelectedLanguage())?></a>  
            </div>
            <div class="row usList">       
              <div class="col-sm-4"> 
                <span ><?=getContentLanguageSelected('FILTER_BY_COMPANY',defaultSelectedLanguage())?>:</span>
                <?php
                $data = 'class="filter_by_companyname" id="companyname_id"';
                 echo form_dropdown('companyname_id', getSingleOptions('tbl_company','Select Company',1) ,set_value('companyname_id', (isset($_GET['companyname_id'])) ? $_GET['companyname_id'] : '' ),$data); 
                ?>
              </div>  

              <div class="col-sm-4">     
                <span ><?=getContentLanguageSelected('FILTER_BY_RISQUE',defaultSelectedLanguage())?>:</span>
                <?php
                  $data = 'class="filter_by_risque" id="risque_id"';
                  echo form_dropdown('risque_id', getSingleOptions('tbl_risque','Select Risque',1) ,set_value('risque_id', (isset($_GET['risque_id'])) ? $_GET['risque_id'] : '' ),$data); 
                ?>
              </div>

              <div class="col-sm-4">
                <span ><?=getContentLanguageSelected('FILTER_BY_FISCAL_POWER',defaultSelectedLanguage())?>:</span>
                <?php
                  $data = 'class="filter_by_fiscalpower" id="fiscal_power_filter"';
                  echo form_dropdown('fiscal_power', getFiscalPowerOptions('tbl_company_vehicle_quote','Select Fiscal Power',1) ,set_value('fiscal_power', (isset($_GET['fiscal_power'])) ? $_GET['fiscal_power'] : '' ),$data); 
                ?>
              </div>
              
              <div class="col-sm-12">
                <button id="clear_filter_company_quote" class="btn btn-success"><?=getContentLanguageSelected('CLEAR_FILTER',defaultSelectedLanguage())?></button>
              </div>
            </div> 
          </div>
          <div class="panel-body">
                     
            <div class="table-responsive">
              <table id="example2" class="table table-bordered table-hover">
                <thead>
                  <tr>  
                    <th><?=getContentLanguageSelected('COMPANY_NAME ',defaultSelectedLanguage())?></th>
                    <th><?=getContentLanguageSelected('FISCAL_POWER',defaultSelectedLanguage())?></th>
                    <th><?=getContentLanguageSelected('AMOUNT_QUOTE',defaultSelectedLanguage())?></th>
                    <th><?=getContentLanguageSelected('FUEL_TYPE',defaultSelectedLanguage())?></th>
                    <th><?=getContentLanguageSelected('RISQUE',defaultSelectedLanguage())?></th>
                    <th><?=getContentLanguageSelected('USAGE',defaultSelectedLanguage())?></th>
                    <th><?=getContentLanguageSelected('SEATS',defaultSelectedLanguage())?></th>
                    <th><?=getContentLanguageSelected('STATUS',defaultSelectedLanguage())?></th>
                    <th><?=getContentLanguageSelected('ACTION',defaultSelectedLanguage())?></th>
                  </tr>
                </thead>
                <tbody>
                  <?php if(!empty($dataCollection)) { 
                
                  foreach ($dataCollection as $data) { ?>
                    <tr >
                      <td><?=getName($data->company_id,'tbl_company')?></td>
                      <td><?=$data->fiscal_power?></td>
                      <td><?=$data->amount?></td>
                      <td><?=getName($data->fuel_type,'tbl_fuel_type')?></td>
                      <td><?=getName($data->risque_id,'tbl_risque')?></td>
                      <td><?=getName($data->usage,'tbl_usage')?></td>
                      <td><?=$data->seats?></td>
                      <?php if($data->status==1){ ?>
                        <td width="80"><a title="Click to Inactive" href="<?=base_url('admin/company/company_quote_status/'.$data->id.'/0')?>"  data-toggle="tooltip" data-placement="left" class="label-default label label-success">Active</a></td>
                      <?php } else { ?>
                        <td width="80"><a title="Click to Active" href="<?=base_url('admin/company/company_quote_status/'.$data->id.'/1')?>"  data-toggle="tooltip" data-placement="left" class="label-default label label-danger">Inactive</a></td>
                      <?php } ?>
                      <td width="10%">
                        <a href="<?=base_url('admin/company/company-quote-edit/'.$data->id)?>" class="label-default label label-success" data-toggle="tooltip" data-placement="left" title="Edit"><i class="fa fa-pencil" aria-hidden="true"></i></a>
                        <a  onclick="return confirm('Sure you want to delete')" href="<?=base_url('admin/company/company_quote_delete/'.$data->id)?>" class="label-default label label-danger" data-toggle="tooltip" data-placement="right" title="Delete "><i class="fa fa-trash-o" aria-hidden="true"></i></a>
                      </td>
                    </tr>
                  <?php }}
                  else { 
                    echo getContentLanguageSelected('NO_RESULT',defaultSelectedLanguage());
                  } ?>
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