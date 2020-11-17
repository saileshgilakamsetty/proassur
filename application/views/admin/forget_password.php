<div class="login-wrapper">
   <div class="container-center">
      <div class="panel panel-bd">
         <div class="panel-heading">
            <div class="view-header">
               <div class="header-icon">
                  <i class="pe-7s-unlock"></i>
               </div>
               <div class="header-title">
                  <h3>Forget Password</h3>
                  <small><strong>Please enter your valid email address.</strong></small>
                  <?php $error= $this->session->flashdata('error');
                     if(!empty($error)) { ?>
                  <div style="color: red"><small><strong><?=$error?></strong></small></div>
                  <?php } ?>                  
                  <?php $message= $this->session->flashdata('message');
                     if(!empty($message)) { ?>
                  <div style="color: green"><small><strong><?=$message?></strong></small></div>
                  <?php } ?>
               </div>
            </div>
         </div>
         <div class="panel-body">
            <form  id="ForgetPasswordForm" method="post">
               <div class="form-group">
                  <label class="control-label" for="email">Email</label>
                  <input type="text" placeholder="proassur@gmail.com" title="Please enter your Email" name="email" id="email" class="form-control">
                <?=form_error('email'); ?>

               </div>
               <div>
                  <button class="btn btn-primary">Submit</button>
               </div>
            </form>
         </div>
      </div>
   </div>
</div>