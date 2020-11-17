<?php
//$transaction_id = random_string('numeric', 5);

if($user_payment_data['payment_status'] == 0) {
    $payment_status = 'Pending';
} else if($user_payment_data['payment_status'] == 1) {
    $payment_status = 'Failed';
} else if($user_payment_data['payment_status'] == 2) {
    $payment_status = 'Success';
} else {
    $payment_status = 'Expired';
}
//echo '<pre>';
//print_r($user_payment_data);
//die;
?>
<?php
    if(isset($_POST)) {
        print_r($_POST);
    }

?>
<div class="content-wrapper">

    <section class="content-header">
        <div class="header-icon">
            <i class="pe-7s-box1"></i>
        </div>
        <div class="header-title">
            <h1><?= getContentLanguageSelected('PAYMENT', defaultSelectedLanguage()) ?></h1>
            <small><?= getContentLanguageSelected('PAYMENT', defaultSelectedLanguage()) ?></small>
            <ol class="breadcrumb hidden-xs">
                <li><a href="<?= base_url('admin/dashboard'); ?>"><i class="pe-7s-home"></i><?= getContentLanguageSelected('HOME', defaultSelectedLanguage()) ?></a></li>
                <li class="active"><?= getContentLanguageSelected('PAYMENT', defaultSelectedLanguage()) ?></li>
            </ol>
        </div>
    </section>


    <section class="content">
        <div class="row">
            <div class="col-sm-12">
                <div class="panel panel-bd">
                    <?php $success= $this->session->flashdata('message'); 
                        if(!empty($success)) { ?>
                        <div class="panel panel-success">
                          <div class="panel-heading">
                            <?php echo $this->session->flashdata('message'); ?>
                          </div>
                        </div>
                    <?php } ?>
                    <div class="panel-heading">
                        <h2><?= getContentLanguageSelected('REQUIRED_DETAILS_FOR_PAYMENT', defaultSelectedLanguage()) ?></h2>
                    </div>
                    <input type="hidden" id="insurance_type_id" value="<?= $user_payment_data['insurance_type_id'] ?>">
                    <input type="hidden" id="user_id" value="<?= $user_payment_data['user_id'] ?>">
                    <input type="hidden" id="insured_id" value="<?= $user_payment_data['insured_id'] ?>">
                    <input type="hidden" id="amount" value="<?= $user_payment_data['amount'] ?>">
                    <input type="hidden" id="accessories_id" value="<?= $user_payment_data['accessories_id'] ?>">
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table id="example2" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th><?= getContentLanguageSelected('PAYMENT_METHOD', defaultSelectedLanguage()) ?></th>
                                        <th><?= getContentLanguageSelected('REQUIRED_DETAILS', defaultSelectedLanguage()) ?></th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>

                                    <tr>
                                        <td class="select_payment_method" value="0">
                                            <?php
                                            $dateh        = date('c');
                                            $identifiant  = md5("2214926760");
                                            $ref_commande = "OM201905WEBP045";
                                            $site         = md5("1311893837");
                                            //$total = $user_payment_data['amount'];
                                            $total        = 100;
                                            $commande     = " TEST Paiement par Orange Money";
                                            $algo         = "SHA512";
                                            $cle_secrete  = "4B820041902C84D1AB6D9E69960CAFA79231A90A3BFA4358ED69E2CA517872E2";
                                            $cle_bin      = pack("H*", $cle_secrete);
                                            $message      = "S2M_COMMANDE=$commande" .
                                                            "&S2M_DATEH=$dateh" .
                                                            "&S2M_HTYPE=$algo" .
                                                            "&S2M_IDENTIFIANT=$identifiant" .
                                                            "&S2M_REF_COMMANDE=$ref_commande" .
                                                            "&S2M_SITE=$site" .
                                                            "&S2M_TOTAL=$total";
                                            $hmac         = strtoupper(hash_hmac(strtolower($algo), $message, $cle_bin));
                                            ?>
                                            <form method = "POST" id = "orangepay_form" action = "https://api.paiementorangemoney.com">
                                                <input type="hidden" name="S2M_IDENTIFIANT" value="<?php echo $identifiant; ?>">
                                                <input type="hidden" name="S2M_SITE" value="<?php echo $site; ?>">
                                                <input type="hidden" name="S2M_TOTAL" value="<?php echo $total; ?>">
                                                <input type="hidden" name="S2M_REF_COMMANDE" value="<?php echo $ref_commande; ?>">
                                                <input type="hidden" name="S2M_COMMANDE" value="<?php echo $commande; ?>">
                                                <input type="hidden" name="S2M_DATEH" value="<?php echo $dateh; ?>">
                                                <input type="hidden" name="S2M_HTYPE" value="<?php echo $algo; ?>">
                                                <input type="hidden" name="S2M_HMAC" value="<?php echo $hmac; ?>">
                                                <input type="submit" name="Orange Pay" value="Orange Pay" alt="Payer"  />
                                            </form>
                                        </td>
                                        <td><?= getContentLanguageSelected('USER_NAME', defaultSelectedLanguage()) ?></td>
                                        <td><?= getUserName($user_payment_data['user_id']) ?></td>
                                    </tr>
                
                                    <tr>
                                        <td class="select_payment_method" value="1" >
                                            <form method="POST" id="waripay_form" action="<?php echo  base_url('wariPay'); ?>">    
                                                <input type="hidden" name="id" value="<?php echo $payment_id; ?>">                                            
                                                <input type="submit" name="Wari Pay" value=" Wari Pay" alt="Payer" />
                                            </form>
                                        </td>
                                        <td><?= getContentLanguageSelected('AMOUNT', defaultSelectedLanguage()) ?></td>
                                        <td><?= $user_payment_data['amount'] ?></td>
                                    </tr>
                                    <tr>
                                        <td class="select_payment_method" value="2" ><?php echo $jula_form;?></td>
                                        <td><?= getContentLanguageSelected('PAYMENT_STATUS', defaultSelectedLanguage()) ?></td>
                                        <td><?= $payment_status ?></td>
                                    </tr>
                                    <tr>
                                        <td class="select_payment_method" value="3" >Cash</td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td class="select_payment_method" value="4" >Cheque</td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>