<div class="content-wrapper">
   <section class="content-header">
      <div class="header-icon">
         <i class="pe-7s-box1"></i>
      </div>
      <div class="header-title">
         <h1><?=getContentLanguageSelected('HOUSE_TARIFICATION',defaultSelectedLanguage())?></h1>
         <small><?=getContentLanguageSelected('HOUSE_TARIFICATION_LIST',defaultSelectedLanguage())?></small>
         <ol class="breadcrumb hidden-xs">
            <li><a href="<?=base_url('admin/dashboard');?>"><i class="pe-7s-home"></i> <?=getContentLanguageSelected('HOME',defaultSelectedLanguage())?></a></li>
            <li class="active"><?=getContentLanguageSelected('HOUSE_TARIFICATION',defaultSelectedLanguage())?></li>
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
                     <a class="btn btn-success" href="<?=base_url('admin/housingterification/add_house_tarification')?>"> <i class="fa fa-plus"></i><?=getContentLanguageSelected('ADD_HOUSE_TARIFICATION',defaultSelectedLanguage())?></a>  
                  </div>
                  <div class="row usList">
                     <div class="col-sm-4">  
                        <span ><?=getContentLanguageSelected('FILTER_BY_INSURER_QUALITY',defaultSelectedLanguage())?>:</span>
                        <?php
                         $data = 'class="filter_by_insurerquality" id="insurer_quality_filter"';
                         
                         echo form_dropdown('insurer_quality_id',getCompanyOptions('tbl_insurer_quality','Select Insurer Qulality',0),set_value("insurer_quality_id",isset($_GET['insurer_quality_id'])?$_GET['insurer_quality_id']:''),$data);
                        ?>  
                     </div> 
                     
                     <div class="col-sm-4">        
                       <span ><?=getContentLanguageSelected('FILTER_BY_COMPANY',defaultSelectedLanguage())?>:</span>
                       <?php
                         $data = 'class="filter_by_companyname" id="company_id_filter"';
                         
                         echo form_dropdown('company_id',getCompanyOptions('tbl_company','Select Insurer Qulality',0),set_value("company_id",isset($_GET['company_id'])?$_GET['company_id']:''),$data);
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
                              <th><?=getContentLanguageSelected('ADD_HOUSE_TARIFICATION',defaultSelectedLanguage())?></th>
                              <th><?=getContentLanguageSelected('RISQUE',defaultSelectedLanguage())?></th>
                              <th><?=getContentLanguageSelected('INSURER_QUALITY',defaultSelectedLanguage())?></th>
                              <th><?=getContentLanguageSelected('HOUSE_TYPE',defaultSelectedLanguage())?></th>
                              <th><?=getContentLanguageSelected('HOUSE_CATEGORY',defaultSelectedLanguage())?></th>
                              <th><?=getContentLanguageSelected('DURATION',defaultSelectedLanguage())?></th>
                              <th><?=getContentLanguageSelected('STATUS',defaultSelectedLanguage())?></th>
                              <th><?=getContentLanguageSelected('ACTION',defaultSelectedLanguage())?></th>
                           </tr>
                        </thead>
                        <tbody>
                           <?php if(!empty($dataCollection)){ 
                              foreach ($dataCollection as $data) { ?>
                           <tr >
                              <td><?=getCompanyName($data->company_id)?></td>
                              <td><?=getRisqueName($data->risque_id)?></td>
                              <td><?=getName($data->insurer_quality_id,'tbl_insurer_quality')?></td>
                              <td><?=getName($data->house_type_id,'tbl_house_type')?></td>
                              <td><?=getName($data->house_category_id,'tbl_house_category')?></td>
                              <td><?=getName($data->month_id,'tbl_house_month')?></td>
                              <?php if($data->status==1){ ?>
                              <td width="80"><a title="Click to Inactive" href="<?=base_url('admin/housingterification/status/'.$data->id.'/0')?>"  data-toggle="tooltip" data-placement="left" class="label-default label label-success">Active</a></td>
                              <?php } else { ?>
                              <td width="80"><a title="Click to Active" href="<?=base_url('admin/housingterification/status/'.$data->id.'/1')?>"  data-toggle="tooltip" data-placement="left" class="label-default label label-danger">Inactive</a></td>
                              <?php } ?>
                              <td width="10%">
                                 <a href="<?=base_url('admin/housingterification/edit_house_tarification/'.$data->id)?>" class="label-default label label-success" data-toggle="tooltip" data-placement="left" title="Edit"><i class="fa fa-pencil" aria-hidden="true"></i></a>
                                 <a  onclick="return confirm('Sure you want to delete')" href="<?=base_url('admin/housingterification/delete/'.$data->id)?>" class="label-default label label-danger" data-toggle="tooltip" data-placement="right" title="Delete "><i class="fa fa-trash-o" aria-hidden="true"></i></a>
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
   </section>
   <!-- /.content -->
</div>