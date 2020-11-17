<div class="login-wrapper">
   <div class="container-center">
      <div class="panel panel-bd">
         <div class="panel-heading">
            <div class="view-header">
               <div class="header-icon">
                  <i class="pe-7s-unlock"></i>
               </div>
               <div class="header-title">
                  <h3>Login</h3>
                  <small><strong>Please enter your credentials to login.</strong></small>
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
            <form  id="loginForm" method="post">
               <div class="form-group">
                  <label class="control-label" for="username">Email</label>
                  <input type="text" placeholder="Email" title="Please enter your Email" name="username" id="username" class="form-control">
                  <!-- <span class="help-block small">Your unique username to app</span> -->
               </div>
               <div class="form-group">
                  <label class="control-label" for="userpass">Password</label>
                  <input type="password" title="Please enter your password" placeholder="******" required=""  name="userpass" id="userpass" class="form-control">
                  <!-- <span class="help-block small">Your strong password</span> -->
               </div>
               <div>
                  <button class="btn btn-primary">Login</button>
                  <a href="admin/forget-password" id="forget_password">Forgotten Password?</a>
               </div>
            </form>
         </div>
      </div>
   </div>
</div>