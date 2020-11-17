<section class="insurForm">
   <div class="container">
      <div class="row">
         <div class="col-xs-12">
            <h3 class="title"><?=getContentLanguageSelected('MOTOR_INSURANCE',defaultSelectedLanguage())?></h3>
         </div>
      </div>
   </div>
   <div class="tabMenu">
      <ul>
         <li <?php
         if ($this->uri->segment(2) == 'vehicle-detail') {?>
         class = 'active'
         <?php }?>><a href="<?=base_url('vehicle/vehicle-detail')?>"><?=getContentLanguageSelected('COMPULSORY_CIVIL_LIABILITY',defaultSelectedLanguage())?></a></li>
         <li <?php
         if ($this->uri->segment(2) == 'optional-warranties') {?>
         class = 'active'
         <?php }?>><a href="#"><?=getContentLanguageSelected('OPTIONAL_WARRANTIES',defaultSelectedLanguage())?></a></li>
         <li<?php
         if ($this->uri->segment(2) == 'transport-person-insurance') {?>
         class = 'active'
         <?php }?> ><a href="#"><?=getContentLanguageSelected('TRANSPORTED_PERSON_INSURANCE',defaultSelectedLanguage())?></a></li>
         <li<?php
         if ($this->uri->segment(2) == 'optional-deductibles') {?>
         class = 'active'
         <?php }?> ><a href="#"><?=getContentLanguageSelected('OPTIONAL_DEDUCTIBLES',defaultSelectedLanguage())?></a></li>
         <li<?php
         if ($this->uri->segment(2) == 'bonus-reductions') {?>
         class = 'active'
         <?php }?> ><a href="#"><?=getContentLanguageSelected('BONUS_&_REDUCTIONS',defaultSelectedLanguage())?></a></li>

         <li<?php
         if ($this->uri->segment(2) == 'premium-duration') {?>
         class = 'active'
         <?php }?> ><a href="#"><?=getContentLanguageSelected('PREMIUM_DURATION',defaultSelectedLanguage())?></a></li>
      </ul>
      <div class="clearfix"></div>
   </div>