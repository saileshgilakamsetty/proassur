<div class="content-wrapper">
                <!-- Content Header (Page header) -->
                <?php //print_r($dataCollection); ?>

                <section class="content-header">
                    <div class="header-icon">
                        <i class="pe-7s-box1"></i>
                    </div>
                    <div class="header-title">
                        
                        <h1><?=getContentLanguageSelected('APPROVE_BONUS',defaultSelectedLanguage())?></h1>
                        <small><?=getContentLanguageSelected('APPROVE_BONUS_LIST',defaultSelectedLanguage())?></small>
                        <ol class="breadcrumb hidden-xs">
                            <li><a href="<?=base_url('admin/dashboard');?>"><i class="pe-7s-home"></i> <?=getContentLanguageSelected('HOME',defaultSelectedLanguage())?></a></li>
                            <li class="active"><?=getContentLanguageSelected('APPROVE_BONUS',defaultSelectedLanguage())?></li>
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
                              <div class="row usList">
                                
                                <div class="col-sm-4">
                                  <span >Filter by Company Name:</span>
                                  <?php
                                    $data = 'class="filter_by_companyname" id="company_id_bonus"';
                                    echo form_dropdown('bonus_company_id', getSingleOptions('tbl_company','Select Company',1) ,set_value('company_id', (isset($_GET['bonus_company_id'])) ? $_GET['bonus_company_id'] : '' ),$data); 
                                  ?>  
                                </div>
                                <div class="col-sm-4">     
                                  <span >Filter by Branch:</span>
                                  <?php
                                    $data = 'class="filter_by_companyname" id="branch_id_bonus"';
                                    echo form_dropdown('bonus_branch_id', getSingleOptions('tbl_branch','Select Branch',1) ,set_value('bonus_branch_id', (isset($_GET['bonus_branch_id'])) ? $_GET['bonus_branch_id'] : '' ),$data); 
                                  ?>   
                                </div> 
                            
                                <div class="col-sm-12">    
                                  <button id="filter_clear" class="btn-success">Clear Filter</button>
                                </div>
                              </div>
                          </div>


                        <div class="panel-body">  
                          <div class="table-responsive">
                            <table id="example2" class="table table-bordered table-hover">
                                <thead>
                                    <tr>  
                                        <th><?=getContentLanguageSelected('COMPANY_NAME',defaultSelectedLanguage())?></th>

                                        <th><?=getContentLanguageSelected('BRANCH_NAME',defaultSelectedLanguage())?></th>


                                        <th><?=getContentLanguageSelected('YEAR',defaultSelectedLanguage())?></th>

                                        <th><?=getContentLanguageSelected('DISCOUNT',defaultSelectedLanguage())?></th>


                                        <th><?=getContentLanguageSelected('DOCUMENT',defaultSelectedLanguage())?></th>
                                        <th><?=getContentLanguageSelected('APPROVED_STATUS',defaultSelectedLanguage())?></th>
                                        
                                        <th><?=getContentLanguageSelected('ACTION',defaultSelectedLanguage())?> </th>
                                    </tr>
                                </thead>
                                <tbody>
                          <?php if(!empty($dataCollection)){ 
                          
                          foreach ($dataCollection as $data) { ?>
                          <tr >
                                   <td><?=getCompanyName(getCompanyIdByBonusId($data->value_selected_bounus_option))?></td>
                                   <td><?=getBranchName(getBranchIdByBonusId($data->value_selected_bounus_option))?></td>
                                   <td><?=getYearSelectedForBonusByBonusId($data->value_selected_bounus_option)?></td>
                                   <td><?=getDiscountForBonusByBonusId($data->value_selected_bounus_option)."%" ?></td>
                                   <td><?=getImageTag($data->document_image)?></td>
                                   <?php
                                   if($data->approved_status == 1) { ?>
                                   <td>Approved</td>
                                   <?php } else { ?>
                                    
                                   <td>Not Approved</td>
                                    <?php }?>
                                    <?php
                                    if($data->approved_status == 1) { ?>
                                   <td width="15%">No Action Required</td>

                                    <?php } else {?>
                                   <td>

                                    <a  href="<?=base_url('admin/approve/approve/'.$data->id)?>/1" class="label-default label label-success" data-toggle="tooltip" data-placement="right" title="Approve "><i class="fa fa-check" aria-hidden="true"></i></a>
                                    </td>
                                    <?php }?>
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
  

  <!-- Modal to show image with data coming in "viewBonusImageInModal"  -->
  <div class="modal fade" id="viewBonusImageModal" role="dialog">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body">
        <div id="viewBonusImageInModal" ></div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
  