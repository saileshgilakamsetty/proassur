<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <?php //print_r($dataCollection); ?>

  <section class="content-header">
    <div class="header-icon">
        <i class="pe-7s-box1"></i>
    </div>
    <div class="header-title">
       <h1><?=getContentLanguageSelected('WARRANTY_NAME',defaultSelectedLanguage())?></h1>
       <small><?=getContentLanguageSelected('WARRANTY_NAME_LIST',defaultSelectedLanguage())?></small>
       <ol class="breadcrumb hidden-xs">
          <li><a href="<?=base_url('admin/dashboard');?>"><i class="pe-7s-home"></i> <?=getContentLanguageSelected('HOME',defaultSelectedLanguage())?></a></li>
          <li class="active"><?=getContentLanguageSelected('WARRANTY_NAME',defaultSelectedLanguage())?></li>
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
          <div class="panel-heading">

            <div class="btn-group"> 
              <a class="btn btn-success" href="<?=base_url('admin/warranty-name/add')?>"> <i class="fa fa-plus"></i><?=getContentLanguageSelected('ADD_WARRANTY_NAME',defaultSelectedLanguage())?></a>  
            </div>
            <div class="row usList">
              <div class="col-sm-4">        
                <span >Filter by Name:</span>
                <?php
                  $data = 'class="filter_by_companyname" id="warranty_name_filter"';
                  
                  echo form_dropdown('warranty_name_id',getCompanyOptions('tbl_warranty_name','Select Warranty',0),set_value("warranty_name_id",isset($_GET['warranty_name_id'])?$_GET['warranty_name_id']:''),$data);
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
                    <th>Name</th>
                    <th>Status</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  <?php if(!empty($dataCollection)){ 
                
                  foreach ($dataCollection as $data) { ?>
                  <tr >
                    <td><?=$data->name?></td>
                    <?php if($data->status==1){ ?>
                      <td width="80"><a title="Click to Inactive" href="<?=base_url('admin/warrantyname/status/'.$data->id.'/0')?>"  data-toggle="tooltip" data-placement="left" class="label-default label label-success">active</a></td>
                    <?php } else { ?>
                      <td width="80"><a title="Click to Active" href="<?=base_url('admin/warrantyname/status/'.$data->id.'/1')?>"  data-toggle="tooltip" data-placement="left" class="label-default label label-danger">Inactive</a></td>
                    <?php } ?>
                      <td width="10%">
                        <a href="<?=base_url('admin/warranty-name/edit/'.$data->id)?>" class="label-default label label-success" data-toggle="tooltip" data-placement="left" title="Edit"><i class="fa fa-pencil" aria-hidden="true"></i></a>
                        <a  onclick="return confirm('Sure you want to delete')" href="<?=base_url('admin/warrantyname/delete/'.$data->id)?>" class="label-default label label-danger" data-toggle="tooltip" data-placement="right" title="Delete "><i class="fa fa-trash-o" aria-hidden="true"></i></a>
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