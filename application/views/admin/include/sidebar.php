<?php  
$segment=$this->uri->segment(2); 
$segment2=$this->uri->segment(3);
?>
<aside class="main-sidebar">
   <!-- sidebar -->
   <div class="sidebar">
      <!-- Sidebar user panel -->
     
      <!-- sidebar menu -->
      <ul class="sidebar-menu">
         <li class="<?php if($segment=='dashboard') { echo 'active'; } ?>">
            <a href="<?=base_url('admin/dashboard')?>"><i class="fa fa-tachometer"></i><span><?=getContentLanguageSelected('DASHBOARD',defaultSelectedLanguage())?></span>
            </a>
         </li>

         <li class="<?php if($segment=='approve') { echo 'active'; } ?>">
            <a href="<?=base_url('admin/approve/bonus')?>"><i class="fa fa-tachometer"></i><span><?=getContentLanguageSelected('APPROVE_BONUS',defaultSelectedLanguage())?></span>
            </a>
         </li>
<?php /*
         <li class="treeview <?php if($segment=='adminUsers') { echo 'active'; } ?>">
            <a href="#">
            <i class="fa fa-list"></i><span><?=getContentLanguageSelected('ADMIN_USERS_MANAGEMENT',defaultSelectedLanguage())?></span>
            <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
            </span>
            </a>
            <ul class="treeview-menu">
               <li class="<?php if($segment2=='add') { echo 'active'; } ?>"><a href="<?=base_url('admin/adminUsers/add')?>"><?=getContentLanguageSelected('ADD_ADMIN_USER',defaultSelectedLanguage())?></a></li>
                <li class="<?php if($segment2=='lists') { echo 'active'; } ?>"><a href="<?=base_url('admin/adminUsers/lists')?>"><?=getContentLanguageSelected('ADMIN_USERS',defaultSelectedLanguage())?></a></li>
            </ul>
         </li>    
*/ ?>
         <li class="treeview <?php if($segment=='pages' || $segment=='slidder' || $segment=='slider') { echo 'active'; } ?>">
            <a href="#">
            <i class="fa fa-list"></i><span><?=getContentLanguageSelected('CMS_MANAGEMENT',defaultSelectedLanguage())?></span>
            <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
            </span>
            </a>
            <ul class="treeview-menu">
               <li class="<?php if($segment2=='lists') { echo 'active'; } ?>"><a href="<?=base_url('admin/pages/lists')?>"><?=getContentLanguageSelected('PAGES',defaultSelectedLanguage())?></a></li>
                <li class="<?php if($segment2=='slidder-lists') { echo 'active'; } ?>"><a href="<?=base_url('admin/slidder/slidder-lists')?>"><?=getContentLanguageSelected('SLIDER',defaultSelectedLanguage())?></a></li>
                <li class="<?php if($segment2=='testimonial-lists') { echo 'active'; } ?>"><a href="<?=base_url('admin/testimonial/lists')?>"><?=getContentLanguageSelected('TESTIMONIAL',defaultSelectedLanguage())?></a></li>
            </ul>
         </li>  

         <li class="treeview <?php if($segment=='quittance') { echo 'active'; } ?>">
            <a href="#">
            <i class="fa fa-asterisk"></i><span><?=getContentLanguageSelected('QUITTANCE_MANAGEMENT',defaultSelectedLanguage())?></span>
            <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
            </span>
            </a>
            <ul class="treeview-menu">
               <li class="<?php if($segment2=='add' || $segment2 == 'lists') { echo 'active'; } ?>"><a href="<?=base_url('admin/quittance/lists')?>"><?=getContentLanguageSelected('QUITTANCE_LIST',defaultSelectedLanguage())?></a></li>
            </ul>
            <ul class="treeview-menu">
               <li class="<?php if($segment2=='slips') { echo 'active'; } ?>"><a href="<?=base_url('admin/quittance/slips')?>"><?=getContentLanguageSelected('SLIPS',defaultSelectedLanguage())?></a></li>
            </ul>
         </li> 

         <li class="treeview <?php if($segment=='settings') { echo 'active'; } ?>">
            <a href="#">
            <i class="fa fa-asterisk"></i><span><?=getContentLanguageSelected('PAYMENT_MANAGEMENT',defaultSelectedLanguage())?></span>
            <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
            </span>
            </a>
            <ul class="treeview-menu">
               <li class="<?php if($segment2=='view_policies') { echo 'active'; } ?>"><a href="<?=base_url('admin/settings/view_policies')?>"><?=getContentLanguageSelected('VIEW_POLICIES',defaultSelectedLanguage())?></a></li>
            </ul>
         </li>   

         <li class="treeview <?php if($segment=='vehicle' || $segment2 == 'settings' || $segment2 == 'company-quote' ) { echo 'active'; } ?>">
            <a href="#">
            <i class="fa fa-asterisk"></i><span><?=getContentLanguageSelected('CAR_INSURANCE_MANAGEMENT',defaultSelectedLanguage())?></span>
            <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
            </span>
            </a>
            <ul class="treeview-menu">
               <li class="treeview <?php if($segment2 == 'vehicle-company-quote'||$segment2 == 'vehicle-type'|| $segment2 == 'add-type' || $segment2 == 'edit-type' || $segment2 == 'vehicle-make'|| $segment2 == 'add-make'|| $segment2 == 'edit-make'|| $segment2 == 'vehicle-model'|| $segment2 == 'add-model'|| $segment2 == 'edit-model'|| $segment2 == 'vehicle-permit'|| $segment2 == 'add-permit'|| $segment2 == 'edit-permit'|| $segment2 == 'vehicle-warranty'|| $segment2 == 'add-warranty'|| $segment2 == 'edit-warranty'|| $segment2 == 'bodywork'|| $segment2 == 'bodywork-add'|| $segment2 == 'bodywork-edit'|| $segment2 == 'designation'|| $segment2 == 'designation-add'|| $segment2 == 'designation-edit'|| $segment2 == 'category'|| $segment2 == 'category-add'|| $segment2 == 'category-edit'|| $segment2 == 'usage'|| $segment2 == 'usage-add'|| $segment2 == 'usage-edit'|| $segment2 == 'usage-area'|| $segment2 == 'usage-area-add'|| $segment2 == 'usage-area-edit'|| $segment2 == 'optional-franchise-edit'|| $segment2 == 'optional-franchise-add'|| $segment2 == 'optional-franchise'|| $segment2 == 'transported-person'|| $segment2 == 'transported-person-add'|| $segment2 == 'transported-person-edit'|| $segment2 == 'fuel-type'|| $segment2 == 'fuel-type-add'|| $segment2 == 'fuel-type-edit') { echo 'active'; } ?>">
                  <a href="#">
                  <i class="fa fa-car"></i><span><?=getContentLanguageSelected('VEHICLE_MANAGEMENT',defaultSelectedLanguage())?></span>
                  <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                  </span>
                  </a>
                  <ul class="treeview-menu">
                     <li class="<?php if($segment2 == 'vehicle-type'||$segment2 == 'add-type' || $segment2 == 'edit-type') { echo 'active'; } ?>"><a href="<?=base_url('admin/vehicle/vehicle-type')?>"><?=getContentLanguageSelected('TYPE_OF_VEHICLE',defaultSelectedLanguage())?></a></li>

                     <li class="<?php if($segment2 == 'vehicle-company-quote') { echo 'active'; } ?>"><a href="<?=base_url('admin/vehicle/vehicle-company-quote')?>"><?=getContentLanguageSelected('GET_VEHICLE_COMPANY_QUOTE',defaultSelectedLanguage())?></a></li> 

                     <li class="<?php if($segment2 == 'vehicle-make' || $segment2 == 'add-make' || $segment2 == 'edit-make') { echo 'active'; } ?>"><a href="<?=base_url('admin/vehicle/vehicle-make')?>"><?=getContentLanguageSelected('VEHICLE_MAKE',defaultSelectedLanguage())?></a></li> 

                     <li class="<?php if($segment2 == 'vehicle-model'|| $segment2 == 'add-model'|| $segment2 == 'edit-model') { echo 'active'; } ?>"><a href="<?=base_url('admin/vehicle/vehicle-model')?>"><?=getContentLanguageSelected('VEHICLE_MODEL',defaultSelectedLanguage())?></a></li>

                     <li class="<?php if($segment2 == 'designation'|| $segment2 == 'designation-add'|| $segment2 == 'designation-edit') { echo 'active'; } ?>"><a href="<?=base_url('admin/vehicle/designation')?>"><?=getContentLanguageSelected('VEHICLE_COMMERCIAL_DESIGNATION',defaultSelectedLanguage())?></a></li>

                     <li class="<?php if($segment2 == 'vehicle-permit' || $segment2 == 'add-permit' || $segment2 == 'edit-permit') { echo 'active'; } ?>"><a href="<?=base_url('admin/vehicle/vehicle-permit')?>"><?=getContentLanguageSelected('VEHICLE_PERMIT',defaultSelectedLanguage())?></a></li>

                    <!--  <li class="<?php if($segment2 == 'vehicle-warranty'|| $segment2 == 'add-warranty'|| $segment2 == 'edit-warranty') { echo 'active'; } ?>"><a href="<?=base_url('admin/vehicle/vehicle-warranty')?>"><?=getContentLanguageSelected('VEHICLE_WARRANTY',defaultSelectedLanguage())?></a></li> -->

                     <li class="<?php if($segment2 == 'bodywork'|| $segment2 == 'bodywork-add'|| $segment2 == 'bodywork-edit') { echo 'active'; } ?>"><a href="<?=base_url('admin/vehicle/bodywork')?>"><?=getContentLanguageSelected('VEHICLE_BODYWORK',defaultSelectedLanguage())?></a></li>

                     

                     <!--                <li class="<?php if($segment2 == 'category'|| $segment2 == 'category-add'|| $segment2 == 'category-edit') { echo 'active'; } ?>"><a href="<?=base_url('admin/vehicle/category')?>"><?=getContentLanguageSelected('VEHICLE_CATEGORY',defaultSelectedLanguage())?></a></li> -->

                     <!-- <li class="<?php if($segment2 == 'usage'|| $segment2 == 'usage-add'|| $segment2 == 'usage-edit') { echo 'active'; } ?>"><a href="<?=base_url('admin/vehicle/usage')?>"><?=getContentLanguageSelected('VEHICLE_USAGE',defaultSelectedLanguage())?></a></li> -->

                     <!-- <li class="<?php if($segment2 == 'usage-area'|| $segment2 == 'usage-area-add'|| $segment2 == 'usage-area-edit') { echo 'active'; } ?>"><a href="<?=base_url('admin/vehicle/usage-area')?>"><?=getContentLanguageSelected('VEHICLE_USAGE_AREA',defaultSelectedLanguage())?></a></li> -->

                     <li class="<?php if($segment2 == 'transported-person'|| $segment2 == 'transported-person-add'|| $segment2 == 'transported-person-edit') { echo 'active'; } ?>"><a href="<?=base_url('admin/vehicle/transported-person')?>"><?=getContentLanguageSelected('TRANSPORTED_PERSON_INSURANCE',defaultSelectedLanguage())?></a></li>

                     <!-- <li class="<?php if($segment2 == 'optional-franchise'|| $segment2 == 'optional-franchise-add'|| $segment2 == 'optional-franchise-edit') { echo 'active'; } ?>"><a href="<?=base_url('admin/vehicle/optional-franchise')?>"><?=getContentLanguageSelected('VEHICLE_OPTIONAL_FRANCHISE',defaultSelectedLanguage())?></a></li> -->

                     <li class="<?php if($segment2 == 'fuel-type'|| $segment2 == 'fuel-type-add'|| $segment2 == 'fuel-type-edit') { echo 'active'; } ?>"><a href="<?=base_url('admin/vehicle/fuel-type')?>"><?=getContentLanguageSelected('FUEL_TYPE',defaultSelectedLanguage())?></a></li>
                     <li class="<?php if($segment2 == 'vehicle-policies' || $segment2 == 'vehicle-policies-edit') { echo 'active'; } ?>"><a href="<?=base_url('admin/vehicle/vehicle-policies')?>"><?=getContentLanguageSelected('VEHICLE_INSURANCE_POLICIES',defaultSelectedLanguage())?></a></li>
                  </ul>
               </li>
            </ul>
            <ul class="treeview-menu">
               <li class="<?php if($segment2=='company-quote'||$segment2=='company-quote-edit'||$segment2=='company-quote-add') { echo 'active'; } ?>"><a href="<?=base_url('admin/company/company-quote')?>"><?=getContentLanguageSelected('COMPANY_VEHICLE_QUOTE',defaultSelectedLanguage())?></a></li>
            </ul>
         </li> 

         <!-- Travel Management added by Shiv -->
         <li class="treeview <?php if($segment=='travel-conditions' || $segment=='travel-condition' || $segment=='travel-quote' 
         || $segment == 'travel-getquote') { echo 'active'; } ?>">
            <a href="#">
            <i class="fa fa-building"></i><span><?=getContentLanguageSelected('TRAVEL_MANAGEMENT',defaultSelectedLanguage())?></span>
            <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
            </span>
            </a>
            <ul class="treeview-menu">
               <li class="<?php if($segment=='travel-conditions') { echo 'active'; } ?>"><a href="<?=base_url('admin/travel-conditions/lists')?>"><?=getContentLanguageSelected('ADD_TRAVEL_EXAMINATION',defaultSelectedLanguage())?></a></li>
            </ul>

            <ul class="treeview-menu">
               <li class="<?php if($segment=='travel-quote') { echo 'active'; } ?>"><a href="<?=base_url('admin/travel-quote/lists')?>"><?=getContentLanguageSelected('ADD_TRAVEL_AMOUNT_QUOTE',defaultSelectedLanguage())?></a></li>
            </ul>

            <ul class="treeview-menu">
               <li class="<?php if($segment=='travel-getquote') { echo 'active'; } ?>"><a href="<?=base_url('admin/travel-getquote')?>"><?=getContentLanguageSelected('GET_TRAVEL_QUOTE',defaultSelectedLanguage())?></a></li>
            </ul>

            <ul class="treeview-menu">
               <li class="<?php if($segment=='travel-policies') { echo 'active'; } ?>"><a href="<?=base_url('admin/travel-policies')?>"><?=getContentLanguageSelected('TRAVEL_INSURANCE_POLICIES',defaultSelectedLanguage())?></a></li>
            </ul>
         </li> 

         <!-- Housing Management -->
         <li class="treeview <?php if($segment=='house-type' || $segment == 'house-category' || $segment=='house-insurer-quality' || $segment == 'add-house-insurer-quality' || $segment == 'add-house-type' || $segment == 'add-house-category' || $segment == 'house-month' || $segment == 'add-house-month'|| $segment == 'housingterification' || $segment == 'house-multi-risk-quote' || $segment == 'house-policies' || $segment == 'house-policies-edit') { echo 'active'; } ?>">

            <a href="#">
            <i class="fa fa-question-circle"></i><span> <?=getContentLanguageSelected('HOUSING_MANAGEMENT',defaultSelectedLanguage())?> </span>
            <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
            </span>
            </a>
            <ul class="treeview-menu">
               <li class="<?php if($segment=='house-type') { echo 'active'; } ?>"><a href="<?=base_url('admin/house-type')?>"><?=getContentLanguageSelected('HOUSE_TYPE',defaultSelectedLanguage())?></a></li>
            </ul>

            <ul class="treeview-menu">
               <li class="<?php if($segment2=='housingterification') { echo 'active'; } ?>"><a href="<?=base_url('admin/housingterification/list_house_tarification')?>"><?=getContentLanguageSelected('HOUSING_TARIFICATION',defaultSelectedLanguage())?></a></li>
            </ul>

            <ul class="treeview-menu">
               <li class="<?php if($segment=='house-category') { echo 'active'; } ?>"><a href="<?=base_url('admin/house-category')?>"><?=getContentLanguageSelected('HOUSING_CATEGORIES',defaultSelectedLanguage())?></a></li>
            </ul>

            <ul class="treeview-menu">
               <li class="<?php if($segment=='house-insurer-quality') { echo 'active'; } ?>"><a href="<?=base_url('admin/house-insurer-quality')?>"><?=getContentLanguageSelected('INSURER_QUALITY',defaultSelectedLanguage())?></a></li>
            </ul>

            <ul class="treeview-menu">
               <li class="<?php if($segment=='house-month') { echo 'active'; } ?>"><a href="<?=base_url('admin/house-month')?>"><?=getContentLanguageSelected('HOUSING_MONTH',defaultSelectedLanguage())?></a></li>
            </ul>
            <ul class="treeview-menu">
               <li class="<?php if($segment=='house-multi-risk-quote') { echo 'active'; } ?>"><a href="<?=base_url('admin/house-multi-risk-quote')?>"><?=getContentLanguageSelected('HOUSING_MULTI_RISK_QUOTE',defaultSelectedLanguage())?></a></li>
            </ul>
            <ul class="treeview-menu">
               <li class="<?php if($segment=='house-policies' || $segment == 'house-policies-edit') { echo 'active'; } ?>"><a href="<?=base_url('admin/house-policies')?>"><?=getContentLanguageSelected('HOUSING_POLICIES',defaultSelectedLanguage())?></a></li>
            </ul>
         </li> 


         <!-- Professional Mulrirsik Insurance Management -->
         <li class="treeview <?php if($segment == 'proffesional-multi-risk-quote' || $segment == 'proffesional-multirisk-quote-activity' || $segment == 'proffesional-multirisk-quote-company' || $segment == 'proffesionalmultirisk' || $segment == 'proffesional-multi-risk-policies' || $segment == 'activity') { echo 'active'; } ?>">
            <a href="#">
               <i class="fa fa-question-circle"></i><span> <?=getContentLanguageSelected('PROFESSIONAL_MULTI_RISK_INSURANCE_MANAGEMENT',defaultSelectedLanguage())?> </span>
               <span class="pull-right-container">
               <i class="fa fa-angle-left pull-right"></i>
               </span>
            </a>
            <ul class="treeview-menu">
               <li class="<?php if($segment=='proffesional-multi-risk-quote' || $segment == 'proffesional-multirisk-quote-activity' || $segment == 'proffesional-multirisk-quote-company' || $segment == 'proffesionalmultirisk') { echo 'active'; } ?>"><a href="<?=base_url('admin/proffesional-multi-risk-quote')?>"><?=getContentLanguageSelected('PROFESSIONAL_MULTI_RISK_QUOTE',defaultSelectedLanguage())?></a></li>
            </ul>
            <ul class="treeview-menu">
               <li class="<?php if($segment == 'proffesional-multi-risk-policies') { echo 'active'; } ?>"><a href="<?=base_url('admin/proffesional-multi-risk-policies')?>"><?=getContentLanguageSelected('PROFESSIONAL_MULTI_RISK_INSURANCE_POLICIES',defaultSelectedLanguage())?></a></li>
            </ul>

            <ul class="treeview-menu">
              <!-- Activity Management -->
               <li class="treeview <?php if($segment=='activity') { echo 'active'; } ?>">
                  <a href="#">
                  <i class="fa fa-asterisk"></i><span><?=getContentLanguageSelected('ACTIVITY_MANAGEMENT',defaultSelectedLanguage())?></span>
                  <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                  </span>
                  </a>
                  <ul class="treeview-menu">
                     <li class="<?php if($segment2=='add') { echo 'active'; } ?>"><a href="<?=base_url('admin/activity/add')?>"><?=getContentLanguageSelected('ADD_ACTIVITY',defaultSelectedLanguage())?></a></li>
                     <li class="<?php if($segment2=='lists') { echo 'active'; } ?>"><a href="<?=base_url('admin/activity/lists')?>"><?=getContentLanguageSelected('ACTIVITY',defaultSelectedLanguage())?></a></li>
                  </ul>
               </li>
            </ul>

         </li> 


         <!-- Individual Accident Management -->
         <li class="treeview <?php if($segment == 'individual-accident' ) { echo 'active'; } ?>">

            <a href="#">
            <i class="fa fa-question-circle"></i><span> <?=getContentLanguageSelected('INDIVIDUAL_ACCIDENT_MANAGEMENT',defaultSelectedLanguage())?> </span>
            <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
            </span>
            </a>
            <ul class="treeview-menu">
               <li class="<?php if($segment2 == 'accident-insurance-options'|| $segment2 == 'accident-insurance-options-add'|| $segment2 == 'accident-insurance-options-edit') { echo 'active'; } ?>"><a href="<?=base_url('admin/individual-accident/accident-insurance-options')?>"><?=getContentLanguageSelected('ACCIDENT_INSURANCE_OPTIONS',defaultSelectedLanguage())?></a></li>
            </ul>

            <ul class="treeview-menu">
               <li class="<?php if($segment2 == 'individual-accident-activity-list'|| $segment2 == 'individual-accident-activity-add'|| $segment2 == 'individual-accident-activity-edit') { echo 'active'; } ?>"><a href="<?=base_url('admin/individual-accident/individual-accident-activity-list')?>"><?=getContentLanguageSelected('ACTIVITY_MANAGEMENT',defaultSelectedLanguage())?></a></li>
            </ul>

            <ul class="treeview-menu">
               <li class="<?php if($segment2 == 'individual-accident-getquote') { echo 'active'; } ?>"><a href="<?=base_url('admin/individual-accident/individual-accident-getquote')?>"><?=getContentLanguageSelected('GET_INDIVIDUAL_ACCIDENT_QUOTE',defaultSelectedLanguage())?></a></li>
            </ul>

            <ul class="treeview-menu">
               <li class="<?php if($segment2 == 'individual-accident-getquote') { echo 'active'; } ?>"><a href="<?=base_url('admin/individual-accident/individual-accident-policies')?>"><?=getContentLanguageSelected('INDIVIDUAL_ACCIDENT_INSURANCE_POLICIES',defaultSelectedLanguage())?></a></li>
            </ul>
         </li>


         <li class="treeview <?php if($segment=='healthcareprovider-name' || $segment=='health-insurance-conditions' || $segment=='health-insurance-condition' || $segment=='health-insurance-quote' || $segment == 'health-insurance-getquote' || $segment == 'health-insurance-policies' || $segment == 'policycoverage-area' || $segment == 'claim-reimbursement-rate' || $segment == 'hospitalization' || $segment == 'health-insurance-conditions' || $segment == 'health-insurance-quote' || $segment == 'health-insurance-getquote' || $segment == 'health-insurance-policies') { echo 'active'; } ?>">
            <a href="#">
               <i class="fa fa-question-circle"></i><span> <?=getContentLanguageSelected('HEALTH_INSURANCE',defaultSelectedLanguage())?> </span>
               <span class="pull-right-container">
               <i class="fa fa-angle-left pull-right"></i>
               </span>
            </a>

            <ul class="treeview-menu">

               <!-- Healthcare Provider Management added by Shiv -->
               <li class="treeview <?php if($segment=='healthcareprovider-name') { echo 'active'; } ?>">
                  <a href="#">
                  <i class="fa fa-question-circle"></i><span> <?=getContentLanguageSelected('HEALTHCARE_PROVIDER_NAME_MANAGEMENT',defaultSelectedLanguage())?> </span>
                  <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                  </span>
                  </a>
                  <ul class="treeview-menu">
                     <li class="<?php if($segment2=='add') { echo 'active'; } ?>"><a href="<?=base_url('admin/healthcareprovider-name/add')?>"><?=getContentLanguageSelected('ADD_NAME',defaultSelectedLanguage())?></a></li>
                     <li class="<?php if($segment2=='lists') { echo 'active'; } ?>"><a href="<?=base_url('admin/healthcareprovider-name/lists')?>"><?=getContentLanguageSelected('LISTS',defaultSelectedLanguage())?></a></li>
                  </ul>
               </li>
            </ul>


            <!-- Policy Coverage Area added by Shiv -->
            <ul class="treeview-menu">
               <li class="treeview <?php if($segment=='policycoverage-area') { echo 'active'; } ?>">
                  <a href="#">
                  <i class="fa fa-question-circle"></i><span> <?=getContentLanguageSelected('POLICY_COVERAGE_AREA',defaultSelectedLanguage())?> </span>
                  <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                  </span>
                  </a>
                  <ul class="treeview-menu">
                     <li class="<?php if($segment2=='add') { echo 'active'; } ?>"><a href="<?=base_url('admin/policycoverage-area/add')?>"><?=getContentLanguageSelected('ADD_NAME',defaultSelectedLanguage())?></a></li>
                     <li class="<?php if($segment2=='lists') { echo 'active'; } ?>"><a href="<?=base_url('admin/policycoverage-area/lists')?>"><?=getContentLanguageSelected('LISTS',defaultSelectedLanguage())?></a></li>
                  </ul>
               </li>
            </ul>
            <!-- Claim Reimbursement Rate added by Shiv -->
            <ul class="treeview-menu">
               <li class="treeview <?php if($segment=='claim-reimbursement-rate') { echo 'active'; } ?>">
                  <a href="#">
                  <i class="fa fa-question-circle"></i><span> <?=getContentLanguageSelected('CLAIM_REIMBURSEMENT_RATE',defaultSelectedLanguage())?> </span>
                  <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                  </span>
                  </a>
                  <ul class="treeview-menu">
                     <li class="<?php if($segment2=='add') { echo 'active'; } ?>"><a href="<?=base_url('admin/claim-reimbursement-rate/add')?>"><?=getContentLanguageSelected('ADD_NAME',defaultSelectedLanguage())?></a></li>
                     <li class="<?php if($segment2=='lists') { echo 'active'; } ?>"><a href="<?=base_url('admin/claim-reimbursement-rate/lists')?>"><?=getContentLanguageSelected('LISTS',defaultSelectedLanguage())?></a></li>
                  </ul>
               </li>
            </ul>

            <!-- Hospitalization Management added by Shiv -->  
            <ul class="treeview-menu">
               <li class="treeview <?php if($segment=='hospitalization') { echo 'active'; } ?>">
                  <a href="#">
                  <i class="fa fa-building"></i><span><?=getContentLanguageSelected('HOSPITALIZATION_MANAGEMENT',defaultSelectedLanguage())?></span>
                  <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                  </span>
                  </a>
                  <ul class="treeview-menu">
                     <li class="<?php if($segment2=='add') { echo 'active'; } ?>"><a href="<?=base_url('admin/hospitalization/add')?>"><?=getContentLanguageSelected('ADD_HOSPITALIZATION',defaultSelectedLanguage())?></a></li>
                     <li class="<?php if($segment2=='lists') { echo 'active'; } ?>"><a href="<?=base_url('admin/hospitalization/lists')?>"><?=getContentLanguageSelected('HOSPITALIZATION',defaultSelectedLanguage())?></a></li>
                  </ul>
               </li> 
            </ul>

            <!-- Health Insurance added by Shiv -->
            <ul class="treeview-menu">
               <li class="treeview <?php if($segment=='health-insurance' || $segment=='health-insurance-conditions' || $segment=='health-insurance-condition' || $segment=='health-insurance-quote' || $segment == 'health-insurance-getquote' || $segment == 'health-insurance-policies') { echo 'active'; } ?>">
                  <a href="#">
                     <i class="fa fa-question-circle"></i><span> <?=getContentLanguageSelected('HEALTH_MANAGEMENT',defaultSelectedLanguage())?> </span>
                     <span class="pull-right-container">
                     <i class="fa fa-angle-left pull-right"></i>
                     </span>
                  </a>
                  <ul class="treeview-menu">
                     <li class="<?php if($segment == 'health-insurance-conditions') { echo 'active'; } ?>"><a href="<?=base_url('admin/health-insurance-conditions/lists')?>"><?=getContentLanguageSelected('ADD_HEALTH_INSURANCE_EXAMINATION',defaultSelectedLanguage())?></a></li>
                  </ul>
                  <ul class="treeview-menu">
                     <li class="<?php if($segment == 'health-insurance-quote') { echo 'active'; } ?>"><a href="<?=base_url('admin/health-insurance-quote/lists')?>"><?=getContentLanguageSelected('ADD_HEALTH_INSURANCE_AMOUNT_QUOTE',defaultSelectedLanguage())?></a></li>
                  </ul>
                  <ul class="treeview-menu">
                     <li class="<?php if($segment == 'health-insurance-getquote') { echo 'active'; } ?>"><a href="<?=base_url('admin/health-insurance-getquote')?>"><?=getContentLanguageSelected('GET_HEALTH_INSURANCE_QUOTE',defaultSelectedLanguage())?></a></li>
                  </ul>
                  <ul class="treeview-menu">
                     <li class="<?php if($segment == 'health-insurance-policies') { echo 'active'; } ?>"><a href="<?=base_url('admin/health-insurance-policies')?>"><?=getContentLanguageSelected('HEALTH_INSURANCE_POLICIES',defaultSelectedLanguage())?></a></li>
                  </ul>
               </li>
            </ul>
         </li>

         <!-- Credit Management -->
         <li class="treeview <?php if($segment=='credit') { echo 'active'; } ?>">
            <a href="#">
            <i class="fa fa-asterisk"></i><span><?=getContentLanguageSelected('CREDIT_MANAGEMENT',defaultSelectedLanguage())?></span>
            <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
            </span>
            </a>
            <ul class="treeview-menu">
               <li class="<?php if($segment2 == 'list_tarification' || $segment2 == 'add_tarification' || $segment2 == 'edit_tarification') { echo 'active'; } ?>"><a href="<?=base_url('admin/credit/list_tarification')?>"><?=getContentLanguageSelected('CREDIT_TARIFICATION_LIST',defaultSelectedLanguage())?></a></li>
            </ul>

            <ul class="treeview-menu">
               <li class="<?php if($segment2 == 'credit_insurance_tenure' || $segment2 == 'optional_warranties' || $segment2 == 'rate_calculation') { echo 'active'; } ?>"><a href="<?=base_url('admin/credit/credit_insurance_tenure')?>"><?=getContentLanguageSelected('CREDIT_INSURANCE_TENURE',defaultSelectedLanguage())?></a></li>
            </ul>

            <ul class="treeview-menu">
               <li class="<?php if($segment2 == 'credit_policies') { echo 'active'; } ?>"><a href="<?=base_url('admin/credit/credit_policies')?>"><?=getContentLanguageSelected('CREDIT_INSURANCE_POLICIES',defaultSelectedLanguage())?></a></li>
            </ul>
         </li> 


         <!-- User Management -->
         <li class="treeview <?php if($segment=='users' || $segment == 'region' || $segment == 'department' || $segment == 'commune') { echo 'active'; } ?>">
            <a href="#">
            <i class="fa fa-user"></i><span><?=getContentLanguageSelected('USER_MANAGEMENT',defaultSelectedLanguage())?></span>
            <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
            </span>
            </a>
            <ul class="treeview-menu">
               <li class="<?php if($segment2=='add') { echo 'active'; } ?>"><a href="<?=base_url('admin/users/add')?>"><?=getContentLanguageSelected('ADD_USER',defaultSelectedLanguage())?></a></li>
               <li class="<?php if($segment2=='lists') { echo 'active'; } ?>"><a href="<?=base_url('admin/users/lists')?>"><?=getContentLanguageSelected('USERS',defaultSelectedLanguage())?></a></li>
            </ul>

            <!-- Region Management Menu -->
            <ul class="treeview-menu">
               <li class="treeview <?php if($segment=='region') { echo 'active'; } ?>">
                  <a href="#">
                  <i class="fa fa-question-circle"></i><span> <?=getContentLanguageSelected('REGION_MANAGEMENT',defaultSelectedLanguage())?> </span>
                  <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                  </span>
                  </a>
                  <ul class="treeview-menu">
                     <li class="<?php if($segment2=='add') { echo 'active'; } ?>"><a href="<?=base_url('admin/region/add')?>"><?=getContentLanguageSelected('ADD_REGION',defaultSelectedLanguage())?></a></li>
                     <li class="<?php if($segment2=='lists') { echo 'active'; } ?>"><a href="<?=base_url('admin/region/lists')?>"><?=getContentLanguageSelected('REGION',defaultSelectedLanguage())?></a></li>
                  </ul>
               </li>         
            </ul>

            <!-- Department Management Menu -->
            <ul class="treeview-menu">
               <li class="treeview <?php if($segment=='department') { echo 'active'; } ?>">
                  <a href="#">
                  <i class="fa fa-question-circle"></i><span> <?=getContentLanguageSelected('DEPARTMENT_MANAGEMENT',defaultSelectedLanguage())?> </span>
                  <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                  </span>
                  </a>
                  <ul class="treeview-menu">
                     <li class="<?php if($segment2=='add') { echo 'active'; } ?>"><a href="<?=base_url('admin/department/add')?>"><?=getContentLanguageSelected('ADD_DEPARTMENT',defaultSelectedLanguage())?></a></li>
                     <li class="<?php if($segment2=='lists') { echo 'active'; } ?>"><a href="<?=base_url('admin/department/lists')?>"><?=getContentLanguageSelected('DEPARTMENT',defaultSelectedLanguage())?></a></li>
                  </ul>
               </li>
            </ul>

            <!-- Commune Management Menu -->
            <ul class="treeview-menu">
               <li class="treeview <?php if($segment=='commune') { echo 'active'; } ?>">
                  <a href="#">
                  <i class="fa fa-question-circle"></i><span> <?=getContentLanguageSelected('COMMUNE_MANAGEMENT',defaultSelectedLanguage())?> </span>
                  <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                  </span>
                  </a>
                  <ul class="treeview-menu">
                     <li class="<?php if($segment2=='add') { echo 'active'; } ?>"><a href="<?=base_url('admin/commune/add')?>"><?=getContentLanguageSelected('ADD_COMMUNE',defaultSelectedLanguage())?></a></li>
                     <li class="<?php if($segment2=='lists') { echo 'active'; } ?>"><a href="<?=base_url('admin/commune/lists')?>"><?=getContentLanguageSelected('COMMUNE',defaultSelectedLanguage())?></a></li>
                  </ul>
               </li> 
            </ul>
         </li>


         <!-- Parameters -->
         <li class="treeview <?php if($segment=='branch' || $segment=='risque' || $segment=='warranty' || $segment=='warranty-name' || $segment=='franchise' || $segment=='franchise-name' || $segment=='bonus' || $segment=='accessories' || $segment=='policy-duration' || $segment == 'wallet') { echo 'active'; } ?>">
            <a href="#">
            <i class="fa fa-user"></i><span><?=getContentLanguageSelected('PARAMETERS',defaultSelectedLanguage())?></span>
            <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
            </span>
            </a>
            <ul class="treeview-menu">
               <li class="treeview <?php if($segment=='branch') { echo 'active'; } ?>">
                  <a href="#">
                  <i class="fa fa-building"></i><span><?=getContentLanguageSelected('BRANCH_MANAGEMENT',defaultSelectedLanguage())?></span>
                  <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                  </span>
                  </a>
                  <ul class="treeview-menu">
                     <li class="<?php if($segment2=='add') { echo 'active'; } ?>"><a href="<?=base_url('admin/branch/add')?>"><?=getContentLanguageSelected('ADD_BRANCH',defaultSelectedLanguage())?></a></li>
                     <li class="<?php if($segment2=='lists') { echo 'active'; } ?>"><a href="<?=base_url('admin/branch/lists')?>"><?=getContentLanguageSelected('BRANCH',defaultSelectedLanguage())?></a></li>

                  </ul>
               </li> 
            </ul>


            <ul class="treeview-menu">
               <li class="treeview <?php if($segment=='risque') { echo 'active'; } ?>">
                  <a href="#">
                  <i class="fa fa-building"></i><span><?=getContentLanguageSelected('RISQUE_MANAGEMENT',defaultSelectedLanguage())?></span>
                  <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                  </span>
                  </a>
                  <ul class="treeview-menu">
                     <li class="<?php if($segment2=='add') { echo 'active'; } ?>"><a href="<?=base_url('admin/risque/add')?>"><?=getContentLanguageSelected('ADD_RISQUE',defaultSelectedLanguage())?></a></li>
                     <li class="<?php if($segment2=='lists') { echo 'active'; } ?>"><a href="<?=base_url('admin/risque/lists')?>"><?=getContentLanguageSelected('RISQUE',defaultSelectedLanguage())?></a></li>
                  </ul>
               </li> 
            </ul>

            <ul class="treeview-menu">
               <li class="treeview <?php if($segment=='warranty') { echo 'active'; } ?>">
                  <a href="#">
                  <i class="fa fa-building"></i><span><?=getContentLanguageSelected('WARRANTY_MANAGEMENT',defaultSelectedLanguage())?></span>
                  <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                  </span>
                  </a>
                  <ul class="treeview-menu">
                     <li class="<?php if($segment2=='add') { echo 'active'; } ?>"><a href="<?=base_url('admin/warranty/add')?>"><?=getContentLanguageSelected('ADD_WARRANTY',defaultSelectedLanguage())?></a></li>
                     <li class="<?php if($segment2=='lists') { echo 'active'; } ?>"><a href="<?=base_url('admin/warranty/lists')?>"><?=getContentLanguageSelected('WARRANTY',defaultSelectedLanguage())?></a></li>

                  </ul>
               </li>
            </ul>

            <ul class="treeview-menu">
               <li class="treeview <?php if($segment=='warranty-name') { echo 'active'; } ?>">
                  <a href="#">
                  <i class="fa fa-question-circle"></i><span> <?=getContentLanguageSelected('WARRANTY_NAME_MANAGEMENT',defaultSelectedLanguage())?> </span>
                  <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                  </span>
                  </a>
                  <ul class="treeview-menu">
                     <li class="<?php if($segment2=='add') { echo 'active'; } ?>"><a href="<?=base_url('admin/warranty-name/add')?>"><?=getContentLanguageSelected('ADD_NAME',defaultSelectedLanguage())?></a></li>
                     <li class="<?php if($segment2=='lists') { echo 'active'; } ?>"><a href="<?=base_url('admin/warranty-name/lists')?>"><?=getContentLanguageSelected('LISTS',defaultSelectedLanguage())?></a></li>
                  </ul>
               </li>
            </ul>

            <ul class="treeview-menu">
               <li class="treeview <?php if($segment=='franchise') { echo 'active'; } ?>">
                  <a href="#">
                  <i class="fa fa-building"></i><span><?=getContentLanguageSelected('FRANCHISE_MANAGEMENT',defaultSelectedLanguage())?></span>
                  <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                  </span>
                  </a>
                  <ul class="treeview-menu">
                     <li class="<?php if($segment2=='add') { echo 'active'; } ?>"><a href="<?=base_url('admin/franchise/add')?>"><?=getContentLanguageSelected('ADD_FRANCHISE',defaultSelectedLanguage())?></a></li>
                     <li class="<?php if($segment2=='lists') { echo 'active'; } ?>"><a href="<?=base_url('admin/franchise/lists')?>"><?=getContentLanguageSelected('FRANCHISE',defaultSelectedLanguage())?></a></li>
                  </ul>
               </li>   
            </ul>


            <ul class="treeview-menu">
               <li class="treeview <?php if($segment=='franchise-name') { echo 'active'; } ?>">
                  <a href="#">
                  <i class="fa fa-question-circle"></i><span> <?=getContentLanguageSelected('FRANCHISE_NAME_MANAGEMENT',defaultSelectedLanguage())?> </span>
                  <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                  </span>
                  </a>
                  <ul class="treeview-menu">
                     <li class="<?php if($segment2=='add') { echo 'active'; } ?>"><a href="<?=base_url('admin/franchise-name/add')?>"><?=getContentLanguageSelected('ADD_NAME',defaultSelectedLanguage())?></a></li>
                     <li class="<?php if($segment2=='lists') { echo 'active'; } ?>"><a href="<?=base_url('admin/franchise-name/lists')?>"><?=getContentLanguageSelected('LISTS',defaultSelectedLanguage())?></a></li>
                  </ul>
               </li>
            </ul>



            <ul class="treeview-menu">
               <li class="treeview <?php if($segment=='bonus') { echo 'active'; } ?>">
                  <a href="#">
                  <i class="fa fa-building"></i><span><?=getContentLanguageSelected('BONUS_MANAGEMENT',defaultSelectedLanguage())?></span>
                  <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                  </span>
                  </a>
                  <ul class="treeview-menu">
                     <li class="<?php if($segment2=='add') { echo 'active'; } ?>"><a href="<?=base_url('admin/bonus/add')?>"><?=getContentLanguageSelected('ADD_BONUS',defaultSelectedLanguage())?></a></li>
                     <li class="<?php if($segment2=='lists') { echo 'active'; } ?>"><a href="<?=base_url('admin/bonus/lists')?>"><?=getContentLanguageSelected('BONUS',defaultSelectedLanguage())?></a></li>
                  </ul>
               </li>    
            </ul>

            <ul class="treeview-menu">
               <li class="treeview <?php if($segment=='accessories') { echo 'active'; } ?>">
                  <a href="#">
                  <i class="fa fa-user"></i><span><?=getContentLanguageSelected('ACCESSORIES_MANAGEMENT',defaultSelectedLanguage())?></span>
                  <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                  </span>
                  </a>
                  <ul class="treeview-menu">
                     <li class="<?php if($segment2=='add') { echo 'active'; } ?>"><a href="<?=base_url('admin/accessories/add')?>"><?=getContentLanguageSelected('ADD_ACCESSORIES',defaultSelectedLanguage())?></a></li>
                     <li class="<?php if($segment2=='lists') { echo 'active'; } ?>"><a href="<?=base_url('admin/accessories/lists')?>"><?=getContentLanguageSelected('ACCESSORIES',defaultSelectedLanguage())?></a></li>
                  </ul>
               </li>
            </ul>

            <ul class="treeview-menu">
               <li class="treeview <?php if($segment=='policy-duration') { echo 'active'; } ?>">
                  <a href="#">
                  <i class="fa fa-fire"></i><span><?=getContentLanguageSelected('POLICY_DURATION_MANAGEMENT',defaultSelectedLanguage())?></span>
                  <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                  </span>
                  </a>
                  <ul class="treeview-menu">
                     <li class="<?php if($segment2=='add') { echo 'active'; } ?>"><a href="<?=base_url('admin/policy-duration/add')?>"><?=getContentLanguageSelected('ADD_POLICY_DURATION',defaultSelectedLanguage())?></a></li>
                     <li class="<?php if($segment2=='lists') { echo 'active'; } ?>"><a href="<?=base_url('admin/policy-duration/lists')?>"><?=getContentLanguageSelected('POLICIES_DURATION',defaultSelectedLanguage())?></a></li>
                  </ul>
               </li>
            </ul>

            <ul class="treeview-menu">
               <li class="treeview <?php if($segment=='wallet') { echo 'active'; } ?>">
                  <a href="#">
                  <i class="fa fa-user"></i><span><?=getContentLanguageSelected('WALLET_MANAGEMENT',defaultSelectedLanguage())?></span>
                  <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                  </span>
                  </a>
                  <ul class="treeview-menu">
                     <li class="<?php if($segment2=='add') { echo 'active'; } ?>"><a href="<?=base_url('admin/wallet/add')?>"><?=getContentLanguageSelected('ADD_MONEY',defaultSelectedLanguage())?></a></li>
                     <li class="<?php if($segment2=='index') { echo 'active'; } ?>"><a href="<?=base_url('admin/wallet')?>"><?=getContentLanguageSelected('WALLET_LIST',defaultSelectedLanguage())?></a></li>
                  </ul>
               </li>
            </ul> 
         </li>


         <!-- <li class="treeview <?php if($segment == 'individual-accident' ) { echo 'active'; } ?>">

            <a href="#">
            <i class="fa fa-question-circle"></i><span> <?=getContentLanguageSelected('CREDIT_INSURANCE',defaultSelectedLanguage())?> </span>
            <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
            </span>
            </a>
            <ul class="treeview-menu">
               <li class="<?php if($segment2 == 'accident-insurance-options'|| $segment2 == 'accident-insurance-options-add'|| $segment2 == 'accident-insurance-options-edit') { echo 'active'; } ?>"><a href="<?=base_url('admin/individual-accident/accident-insurance-options')?>"><?=getContentLanguageSelected('ACCIDENT_INSURANCE_OPTIONS',defaultSelectedLanguage())?></a></li>
            </ul>

            <ul class="treeview-menu">
               <li class="<?php if($segment2 == 'individual-accident-getquote') { echo 'active'; } ?>"><a href="<?=base_url('admin/individual-accident/individual-accident-getquote')?>"><?=getContentLanguageSelected('GET_INDIVIDUAL_ACCIDENT_QUOTE',defaultSelectedLanguage())?></a></li>
            </ul>
         </li> -->        

         <!-- <li class="treeview <?php if($segment=='warranty') { echo 'active'; } ?>">
            <a href="#">
            <i class="fa fa-exclamation"></i><span><?=getContentLanguageSelected('WARRANTY',defaultSelectedLanguage())?> </span>
            <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
            </span>
            </a>
            <ul class="treeview-menu">
               <li class="<?php if($segment2=='add') { echo 'active'; } ?>"><a href="<?=base_url('admin/warranty/add')?>"><?=getContentLanguageSelected('ADD_WARRANTY',defaultSelectedLanguage())?></a></li>
               <li class="<?php if($segment2=='lists') { echo 'active'; } ?>"><a href="<?=base_url('admin/warranty/lists')?>"><?=getContentLanguageSelected('WARRANTY',defaultSelectedLanguage())?></a></li>
            </ul>
         </li> -->

         
<!--          <li class="treeview <?php if($segment=='insurance-type') { echo 'active'; } ?>">
            <a href="#">
            <i class="fa fa-superpowers"></i><span> <?=getContentLanguageSelected('INSURANCE_TYPE',defaultSelectedLanguage())?></span>
            <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
            </span>
            </a>
            <ul class="treeview-menu">
               <li class="<?php if($segment2=='add') { echo 'active'; } ?>"><a href="<?=base_url('admin/insurance-type/add')?>"><?=getContentLanguageSelected('ADD_INSURANCE_TYPE',defaultSelectedLanguage())?></a></li>
               <li class="<?php if($segment2=='lists') { echo 'active'; } ?>"><a href="<?=base_url('admin/insurance-type/lists')?>"><?=getContentLanguageSelected('INSURANCE_TYPE',defaultSelectedLanguage())?></a></li>
            </ul>
         </li> -->


<!--          <li class="treeview <?php if($segment=='optional-warranty') { echo 'active'; } ?>">
            <a href="#">
            <i class="fa fa-exclamation-triangle"></i><span><?=getContentLanguageSelected('OPTIONAL_WARRANTY',defaultSelectedLanguage())?></span>
            <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
            </span>
            </a>
            <ul class="treeview-menu">
               <li class="<?php if($segment2=='add') { echo 'active'; } ?>"><a href="<?=base_url('admin/optional-warranty/add')?>"><?=getContentLanguageSelected('ADD_OPTIONAL_WARRANTY',defaultSelectedLanguage())?></a></li>
               <li class="<?php if($segment2=='lists') { echo 'active'; } ?>"><a href="<?=base_url('admin/optional-warranty/lists')?>"><?=getContentLanguageSelected('OPTIONAL_WARRANTY',defaultSelectedLanguage())?></a></li>
            </ul>
         </li> -->
     
        

<!--          <li class="treeview <?php if($segment=='event') { echo 'active'; } ?>">
            <a href="#">
            <i class="fa fa-leaf"></i><span> <?=getContentLanguageSelected('EVENT_MANAGEMENT',defaultSelectedLanguage())?></span>
            <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
            </span>
            </a>
            <ul class="treeview-menu">
               <li class="<?php if($segment2=='add') { echo 'active'; } ?>"><a href="<?=base_url('admin/event/add')?>"><?=getContentLanguageSelected('ADD_EVENT',defaultSelectedLanguage())?></a></li>
               <li class="<?php if($segment2=='lists') { echo 'active'; } ?>"><a href="<?=base_url('admin/event/lists')?>"><?=getContentLanguageSelected('EVENT',defaultSelectedLanguage())?></a></li>
            </ul>
         </li>        
         <li class="treeview <?php if($segment=='event') { echo 'active'; } ?>">
            <a href="#">
            <i class="fa fa-magic"></i><span> <?=getContentLanguageSelected('EVENT_CLAIM_MANAGEMENT',defaultSelectedLanguage())?></span>
            <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
            </span>
            </a>
            <ul class="treeview-menu">
               <li class="<?php if($segment2=='add') { echo 'active'; } ?>"><a href="<?=base_url('admin/event-claim/add')?>"><?=getContentLanguageSelected('ADD_EVENT',defaultSelectedLanguage())?></a></li>
               <li class="<?php if($segment2=='lists') { echo 'active'; } ?>"><a href="<?=base_url('admin/event-claim/lists')?>"><?=getContentLanguageSelected('EVENT',defaultSelectedLanguage())?></a></li>
            </ul>
         </li> -->

         <li class="treeview <?php if($segment=='company' || $segment == 'questionnaries' || $segment == 'company-question') { echo 'active'; } ?>">
            <a href="#">
            <i class="fa fa-building"></i><span><?=getContentLanguageSelected('COMPANY_MANAGEMENT',defaultSelectedLanguage())?></span>
            <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
            </span>
            </a>
            <ul class="treeview-menu">
               <li class="<?php if($segment2=='add') { echo 'active'; } ?>"><a href="<?=base_url('admin/company/add')?>"><?=getContentLanguageSelected('ADD_COMPANY',defaultSelectedLanguage())?></a></li>
               <li class="<?php if($segment2=='lists') { echo 'active'; } ?>"><a href="<?=base_url('admin/company/lists')?>"><?=getContentLanguageSelected('COMPANY',defaultSelectedLanguage())?></a></li>
            </ul>


            <!-- Company Questions Menu -->
            <ul class="treeview-menu">
               <li class="treeview <?php if($segment=='credit' || $segment == 'questionnaries' || $segment == 'company-question') { echo 'active'; } ?>">
               <a href="#">
               <i class="fa fa-asterisk"></i><span><?=getContentLanguageSelected('COMPANY_QUESTIONS',defaultSelectedLanguage())?></span>
               <span class="pull-right-container">
               <i class="fa fa-angle-left pull-right"></i>
               </span>
               </a>
               <ul class="treeview-menu">
                  <li class="treeview <?php if($segment=='questionnaries') { echo 'active'; } ?>">
                     <a href="#">
                     <i class="fa fa-question-circle"></i><span> <?=getContentLanguageSelected('QUESTIONNARIES',defaultSelectedLanguage())?> </span>
                     <span class="pull-right-container">
                     <i class="fa fa-angle-left pull-right"></i>
                     </span>
                     </a>
                     <ul class="treeview-menu">
                        <li class="<?php if($segment2=='add') { echo 'active'; } ?>"><a href="<?=base_url('admin/questionnaries/add')?>"><?=getContentLanguageSelected('ADD_QUESTIONNARIES',defaultSelectedLanguage())?></a></li>
                        <li class="<?php if($segment2=='lists') { echo 'active'; } ?>"><a href="<?=base_url('admin/questionnaries/lists')?>"><?=getContentLanguageSelected('QUESTION',defaultSelectedLanguage())?></a></li>
                     </ul>
                  </li> 
               </ul>

               <ul class="treeview-menu">
                  <li class="treeview <?php if($segment=='company-question') { echo 'active'; } ?>">
                     <a href="#">
                     <i class="fa fa-question"></i><span>  <?=getContentLanguageSelected('COMPANY__QUESTIONNARIES',defaultSelectedLanguage())?> </span>
                     <span class="pull-right-container">
                     <i class="fa fa-angle-left pull-right"></i>
                     </span>
                     </a>
                     <ul class="treeview-menu">
                        <li class="<?php if($segment2=='add') { echo 'active'; } ?>"><a href="<?=base_url('admin/company-question/add')?>"><?=getContentLanguageSelected('ADD_COMPANY_QUESTION',defaultSelectedLanguage())?></a></li>
                        <li class="<?php if($segment2=='lists') { echo 'active'; } ?>"><a href="<?=base_url('admin/company-question/lists')?>"><?=getContentLanguageSelected('COMPANY_QUESTION',defaultSelectedLanguage())?></a></li>
                     </ul>
                  </li>
               </ul>
               </li>
            </ul>
         </li>
       
  

      

<!--          <li class="treeview <?php if($segment=='policy') { echo 'active'; } ?>">
            <a href="#">
            <i class="fa fa-fire"></i><span><?=getContentLanguageSelected('POLICY_MANAGEMENT',defaultSelectedLanguage())?></span>
            <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
            </span>
            </a>
            <ul class="treeview-menu">
               <li class="<?php if($segment2=='add') { echo 'active'; } ?>"><a href="<?=base_url('admin/policy/add')?>"><?=getContentLanguageSelected('ADD_POLICY',defaultSelectedLanguage())?></a></li>
               <li class="<?php if($segment2=='lists') { echo 'active'; } ?>"><a href="<?=base_url('admin/policy/lists')?>"><?=getContentLanguageSelected('POLICIES',defaultSelectedLanguage())?></a></li>
            </ul>
         </li>   --> 
        


         <li class="treeview <?php if($segment=='settings') { echo 'active'; } ?>">
            <a href="#">
            <i class="fa fa-cogs"></i><span> <?=getContentLanguageSelected('SETTINGS',defaultSelectedLanguage())?></span>
            <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
            </span>
            </a>
            <ul class="treeview-menu">
               <li class="<?php if($segment2=='social') { echo 'active'; } ?>"><a href="<?=base_url('admin/settings/social')?>"><?=getContentLanguageSelected('SOCIAL',defaultSelectedLanguage())?></a></li>
               <li class="<?php if($segment2=='support') { echo 'active'; } ?>"><a href="<?=base_url('admin/settings/support')?>"><?=getContentLanguageSelected('SUPPORT',defaultSelectedLanguage())?></a></li>
               <li class="<?php if($segment2=='smtp') { echo 'active'; } ?>"><a href="<?=base_url('admin/settings/smtp')?>"><?=getContentLanguageSelected('SMTP',defaultSelectedLanguage())?></a></li>
               <!-- <li class="<?php if($segment2=='advance') { echo 'active'; } ?>"><a href="<?=base_url('admin/settings/advance')?>">Advance Setting</a></li>  -->
               <li class="<?php if($segment2=='static_content' || $segment2=='add_content' || $segment2=='edit_content') { echo 'active'; } ?>"><a href="<?=base_url('admin/settings/static_content')?>"><?=getContentLanguageSelected('STATIC_CONTENT',defaultSelectedLanguage())?></a></li>
               <li class="<?php if($segment2=='language') { echo 'active'; } ?>"><a href="<?=base_url('admin/settings/language')?>"><?=getContentLanguageSelected('LANGUAGE_SETTING',defaultSelectedLanguage())?></a></li>
               <li class="<?php if($segment2=='xls') { echo 'active'; } ?>"><a href="<?=base_url('admin/settings/xls')?>"><?=getContentLanguageSelected('XLS_UPLOAD',defaultSelectedLanguage())?></a></li>
               <li class="<?php if($segment2=='miscellaneous') { echo 'active'; } ?>"><a href="<?=base_url('admin/settings/miscellaneous')?>"><?=getContentLanguageSelected('MISCELLANEOUS',defaultSelectedLanguage())?></a></li>
            </ul>
         </li>

      </ul>
   </div>
   <!-- /.sidebar -->
</aside>