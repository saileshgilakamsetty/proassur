<?php 
  $userID=$this->session->userdata('user_id');
  if(empty($userID)){ ?>   
  <div class="modal fade custom2" id="loginModel" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title"><?=getContentLanguageSelected('LOGIN',defaultSelectedLanguage())?> </h4>
        </div>
        <div class="modal-body">
        <div id="loginMsg"></div>
          <form class="form-horizontal" id="myLogin" action="" method="post">
          <fieldset>
           <!-- Name input-->
            <div class="form-group">
              <label class="col-md-2 control-label" for="name"><?=getContentLanguageSelected('EMAIL_ID',defaultSelectedLanguage())?></label>
              <div class="col-md-10">
                <input id="useremail" name="useremail" type="email" pattern="[A-Za-z0-9._%+-]+@[A-Za-z0-9.-]+\.[a-z]{2,4}$" title="Invalid email address" placeholder="Email" class="form-control" required>
              </div>
            </div>
    
            <!-- Email input-->
            <div class="form-group">
              <label class="col-md-2 control-label" for="email"><?=getContentLanguageSelected('PASSSWORD',defaultSelectedLanguage())?></label>
              <div class="col-md-10">
                <input id="email" name="password" type="password" placeholder="Password" class="form-control" required>
              </div>
            </div>
            <!-- Form actions -->
            <div class="form-group">
            <div class="col-md-9 text-right">
            <div class="check2">
            <a href="#" data-dismiss="modal" data-toggle="modal" data-target="#forgotModel"><i class="fa fa-user" aria-hidden="true"></i><?=getContentLanguageSelected('FORGOT_PASSWORD',defaultSelectedLanguage())?></a>
            <a href="#" data-dismiss="modal" data-toggle="modal" data-target="#registerModel"><i class="fa fa-user" aria-hidden="true"></i>I'd like to register?</a>
            </div>
            </div>
              <div class="col-md-3 text-right">
                <div class="sBtn"><button type="submit"><?=getContentLanguageSelected('LOGIN',defaultSelectedLanguage())?></button></div>
              </div>
            </div>            
          </fieldset>
          </form>
        </div>
       
     
      </div>
      
    </div>
  </div>
 <!-- Modal -->
  <div class="modal fade custom2" id="registerModel" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title"><?=getContentLanguageSelected('REGISTRATION',defaultSelectedLanguage())?></h4>
        </div>
        <div class="modal-body">
          <div id="registrationMsg"></div>
          <form class="form-horizontal" id="myRegistration" action="" method="post">
          <fieldset>
           <!-- Name input-->
             <div class="form-group">
              <label class="col-md-3 control-label" for="name"><?=getContentLanguageSelected('FIRST_NAME',defaultSelectedLanguage())?> <span class="required">*</span></label>
              <div class="col-md-9">
                <input id="fname" name="fname" type="text" placeholder="First Name" class="form-control" required >
              </div>
            </div>
            <div class="form-group">
              <label class="col-md-3 control-label" for="name"><?=getContentLanguageSelected('LAST_NAME',defaultSelectedLanguage())?> <span class="required">*</span></label>
              <div class="col-md-9">
                <input id="lname" name="lname" type="text" placeholder="Last Name" class="form-control" required >
              </div>
            </div>
            <div class="form-group">
              <label class="col-md-3 control-label" for="name"><?=getContentLanguageSelected('MOBILE',defaultSelectedLanguage())?> <span class="required">*</span></label>
              <div class="col-md-9">
                <input id="mobile" name="mobile" type="text" pattern="[0-9]{1}[0-9]{9}" title="Please enter the your 10 digit moble number" placeholder="Mobile" class="form-control" required>
              </div>
            </div>
            <div class="form-group">
              <label class="col-md-3 control-label" for="name"><?=getContentLanguageSelected('EMAIL_ID',defaultSelectedLanguage())?> <span class="required">*</span></label>
              <div class="col-md-9">
                <input id="useremail" name="useremail" type="email" pattern="[A-Za-z0-9._%+-]+@[A-Za-z0-9.-]+\.[a-z]{2,4}$" title="Invalid email address"  placeholder="Email" class="form-control" required>
              </div>
            </div>    
            <!-- Email input-->
            <div class="form-group">
              <label class="col-md-3 control-label" for="email"><?=getContentLanguageSelected('PASSSWORD',defaultSelectedLanguage())?> <span class="required">*</span></label>
              <div class="col-md-9">
                <input id="password" name="password" type="Password" placeholder="Password" class="form-control" required>
              </div>
            </div>
            <div class="form-group">
              <label class="col-md-3 control-label" for="email"><?=getContentLanguageSelected('RETYPE_PASSSWORD',defaultSelectedLanguage())?> <span class="required">*</span></label>
              <div class="col-md-9">
                <input id="confirm_password" type="Password" placeholder="Retype Password" class="form-control" required>
              </div>
            </div>
            
            <!-- Form actions -->
            <div class="form-group">
            <div class="col-md-9 text-right">
            <div class="check2">            
            <a href="#" data-dismiss="modal" data-toggle="modal" data-target="#loginModel"><i class="fa fa-user" aria-hidden="true"></i> I'm already registered?</a>
            </div>
            </div>
              <div class="col-md-3 text-right">
                <div class="sBtn"><button type="submit" id="submit" ><?=getContentLanguageSelected('SUBMIT',defaultSelectedLanguage())?></button></div>
              </div>
            </div>
            
          </fieldset>
          </form>
        </div>
       
     
      </div>
      
    </div>
  </div>

  <!-- Modal -->
  <div class="modal fade custom2" id="forgotModel" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title"><?=getContentLanguageSelected('FORGOT_PASSSWORD',defaultSelectedLanguage())?></h4>
        </div>
        <div class="modal-body">
        <div id="forgotMsg"></div>
          <form class="form-horizontal" id="myForget" action="" method="post">
          <fieldset>
           <!-- Name input-->
            <div class="form-group">
              <label class="col-md-2 control-label" for="name"><?=getContentLanguageSelected('EMAIL_ID',defaultSelectedLanguage())?></label>
              <div class="col-md-10">
                <input id="useremail" name="useremail" type="email" pattern="[A-Za-z0-9._%+-]+@[A-Za-z0-9.-]+\.[a-z]{2,4}$" title="Invalid email address" placeholder="Email" class="form-control" required >
              </div>
            </div>
    
            <!-- Email input-->
          
            <!-- Form actions -->
            <div class="form-group">
            <div class="col-md-9 text-right">
            <div class="check2">
            <a href="#" data-dismiss="modal" data-toggle="modal" data-target="#loginModel"><i class="fa fa-user" aria-hidden="true"></i> I'm already registered?</a>
            <a href="#" data-dismiss="modal" data-toggle="modal" data-target="#registerModel"><i class="fa fa-user" aria-hidden="true"></i>I'd like to register?</a>
            </div>
            </div>
              <div class="col-md-2 text-right">
                <div class="sBtn"><button type="submit"><?=getContentLanguageSelected('SUBMIT',defaultSelectedLanguage())?></button></div>
              </div>
            </div>
            
          </fieldset>
          </form>
        </div>
       
     
      </div>
      
    </div>
  </div>


  <!-- Modal -->
  <div class="modal fade custom2" id="resetModel" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title"><?=getContentLanguageSelected('RESET_PASSSWORD',defaultSelectedLanguage())?></h4>
        </div>
        <div class="modal-body">
        <div id="resetMsg"></div>
          <form class="form-horizontal" id="resetPassword" action="" method="post">
          <input type="hidden" name="resetpassword" value="<?=$this->input->get('resetpassword')?>">
          <fieldset>
           <!-- Name input-->
            <div class="form-group">
              <label class="col-md-3 control-label" for="email"><?=getContentLanguageSelected('NEW_PASSWORD',defaultSelectedLanguage())?> <span class="required">*</span></label>
              <div class="col-md-9">
                <input id="rpassword" name="password" type="Password" placeholder="Password" class="form-control" required>
              </div>
            </div>
            <div class="form-group">
              <label class="col-md-3 control-label" for="email"><?=getContentLanguageSelected('RETYPE_PASSSWORD',defaultSelectedLanguage())?> <span class="required">*</span></label>
              <div class="col-md-9">
                <input id="rconpassword" name="rconpassword" type="Password" placeholder="Retype Password" class="form-control" required>
              </div>
            </div>
    
            <!-- Email input-->
          
            <!-- Form actions -->
            <div class="form-group">
            <div class="col-md-9 text-right">
            <div class="check2">
            <a href="#" data-dismiss="modal" data-toggle="modal" data-target="#loginModel"><i class="fa fa-user" aria-hidden="true"></i> I'm already registered?</a>
            <a href="#" data-dismiss="modal" data-toggle="modal" data-target="#registerModel"><i class="fa fa-user" aria-hidden="true"></i>I'd like to register?</a>
            </div>
            </div>
              <div class="col-md-2 text-right">
                <div class="sBtn"><button type="submit"><?=getContentLanguageSelected('SUBMIT',defaultSelectedLanguage())?></button></div>
              </div>
            </div>
            
          </fieldset>
          </form>
        </div>
       
     
      </div>
      
    </div>
  </div>

  <div class="modal fade custom2" id="accountModel" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title"><?=getContentLanguageSelected('ACCOUNT_VERIFICATION',defaultSelectedLanguage())?></h4>
        </div>
        <div class="modal-body">
        <div id="forgotMsg"></div>
          <form class="form-horizontal" id="myForget" action="" method="post">
          <fieldset>
           <!-- Name input-->
            <div class="form-group">
              <div class="col-md-12 text-center" >
              <?=getProfileActiveMessage()?>
              </div>
            </div>
    
            <!-- Email input-->
          
            <!-- Form actions -->
            <div class="form-group">
            <div class="col-md-9 text-right">
            
            </div>
              
            </div>
            
          </fieldset>
          </form>
        </div>
       
     
      </div>
      
    </div>
  </div>
  <?php } else { ?>
  

  <div class="modal fade custom2 popUp" id="popUpWishlist" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title"><?=getStaticContent('ADD_TO_WISHLIST')?></h4>
        </div>
      <div class="checkout_responce text-center">
      <div id="checkout_responce" class="text-center"></div>
      <a class="btn btn-info" href="<?=base_url('my-favorite-site')?>"><?=getStaticContent('GO_TO_WISHLIST')?></a> 
      <a class="btn btn-info close" data-dismiss="modal" href="#"><?=getStaticContent('CONTINUE')?></a> 
     
      </div>
    </div>
  </div>
</div>

<div class="modal fade custom2 popUp" id="popUpVote" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title"><?=getStaticContent('VOTE_POPUP_TITLE')?></h4>
        </div>
      <div class="checkout_responce text-center">
      <div id="vote_responce" class="text-center"></div>
      <div style="height: 10px;"></div>
      <a class="btn btn-info close" data-dismiss="modal" href="#"><?=getStaticContent('CONTINUE_VOTE')?></a>
     
      </div>
    </div>
  </div>
</div>



  <?php } ?>

