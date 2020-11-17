<div class="login-wrapper">
   <div class="container-center">
      <div class="panel panel-bd">
         <div class="panel-heading">
            <div class="view-header">
               <div class="header-icon">
                  <i class="pe-7s-unlock"></i>
               </div>
               <div class="header-title">
                  <h3>Reset Password</h3>
                  <small><strong>Please enter your new password.</strong></small>
                  <?php $error= $this->session->flashdata('error');
                     if(!empty($error)) { ?>
                  <div style="color: red"><small><strong><?=$error?></strong></small></div>
                  <?php } ?>
               </div>
            </div>
         </div>
         <div class="panel-body">
            <form  id="ForgetPasswordForm" method="post">
               <div class="form-group">
                  <label class="control-label" for="password">Password</label>
                  <input type="password" placeholder="******" title="Please enter your password" name="password" id="password" class="form-control">
                <?=form_error('password'); ?>
               </div>               
               <div class="form-group">
                  <label class="control-label" for="confirm_password">Confirm Password</label>
                  <input type="password" placeholder="******" title="Please enter your confirm password" name="confirm_password" id="confirm_password" class="form-control">
                <?=form_error('confirm_password'); ?>
               </div>
               <div>
                  <button class="btn btn-primary">Submit</button>
               </div>
            </form>
         </div>
      </div>
   </div>
</div>