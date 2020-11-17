<div class="content-wrapper">
   <!-- Content Header (Page header) -->
   <section class="content-header">
      <div class="header-icon">
         <i class="pe-7s-box1"></i>
      </div>
      <div class="header-title">
         <h1><?=getContentLanguageSelected('HOUSE_POLICIES',defaultSelectedLanguage())?></h1>
         <small><?=getContentLanguageSelected('HOUSE_POLICIES',defaultSelectedLanguage())?></small>
         <ol class="breadcrumb hidden-xs">
            <li><a href="<?=base_url('admin/dashboard');?>"><i class="pe-7s-home"></i> <?=getContentLanguageSelected('HOME',defaultSelectedLanguage())?></a></li>
            <li class="active"><?=getContentLanguageSelected('HOUSE_POLICIES',defaultSelectedLanguage())?></li>
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
               <!-- <div class="panel-heading">
                  <div class="btn-group"> 
                     <a class="btn btn-success" href="#"> <i class="fa fa-plus"></i>  <?=getContentLanguageSelected('ADD_CONDITION',defaultSelectedLanguage())?></a>  
                  </div>
               </div> -->
               <div class="panel-body">
                  <div class="table-responsive">
                     <table id="example2" class="table table-bordered table-hover">
                        <thead>
                           <tr>
                              <th><?=getContentLanguageSelected('DATE',defaultSelectedLanguage())?></th>
                              <th><?=getContentLanguageSelected('POLICY_NO',defaultSelectedLanguage())?></th>
                              <th><?=getContentLanguageSelected('NET_PREMIUM',defaultSelectedLanguage())?></th>
                              <th><?=getContentLanguageSelected('ACCESSORIES',defaultSelectedLanguage())?></th>
                              <th><?=getContentLanguageSelected('TAX',defaultSelectedLanguage())?></th>
                              <th><?=getContentLanguageSelected('TOTAL_PREMIUM',defaultSelectedLanguage())?></th>
                              <th><?=getContentLanguageSelected('ACTION',defaultSelectedLanguage())?></th>
                           </tr>
                        </thead>
                        <tbody>
                           <?php if(!empty($dataCollection)){ 
                              foreach ($dataCollection as $data) { ?>
                           <tr >
                              <td><?= $data['date'];?></td>
                              <td><?= $data['policy_number'];?></td>
                              <td><?= $data['net_premium'];?></td>
                              <td><?= $data['accessories'];?></td>
                              <td><?= $data['tax'];?></td>
                              <td><?= $data['total_premium'];?></td>
                              <td width="10%" >
                                 <a href="<?=base_url('admin/house-policy-detail/'.$data['policy_number'].'/'.$data['insured_id'])?>" class="label-default label label-success" data-toggle="tooltip" data-placement="left" title="Edit"><i class="fa fa-pencil" aria-hidden="true"></i></a>
                              </td>
                           </tr>
                           <?php }} else { ?>
                              <tr>
                                 <td></td>
                                 <td></td>
                                 <td></td>
                                 <td><?=getContentLanguageSelected('NO_RECORDS_FOUND',defaultSelectedLanguage())?></td>
                                 <td></td>
                                 <td></td>
                                 <td></td>
                              </tr>
                           <?php } ?>
                        </tbody>
                     </table>
                  </div>
                  <!-- <div class="page-nation text-right">
                     <?=$pagination?>
                  </div> -->
               </div>
            </div>
         </div>
      </div>
   </section>
   <!-- /.content -->
</div>