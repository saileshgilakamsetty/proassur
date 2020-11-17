<div class="content-wrapper">
   <!-- Content Header (Page header) -->
   <section class="content-header">
      <div class="header-icon">
         <i class="pe-7s-note2"></i>
      </div>
      <div class="header-title">
        
         <h1>Change Password </h1>
         <small>Change Password</small>
         <ol class="breadcrumb hidden-xs">
            <li><a href="<?=base_url('admin/dashboard');?>"><i class="pe-7s-home"></i> Home</a></li>
            <li class="active">Change Password</li>
         </ol>
      </div>
   </section>
   <!-- Main content -->
   <section class="content">
      <div class="row">
      
         <div class="col-sm-12">
                           <?php $success= $this->session->flashdata('message'); 
                        if(!empty($success)) { ?>
                        <div class="panel panel-success lobidrag">
                          <div class="panel-heading">
                            <?php echo $this->session->flashdata('message'); ?>
                          </div>
                        </div>
                        <?php } ?>
         <!-- Form controls -->
            <div class="panel panel-bd lobidrag">
               <div class="panel-body">
                  <form  method="post" enctype="multipart/form-data">
                     <div class="col-sm-10" >
                        <div class="form-group">
                           <label>Current Password<span class="required">*</span></label>
                           <input type="password" class="form-control" name="current_password" id="current_password" placeholder="Current Password" value="<?php echo set_value('current_password') ?>" >
                           <?=form_error('current_password'); ?>
                        </div>
                     </div>                     
                     <div class="col-sm-10" >
                        <div class="form-group">
                           <label>New Password<span class="required">*</span></label>
                           <input type="password" class="form-control" name="new_password" id="new_password" placeholder="New Password" value="<?php echo set_value('new_password') ?>" >
                           <?=form_error('new_password'); ?>
                        </div>
                     </div>                     
                     <div class="col-sm-10" >
                        <div class="form-group">
                           <label>Confirm Password<span class="required">*</span></label>
                           <input type="password" class="form-control" name="confirm_password" id="confirm_password" placeholder="Confirm Password" value="<?php echo set_value('confirm_password') ?>" >
                           <?=form_error('confirm_password'); ?>
                        </div>
                     </div>
                     <div class="col-sm-10" >
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