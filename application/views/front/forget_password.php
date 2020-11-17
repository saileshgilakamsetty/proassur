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
                              <input id="email" name="email" type="text" placeholder="Email" class="form-control">
                           </div>
                        </div>
                        <?=form_error('email')?>
                     </div>
                     <!-- Email input-->


                     <!-- Form actions -->
                     <div class="row form-group">
                        <div class="col-md-12 text-right">
                           <button type="submit" class="btn btn-primary btn-lg"><?= getContentLanguageSelected('SEND', defaultSelectedLanguage()) ?></button>
                        </div>
                     </div>
                     <div class="row">
                        <div class="col-md-12">
                           <p class="backHome"><a href="<?=base_url('auth/login')?>"><?= getContentLanguageSelected('BACK_TO_LOGIN', defaultSelectedLanguage()) ?></a></p>
                        </div>
                     </div>

                  </form>
               </div>
            </div>
         </div>
      </div>
   </div>