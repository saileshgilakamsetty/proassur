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
                     <div class="row form-group">
                        <div class="col-md-12">
                           <div class="emailicon"><span><img src="<?=base_url(); ?>/assets/front/images/key.png"></span>
                              <input id="new_password" name="new_password" type="password" placeholder="New Password" class="form-control">
                           </div>
                        </div>
                        <?=form_error('new_password')?>
                     </div>
                     <div class="row form-group">
                        <div class="col-md-12">
                           <div class="emailicon"><span><img src="<?=base_url(); ?>/assets/front/images/key.png"></span>
                              <input id="confirm_password" name="confirm_password" type="password" placeholder="Confirm Password" class="form-control">
                           </div>
                        </div>
                        <?=form_error('confirm_password')?>
                     </div>
                     <div class="row form-group">
                        <div class="col-md-12 text-right">
                           <button type="submit" class="btn btn-primary btn-lg"><?=getContentLanguageSelected('CHANGE_PASSWORD',defaultSelectedLanguage())?></button>
                        </div>
                     </div>

                  </form>
               </div>
            </div>
         </div>
      </div>
   </div>