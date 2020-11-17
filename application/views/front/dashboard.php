<style>
.searchBlock input {
    width: 150px;
    padding: 5px 10px;
}
</style>
<?php 
    $message = $this->session->flashdata('message'); 
    if(!empty($message)) { ?>
        <div class="panel panel-warning">
          <div class="panel-heading">
            <?php echo $this->session->flashdata('message'); ?>
          </div>
        </div>
        <?php 
    } 
?>
<?php if ($user_role == 2) { // Customer    ?>     
    
    <div class="resp-tabs-container hor_1">
        <div>
            <div class="mngPay">
                <?php
                if (!empty($policies)) {
                    foreach ($policies as $value) {
                        ?> 
                        <div class="payBox ">
                            <div class="motorInsor">
                                <div class="dropdown moreOpt">
                                    <a data-toggle="dropdown" href="#"><img src="<?= base_url(); ?>assets/front/images/threedot.png"></a>
                                    <ul class="dropdown-menu">
                                      <!-- <li><a href="#"><?= getContentLanguageSelected('RENEW_POLICY', defaultSelectedLanguage()) ?></a></li> -->
                                        <li><a href="<?= base_url('user/report/' . $value['insurance_type_id'] . '/' . $value['insured_id']) ?>" target="_blank"><?= getContentLanguageSelected('VIEW_QUITTANCE', defaultSelectedLanguage()) ?></a></li>
                                        <li><a href="<?= base_url('user/downloadReport/' . $value['insurance_type_id'] . '/' . $value['insured_id']) ?>" target="_blank"><?= getContentLanguageSelected('DOWNLOAD_REPORT', defaultSelectedLanguage()) ?></a></li>
                                        <!--<li><a href="#"><?= getContentLanguageSelected('VIEW_MORE', defaultSelectedLanguage()) ?></a></li> -->
                                    </ul>
                                </div>

                                <ul class="motList">
                                    <li><?= $value['company_name'] ?></li>
                                    <li><?= getInsuranceTypeName($value['insurance_type_id']) ?> Insurance</li>
                                </ul>
                            </div>

                            <div class="payBooking">
                                <ul>
                                    <li>
                                        <h3><?= getContentLanguageSelected('POLICY_ID', defaultSelectedLanguage()) ?></h3>
                                        <p><?= $value['policy_number'] ?></p>
                                    </li>
                                    <li>
                                        <h3><?= getContentLanguageSelected('CREATION_DATE', defaultSelectedLanguage()) ?></h3>
                                        <p><?= getCreatedAndExpirationDate($value['insurance_type_id'], $value['insured_id'])['start'] ?></p>
                                    </li>
                                    <li>
                                        <h3><?= getContentLanguageSelected('EXPIRATION_DATE', defaultSelectedLanguage()) ?></h3>
                                        <p><?= getCreatedAndExpirationDate($value['insurance_type_id'], $value['insured_id'])['end'] ?></p>
                                    </li>
                                    <li>
                                        <h3><?= getContentLanguageSelected('AMOUNT', defaultSelectedLanguage()) ?></h3>
                                        <p>$<?= $value['amount'] ?></p>
                                    </li>
                                    <li>
                                        <h3><?= getContentLanguageSelected('CREATED_BY', defaultSelectedLanguage()) ?></h3>
                                        <p><?= $value['policy_created_by'] ?></p>
                                    </li>
                                    <li>
                                        <h3><?= getContentLanguageSelected('CREATER_NAME', defaultSelectedLanguage()) ?></h3>
                                        <p><?= $value['policy_creater'] ?></p>
                                    </li>
                                    <?php
                                    if ($value['payment_status'] == 0) { // pending
                                        ?>
                                       <!--  <li><a class="btnInvo" href="#">PAY</a></li> -->
                                    <?php } else if ($value['payment_status'] == 2) { //success 
                                        ?> 
                                        <li><a class="btnInvo" href="<?php echo base_url('user/claim_policy/'.$value['id'])?>">CLAIM</a></li>
                                    <?php } else if ($value['payment_status'] == 1) { // fail
                                        ?>
                                        <!-- <li><a class="btnInvo" href="#">PAY</a></li> -->
                                    <?php } ?>
                                </ul>
                                <?php
                                if ($value->payment_status == 2) { // success
                                    ?>
                                    <div class="morCont">
                                        <ul>
                                            <!-- <li>
                                                <h3>Quittance Number</h3>
                                                <p>12400470</p>
                                            </li> -->
                                            <li>
                                                <h3><?= getContentLanguageSelected('NET_PREMIUM', defaultSelectedLanguage()) ?></h3>

                                                <p><?= getNetPremiumAccessoriesAndTax($value['insurance_type_id'], $value['insured_id'])['net_premium'] ?></p>
                                            </li>
                                            <li>
                                                <h3><?= getContentLanguageSelected('ACCESSORIES', defaultSelectedLanguage()) ?></h3>
                                                <p>124470</p>
                                            </li>
                                            <li>
                                                <h3><?= getContentLanguageSelected('TAXES', defaultSelectedLanguage()) ?></h3>
                                                <p>$8780</p>
                                            </li>
                                        </ul>
                                    </div>
                                    <a class="plcDtl"><img src="<?= base_url(); ?>assets/front/images/arrow-bottom.png"></a>
                                    <?php
                                }
                                ?>
                            </div>
                        </div> 
                        <hr>
                        <?php
                    }
                } else {
                    ?>
                    <h2><?= getContentLanguageSelected('NO_RECORDS_FOUND', defaultSelectedLanguage()) ?></h2>
                <?php } ?>



            </div>
        </div>

        <div>
            <div class="mngPay">


                <?php
                if (!empty($active_policies)) {
                    foreach ($active_policies as $value) {
                        ?> 

                        <div class="payBox">
                            <div class="motorInsor">
                                <div class="dropdown moreOpt">
                                    <a data-toggle="dropdown" href="#"><img src="<?= base_url(); ?>assets/front/images/threedot.png"></a>
                                    <ul class="dropdown-menu">
                                        <li><a href="<?= base_url('user/report/' . $value['insurance_type_id'] . '/' . $value['insured_id']) ?>" target="_blank"><?= getContentLanguageSelected('VIEW_QUITTANCE', defaultSelectedLanguage()) ?></a></li>
                                        <li><a href="<?= base_url('user/downloadReport/' . $value['insurance_type_id'] . '/' . $value['insured_id']) ?>" target="_blank"><?= getContentLanguageSelected('DOWNLOAD_REPORT', defaultSelectedLanguage()) ?></a></li>
                                        <!-- <li><a href="#"><?= getContentLanguageSelected('VIEW_MORE', defaultSelectedLanguage()) ?></a></li> -->
                                    </ul>
                                </div>

                                <ul class="motList">
                                    <li><?= $value['company_name'] ?></li>
                                    <li><?= getInsuranceTypeName($value['insurance_type_id']) ?> Insurance</li>
                                </ul>
                            </div>

                            <div class="payBooking">
                                <ul>
                                    <li>
                                        <h3><?= getContentLanguageSelected('POLICY_ID', defaultSelectedLanguage()) ?></h3>
                                        <p><?= $value['policy_number'] ?></p>
                                    </li>
                                    <li>
                                        <h3><?= getContentLanguageSelected('CREATION_DATE', defaultSelectedLanguage()) ?></h3>
                                        <p><?= getCreatedAndExpirationDate($value['insurance_type_id'], $value['insured_id'])['start'] ?></p>
                                    </li>
                                    <li>
                                        <h3><?= getContentLanguageSelected('EXPIRATION_DATE', defaultSelectedLanguage()) ?></h3>
                                        <p><?= getCreatedAndExpirationDate($value['insurance_type_id'], $value['insured_id'])['end'] ?></p>
                                    </li>
                                    <li>
                                        <h3><?= getContentLanguageSelected('AMOUNT', defaultSelectedLanguage()) ?></h3>
                                        <p>$<?= $value['amount'] ?></p>
                                    </li>
                                    <li>
                                        <h3><?= getContentLanguageSelected('CREATED_BY', defaultSelectedLanguage()) ?></h3>
                                        <p><?= $value['policy_created_by'] ?></p>
                                    </li>
                                    <li>
                                        <h3><?= getContentLanguageSelected('CREATER_NAME', defaultSelectedLanguage()) ?></h3>
                                        <p><?= $value['policy_creater'] ?></p>
                                    </li>
                                    <li>
                                        <a class="btnInvo" href="<?php echo base_url('user/claim_policy/' . $value["id"]); ?>"><?= getContentLanguageSelected('CLAIM', defaultSelectedLanguage()) ?></a>
                                    </li>
                                </ul>
                                <div class="morCont">
                                    <ul>
                                        <!-- <li>
                                            <h3>Quittance Number</h3>
                                            <p>12400470</p>
                                        </li> -->
                                        <li>
                                            <h3><?= getContentLanguageSelected('NET_PREMIUM', defaultSelectedLanguage()) ?></h3>
                                            <p>15843</p>
                                        </li>
                                        <li>
                                            <h3><?= getContentLanguageSelected('ACCESSORIES', defaultSelectedLanguage()) ?></h3>
                                            <p>124470</p>
                                        </li>
                                        <li>
                                            <h3><?= getContentLanguageSelected('TAXES', defaultSelectedLanguage()) ?></h3>
                                            <p>$8780</p>
                                        </li>
                                    </ul>
                                </div>
                                <a class="plcDtl"><img src="<?= base_url(); ?>assets/front/images/arrow-bottom.png"></a>
                            </div>
                        </div>
                        <hr>
                        <?php
                    }
                } else {
                    ?>
                    <h2><?= getContentLanguageSelected('NO_RECORDS_FOUND', defaultSelectedLanguage()) ?></h2>
                <?php } ?>

            </div>
        </div>

        <div>
            <div class="mngPay">

                <?php
                if (!empty($expired_policies)) {
                    foreach ($expired_policies as $value) {
                        ?> 
                        <div class="payBox">
                            <div class="motorInsor">
                                <div class="dropdown moreOpt">
                                    <a data-toggle="dropdown" href="#"><img src="<?= base_url(); ?>assets/front/images/threedot.png"></a>
                                    <ul class="dropdown-menu">
                                        <li><a href="#"><?= getContentLanguageSelected('VIEW_QUITTANCE', defaultSelectedLanguage()) ?></a></li>
                                         <li><a href="<?= base_url('user/downloadReport/' . $value['insurance_type_id'] . '/' . $value['insured_id']) ?>" target="_blank"><?= getContentLanguageSelected('DOWNLOAD_REPORT', defaultSelectedLanguage()) ?></a></li>
                                        <!--<li><a href="#"><?= getContentLanguageSelected('VIEW_MORE', defaultSelectedLanguage()) ?></a></li> -->
                                    </ul>
                                </div>

                                <ul class="motList">
                                    <li><?= $value['company_name'] ?></li>
                                    <li><?= getInsuranceTypeName($value['insurance_type_id']) ?> Insurance</li>
                                </ul>
                            </div>

                            <div class="payBooking">
                                <ul>
                                    <li>
                                        <h3><?= getContentLanguageSelected('POLICY_ID', defaultSelectedLanguage()) ?></h3>
                                        <p><?= $value['policy_number'] ?></p>
                                    </li>
                                    <li>
                                        <h3><?= getContentLanguageSelected('CREATION_DATE', defaultSelectedLanguage()) ?></h3>
                                        <p><?= getCreatedAndExpirationDate($value['insurance_type_id'], $value['insured_id'])['start'] ?></p>
                                    </li>
                                    <li>
                                        <h3><?= getContentLanguageSelected('EXPIRATION_DATE', defaultSelectedLanguage()) ?></h3>
                                        <p><?= getCreatedAndExpirationDate($value['insurance_type_id'], $value['insured_id'])['end'] ?></p>
                                    </li>
                                    <li>
                                        <h3><?= getContentLanguageSelected('AMOUNT', defaultSelectedLanguage()) ?></h3>
                                        <p>$<?= $value['amount'] ?></p>
                                    </li>
                                    <li>
                                        <h3><?= getContentLanguageSelected('CREATED_BY', defaultSelectedLanguage()) ?></h3>
                                        <p><?= $value['policy_created_by'] ?></p>
                                    </li>
                                    <li>
                                        <h3><?= getContentLanguageSelected('CREATER_NAME', defaultSelectedLanguage()) ?></h3>
                                        <p><?= $value['policy_creater'] ?></p>
                                    </li>
                                    <li>
                                        <a class="btnInvo" href="<?php echo base_url('payment/proceed-to-pay/'.$value['id'])?>"><?= getContentLanguageSelected('RENEW', defaultSelectedLanguage()) ?></a>
                                    </li>
                                </ul>
                                <div class="morCont">
                                    <ul>
                                        <li>
                                            <h3><?=getContentLanguageSelected('QUITTANCE_NUMBER',defaultSelectedLanguage())?></h3>
                                            <p>12400470</p>
                                        </li> -->
                                        <li>
                                            <h3><?= getContentLanguageSelected('NET_PREMIUM', defaultSelectedLanguage()) ?></h3>
                                            <p>15843</p>
                                        </li>
                                        <li>
                                            <h3><?= getContentLanguageSelected('ACCESSORIES', defaultSelectedLanguage()) ?></h3>
                                            <p>124470</p>
                                        </li>
                                        <li>
                                            <h3><?= getContentLanguageSelected('TAXES', defaultSelectedLanguage()) ?></h3>
                                            <p>$8780</p>
                                        </li>
                                    </ul>
                                </div>
                                <a class="plcDtl"><img src="<?= base_url('assets/front/') ?>images/arrow-bottom.png"></a>
                            </div>
                        </div>
                        <hr>
                        <?php
                    }
                } else {
                    ?>
                    <h2><?= getContentLanguageSelected('NO_RECORDS_FOUND', defaultSelectedLanguage()) ?></h2>
                <?php } ?>
            </div>
        </div> 
    </div>
<?php } else if ($user_role == 4) { // Company   ?>
    <div class="resp-tabs-container hor_1">
        <!-- Dashboard Option for company dashboard -->
        <div>
            <div class="mngPay">
                <div class="container-fluid">
                    <div class="mainTitle">
                        <h1><?= getContentLanguageSelected('DASHBOARD', defaultSelectedLanguage()) ?></h1>
                        <p><?= getContentLanguageSelected('POLICY_MANAGEMENT_SIGNATURE', defaultSelectedLanguage()) ?></p>
                        <!-- <a href="#"><i class="fas fa-bell"></i></a> -->
                    </div>
                    <div class="totalIssue">
                        <h3><?= getContentLanguageSelected('TOTAL_POLICIES_ISSUED', defaultSelectedLanguage()) ?></h3>
                        <ul>
                            <?php
                            foreach ($todays_total_issued_policies['insurance_policy'] as $key => $value) {
                                if ($key == 1) {
                                    $image_path = base_url() . "assets/front/images/dashbaord/motor.png";
                                    $insurance_type = getInsuranceType($key) . "  INSURANCE";
                                } else if ($key == 2) {
                                    $image_path = base_url() . "assets/front/images/dashbaord/health.png";
                                    $insurance_type = getInsuranceType($key) . "  INSURANCE";
                                } else if ($key == 3) {
                                    $image_path = base_url() . "assets/front/images/dashbaord/travler.png";
                                    $insurance_type = getInsuranceType($key) . "  INSURANCE";
                                } else if ($key == 4) {
                                    $image_path = base_url() . "assets/front/images/dashbaord/professional_multirisk.png";
                                    $insurance_type = getInsuranceType($key) . "  INSURANCE";
                                } else if ($key == 5) {
                                    $image_path = base_url() . "assets/front/images/dashbaord/individual_accident.png";
                                    $insurance_type = getInsuranceType($key) . "  INSURANCE";
                                } else if ($key == 6) {
                                    $image_path = base_url() . "assets/front/images/dashbaord/credit.png";
                                    $insurance_type = getInsuranceType($key) . "  INSURANCE";
                                } else if ($key == 7) {
                                    $image_path = base_url() . "assets/front/images/dashbaord/home.png";
                                    $insurance_type = getInsuranceType($key) . "  INSURANCE";
                                }
                                ?>
                                <li><figure><img src="<?= $image_path; ?>"></figure>
                                    <h4><?= $value; ?></h4><p><?= $insurance_type; ?></p></li> 
                                <?php
                            }
                            ?>
                            <li>
                                <figure><img src="<?= base_url(); ?>assets/front/images/dashbaord/travler.png"></figure><h4><?= $todays_total_issued_policies['total_policies_issued']; ?></h4><p><?= getContentLanguageSelected('TOTAL', defaultSelectedLanguage()) ?></p>
                            </li>
                        </ul>
                    </div>
                    <div class="totalDay">
                        <h3><?= getContentLanguageSelected('TOTAL_REVENUE_OF_THE_DAY', defaultSelectedLanguage()) ?></h3>
                        <div class="row">
                            <?php foreach ($todays_total_sold_policies as $key => $value) { ?>
                                <div class="col-xs-6 col-sm-4">
                                    <div class="nBox">
                                        <h4><?= $value; ?></h4>
                                        <p><?= $key; ?></p>
                                    </div>
                                </div>
                                <?php
                            }
                            ?>
                            <!-- <div class="col-xs-6 col-sm-4">
                                <div class="nBox">
                                    <h4>3</h4>
                                    <p>Total Revenue</p>
                                </div>
                            </div> -->
                            <div class="col-xs-12 col-sm-4">
                                <div class="nBox">
                                    <h4><?= $todays_total_pending_slips; ?></h4>
                                    <p><?= getContentLanguageSelected('PENDING_SLIPS', defaultSelectedLanguage()) ?></p>
                                </div>
                            </div> 
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Insurance Policies Option for company dashboard -->
        <div>
            <div class="mngPay">             
                <div class="container-fluid">
                    <div class="mainTitle">
                        <h1><?= getContentLanguageSelected('INSURANCE_POLICIES', defaultSelectedLanguage()) ?></h1>
                        <div class="insDiv">
                            <div class="row">
                                <aside class="col-sm-5">
                                    <label><?= getContentLanguageSelected('SELECT_BRANCH', defaultSelectedLanguage()) ?><span class="required" >*</span></label>
                                    <?php
                                    $data = ' id="policy_branch"  class="form-control input"';
                                    echo form_dropdown('policy_branch', getOptions('tbl_branch', 'Select Branch', 1), set_value("policy_branch"), $data);
                                    ?>
                                    <?= form_error('policy_branch'); ?>
                                </aside>
                            </div>
                            <div class="row">
                                <div class="col-sm-5">
                                    <label><?= getContentLanguageSelected('SELECT_START_DATE', defaultSelectedLanguage()) ?><span class="required" >*</span></label>
                                    <input name="insurance_start_date" id="insurance_start_date" type="text" placeholder="Enter Start Date">
                                    <i class="far fa-calendar-alt"></i> 
                                    <?= form_error('insurance_start_date'); ?>
                                </div>

                                <div class="col-sm-5">
                                    <label><?= getContentLanguageSelected('SELECT_END_DATE', defaultSelectedLanguage()) ?><span class="required" >*</span></label>
                                    <input name="insurance_end_date" id="insurance_end_date" type="text" placeholder="Enter End Date">
                                    <i class="far fa-calendar-alt"></i> 
                                    <?= form_error('insurance_end_date'); ?>
                                </div>    
                            </div>
                            <div class="row">
                                <aside class="col-sm-12">
                                    <button id="get_quittance_of_month_website"><?= getContentLanguageSelected('GET_QUITTANCE_OF_MONTH', defaultSelectedLanguage()) ?></button>
                                </aside>
                            </div>
                        </div>
                    </div>
                    
                    <div class="selectArea mainTitle">
                        <div class="row">
                            <aside class="col-sm-12">
                                <a href="mailto:<?= getSettings('support_email')?>" class="askAdmin"><?= getContentLanguageSelected('ASK_ADMIN_FOR_THE_MODIFICATION', defaultSelectedLanguage()) ?></a>
                            </aside>
                        </div>
                    </div>
                    <!---->
                    
                  

                    <div class="searchBlock">
                    <div class="control-group col-sm-4">
                            <label><?=getContentLanguageSelected('Select Payment Status',defaultSelectedLanguage())?><span class="required">*</span> </label><br>
                            <?php
                                $data = 'class="filter_by_userdata form-control" id="btn_payment_status"';
                                echo form_dropdown('payment_status', getPaymentStatusOptions('Select Status') ,set_value('payment_status'),$data); ?> 
                            </div>
                        <form>
                            <input id="start_date" type="date" placeholder="From">
                            <input id="end_date" type="date" placeholder="To">
                            <div class="searchBar">
                                <button type="submit" id="ssubmit"><i class="fas fa-search"></i></button>
                                <input id="searchkey" type="text" placeholder="Search">
                            </div>
                        </form>
                    </div>
                    
                    <!---->
                    <div class="table-responsive">
                        <table class="dashBrdTable">
                            <thead>
                                <tr>
                                    <th><?= getContentLanguageSelected('DATE', defaultSelectedLanguage()) ?> <i class="fas fa-caret-down"></i></th>
                                    <th><?= getContentLanguageSelected('POLICIY_NO', defaultSelectedLanguage()) ?> <i class="fas fa-caret-down"></i></th>
                                    <th><?= getContentLanguageSelected('NET_PREMIUM', defaultSelectedLanguage()) ?> <i class="fas fa-caret-down"></i></th>
                                    <th><?= getContentLanguageSelected('ACCESSORIES', defaultSelectedLanguage()) ?> <i class="fas fa-caret-down"></i></th>
                                    <th><?= getContentLanguageSelected('ADMIN_POLICY_COMMISSION', defaultSelectedLanguage()) ?> <i class="fas fa-caret-down"></i></th>
                                    <th><?= getContentLanguageSelected('ADMIN_ACCCESSORIES_COMMISSION', defaultSelectedLanguage()) ?> <i class="fas fa-caret-down"></i></th>
                                    <th><?= getContentLanguageSelected('TAX', defaultSelectedLanguage()) ?> <i class="fas fa-caret-down"></i></th>
                                    <th><?= getContentLanguageSelected('TOTAL_PREMIUM', defaultSelectedLanguage()) ?> <i class="fas fa-caret-down"></i></th>
                                </tr>
                            </thead>
                            <tbody id ="policyData2">
                                <?php
                                if (!empty($insurance_policies)) {
                                    foreach ($insurance_policies as $key => $value) {
                                        ?>
                                        <tr id ="policyData">
                                            <td><?= $value['date']; ?></td>
                                            <td><?= $value['policy_number']; ?></td>
                                            <td><?= $value['net_premium']; ?></td>
                                            <td><?= $value['accessories']; ?></td>
                                            <td><?= $value['admin_policy_commission']; ?></td>
                                            <td><?= $value['accessories_admin_share']; ?></td>
                                            <td><?= $value['tax']; ?></td>
                                            <td><?= $value['total_premium']; ?></td>
                                        </tr> <?php
                                    }
                                } else {
                                    ?>
                                    <tr>
                                        <td></td>
                                        <td><?= getContentLanguageSelected('NO_RECORDS_FOUND', defaultSelectedLanguage()) ?></td>
                                        <td></td>
                                        <td></td>
                                    </tr> <?php
                                }
                                ?>
                            </tbody>
                        </table> 
                    </div>
                </div>
            </div>
        </div>

        <!-- Slips Option for company dashboard -->
        <div>
            <div class="mngPay">
                <?php 
                    $user_id    = $this->session->userdata('user_id');
                    $company_id = getCompanyIdByUserId($user_id);
                ?>
                <input type="hidden" id="company_id_slip" value="<?= $company_id?>">
                <div class="col-md-4">
                <label> Select Year</label>
                <?php
                $data = 'id="get_year" class="form-control"';
                echo form_dropdown('year_selected', getYears(), set_value("year_selected"), $data);
                ?>
                </div>
                <div class="col-md-4">
                <label> Select Month</label>
                <?php
                $data = ' id="get_month" class="form-control"';
                echo form_dropdown('month_selected', getMonths(), set_value("month_selected"), $data);
                ?>
                </div>
                <div class="col-md-4">
                <label> Created By</label>
                <?php
                $data = ' id="get_created" class="form-control" onChange="get_slip_detail()" ';
                echo form_dropdown('get_created', getCreatedBy(), set_value("get_created"), $data);
                ?>
                </div>
            </div>

            <div id="slip_record">

            </div>
        </div>
    </div>
<?php } else if ($user_role == 3) { // Partner   ?>
    <div class="searchBuulock">
        <form id="myForm">
            <div class="form-group col-sm-4">
                <label>Start Date:</label>
                <input type="text" name="insurance_start_date" class="form-control" placeholder="<?php echo date('Y-m-d'); ?>" id="insurance_start_date">
            </div>

            <div class="form-group col-sm-4">
                <label>End Date:</label>
                <input type="text" name="insurance_end_date" class="form-control" placeholder="<?php echo date('Y-m-d'); ?>" id="insurance_end_date">
            </div>
            <button type="button" class="btn btn-primary" id="get_quittance" style="margin-top: 24px;">Get Quittance of Month </button>
        </form>
    </div>
    <!---->
    <div class="resp-tabs-container hor_1">


        <!-- All Policies Option for Partner -->
        <div>
            <div class="mngPay">

                <?php
                if (!empty($policies)) {
                    foreach ($policies as $value) {
                        ?> 
                        <div class="payBox ">
                            <div class="motorInsor">
                                <div class="dropdown moreOpt">
                                    <a data-toggle="dropdown" href="#"><img src="<?= base_url(); ?>assets/front/images/threedot.png"></a>
                                    <ul class="dropdown-menu">
                                      <!-- <li><a href="#"><?= getContentLanguageSelected('RENEW_POLICY', defaultSelectedLanguage()) ?></a></li> -->
                                        <li><a href="<?= base_url('user/report/' . $value['insurance_type_id'] . '/' . $value['insured_id']) ?>" target="_blank"><?= getContentLanguageSelected('VIEW_QUITTANCE', defaultSelectedLanguage()) ?></a></li>
                                        <li><a href="<?= base_url('user/downloadReport/' . $value['insurance_type_id'] . '/' . $value['insured_id']) ?>" target="_blank"><?= getContentLanguageSelected('DOWNLOAD_REPORT', defaultSelectedLanguage()) ?></a></li>
                                        <!-- <li><a href="#"><?= getContentLanguageSelected('VIEW_MORE', defaultSelectedLanguage()) ?></a></li> -->
                                    </ul>
                                </div>

                                <ul class="motList">
                                    <li><?= $value['company_name'] ?></li>
                                    <li><?= getInsuranceTypeName($value['insurance_type_id']) ?> Insurance</li>
                                </ul>
                            </div>

                            <div class="payBooking">
                                <ul>
                                    <li>
                                        <h3><?= getContentLanguageSelected('POLICY_ID', defaultSelectedLanguage()) ?></h3>
                                        <p><?= $value['policy_number'] ?></p>
                                    </li>
                                    <li>
                                        <h3><?= getContentLanguageSelected('CREATION_DATE', defaultSelectedLanguage()) ?></h3>
                                        <p><?= getCreatedAndExpirationDate($value['insurance_type_id'], $value['insured_id'])['start'] ?></p>
                                    </li>
                                    <li>
                                        <h3><?= getContentLanguageSelected('EXPIRATION_DATE', defaultSelectedLanguage()) ?></h3>
                                        <p><?= getCreatedAndExpirationDate($value['insurance_type_id'], $value['insured_id'])['end'] ?></p>
                                    </li>
                                    <li>
                                        <h3><?= getContentLanguageSelected('AMOUNT', defaultSelectedLanguage()) ?></h3>
                                        <p>$<?= $value['amount'] ?></p>
                                    </li>
                                    <li>
                                        <h3><?= getContentLanguageSelected('CREATED_FOR', defaultSelectedLanguage()) ?></h3>
                                        <p><?= $value['policy_created_for'] ?></p>
                                    </li>
                                    <li>
                                        <h3><?= getContentLanguageSelected('CUSTOMER_NAME', defaultSelectedLanguage()) ?></h3>
                                        <p><?= $value['customer_name'] ?></p>
                                    </li>
                                </ul>
                                <?php
                                if ($value->payment_status == 2) { // success
                                    ?>
                                    <div class="morCont">
                                        <ul>
                                            <!-- <li>
                                                <h3>Quittance Number</h3>
                                                <p>12400470</p>
                                            </li> -->
                                            <li>
                                                <h3><?= getContentLanguageSelected('NET_PREMIUM', defaultSelectedLanguage()) ?></h3>

                                                <p><?= getNetPremiumAccessoriesAndTax($value['insurance_type_id'], $value['insured_id'])['net_premium'] ?></p>
                                            </li>
                                            <li>
                                                <h3><?= getContentLanguageSelected('ACCESSORIES', defaultSelectedLanguage()) ?></h3>
                                                <p>124470</p>
                                            </li>
                                            <li>
                                                <h3><?= getContentLanguageSelected('TAXES', defaultSelectedLanguage()) ?></h3>
                                                <p>$8780</p>
                                            </li>
                                        </ul>
                                    </div>
                                    <a class="plcDtl"><img src="<?= base_url(); ?>assets/front/images/arrow-bottom.png"></a>
                                    <?php
                                }
                                ?>
                            </div>
                        </div> 
                        <hr>
                        <?php
                    }
                } else {
                    ?>
                    <h2><?= getContentLanguageSelected('NO_RECORDS_FOUND', defaultSelectedLanguage()) ?></h2>
                <?php } ?>

            </div>
        </div>

        <!-- Active Policies Option for Partner -->
        <div>
            <div class="mngPay">


                <?php
                if (!empty($active_policies)) {
                    foreach ($active_policies as $value) {
                        ?> 

                        <div class="payBox">
                            <div class="motorInsor">
                                <div class="dropdown moreOpt">
                                    <a data-toggle="dropdown" href="#"><img src="<?= base_url(); ?>assets/front/images/threedot.png"></a>
                                    <ul class="dropdown-menu">
                                        <li><a href="<?= base_url('user/report/' . $value['insurance_type_id'] . '/' . $value['insured_id']) ?>" target="_blank"><?= getContentLanguageSelected('VIEW_QUITTANCE', defaultSelectedLanguage()) ?></a></li>
                                        <!-- <li><a href="#"><?= getContentLanguageSelected('GET_HELP', defaultSelectedLanguage()) ?></a></li>
                                        <li><a href="#"><?= getContentLanguageSelected('VIEW_MORE', defaultSelectedLanguage()) ?></a></li> -->
                                    </ul>
                                </div>

                                <ul class="motList">
                                    <li><?= $value['company_name'] ?></li>
                                    <li><?= getInsuranceTypeName($value['insurance_type_id']) ?> Insurance</li>
                                </ul>
                            </div>

                            <div class="payBooking">
                                <ul>
                                    <li>
                                        <h3><?= getContentLanguageSelected('POLICY_ID', defaultSelectedLanguage()) ?></h3>
                                        <p><?= $value['policy_number'] ?></p>
                                    </li>
                                    <li>
                                        <h3><?= getContentLanguageSelected('CREATION_DATE', defaultSelectedLanguage()) ?></h3>
                                        <p><?= getCreatedAndExpirationDate($value['insurance_type_id'], $value['insured_id'])['start'] ?></p>
                                    </li>
                                    <li>
                                        <h3><?= getContentLanguageSelected('EXPIRATION_DATE', defaultSelectedLanguage()) ?></h3>
                                        <p><?= getCreatedAndExpirationDate($value['insurance_type_id'], $value['insured_id'])['end'] ?></p>
                                    </li>
                                    <li>
                                        <h3><?= getContentLanguageSelected('AMOUNT', defaultSelectedLanguage()) ?></h3>
                                        <p>$<?= $value['amount'] ?></p>
                                    </li>
                                    <li>
                                        <h3><?= getContentLanguageSelected('CREATED_FOR', defaultSelectedLanguage()) ?></h3>
                                        <p><?= $value['policy_created_for'] ?></p>
                                    </li>
                                    <li>
                                        <h3><?= getContentLanguageSelected('CUSTOMER_NAME', defaultSelectedLanguage()) ?></h3>
                                        <p><?= $value['customer_name'] ?></p>
                                    </li>
                                    <li>
                                        <a class="btnInvo" href="<?php echo base_url('user/claim_policy/' . $value["id"]); ?>"><?= getContentLanguageSelected('CLAIM', defaultSelectedLanguage()) ?></a>
                                    </li>
                                </ul>
                                <div class="morCont">
                                    <ul>
                                        <!-- <li>
                                            <h3>Quittance Number</h3>
                                            <p>12400470</p>
                                        </li> -->
                                        <li>
                                            <h3><?= getContentLanguageSelected('NET_PREMIUM', defaultSelectedLanguage()) ?></h3>
                                            <p>15843</p>
                                        </li>
                                        <li>
                                            <h3><?= getContentLanguageSelected('ACCESSORIES', defaultSelectedLanguage()) ?></h3>
                                            <p>124470</p>
                                        </li>
                                        <li>
                                            <h3><?= getContentLanguageSelected('TAXES', defaultSelectedLanguage()) ?></h3>
                                            <p>$8780</p>
                                        </li>
                                    </ul>
                                </div>
                                <a class="plcDtl"><img src="<?= base_url(); ?>assets/front/images/arrow-bottom.png"></a>
                            </div>
                        </div>
                        <hr>
                        <?php
                    }
                } else {
                    ?>
                    <h2><?= getContentLanguageSelected('NO_RECORDS_FOUND', defaultSelectedLanguage()) ?></h2>
                <?php } ?>

            </div>
        </div>

        <!-- Expired Policies Option for Partner -->
        <div>
            <div class="mngPay">

                <?php
                if (!empty($expired_policies)) {
                    foreach ($expired_policies as $value) {
                        ?> 
                        <div class="payBox">
                            <div class="motorInsor">
                                <div class="dropdown moreOpt">
                                    <a data-toggle="dropdown" href="#"><img src="images/threedot.png"></a>
                                    <ul class="dropdown-menu">
                                        <li><?= base_url('user/report/' . $value['insurance_type_id'] . '/' . $value['insured_id']) ?><?= getContentLanguageSelected('VIEW_QUITTANCE', defaultSelectedLanguage()) ?></a></li>
                                        <li><a href="<?= base_url('user/downloadReport/' . $value['insurance_type_id'] . '/' . $value['insured_id']) ?>" target="_blank"><?= getContentLanguageSelected('DOWNLOAD_REPORT', defaultSelectedLanguage()) ?></a></li>
                                        <!-- <li><a href="#"><?= getContentLanguageSelected('VIEW_MORE', defaultSelectedLanguage()) ?></a></li> -->
                                    </ul>
                                </div>

                                <ul class="motList">
                                    <li><?= $value['company_name'] ?></li>
                                    <li><?= getInsuranceTypeName($value['insurance_type_id']) ?> Insurance</li>
                                </ul>
                            </div>

                            <div class="payBooking">
                                <ul>
                                    <li>
                                        <h3><?= getContentLanguageSelected('POLICY_ID', defaultSelectedLanguage()) ?></h3>
                                        <p><?= $value['policy_number'] ?></p>
                                    </li>
                                    <li>
                                        <h3><?= getContentLanguageSelected('CREATION_DATE', defaultSelectedLanguage()) ?></h3>
                                        <p><?= getCreatedAndExpirationDate($value['insurance_type_id'], $value['insured_id'])['start'] ?></p>
                                    </li>
                                    <li>
                                        <h3><?= getContentLanguageSelected('EXPIRATION_DATE', defaultSelectedLanguage()) ?></h3>
                                        <p><?= getCreatedAndExpirationDate($value['insurance_type_id'], $value['insured_id'])['end'] ?></p>
                                    </li>
                                    <li>
                                        <h3><?= getContentLanguageSelected('AMOUNT', defaultSelectedLanguage()) ?></h3>
                                        <p>$<?= $value['amount'] ?></p>
                                    </li>
                                    <li>
                                        <h3><?= getContentLanguageSelected('CREATED_FOR', defaultSelectedLanguage()) ?></h3>
                                        <p><?= $value['policy_created_for'] ?></p>
                                    </li>
                                    <li>
                                        <h3><?= getContentLanguageSelected('CUSTOMER_NAME', defaultSelectedLanguage()) ?></h3>
                                        <p><?= $value['customer_name'] ?></p>
                                    </li>
                                    <li>
                                        <a class="btnInvo" href="#"><?= getContentLanguageSelected('RENEW', defaultSelectedLanguage()) ?></a>
                                    </li>
                                </ul>
                                <div class="morCont">
                                    <ul>
                                        <!-- <li>
                                            <h3>Quittance Number</h3>
                                            <p>12400470</p>
                                        </li> -->
                                        <li>
                                            <h3><?= getContentLanguageSelected('NET_PREMIUM', defaultSelectedLanguage()) ?></h3>
                                            <p>15843</p>
                                        </li>
                                        <li>
                                            <h3><?= getContentLanguageSelected('ACCESSORIES', defaultSelectedLanguage()) ?></h3>
                                            <p>124470</p>
                                        </li>
                                        <li>
                                            <h3><?= getContentLanguageSelected('TAXES', defaultSelectedLanguage()) ?></h3>
                                            <p>$8780</p>
                                        </li>
                                    </ul>
                                </div>
                                <a class="plcDtl"><img src="<?= base_url('assets/front/') ?>images/arrow-bottom.png"></a>
                            </div>
                        </div>
                        <hr>
                        <?php
                    }
                } else {
                    ?>
                    <h2><?= getContentLanguageSelected('NO_RECORDS_FOUND', defaultSelectedLanguage()) ?></h2>
                <?php } ?>


            </div>
        </div>

        <!-- Slips Option for Partner -->
        <?php if ($user_role == 3) { ?>
            <div>
                <div class="mngPay">
                    <div class="col-md-4">
                        <label> <?=getContentLanguageSelected('SELECT_YEAR',defaultSelectedLanguage())?></label>
                        <?php
                        $data = ' id="get_year" class="form-control" ';
                        echo form_dropdown('year_selected', getYears(), set_value("year_selected"), $data);
                        ?>
                    </div>

                    <div class="col-md-4">
                        <label> <?=getContentLanguageSelected('SELECT_MONTH',defaultSelectedLanguage())?></label>
                        <?php
                        $data = ' id="get_month" class="form-control" ';
                        echo form_dropdown('month_selected', getMonths(), set_value("month_selected"), $data);
                        ?>
                    </div>

                    <div class="col-md-4">
                        <label> <?=getContentLanguageSelected('CREATED_BY',defaultSelectedLanguage())?></label>
                        <?php
                        $data = ' id="get_created" class="form-control" onChange="get_slip_detail()" ';
                        echo form_dropdown('get_created', getCreatedByForPartner(), set_value("get_created"), $data);
                        ?>
                    </div>

                </div>

                <div id="slip_record">

                </div>
            </div> 
        <?php } ?>
    </div>
<?php } ?>
</div>





</div>
</div> <!-- /#page-content-wrapper -->
</div> <!-- /#wrapper -->
<!-- Bootstrap core JavaScript -->


<div id="quittance_of_month" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <form enctype="multipart/form-data" method="post">
            <div class="modal-content modal_width">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4  class="modal-title" style="text-align-last: center"><?= getContentLanguageSelected('QUITTANCE_OF_MONTH', defaultSelectedLanguage()) ?></h4>
                </div>
                <div id="loading-image"  style="display:none;"></div>
                <div class="modal-body">
                    <input type="hidden" id="quittances_start_interval" value="">
                    <input type="hidden" id="quittances_end_interval" value="">
    <!--                 <input type="text" id="selected_branch" value="">
                    <input type="text" id="selected_company" value="">
                    <input type="text" id="policy_number_selected" value="">
                    <input type="text" id="company_policy_selected" value=""> -->
                    <div id="quittance_of_month_record"></div>
                </div>
                <div class="modal-footer">

                    <!-- <div id="policy_selected_total_amount"> Total Amount : 0</div> -->
                    <input type="file"  name="image" id="image"/>

                    <button type="button" id="send_month_quittance_company_site" class="btn btn-success"><?= getContentLanguageSelected('SEND', defaultSelectedLanguage()) ?></button>
                    <button type="button" class="btn btn-default" data-dismiss="modal"><?= getContentLanguageSelected('CLOSE', defaultSelectedLanguage()) ?></button>
                </div>
            </div>
        </form>
    </div>
</div>

<script type="text/javascript">

    // function to get the slips details
    function get_slip_detail() {
        var url = "<?php echo base_url('front/slip_detail'); ?>";
        var data = {'get_year': $('#get_year').val(),
            'get_month': $('#get_month').val(),
            'get_created': $('#get_created').val(),
            'company_id' : $('#company_id_slip').val()
        };
        $.ajax({
            type: 'post',
            url: url,
            data: data,
            success: function (data) {
                var dataJson = JSON.parse(data);
                var dataResult = '';
            for(var m = 0; m < dataJson.length; m++) {
                policy_num = Object.values(dataJson[m].policy_numbers)
                // console.log(policy_num.length);
                dataResult = dataResult + '<div class="slipTb"><div class="col-md-3">';
                dataResult = dataResult + '<img class="img-responsive" src=' + dataJson[m].cheque_path + '>';
                dataResult = dataResult + '</div>';
                dataResult = dataResult + '<div class="col-md-3">';
                dataResult = dataResult + '<label>';
                dataResult = dataResult + 'Slip Name';
                dataResult = dataResult + '</label>';
                dataResult = dataResult + '<p>';
                dataResult = dataResult + dataJson[m].slip_name;
                dataResult = dataResult + '</p>';
                dataResult = dataResult + '</div>';
                dataResult = dataResult + '<div class="col-md-3">';
                dataResult = dataResult + '<label>';
                dataResult = dataResult + 'Number of Policies';
                dataResult = dataResult + '</label>';
                dataResult = dataResult + '<p>';
                dataResult = dataResult + policy_num.length;
                dataResult = dataResult + '</p>';
                dataResult = dataResult + '</div>';
                dataResult = dataResult + '<div class="col-md-3">';
                dataResult = dataResult + '<label>';
                dataResult = dataResult + 'Attachment';
                dataResult = dataResult + '</label>';
                dataResult = dataResult + '<a href="front/download_file?file=' + dataJson[m].cheque_path + '"><i class="fa fa-download" title="Download Cheque"></i></a>';
                dataResult = dataResult + '</div></div>';




                // Other Details

                dataResult +=  '<div class="slipTb">';
                    dataResult +=  '<div class="col-md-2">';
                    dataResult +=  '<label>';
                    dataResult +=  'User Name';
                    dataResult +=  '</label>';
                    dataResult +=  '</div>';
                   

                    dataResult +=  '<div class="col-md-2">';
                    dataResult +=  '<label>';
                    dataResult +=  'Policy Number';
                    dataResult +=  '</label>';
                    dataResult +=  '</div>';
                    

                    dataResult +=  '<div class="col-md-2">';
                    dataResult +=  '<label>';
                    dataResult +=  'Net Premium';
                    dataResult +=  '</label>';
                    dataResult +=  '</div>';
                   

                    dataResult +=  '<div class="col-md-2">';
                    dataResult +=  '<label>';
                    dataResult +=  'Tax';
                    dataResult +=  '</label>';
                    dataResult +=  '</div>';
                   

                    dataResult +=  '<div class="col-md-2">';
                    dataResult +=  '<label>';
                    dataResult +=  'Accessories';
                    dataResult +=  '</label>';
                    dataResult +=  '</div>';
                   

                    dataResult +=  '<div class="col-md-2">';
                    dataResult +=  '<label>';
                    dataResult +=  'Total Amount';
                    dataResult +=  '</label>';
                    dataResult +=  '</div>';
                dataResult +=  '</div>';

                policy_data = Object.values(dataJson[m].policy_data);
                dataResult  = dataResult + '<div class="slipTb">';
                
                total_net_premium   = 0;
                total_tax           = 0;
                total_accessories   = 0;
                total_policy_amount = 0;
                for(var j = 0; j < policy_data.length;j++) {
                    dataResult = dataResult + '<div class="col-md-2">';
                   
                    dataResult = dataResult + '<p>';
                    dataResult = dataResult + policy_data[j].user_name;
                    dataResult = dataResult + '</p>';
                    dataResult = dataResult + '</div>';

                    dataResult = dataResult + '<div class="col-md-2">';
                    dataResult = dataResult + '<p>';
                    dataResult = dataResult + policy_data[j].policy_number;
                    dataResult = dataResult + '</p>';
                    dataResult = dataResult + '</div>';

                    dataResult = dataResult + '<div class="col-md-2">';
                    dataResult = dataResult + '<p>';
                    dataResult = dataResult + policy_data[j].net_premium;
                    dataResult = dataResult + '</p>';
                    dataResult = dataResult + '</div>';

                    dataResult = dataResult + '<div class="col-md-2">';
                    dataResult = dataResult + '<p>';
                    dataResult = dataResult + policy_data[j].tax;
                    dataResult = dataResult + '</p>';
                    dataResult = dataResult + '</div>';

                    dataResult = dataResult + '<div class="col-md-2">';
                    dataResult = dataResult + '<p>';
                    dataResult = dataResult + policy_data[j].accessories;
                    dataResult = dataResult + '</p>';
                    dataResult = dataResult + '</div>';

                    dataResult = dataResult + '<div class="col-md-2">';
                    dataResult = dataResult + '<p>';
                    dataResult = dataResult + policy_data[j].total_amount;
                    dataResult = dataResult + '</p>';
                    dataResult = dataResult + '</div>';

                    // Calculating the total amount
                    total_net_premium = total_net_premium + parseInt(policy_data[j].net_premium);
                    total_tax         = total_tax + parseInt(policy_data[j].tax);
                    total_accessories = total_accessories + parseInt(policy_data[j].accessories);
                    total_policy_amount = total_policy_amount + parseInt(policy_data[j].total_amount);
                }
                dataResult = dataResult + '</div>';


                dataResult +=  '<div class="slipTb">';
                    dataResult +=  '<div class="col-md-2">';
                    dataResult +=  '<label>';
                    dataResult +=  '';
                    dataResult +=  '</label>';
                    dataResult +=  '</div>';
                   

                    dataResult +=  '<div class="col-md-2">';
                    dataResult +=  '<label>';
                    dataResult +=  'Total';
                    dataResult +=  '</label>';
                    dataResult +=  '</div>';
                    

                    dataResult +=  '<div class="col-md-2">';
                    dataResult +=  '<label>';
                    dataResult +=  total_net_premium;
                    dataResult +=  '</label>';
                    dataResult +=  '</div>';
                   

                    dataResult +=  '<div class="col-md-2">';
                    dataResult +=  '<label>';
                    dataResult +=  total_tax;
                    dataResult +=  '</label>';
                    dataResult +=  '</div>';
                   

                    dataResult +=  '<div class="col-md-2">';
                    dataResult +=  '<label>';
                    dataResult +=  total_accessories;
                    dataResult +=  '</label>';
                    dataResult +=  '</div>';
                   

                    dataResult +=  '<div class="col-md-2">';
                    dataResult +=  '<label>';
                    dataResult +=  total_policy_amount;
                    dataResult +=  '</label>';
                    dataResult +=  '</div>';
                dataResult +=  '</div>';
            }


                $("#slip_record").html(dataResult);
            }
        });
    }
</script>
<script  src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<script>
    $(document).ready(function () {
        $('#get_quittance').click(function () {
            var insurance_start_date = $("#insurance_start_date").val();
            var insurance_end_date = $("#insurance_end_date").val();
            var dataString = 'start_date=' + insurance_start_date + '&end_date=' + insurance_end_date;
            if (insurance_start_date == '' || insurance_end_date == '') {
                alert("Please Fill All Fields");
            } else {
                $.ajax({
                    type: "POST",
                    url: "<?php echo base_url('front/get_quote'); ?>",
                    data: dataString,
                    cache: false,
                    success: function (result) {
                        var quittances_start_interval = $('#insurance_start_date').val();
                        var quittances_end_interval   = $('#insurance_end_date').val();
                        $('#quittances_start_interval').val(quittances_start_interval);
                        $('#quittances_end_interval').val(quittances_end_interval);
                        $("#quittance_of_month_record").html(result);
                        $("#quittance_of_month").modal('show');
                    }
                });
            }
            return false;


        });
    });
</script>
<script>
    $(document).ready(function () {
        $("body").on("click", ".add-more", function () {
            var html = $(".after-add-more").first().clone();
            $(html).find(".change").html("<label for=''>&nbsp;</label><br/><a class='btn btn-danger remove'>- Remove</a>");

            $(".after-add-more").last().after(html);
            $(".addMores").last().val('');

        });

        $("body").on("click", ".remove", function () {
            $(this).parents(".after-add-more").remove();
        });
    });
</script>


<script>
    // $(document).ready(function(){
        $("#ssubmit").click(function(){   
            let strId = $('#start_date').val();
            let endId = $('#end_date').val(); 
            let searchkey = $('#searchkey').val(); 
            
            //alert(searchkey);
            
            if (strId == '' && endId == '' && searchkey == '') {
                alert("Please select start date and end date!");
            }else if (strId == '' && searchkey == '') {
                alert("Please select start date!");
            }else if (endId == '' && searchkey == '') {
                alert("Please select end date!");
            }else {
                $.ajax({
                    type: "POST",
                    // dataType: "json",
                    url: "<?php echo base_url('auth/policyFetchByDate'); ?>",
                    data: { 'strId':strId,'endId':endId,'searchkey':searchkey },
                    cache: false,
                    success: function(result) {
                       var data = JSON.parse(result);
                       $('#policyData2').html('');
                       var html = '';
                        // console.log(data.length);
                        for(var i =0; i<data.length; i++) {
                            // alert(data[i].policy_number);
                            // console.log(data[i].policy_number);
                            html += '<tr><td>'+ data[i].date +'</td>'+
                                '<td>'+  data[i].policy_number +'</td>'+
                                '<td>'+  data[i].net_premium +'</td>'+
                                '<td>'+  data[i].accessories +'</td>'+
                                '<td>'+  data[i].admin_policy_commission +'</td>'+
                                '<td>'+  data[i].accessories_admin_share +'</td>'+
                                '<td>'+  data[i].tax +'</td>'+
                                '<td>'+  data[i].total_premium +'</td></tr>';
                                $('#policyData2').append(html);
                        }
                        // $('#policyData2').html(html);
                                       
                        
                    }
                });
            } 
            return false;   
            
        });

</script>


<script>
    $("#btn_payment_status").on("change", function(){
		var pymnts_id = $(this).val();
        // alert(pymnts_id);
        // if (pymnts_id == '') {
        //     alert("Please payment status!");
        // }else {
            $.ajax({
                url: "<?php echo base_url('auth/policyFetchByPaymentStatus'); ?>",
                method:"post",
                data:{pymnts_id:pymnts_id},
                cache: false,
                success: function(data){
                    var result = JSON.parse(data);
                    // alert(result.length);
                    
                       $('#policyData2').html('');
                       var html = '';
                        // console.log(data.length);
                        for(var i =0; i<result.length; i++) {
                            // alert(data[i].policy_number);
                            // console.log(data[i].policy_number);
                            html += '<tr><td>'+ result[i].date +'</td>'+
                                '<td>'+  result[i].policy_number +'</td>'+
                                '<td>'+  result[i].net_premium +'</td>'+
                                '<td>'+  result[i].accessories +'</td>'+
                                '<td>'+  result[i].admin_policy_commission +'</td>'+
                                '<td>'+  result[i].accessories_admin_share +'</td>'+
                                '<td>'+  result[i].tax +'</td>'+
                                '<td>'+  result[i].total_premium +'</td></tr>';
                                $('#policyData2').append(html);
                        }
                }
            });
        // }
    });
</script>