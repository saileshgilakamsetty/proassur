<footer id="contact_us">
    <aside class="footer">
        <div class="container">
            <div class="row">
            
                <div class="col-xs-12 col-sm-4 col-md-5 col-lg-4">
                    <div class="futAbout">
                        <figure><a href="<?= base_url()?>"><img src="<?=base_url(); ?>/assets/front/images/logo.png" class="img-responsive"></a></figure>
                        <p>PROASSUR SA S.A. au capital de F CFA 10.000.000 entièrement libéré - Point E, avenue Birago Diop x Mosquée – Dakar Sénégal</p>
                    </div>
                </div>
                
                <div class="col-xs-6 col-sm-2 col-md-2 col-lg-2">
                    <h3><?=getContentLanguageSelected('PARTNERS',defaultSelectedLanguage())?></h3>
                    <ul>
                        <?php
                            foreach ($partners as $key => $value) { if($key == 6) break;?>
                                <li><?= $value->name;?></li>
                            <?php }
                        ?>
                        <!-- <li><a href="#">Lorem Ipsum</a></li>
                        <li><a href="#">Dolor Sit</a></li>
                        <li><a href="#">Amet Consectetor</a></li>
                        <li><a href="#">Lorem Ipsum</a></li>
                        <li><a href="#">Dolor Sit</a></li>
                        <li><a href="#">Amet Consectetor</a></li> -->
                    </ul>
                </div>
                
                <div class="col-xs-6 col-sm-2 col-md-2 col-lg-2">
                    <h3><?=getContentLanguageSelected('OUR_POLICY',defaultSelectedLanguage())?></h3>
                    <ul>
                        <li><a href="<?php echo base_url('terms-condition') ?>"><?=getContentLanguageSelected('TERMS_AND_CONDITIONS',defaultSelectedLanguage())?></a></li>
                        <li><a href="<?php echo base_url('privacy-policy') ?>"><?=getContentLanguageSelected('PRIVACY_POLICY',defaultSelectedLanguage())?></a></li>
                    </ul>
                </div>
                
                <div class="col-xs-12 col-sm-4 col-md-3 col-lg-4">
                    <h3><?=getContentLanguageSelected('CONTACT_US',defaultSelectedLanguage())?></h3>
                    <address>
                        <p><i class="fas fa-map-marker-alt"></i> RC N°SN DKR 2008 B 4492 - NINEA N° 29784292V3 - Agrément du Ministère des Finances n°06062/MEF/DA</p>
                        <p><i class="fas fa-envelope"></i> <a href="mailto:proassur@orange.sn">proassur@orange.sn</a></p>
                        <!-- <a href="#">martketing@unitedmissions.com</a></p> -->
                        <p><i class="fas fa-phone"></i><span>221 33 825 50 50</span></p>
                        <p><i class="fas fa-fax"></i><span>221 33 825 23 46</span></p>
                    </address>
                </div>
                
            </div>
        </div>
    </aside>
    
    <aside class="copyRight">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-sm-6">
                    <p>&copy <?=getContentLanguageSelected('COPYRIGHT',defaultSelectedLanguage())?> <?=date('Y') ?> <?=getContentLanguageSelected('PROASSUR',defaultSelectedLanguage())?></p>
                </div>
                <div class="col-xs-12 col-sm-6">
                    <ul class="futSocal">
                        <li><a href="<?=getSocialLinks('facebook')?>"><i class="fab fa-facebook"></i></a></li>
                        <li><a href="<?=getSocialLinks('linkedin')?>"><i class="fab fa-linkedin"></i></a></li>
                        <li><a href="<?=getSocialLinks('twitter')?>"><i class="fab fa-twitter-square"></i></a></li>
                    </ul>
                </div>
            </div>
        </div>
    </aside>
</footer>
