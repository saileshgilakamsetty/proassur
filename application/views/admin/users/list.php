<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <?php //print_r($dataCollection); ?>

  <section class="content-header">
    <div class="header-icon">
      <i class="pe-7s-box1"></i>
    </div>
    <div class="header-title">
      <h1><?=getContentLanguageSelected('USERS',defaultSelectedLanguage())?></h1>
      <small><?=getContentLanguageSelected('USERS_LIST',defaultSelectedLanguage())?></small>
      <ol class="breadcrumb hidden-xs">
        <li><a href="<?=base_url('admin/dashboard');?>"><i class="pe-7s-home"></i> <?=getContentLanguageSelected('HOME',defaultSelectedLanguage())?></a></li>
        <li class="active"><?=getContentLanguageSelected('USERS',defaultSelectedLanguage())?></li>
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
              <a class="btn btn-success" href="<?=base_url('admin/users/add')?>"> <i class="fa fa-plus"></i> <?=getContentLanguageSelected('ADD_USER',defaultSelectedLanguage())?></a>  
            </div>

            <div class="row usList">
              <div class="col-sm-4">       
                <span ><?=getContentLanguageSelected('FILTER_BY_FIRSTNAME',defaultSelectedLanguage())?>:</span>
                <?php
                  $data = 'class="filter_by_userdata" id="user_first_name_filter"';
                  echo form_dropdown('first_name', getUsersFirstNameOptions('tbl_users','Select First Name',1) ,set_value('first_name', (isset($_GET['first_name'])) ? $_GET['first_name'] : '' ),$data); 
                ?>
              </div> 
              <div class="col-sm-4">      
                <span ><?=getContentLanguageSelected('FILTER_BY_LASTNAME',defaultSelectedLanguage())?>:</span>
                <?php
                  $data = 'class="filter_by_userdata" id="user_last_name_filter"';
                  echo form_dropdown('last_name', getUsersLastNameOptions('tbl_users','Select Last Name',1) ,set_value('last_name', (isset($_GET['last_name'])) ? $_GET['last_name'] : '' ),$data); 
                ?> 
              </div> 
              <div class="col-sm-4">    
                <?php $admin_role = $this->session->userdata("admin_role"); ?>
                <span ><?=getContentLanguageSelected('FILTER_BY_ROLE',defaultSelectedLanguage())?>:</span>
                <?php
                  $data = 'class="filter_by_userdata" id="user_role_filter"';
                  echo form_dropdown('role', getUserRoleOptionForSubAdmin($admin_role) ,set_value('role', (isset($_GET['role'])) ? $_GET['role'] : '' ),$data); 
                ?>
              </div> 
              <div class="col-sm-4">
              <span ><?=getContentLanguageSelected('FILTER_BY_ADDRESS',defaultSelectedLanguage())?>:</span>
                <?php
                  $data = 'class="filter_by_userdata" id="user_address_filter"';
                  echo form_dropdown('address', getUsersAddressOptions('tbl_users','Select Address',1) ,set_value('address', (isset($_GET['address'])) ? $_GET['address'] : '' ),$data); 
                ?>
              </div> 
              <div class="col-sm-12">    
                <button id="filter_clear" class="btn-success"><?=getContentLanguageSelected('CLEAR_FILTER',defaultSelectedLanguage())?></button>
              </div>
            </div>
          </div>

          <div class="panel-body">
                     
            <div class="table-responsive">
              <table id="example2" class="table table-bordered table-hover">
                <thead>
                    <tr>  
                        <th><?=getContentLanguageSelected('NAME',defaultSelectedLanguage())?></th>
                        <th><?=getContentLanguageSelected('EMAIL',defaultSelectedLanguage())?></th>
                        <th><?=getContentLanguageSelected('STATUS',defaultSelectedLanguage())?></th>
                        <th><?=getContentLanguageSelected('USER_ROLE',defaultSelectedLanguage())?></th>
                        <th><?=getContentLanguageSelected('ACTION',defaultSelectedLanguage())?></th>
                    </tr>
                </thead>
                <tbody>
                  <?php if(!empty($dataCollection)){ 
                
                  foreach ($dataCollection as $data) { ?>
                  <tr >
                    <td><?=$data->first_name.' '.$data->last_name?></td>
                    <td><?=$data->email?></td>
                    <?php if($data->status==1){ ?>
                    <td ><a title="Click to Inactive" href="<?=base_url('admin/users/status/'.$data->id.'/0')?>"  data-toggle="tooltip" data-placement="left" class="label-default label label-success">Active</a></td>
                    <?php } else { ?>
                    <td><a title="Click to Active" href="<?=base_url('admin/users/status/'.$data->id.'/1')?>"  data-toggle="tooltip" data-placement="left" class="label-default label label-danger">Inactive</a></td>
                    <?php } ?>
                    <td><?=getUserRoleName($data->role)?></td>
                    <td width="10%">
                    <a href="<?=base_url('admin/users/edit/'.$data->id)?>" class="label-default label label-success" data-toggle="tooltip" data-placement="left" title="Edit"><i class="fa fa-pencil" aria-hidden="true"></i></a>
                    <a  onclick="return confirm('Sure you want to delete')" href="<?=base_url('admin/users/delete/'.$data->id)?>" class="label-default label label-danger" data-toggle="tooltip" data-placement="right" title="Delete "><i class="fa fa-trash-o" aria-hidden="true"></i></a>
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