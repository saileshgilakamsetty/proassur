<div class="content-wrapper">
   <!-- Content Header (Page header) -->
   <section class="content-header">
      <div class="header-icon">
         <i class="pe-7s-note2"></i>
      </div>
      <div class="header-title">
         <h1><?=getContentLanguageSelected('INDIVIDUAL_ACCIDENT_ACTIVITY',defaultSelectedLanguage())?></h1>
         <small><?=getContentLanguageSelected('INDIVIDUAL_ACCIDENT_ACTIVITY_ADD',defaultSelectedLanguage())?></small>
         <ol class="breadcrumb hidden-xs">
            <li><a href="<?=base_url('admin/dashboard');?>"><i class="pe-7s-home"></i> <?=getContentLanguageSelected('HOME',defaultSelectedLanguage())?></a></li>
            <li class="active"><?=getContentLanguageSelected('INDIVIDUAL_ACCIDENT_ACTIVITY',defaultSelectedLanguage())?></li>
         </ol>
      </div>
   </section>
   <!-- Main content -->
   <section class="content">
      <div class="row">
         <!-- Form controls -->
         <div class="col-sm-12">
            <div class="panel panel-bd">
               <div class="panel-heading">
                  <div class="btn-group"> 
                     <a class="btn btn-primary" href="<?=base_url('admin/individual-accident/individual-accident-activity-list')?>"> <i class="fa fa-list"></i> <?=getContentLanguageSelected('ACTIVITY_LIST',defaultSelectedLanguage())?> </a>  
                  </div>
               </div>
               <div class="panel-body">
                  <form  method="post" enctype="multipart/form-data">
                     <div class="col-md-6" >
                        <div class="form-group">
                           <label><?=getContentLanguageSelected('Name',defaultSelectedLanguage())?><span class="required">*</span></label>

                        <?php $data = 'class="form-control"';
                              $activity = $dataCollection->activity_id;
                              echo form_dropdown('activity_id',getSingleOptions('tbl_activity','Select Activity',1),set_value("activity_id",$activity),$data);?>
                           <?=form_error('activity_id'); ?>
                        </div>

                       

                        <div class="form-group">
                           <label>Company<span class="required">*</span></label>
                           <?php $data = 'class="form-control multiselect"';
                              $company = explode(",",$dataCollectionForCompany);
                              echo form_multiselect('company_id[]',getMultipleOptions('tbl_company','Select Company',1),set_value("company_id[]",$company),$data);?>
                           <?=form_error('company_id[0]'); ?>
                        </div>

                        <div class="control-group">
                           <label><?=getContentLanguageSelected('STATUS',defaultSelectedLanguage())?></label><br>
                           <label class="cus_radio">
                           <input type="radio" name="status" value="1" checked="checked">Active</label>
                           <label class="cus_radio"><input type="radio" name="status" value="0" >InActive</label>
                        </div>
                     </div>

                     <div class="col-md-12" >
                        <div class="reset-button">
                           <button class="btn btn-success">Save</button>
                        </div>
                     </div>
                  </form>
               </div>
            </div>
         </div>
      </div>
   </section>
   <!-- /.content -->
</div>
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
