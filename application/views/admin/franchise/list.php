

<div class="content-wrapper">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <div class="header-icon">
                        <i class="pe-7s-box1"></i>
                    </div>
                    <div class="header-title">

                         
                        <h1><?=getContentLanguageSelected('FRANCHISE',defaultSelectedLanguage())?></h1>
                        <small><?=getContentLanguageSelected('FRANCHISE_LIST',defaultSelectedLanguage())?></small>
                        <ol class="breadcrumb hidden-xs">
                            <li><a href="<?=base_url('admin/dashboard');?>"><i class="pe-7s-home"></i> <?=getContentLanguageSelected('HOME',defaultSelectedLanguage())?></a></li>
                            <li class="active"><?=getContentLanguageSelected('FRANCHISE',defaultSelectedLanguage())?></li>
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
                                        <a class="btn btn-success" href="<?=base_url('admin/franchise/add')?>"> <i class="fa fa-plus"></i>  <?=getContentLanguageSelected('ADD_FRANCHISE',defaultSelectedLanguage())?></a>  
                                    </div>

                                    <div class="row usList">
                                      <div class="col-sm-4">
                                        <span ><?=getContentLanguageSelected('FILTER_BY_COMPANY_NAME',defaultSelectedLanguage())?>:</span>
                                        <?php
                                          $data = 'class="filter_by_companyname" id="company_id_filter"';
                                          echo form_dropdown('company_id', getSingleOptions('tbl_company','Select Company',1) ,set_value('company_id', (isset($_GET['company_id'])) ? $_GET['company_id'] : '' ),$data); 
                                        ?>       
                                      </div>        

                                      <div class="col-sm-4">
                                        <span ><?=getContentLanguageSelected('FILTER_BY_BRANCH',defaultSelectedLanguage())?>:</span>
                                        <?php
                                          $data = 'class="filter_by_companyname" id="branch_id_filter"';
                                          echo form_dropdown('branch_id', getSingleOptions('tbl_branch','Select Branch',1) ,set_value('branch_id', (isset($_GET['branch_id'])) ? $_GET['branch_id'] : '' ),$data); 
                                        ?>       
                                      </div>

                                      <div class="col-sm-4">
                                        <span ><?=getContentLanguageSelected('FILTER_BY_RISQUE',defaultSelectedLanguage())?>:</span>
                                        <?php
                                          $data = 'class="filter_by_companyname" id="risque_id_filter"';
                                          echo form_dropdown('risque_id', getSingleOptions('tbl_risque','Select Risque',1) ,set_value('risque_id', (isset($_GET['risque_id'])) ? $_GET['risque_id'] : '' ),$data); 
                                        ?>        
                                      </div>
                                                                        
                                      <div class="col-sm-4">
                                        <span ><?=getContentLanguageSelected('FILTER_BY_WARRANTY',defaultSelectedLanguage())?>:</span>
                                        <?php
                                          $data = 'class="filter_by_companyname" id="warranty_id_filter"';
                                          echo form_dropdown('warranty_id', getWarrantyOptions('tbl_warranty','Select Warranty',1) ,set_value('warranty_id', (isset($_GET['warranty_id'])) ? $_GET['warranty_id'] : '' ),$data); 
                                        ?>      
                                      </div>

                                      <div class="col-sm-12">
                                        <button id="filter_clear" class="btn btn-success"><?=getContentLanguageSelected('CLEAR_FILTER',defaultSelectedLanguage())?></button> 
                                      </div>
                                    </div> 

                                </div>
                        <div class="panel-body">
                                   
                          <div class="table-responsive">
                            <table id="example2" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        
                                        <th><?=getContentLanguageSelected('NAME',defaultSelectedLanguage())?></th>
                                        <th><?=getContentLanguageSelected('COMPANY',defaultSelectedLanguage())?></th>
                                        <th><?=getContentLanguageSelected('BRANCH',defaultSelectedLanguage())?></th>
                                        <th><?=getContentLanguageSelected('RISQUE',defaultSelectedLanguage())?></th>
                                        <th><?=getContentLanguageSelected('WARRANTY',defaultSelectedLanguage())?></th>
                                        <th><?=getContentLanguageSelected('STATUS',defaultSelectedLanguage())?></th>
                                        <th><?=getContentLanguageSelected('ACTION',defaultSelectedLanguage())?></th>
                                    </tr>
                                </thead>`
                                <tbody>
                          <?php if(!empty($dataCollection)){ 
                        
                          foreach ($dataCollection as $data) { ?>
                          
                          <tr >
                                   
                                    <td><?=getFranchiseName($data->franchise_name_id)?></td> 
                                    <td><?=getCompanyName($data->company_id)?></td> 
                                    <td><?=getBranchName($data->branch_id)?></td> 
                                    <td><?=getRisqueName($data->risque_id)?></td> 
                                    <td><?=getWarrantyNameWarrantyTable($data->warranty_id)?></td> 


                                   <?php if($data->status==1){ ?>
                                   <td width="70"><a title="Click to Inactive" href="<?=base_url('admin/franchise/status/'.$data->id.'/0')?>"  data-toggle="tooltip" data-placement="left" class="label-default label label-success">active</a></td>
                                   <?php } else { ?>
                                   <td width="70"><a title="Click to Active" href="<?=base_url('admin/franchise/status/'.$data->id.'/1')?>"  data-toggle="tooltip" data-placement="left" class="label-default label label-danger">Inactive</a></td>
                                   <?php } ?>
                                   <td width="10%" >
                                    <a href="<?=base_url('admin/franchise/edit/'.$data->id)?>" class="label-default label label-success" data-toggle="tooltip" data-placement="left" title="Edit"><i class="fa fa-pencil" aria-hidden="true"></i></a>
                                    <a  onclick="return confirm('Sure you want to delete')" href="<?=base_url('admin/franchise/delete/'.$data->id)?>" class="label-default label label-danger" data-toggle="tooltip" data-placement="right" title="Delete "><i class="fa fa-trash-o" aria-hidden="true"></i></a>
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