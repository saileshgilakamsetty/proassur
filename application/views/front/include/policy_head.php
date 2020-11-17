<div class="mainTitle2">
   <div class="row">
      <?php
         if($this->uri->segment(1) == 'dashboard' || $this->uri->segment(2) == 'policies-management') {
         ?>
      <div class="col-xs-12 col-sm-6 col-md-7">
         <h1><?=getContentLanguageSelected('POLICY_MANAGEMENT',defaultSelectedLanguage())?></h1>
         <p><?=getContentLanguageSelected('POLICY_MANAGEMENT_SIGNATURE',defaultSelectedLanguage())?></p>
      </div>
      <?php
         } else if($this->uri->segment(1) == 'user' || $this->uri->segment(2) == 'manage_transaction') { ?>
            <div class="col-xs-12 col-sm-6 col-md-7">
               <h1><?=getContentLanguageSelected('TRANSACTION_MANAGEMENT',defaultSelectedLanguage())?></h1>
               <p><?=getContentLanguageSelected('POLICY_MANAGEMENT_SIGNATURE',defaultSelectedLanguage())?></p>
            </div>
         <?php } else if( $this->uri->segment(2) == 'profile' ) { ?>
      <div class="col-xs-12 col-sm-6 col-md-7">
         <h1><?=getContentLanguageSelected('PROFILE',defaultSelectedLanguage())?></h1>
         <p><?=getContentLanguageSelected('PROFILE_MANAGEMENT_SIGNATURE',defaultSelectedLanguage())?></p>
      </div>
      <?php
         }
             ?>
      <div class="col-xs-12 col-sm-6 col-md-5">
         <div class="topNtfction">
            <!-- <a class="nftBell" href="#"><i class="fas fa-bell"></i></a> -->
            <div class="dropdown topPofil">
               <a data-toggle="dropdown"><?=getUserImage($this->session->userdata('user_id'))?></a>
               <ul class="dropdown-menu">
                  <?php
                     if($this->uri->segment(2) =='profile') {
                     ?>
                  <li><a href="<?=base_url()?>dashboard"><?=getContentLanguageSelected('DASHBOARD',defaultSelectedLanguage())?></a></li>
                  <?php
                     }
                     else if($this->uri->segment(1) =='dashboard') {
                     ?>
                  <li><a href="<?=base_url()?>user/profile"><?=getContentLanguageSelected('EDIT_PROFILE',defaultSelectedLanguage())?></a></li>
                  <?php
                     }
                     ?>
                  <li><a href="<?=base_url('auth/logout')?>"><?=getContentLanguageSelected('LOGOUT',defaultSelectedLanguage())?></a></li>
               </ul>
            </div>
         </div>
      </div>
   </div>
</div>
<?php
   if($this->uri->segment(1) == 'dashboard') {
   ?>
      <div id="parentHorizontalTab" class="paymenTab">
         <ul class="resp-tabs-list hor_1">
            <?php 
               if($user_role == 4) { // Insurance Company(Company) ?>
                  <li><?=getContentLanguageSelected('HOME',defaultSelectedLanguage())?></li>
                  <li><?=getContentLanguageSelected('INSURANCE_POLICIES',defaultSelectedLanguage())?></li>
                  <!-- <li><?=getContentLanguageSelected('INSURANCE_CLAIMS',defaultSelectedLanguage())?></li>
                  <li><?=getContentLanguageSelected('POLICY_APPROVALS',defaultSelectedLanguage())?></li> -->
                  <li><?=getContentLanguageSelected('SLIPS',defaultSelectedLanguage())?></li>
                  <!--<li><?=getContentLanguageSelected('QUESTIONNARIES',defaultSelectedLanguage())?></li>--> <?php 
               } else if($user_role == 2) { //Customer ?>
                  <li><?=getContentLanguageSelected('ALL_POLICIES',defaultSelectedLanguage())?></li>
                  <li><?=getContentLanguageSelected('ACTIVE_POLICIES',defaultSelectedLanguage())?></li>
                  <li><?=getContentLanguageSelected('EXPIRED_POLICIES',defaultSelectedLanguage())?></li>
                  <!-- <li><?=getContentLanguageSelected('PAID_POLICIES',defaultSelectedLanguage())?></li>
                  <li><?=getContentLanguageSelected('UNPAID_POLICIES',defaultSelectedLanguage())?></li>  --><?php 
               } 
            ?>
         </ul>
      <?php
   }
?>

<?php 
   if($user_role == 3) { // Partner ?>
      <div id="parentHorizontalTab" class="paymenTab">
      <ul class="resp-tabs-list hor_1">
         <li><?=getContentLanguageSelected('ALL_POLICIES',defaultSelectedLanguage())?></li>
         <li><?=getContentLanguageSelected('ACTIVE_POLICIES',defaultSelectedLanguage())?></li>
         <li><?=getContentLanguageSelected('EXPIRED_POLICIES',defaultSelectedLanguage())?></li>
         <!-- <li><?=getContentLanguageSelected('PAID_POLICIES',defaultSelectedLanguage())?></li>
         <li><?=getContentLanguageSelected('UNPAID_POLICIES',defaultSelectedLanguage())?></li> -->
         <li><?=getContentLanguageSelected('SLIPS',defaultSelectedLanguage())?></li>
         
      </ul>
   <?php }
?>
