<div class="content-wrapper">
<!-- Content Header (Page header) -->
<section class="content-header">
   <div class="header-icon">
      <i class="fa fa-tachometer"></i>
   </div>
   <div class="header-title">
      <h1> <?=getContentLanguageSelected('DASHBOARD',defaultSelectedLanguage())?></h1>
      <small> <?=getContentLanguageSelected('DASHBOARD_FEATURES',defaultSelectedLanguage())?></small>
      <ol class="breadcrumb hidden-xs">
         <li><a href="<?php base_url('admin/dashboard'); ?>"><i class="pe-7s-home"></i> <?=getContentLanguageSelected('HOME',defaultSelectedLanguage())?></a></li>
         <li class="active"><?=getContentLanguageSelected('DASHBOARD',defaultSelectedLanguage())?></li>
      </ol>
   </div>
</section>
<!-- Main content -->
<?php // echo "<pre>"; print_r($recentUserDataCollection); ?>
<section class="content">
   <div class="row">
      <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
         <a href="<?=base_url('admin/users/lists');?>">
            <div class="panel panel-bd cardbox">
               <div class="panel-body">
                  <div class="statistic-box">
                     <h2><span class="count-number"><?=$dataUserCollection?></span>
                     </h2>
                  </div>
                  <div class="items">
                     <h4> <i class="fa fa-user fa-1x"></i> <?=getContentLanguageSelected('USER_MANAGEMENT',defaultSelectedLanguage())?></h4>
                  </div>
               </div>
            </div>
         </a>
      </div>
      <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
         <a href="<?=base_url('admin/pages/lists');?>">
            <div class="panel panel-bd cardbox">
               <div class="panel-body">
                  <div class="statistic-box">
                     <h2><span class="count-number"><?=$dataPagesCollection?></span>
                     </h2>
                  </div>
                  <div class="items">
                     <h4><i class="fa fa-list fa-1x"></i> <?=getContentLanguageSelected('CMS_MANAGEMENT',defaultSelectedLanguage())?></h4>
                  </div>
               </div>
            </div>
         </a>
      </div>      
      <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
         <a href="<?=base_url('admin/company/lists');?>">
            <div class="panel panel-bd cardbox">
               <div class="panel-body">
                  <div class="statistic-box">
                     <h2><span class="count-number"><?=$dataCompanyCollection?></span>
                     </h2>
                  </div>
                  <div class="items">
                     <h4><i class="fa fa-building fa-1x"></i> <span><?=getContentLanguageSelected('COMPANY_MANAGEMENT',defaultSelectedLanguage())?></h4>
                  </div>
               </div>
            </div>
         </a>
      </div>      
     
     

      <div style="clear: both;"></div>
      <div class="row">
         <div class="col-xs-12 col-sm-12">
            <div class="panel panel-bd lobidrag">
               <div class="panel-heading">
                  <div class="panel-title">
                     <h4><?=getContentLanguageSelected('RECENT_USERS',defaultSelectedLanguage())?> </h4>
                  </div>
               </div>
               <div class="panel-body">
                  <div class="table-responsive">
                     <table id="dataTableExample2" class="table table-bordered table-striped table-hover">
                        <thead>
                           <tr>
                              <th><?=getContentLanguageSelected('NAME',defaultSelectedLanguage())?></th>
                              <th><?=getContentLanguageSelected('EMAIL',defaultSelectedLanguage())?></th>
                              <th><?=getContentLanguageSelected('ROLE',defaultSelectedLanguage())?></th>
                              <th><?=getContentLanguageSelected('STATUS',defaultSelectedLanguage())?></th>
                           </tr>
                        </thead>
                        <tbody>
                           <?php 
                              if (!empty($recentUserDataCollection)) {
                                  foreach ($recentUserDataCollection as $value) { ?>
                           <tr>
                              <td><?=$value->first_name?></td>
                              <td><?=$value->email?></td>
                              <td><?=getUserRoleName($value->role)?></td>
                              <?php if ($value->status =="1") {?>
                              <td><a title="" href="#" data-toggle="tooltip" data-placement="left" class="label-default label label-success" data-original-title="">active</a></td>
                              <?php } else { ?>
                              <td><a title="" href="#" data-toggle="tooltip" data-placement="left" class="label-default label label-danger" data-original-title="">Inactive</a></td>
                           </tr>
                           <?php  } }
                              }
                               ?>
                        </tbody>
                     </table>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <!-- /.row -->
</section>
<!-- /.content -->
</div> <!-- /.content-wrapper -->