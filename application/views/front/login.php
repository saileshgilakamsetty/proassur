<body class="loginBg">
   <div class="login">
      <div class="container">
         <div class="row">
            <div class="col-md-12">
               <div class="loginForm">
                  <figure><a href="<?=base_url()?>"><img src="<?=base_url(); ?>/assets/front/images/logo.png"></a></figure>
                  
                  <?php $error= $this->session->flashdata('error');
                     if(!empty($error)) { ?>
                  <div style="color: red"><small><strong><?=$error?></strong></small></div>
                  <?php } ?>                  
                  <?php $message= $this->session->flashdata('message');
                     if(!empty($message)) { ?>
                  <div style="color: green"><small><strong><?=$message?></strong></small></div>
                  <?php } ?>


                  <form class="form-horizontal" action="" method="post">
                     <!-- Name input-->
                     <div class="row form-group">
                        <div class="col-md-12">
                           <div class="emailicon"><span><img src="<?=base_url(); ?>/assets/front/images/email.png"></span>
                              <input id="email" name="email" type="text" value="<?= set_value('email');?>" placeholder="Email" class="form-control">
                           </div>
                        </div>
                        <?=form_error('email')?>
                     </div>
                     <!-- Email input-->
                     <div class="row form-group">
                        <div class="col-md-12 emailicon">
                           <div class="emailicon"><span><img src="<?=base_url(); ?>/assets/front/images/key.png"></span>
                              <input id="password" name="password" type="password" value="<?= set_value('password');?>" placeholder="Password" class="form-control">
                           </div>
                        </div>
                        <?=form_error('password')?>
                     </div>
                     <div class="row form-group">
                        <div class="col-md-12 forgot">
                           <a href="<?=base_url('forget-password')?>">Forgot Password?</a>
                        </div>
                     </div>
                     <!-- Form actions -->
                     <div class="row form-group">
                        <div class="col-md-12 text-right">
                           <button type="submit" class="btn btn-primary btn-lg">Login</button>
                        </div>
                     </div>
                     <div class="row form-group">
                        <div class="col-md-12 text-center signUp">
                           <p>Don’t have an account?</p>
                           <a href="<?=base_url()?>signup">Sign Up</a>
                        </div>
                     </div>
                     <div class="row">
                        <div class="col-md-12">
                           <p class="backHome"><a href="<?=base_url()?>">Back to Home</a></p>
                        </div>
                     </div>
                  </form>
               </div>
            </div>
         </div>
      </div>
   </div>