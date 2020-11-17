 <div class="resp-tabs-container hor_1">
        <div>
            <div class="mngPay">

                <?php
                    if(!empty($policies)) {
                        foreach ($policies as  $value) {
                            ?> 
                <div class="payBox ">
                    <div class="motorInsor">
                        <div class="dropdown moreOpt">
                            <a data-toggle="dropdown" href="#"><img src="<?=base_url(); ?>assets/front/images/threedot.png"></a>
                            <ul class="dropdown-menu">
                              <!-- <li><a href="#"><?=getContentLanguageSelected('RENEW_POLICY',defaultSelectedLanguage())?></a></li> -->
                              <li><a href="<?=base_url('user/report/'.$value['insurance_type_id'].'/'.$value['insured_id'])?>" target="_blank"><?=getContentLanguageSelected('VIEW_QUITTANCE',defaultSelectedLanguage())?></a></li>
                              <!-- <li><a href="#"><?=getContentLanguageSelected('GET_HELP',defaultSelectedLanguage())?></a></li>
                              <li><a href="#"><?=getContentLanguageSelected('VIEW_MORE',defaultSelectedLanguage())?></a></li> -->
                            </ul>
                        </div>
                        
                        <ul class="motList">
                            <li><?=$value['company_name']?></li>
                            <li><?=getInsuranceTypeName($value['insurance_type_id'])?> Insurance</li>
                        </ul>
                    </div>
                
                    <div class="payBooking">
                        <ul>
                            <li>
                                <h3><?=getContentLanguageSelected('POLICY_ID',defaultSelectedLanguage())?></h3>
                                <p><?=$value['policy_number']?></p>
                            </li>
                            <li>
                                <h3><?=getContentLanguageSelected('CREATION_DATE',defaultSelectedLanguage())?></h3>
                                <p><?=getCreatedAndExpirationDate($value['insurance_type_id'],$value['insured_id'])['start']?></p>
                            </li>
                            <li>
                                <h3><?=getContentLanguageSelected('EXPIRATION_DATE',defaultSelectedLanguage())?></h3>
                                <p><?=getCreatedAndExpirationDate($value['insurance_type_id'],$value['insured_id'])['end']?></p>
                            </li>
                            <li>
                                <h3><?=getContentLanguageSelected('AMOUNT',defaultSelectedLanguage())?></h3>
                                <p>$<?=$value['amount']?></p>
                            </li>
                            <li>
                                <h3><?=getContentLanguageSelected('CREATED_FOR',defaultSelectedLanguage())?></h3>
                                <p><?=$value['policy_created_for']?></p>
                            </li>
                            <li>
                                <h3><?=getContentLanguageSelected('AGENT_NAME',defaultSelectedLanguage())?></h3>
                                <p><?=$value['agent_name']?></p>
                            </li>
                            <?php
                            if($value['payment_status'] == 0 ){ // pending
                            ?>
                            <li><a class="btnInvo" href="#">PAY</a></li>
                            <?php }
                            else if($value['payment_status'] == 2) { //success ?> 
                                <li><a class="btnInvo" href="#">CLAIM</a></li>
                            <?php }
                            else if($value['payment_status'] == 1) { // fail?>
                                <li><a class="btnInvo" href="#">PAY</a></li>
                            <?php  }?>
                        </ul>
                        <?php
                        if($value->payment_status == 2){ // success
                        ?>
                        <div class="morCont">
                            <ul>
                            <!-- <li>
                                <h3>Quittance Number</h3>
                                <p>12400470</p>
                            </li> -->
                            <li>
                                <h3><?=getContentLanguageSelected('NET_PREMIUM',defaultSelectedLanguage())?></h3>

                                <p><?=getNetPremiumAccessoriesAndTax($value['insurance_type_id'],$value['insured_id'])['net_premium']?></p>
                            </li>
                            <li>
                                <h3><?=getContentLanguageSelected('ACCESSORIES',defaultSelectedLanguage())?></h3>
                                <p>124470</p>
                            </li>
                            <li>
                                <h3><?=getContentLanguageSelected('TAXES',defaultSelectedLanguage())?></h3>
                                <p>$8780</p>
                            </li>
                        </ul>
                        </div>
                        <a class="plcDtl"><img src="<?=base_url(); ?>assets/front/images/arrow-bottom.png"></a>
                        <?php
                        }
                        ?>
                    </div>
                </div> 
                <hr>
                   <?php }}
      else { ?>
        <h2><?=getContentLanguageSelected('NO_RECORDS_FOUND',defaultSelectedLanguage())?></h2>
      <?php }?>



            </div>
        </div>
        
        <div>
            <div class="mngPay">


                <?php
                    if(!empty($active_policies)) {
                        foreach ($active_policies as  $value) {?> 

                <div class="payBox">
                    <div class="motorInsor">
                        <div class="dropdown moreOpt">
                            <a data-toggle="dropdown" href="#"><img src="<?=base_url(); ?>assets/front/images/threedot.png"></a>
                            <ul class="dropdown-menu">
                              <li><a href="#"><?=getContentLanguageSelected('VIEW_QUITTANCE',defaultSelectedLanguage())?></a></li>
                              <!-- <li><a href="#"><?=getContentLanguageSelected('GET_HELP',defaultSelectedLanguage())?></a></li>
                              <li><a href="#"><?=getContentLanguageSelected('VIEW_MORE',defaultSelectedLanguage())?></a></li> -->
                            </ul>
                        </div>
                        
                        <ul class="motList">
                            <li><?=$value['company_name']?></li>
                            <li><?=getInsuranceTypeName($value['insurance_type_id'])?> Insurance</li>
                        </ul>
                    </div>
                
                    <div class="payBooking">
                        <ul>
                            <li>
                                <h3><?=getContentLanguageSelected('POLICY_ID',defaultSelectedLanguage())?></h3>
                                <p><?=$value['policy_number']?></p>
                            </li>
                            <li>
                                <h3><?=getContentLanguageSelected('CREATION_DATE',defaultSelectedLanguage())?></h3>
                                <p><?=getCreatedAndExpirationDate($value['insurance_type_id'],$value['insured_id'])['start']?></p>
                            </li>
                            <li>
                                <h3><?=getContentLanguageSelected('EXPIRATION_DATE',defaultSelectedLanguage())?></h3>
                                <p><?=getCreatedAndExpirationDate($value['insurance_type_id'],$value['insured_id'])['end']?></p>
                            </li>
                            <li>
                                <h3><?=getContentLanguageSelected('AMOUNT',defaultSelectedLanguage())?></h3>
                                <p>$<?=$value['amount']?></p>
                            </li>
                            <li>
                                <h3><?=getContentLanguageSelected('CREATED_FOR',defaultSelectedLanguage())?></h3>
                                <p><?=$value['policy_created_for']?></p>
                            </li>
                            <li>
                                <h3><?=getContentLanguageSelected('AGENT_NAME',defaultSelectedLanguage())?></h3>
                                <p><?=$value['agent_name']?></p>
                            </li>
                            <li>
                                <a class="btnInvo" href="#"><?=getContentLanguageSelected('CLAIM',defaultSelectedLanguage())?></a>
                            </li>
                        </ul>
                        <div class="morCont">
                            <ul>
                            <!-- <li>
                                <h3>Quittance Number</h3>
                                <p>12400470</p>
                            </li> -->
                            <li>
                                <h3><?=getContentLanguageSelected('NET_PREMIUM',defaultSelectedLanguage())?></h3>
                                <p>15843</p>
                            </li>
                            <li>
                                <h3><?=getContentLanguageSelected('ACCESSORIES',defaultSelectedLanguage())?></h3>
                                <p>124470</p>
                            </li>
                            <li>
                                <h3><?=getContentLanguageSelected('TAXES',defaultSelectedLanguage())?></h3>
                                <p>$8780</p>
                            </li>
                        </ul>
                        </div>
                        <a class="plcDtl"><img src="<?=base_url(); ?>assets/front/images/arrow-bottom.png"></a>
                    </div>
                </div>
                <hr>
      <?php }}
      else { ?>
        <h2><?=getContentLanguageSelected('NO_RECORDS_FOUND',defaultSelectedLanguage())?></h2>
      <?php }?>
      
            </div>
        </div>
        
        <div>
            <div class="mngPay">

                <?php
                    if(!empty($expired_policies)) {
                        foreach ($expired_policies as  $value) {?> 
                <div class="payBox">
                    <div class="motorInsor">
                        <div class="dropdown moreOpt">
                            <a data-toggle="dropdown" href="#"><img src="images/threedot.png"></a>
                            <ul class="dropdown-menu">
                              <li><a href="#"><?=getContentLanguageSelected('VIEW_QUITTANCE',defaultSelectedLanguage())?></a></li>
                              <!-- <li><a href="#"><?=getContentLanguageSelected('GET_HELP',defaultSelectedLanguage())?></a></li>
                              <li><a href="#"><?=getContentLanguageSelected('VIEW_MORE',defaultSelectedLanguage())?></a></li> -->
                            </ul>
                        </div>
                        
                        <ul class="motList">
                            <li><?=$value['company_name']?></li>
                             <li><?=getInsuranceTypeName($value['insurance_type_id'])?> Insurance</li>
                        </ul>
                    </div>
                
                    <div class="payBooking">
                        <ul>
                            <li>
                                <h3><?=getContentLanguageSelected('POLICY_ID',defaultSelectedLanguage())?></h3>
                                <p><?=$value['policy_number']?></p>
                            </li>
                            <li>
                                <h3><?=getContentLanguageSelected('CREATION_DATE',defaultSelectedLanguage())?></h3>
                                <p><?=getCreatedAndExpirationDate($value['insurance_type_id'],$value['insured_id'])['start']?></p>
                            </li>
                            <li>
                                <h3><?=getContentLanguageSelected('EXPIRATION_DATE',defaultSelectedLanguage())?></h3>
                                <p><?=getCreatedAndExpirationDate($value['insurance_type_id'],$value['insured_id'])['end']?></p>
                            </li>
                            <li>
                                <h3><?=getContentLanguageSelected('AMOUNT',defaultSelectedLanguage())?></h3>
                                <p>$<?=$value['amount']?></p>
                            </li>
                            <li>
                                <h3><?=getContentLanguageSelected('CREATED_FOR',defaultSelectedLanguage())?></h3>
                                <p><?=$value['policy_created_for']?></p>
                            </li>
                            <li>
                                <h3><?=getContentLanguageSelected('AGENT_NAME',defaultSelectedLanguage())?></h3>
                                <p><?=$value['agent_name']?></p>
                            </li>
                            <li>
                                <a class="btnInvo" href="#"><?=getContentLanguageSelected('CLAIM',defaultSelectedLanguage())?></a>
                            </li>
                        </ul>
                        <div class="morCont">
                            <ul>
                            <!-- <li>
                                <h3>Quittance Number</h3>
                                <p>12400470</p>
                            </li> -->
                            <li>
                                <h3><?=getContentLanguageSelected('NET_PREMIUM',defaultSelectedLanguage())?></h3>
                                <p>15843</p>
                            </li>
                            <li>
                                <h3><?=getContentLanguageSelected('ACCESSORIES',defaultSelectedLanguage())?></h3>
                                <p>124470</p>
                            </li>
                            <li>
                                <h3><?=getContentLanguageSelected('TAXES',defaultSelectedLanguage())?></h3>
                                <p>$8780</p>
                            </li>
                        </ul>
                        </div>
                        <a class="plcDtl"><img src="<?=base_url('assets/front/')?>images/arrow-bottom.png"></a>
                    </div>
                </div>
                <hr>
      <?php }}
      else { ?>
        <h2><?=getContentLanguageSelected('NO_RECORDS_FOUND',defaultSelectedLanguage())?></h2>
      <?php }?>


            </div>
        </div>
        
        <div>
            <div class="mngPay">
                <?php
                if(!empty($paid_policies)) {
                foreach ($paid_policies as $value) { ?>
                <div class="payBox">
                    <div class="motorInsor">
                        <div class="dropdown moreOpt">
                            <a data-toggle="dropdown" href="#"><img src="<?=base_url('assets/front/')?>images/threedot.png"></a>
                            <ul class="dropdown-menu">
                              <li><a href="#"><?=getContentLanguageSelected('VIEW_QUITTANCE',defaultSelectedLanguage())?></a></li>
                              <!-- <li><a href="#"><?=getContentLanguageSelected('GET_HELP',defaultSelectedLanguage())?></a></li>
                              <li><a href="#"><?=getContentLanguageSelected('VIEW_MORE',defaultSelectedLanguage())?></a></li> -->
                            </ul>
                        </div>
                        
                        <ul class="motList">
                            <li><?=$value['company_name']?></li>
                            <li><?=getInsuranceTypeName($value['insurance_type_id'])?> Insurance</li>
                        </ul>
                    </div>
                
                    <div class="payBooking">
                        <ul>
                            <li>
                                <h3><?=getContentLanguageSelected('POLICY_ID',defaultSelectedLanguage())?></h3>
                                <p><?=$value['policy_number']?></p>
                            </li>
                            <li>
                                <h3><?=getContentLanguageSelected('CREATION_DATE',defaultSelectedLanguage())?></h3>
                                <p><?=getCreatedAndExpirationDate($value['insurance_type_id'],$value['insured_id'])['start']?></p>
                            </li>
                            <li>
                                <h3><?=getContentLanguageSelected('EXPIRATION_DATE',defaultSelectedLanguage())?></h3>
                                <p><?=getCreatedAndExpirationDate($value['insurance_type_id'],$value['insured_id'])['end']?></p>
                            </li>
                            <li>
                                <h3><?=getContentLanguageSelected('AMOUNT',defaultSelectedLanguage())?></h3>
                                <p>$<?=$value['amount']?></p>
                            </li>
                            <li>
                                <h3><?=getContentLanguageSelected('CREATED_FOR',defaultSelectedLanguage())?></h3>
                                <p><?=$value['policy_created_for']?></p>
                            </li>
                            <li>
                                <h3><?=getContentLanguageSelected('AGENT_NAME',defaultSelectedLanguage())?></h3>
                                <p><?=$value['agent_name']?></p>
                            </li>
                            <li>
                                <a class="btnInvo" href="#"><?=getContentLanguageSelected('CLAIM',defaultSelectedLanguage())?></a>
                            </li>
                        </ul>
                        <div class="morCont">
                            <ul>
                            <!-- <li>
                                <h3>Quittance Number</h3>
                                <p>124004sssssssss70</p>
                            </li> -->
                            <li>
                                <h3><?=getContentLanguageSelected('NET_PREMIUM',defaultSelectedLanguage())?></h3>
                                <p><?=getNetPremiumAccessoriesAndTax($value['insurance_type_id'],$value['insured_id'])['net_premium']?></p>
                            </li>
                            <li>
                                <h3><?=getContentLanguageSelected('ACCESSORIES',defaultSelectedLanguage())?></h3>
                                <p><?=getNetPremiumAccessoriesAndTax($value['insurance_type_id'],$value['insured_id'])['accessories']?></p>
                            </li>
                            <li>
                                <h3><?=getContentLanguageSelected('RENEW_POLICY',defaultSelectedLanguage())?>Taxes</h3>
                                <p><?=getNetPremiumAccessoriesAndTax($value['insurance_type_id'],$value['insured_id'])['tax']?></p>
                            </li>
                        </ul>
                        </div>
                        <a class="plcDtl"><img src="<?=base_url('assets/front/')?>images/arrow-bottom.png"></a>
                    </div>
                </div>  
                <hr>
      <?php }}
      else { ?>
        <h2><?=getContentLanguageSelected('NO_RECORDS_FOUND',defaultSelectedLanguage())?></h2>
      <?php }?>


            </div>
        </div>
        
        <div>
            <div class="mngPay">
                <?php
                if(!empty($unpaid_policies)) {
                foreach ($unpaid_policies as $value) {?>
                <div class="payBox">
                    <div class="motorInsor">
                        <div class="dropdown moreOpt">
                            <a data-toggle="dropdown" href="#"><img src="<?=base_url('/assets/front/')?>images/threedot.png"></a>
                            <ul class="dropdown-menu">
                              <li><a href="#"><?=getContentLanguageSelected('VIEW_QUITTANCE',defaultSelectedLanguage())?></a>
                              </li>
                              <!-- <li><a href="#"><?=getContentLanguageSelected('GET_HELP',defaultSelectedLanguage())?></a></li>
                              <li><a href="#"><?=getContentLanguageSelected('VIEW_MORE',defaultSelectedLanguage())?></a></li> -->
                            </ul>
                        </div>
                        
                        <ul class="motList">
                            <li><?=$value['company_name']?></li>
                           <li><?=getInsuranceTypeName($value['insurance_type_id'])?> Insurance</li>
                        </ul>
                    </div>
                
                    <div class="payBooking">
                        <ul>
                            <li>
                                <h3><?=getContentLanguageSelected('POLICY_ID',defaultSelectedLanguage())?></h3>
                                <p><?=$value['policy_number']?></p>
                            </li>
                            <li>
                                <h3><?=getContentLanguageSelected('CREATION_DATE',defaultSelectedLanguage())?></h3>
                                <p><?=getCreatedAndExpirationDate($value['insurance_type_id'],$value['insured_id'])['start']?></p>
                            </li>
                            <li>
                                <h3><?=getContentLanguageSelected('EXPIRATION_DATE',defaultSelectedLanguage())?></h3>
                                <p><?=getCreatedAndExpirationDate($value['insurance_type_id'],$value['insured_id'])['end']?></p>
                            </li>
                            <li>
                                <h3><?=getContentLanguageSelected('AMOUNT',defaultSelectedLanguage())?></h3>
                                <p><?=$value['amount']?></p>
                            </li>
                            <li>
                                <h3><?=getContentLanguageSelected('CREATED_FOR',defaultSelectedLanguage())?></h3>
                                <p><?=$value['policy_created_for']?></p>
                            </li>
                            <li>
                                <h3><?=getContentLanguageSelected('AGENT_NAME',defaultSelectedLanguage())?></h3>
                                <p><?=$value['agent_name']?></p>
                            </li>
                            <li>
                                <a class="btnInvo" href="#"><?=getContentLanguageSelected('PAY',defaultSelectedLanguage())?></a>
                            </li>
                        </ul>
                        <div class="morCont">
                            <ul>
                            <!-- <li>
                                <h3>Quittance Number</h3>
                                <p>12400470</p>
                            </li> -->
                            <li>
                                <h3><?=getContentLanguageSelected('NET_PREMIUM',defaultSelectedLanguage())?></h3>
                                <p>15843</p>
                            </li>
                            <li>
                                <h3><?=getContentLanguageSelected('ACCESSORIES',defaultSelectedLanguage())?></h3>
                                <p>124470</p>
                            </li>
                            <li>
                                <h3><?=getContentLanguageSelected('TAXES',defaultSelectedLanguage())?></h3>
                                <p>$8780</p>
                            </li>
                        </ul>
                        </div>
                        <!-- <a class="plcDtl"><img src="<?=base_url('/assets/front/')?>images/arrow-bottom.png"></a> -->
                    </div>
                </div>
                <hr>
      <?php }}
      else { ?>
        <h2><?=getContentLanguageSelected('NO_RECORDS_FOUND',defaultSelectedLanguage())?></h2>
      <?php }?>

            </div>
        </div>
 </div>


</div>


                </div>
            </div> <!-- /#page-content-wrapper -->
        </div> <!-- /#wrapper -->
        <!-- Bootstrap core JavaScript -->
