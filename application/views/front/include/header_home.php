<!-- header -->
<header>
    <div class="headTop">
        <div class="container">
            <div class="row">
                <div class="col-xs-12">
                    <ul class="topContact">
                        <li><a href="mailto:<?= getSettings('support_email')?>"><i class="fas fa-envelope"></i> <?= getSettings('support_email') ?></a></li>
                        <li><a href="tel:<?= getSettings('support_contact_code') ?> <?= getSettings('support_contact') ?>"><i class="fas fa-phone"></i> <?= getSettings('support_contact_code') ?> <?= getSettings('support_contact') ?></a></li>
                    </ul>
                    <div class="language">
                        <ul>
                            <li><a <?php if (defaultSelectedLanguage() == 1) { ?> class="active" <?php } ?> href="javascript:void(0);" onclick = "changeLanguage(1)"><img src="<?= base_url(); ?>/assets/front/images/english.png" class="img-responsive"></a></li>
                            <li><a <?php if (defaultSelectedLanguage() == 2) { ?> class="active" <?php } ?> href="javascript:void(0);" onclick = "changeLanguage(2)" ><img src="<?= base_url(); ?>/assets/front/images/french.png" class="img-responsive"></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-xs-12 col-sm-3">
                <figure class="topLogo"><a href="<?= base_url(); ?>"><img src="<?= base_url(); ?>/assets/front/images/logo.png" class="img-responsive"></a></figure>
            </div>
            <div class="col-xs-12 col-sm-9">
                <div id="cssmenu">
                    <ul>
                        <li class="<?php echo  ($this->uri->segment(1)) == '' ? 'active' : ''; ?>" class="active"><a href=""><?= getContentLanguageSelected('HOME', defaultSelectedLanguage()) ?></a></li>
                        <li><a href="#about_us" id="about_div"><?= getContentLanguageSelected('ABOUT_US', defaultSelectedLanguage()) ?></a></li>
                        <li><a href="#view_service" id="view_service_div"><?= getContentLanguageSelected('SERVICES', defaultSelectedLanguage()) ?></a></li>
                        <li><a href="<?= base_url('dashboard') ?>"><?= getContentLanguageSelected('RAISE_CLAIM', defaultSelectedLanguage()) ?></a></li>
                        <li><a href="#contact_us" id = "contact_us_div"><?= getContentLanguageSelected('CONTACT_US', defaultSelectedLanguage()) ?></a></li>

                        <?php
                        $user_id = $this->session->userdata('user_id');
                        if (!empty($user_id)) {
                            ?>
                            <li class="signBtn"><a href="<?= base_url() ?>auth/logout"><strong><?= getContentLanguageSelected('LOGOUT', defaultSelectedLanguage()) ?></strong></a></li>
                        <?php } else {
                            ?>
                            <li><a href="<?= base_url() ?>auth/login"><strong><?= getContentLanguageSelected('LOGIN', defaultSelectedLanguage()) ?></strong></a></li>
                            <li class="signBtn"><a href="<?= base_url() ?>auth/signup"><strong><?= getContentLanguageSelected('SIGNUP', defaultSelectedLanguage()) ?></strong></a></li>                  
                                    <?php } ?>

                    </ul>
                </div>
            </div>
        </div>
    </div>
</header>
<!-- header -->