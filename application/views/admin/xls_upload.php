<div class="content-wrapper">
   <!-- Content Header (Page header) -->
   <section class="content-header">
      <div class="header-icon">
         <i class="pe-7s-note2"></i>
      </div>
      <div class="header-title">
         <h1><?=getContentLanguageSelected('XLS',defaultSelectedLanguage())?></h1>
         <small><?=getContentLanguageSelected('XLS_SETTING',defaultSelectedLanguage())?></small>
         <ol class="breadcrumb hidden-xs">
            <li><a href="<?=base_url('admin/dashboard');?>"><i class="pe-7s-home"></i> <?=getContentLanguageSelected('HOME',defaultSelectedLanguage())?></a></li>
            <li class="active"><?=getContentLanguageSelected('XLS',defaultSelectedLanguage())?></li>
         </ol>
      </div>
   </section>
   <!-- Main content -->
   <section class="content">
      <div class="row">
         <!-- Form controls -->
         <div class="col-sm-12">
            <div class="panel panel-bd">
<!--                <div class="panel-heading">
                  <div class="btn-group"> 
                     <a class="btn btn-primary" href="<?=base_url('admin/users/lists')?>"> <i class="fa fa-list"></i>  Users List</a>  
                  </div>
               </div> -->
               <div class="panel-body">
                  <form  action="" method="post" enctype="multipart/form-data">
                     <div class="col-md-6">
                        <div class="control-group">
                        <input type="text" name="field_name" value="1" id="field_name">
                           <label><?=getContentLanguageSelected('SELECT_XL_FILE_TO_UPLOAD',defaultSelectedLanguage())?></label>
                           <input type="file"  name="image" id="image"/>
                        </div>
                     </div>
                     <div class="col-md-12" >
                        <div class="reset-button">
                           <button class="btn btn-success"><?=getContentLanguageSelected('SAVE',defaultSelectedLanguage())?></button>
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

<style type="text/css">
   .inlineinput div {
    display: inline;
}
</style>