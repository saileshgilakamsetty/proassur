<?php
$user_role = $this->session->userdata('role');
//die;
?>
<div id="wrapper" class="toggled">
    <div id="sidebar-wrapper">
        <div class="logo">
            <a href="<?= base_url(); ?>">
                <img src="<?= base_url(); ?>assets/front/images/dashbaord/logo.png">
            </a>
        </div>
        <div class="axa-logo">
            <figure>
                <img src="<?= getUserImageUrl($this->session->userdata('user_id')) ?>" >
            </figure>
            <figcaption><?= getUserName($this->session->userdata('user_id')) ?></figcaption>
        </div>
        <ul class="sidebar-nav">
            <li> <a href="<?= base_url('dashboard') ?>" class="active"><?= getContentLanguageSelected('DASHBOARD', defaultSelectedLanguage()) ?></a> </li>
            <li> <a href="<?php echo base_url('dashboard') ?>"><?= getContentLanguageSelected('INSURANCE_POLICIES', defaultSelectedLanguage()) ?></a> </li>
            <li> <a href="<?= base_url('claim') ?>"><?= getContentLanguageSelected('INSURANCE_CLAIMS', defaultSelectedLanguage()) ?></a> </li>
            <?php if ($user_role == 4) { ?>
				<li> <a href="<?= base_url('user/company_quittances') ?>"><?= getContentLanguageSelected('MANAGE_QUITTANCES', defaultSelectedLanguage()) ?></a> </li>
                <li> <a href="<?= base_url('question') ?>"><?= getContentLanguageSelected('QUESTIONNARIES', defaultSelectedLanguage()) ?></a> </li>
                <li> <a href="<?php echo base_url('user/insurance_settings') ?>"><?= getContentLanguageSelected('INSURANCE_SETTINGS', defaultSelectedLanguage()) ?></a> </li>
                <li> <a href="<?php echo base_url('user/manage_payment') ?>"><?= getContentLanguageSelected('MANAGE_PAYMENT', defaultSelectedLanguage()) ?></a> </li>
                <li> <a href="<?= base_url('user/hospitalization_approval') ?>"><?= getContentLanguageSelected('HOSPITALIZATION_APPROVAL', defaultSelectedLanguage()) ?></a> </li>
            <?php } ?>
<!-- <li> <a href="#"><?= getContentLanguageSelected('POLICY_APPROVALS', defaultSelectedLanguage()) ?></a> </li>-->
            <?php if ($user_role == 3 || $user_role == 2) { ?>
                <li> <a href="<?php echo base_url('user/manage_transaction') ?>"><?= getContentLanguageSelected('MANAGE_TRANSACTION_HISTORY', defaultSelectedLanguage()) ?></a> </li>
                <li> <a href="<?php echo base_url('user/hospitalization_management') ?>"><?= getContentLanguageSelected('HOSPITALIZATION_MANAGEMENT', defaultSelectedLanguage()) ?></a> </li>
<?php } ?>

<!--  <li> <a href="#"><?= getContentLanguageSelected('PAYMENTS', defaultSelectedLanguage()) ?></a> </li> -->
<!--  <li> <a href="#"><?= getContentLanguageSelected('QUESTIONNARIES', defaultSelectedLanguage()) ?></a> </li> -->
        </ul>
    </div> <!-- /#sidebar-wrapper -->

    <div id="page-content-wrapper">
        <a href="#menu-toggle" id="menu-toggle" class="navbar-brand">
            <img src="<?= base_url(); ?>assets/front/images/dashbaord/bar.png">
        </a>
        <div class="container-fluid">
