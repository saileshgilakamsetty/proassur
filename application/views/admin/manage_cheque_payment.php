<div class="content-wrapper">
   <!-- Content Header (Page header) -->
   <section class="content-header">
      <div class="header-icon">
         <i class="pe-7s-note2"></i>
      </div>
      <div class="header-title">
         <h1><?=getContentLanguageSelected('CHEQUE_PAYMENT',defaultSelectedLanguage())?></h1>
         <small><?=getContentLanguageSelected('CHEQUE',defaultSelectedLanguage())?></small>
         <ol class="breadcrumb hidden-xs">
            <li><a href="<?=base_url('admin/dashboard');?>"><i class="pe-7s-home"></i> <?=getContentLanguageSelected('HOME',defaultSelectedLanguage())?></a></li>
            <li class="active"><?=getContentLanguageSelected('CHEQUE_PAYMENT',defaultSelectedLanguage())?></li>
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
                     <a class="btn btn-primary" href="<?=base_url('admin/settings/view_policies')?>"> <i class="fa fa-list"></i> <?=getContentLanguageSelected('VIEW_POLICIES',defaultSelectedLanguage())?></a>  
                  </div>
               </div>
               <div class="panel-body">
                  <form  method="post" action = "" enctype="multipart/form-data">
                     <div class="col-md-6" >
                        <div class="form-group">
                           <label><?=getContentLanguageSelected('UPLAOD_CHEQUE',defaultSelectedLanguage())?><span class="required">*</span></label>
                           <div class="control-group">
                              <input type="file"  name="image" id="image"/>
                           </div>
                           <?= form_error('image');?>
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
