
<section class="topSlider">
    <div id="slider" class="owl-carousel">
        <?php
        if (!empty(getSliderImages())) {
            foreach (getSliderImages() as $value) {
                ?>
                <div><img src="<?= base_url() . '/' . $value->image; ?>"></div>
                <?php
            }
        } else {
            ?>       
            <div><img src="<?= base_url(); ?>assets/front/images/slider1.jpg"></div>
            <div><img src="<?= base_url(); ?>assets/front/images/slider2.jpg"></div>
        <?php } ?>
    </div>
    <div class="slidText">
        <div class="container">
            <h2><?= getContentLanguageSelected('WELCOME_TO', defaultSelectedLanguage()) ?>
                <span><?= getContentLanguageSelected('PROASSUR', defaultSelectedLanguage()) ?></span></h2>
            <p><?= getContentLanguageSelected('TITLE_TAG_LINE', defaultSelectedLanguage()) ?></p>
            <a href="#view_service" id="view_service_div"><?= getContentLanguageSelected('VIEW_ALL_SERVICES', defaultSelectedLanguage()) ?></a>
        </div>
    </div>
</section>


<section class="ourServis" id="view_service">
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <h3><?= getContentLanguageSelected('OUR_SERVICES', defaultSelectedLanguage()) ?></h3>
                <ul class="servicsCat">
                    <li><a href="<?= base_url(); ?>health-insurance">
                            <figure><img src="<?= base_url(); ?>assets/front/images/heart.png"></figure>
                            <p><?= getContentLanguageSelected('HEALTH', defaultSelectedLanguage()) ?><br><?= getContentLanguageSelected('INSURANCE', defaultSelectedLanguage()) ?></p>
                        </a></li>
                    <li><a href="<?= base_url(); ?>individual-accident">
                            <figure><img src="<?= base_url(); ?>assets/front/images/individual.png"></figure>
                            <p><?= getContentLanguageSelected('INDIVIDUAL', defaultSelectedLanguage()) ?><br><?= getContentLanguageSelected('ACCIDENT', defaultSelectedLanguage()) ?> <?= getContentLanguageSelected('INSURANCE', defaultSelectedLanguage()) ?></p>
                        </a></li>
                    <li><a href="<?= base_url(); ?>vehicle">
                            <figure><img src="<?= base_url(); ?>assets/front/images/motor.png"></figure>
                            <p><?= getContentLanguageSelected('MOTOR', defaultSelectedLanguage()) ?><br><?= getContentLanguageSelected('INSURANCE', defaultSelectedLanguage()) ?></p>
                        </a></li>
                    <li><a href="<?= base_url(); ?>housing">
                            <figure><img src="<?= base_url(); ?>assets/front/images/property.png"></figure>
                            <p><?= getContentLanguageSelected('HOUSE', defaultSelectedLanguage()) ?><br><?= getContentLanguageSelected('INSURANCE', defaultSelectedLanguage()) ?></p>
                        </a></li>
                    <li><a href="<?= base_url(); ?>credit">
                            <figure><img src="<?= base_url(); ?>assets/front/images/credit.png"></figure>
                            <p><?= getContentLanguageSelected('CREDIT', defaultSelectedLanguage()) ?><br><?= getContentLanguageSelected('INSURANCE', defaultSelectedLanguage()) ?></p>
                        </a></li>
                    <li><a href="<?= base_url(); ?>professional-multirisk">
                            <figure><img src="<?= base_url(); ?>assets/front/images/professional.png"></figure>
                            <p><?= getContentLanguageSelected('PROFESSIONAL', defaultSelectedLanguage()) ?><br><?= getContentLanguageSelected('MULTIRISK', defaultSelectedLanguage()) ?> <?= getContentLanguageSelected('INSURANCE', defaultSelectedLanguage()) ?></p>
                        </a></li>
                    <li><a href="<?= base_url(); ?>travel">
                            <figure><img src="<?= base_url(); ?>assets/front/images/travel.png"></figure>
                            <p><?= getContentLanguageSelected('TRAVEL', defaultSelectedLanguage()) ?><br><?= getContentLanguageSelected('INSURANCE', defaultSelectedLanguage()) ?></p>
                        </a></li>
                </ul>
            </div>
        </div>
    </div>
</section>


<section class="aboutSet" id="about_us">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <h3 class="title"><?= $aboutus->name ?></h3>
                <?= $aboutus->description ?>
                <a class="watVid" href="#" data-toggle="modal" data-target="#vidPop"><img src="<?= base_url(); ?>assets/front/images/video-link.png"><?= getContentLanguageSelected('WATCH_VIDEO', defaultSelectedLanguage()) ?></a>

            </div>
            <div class="col-md-5 col-md-offset-1">
                <figure><img src="<?= base_url(); ?>assets/front/images/about-img.png" class="img-responsive"></figure>
            </div>
        </div>
    </div>
</section>


<section class="clientSay">
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <h3 class="title"><?= getContentLanguageSelected('WHAT_CLIENT_SAY', defaultSelectedLanguage()) ?></h3>
                <p class="subTitle">This is Photoshop's version of Lorem Ipsum. Proin gravida nibh vel velit auctor aliquet. Sollicitudin lorem quis bibendum auctor.</p>

                <div id="owl-demo" class="owl-carousel">

                    <?php
                    // print_r($testimonials);

                    foreach ($testimonials as $key => $value) {
                        ?>
                        <div class="item">
                            <div class="col-xs-12">
                                <div class="clntSayBox">
                                    <div class="sayBox">
                                        <h3><?= $value->name ?></h3>
                                        <p class="clntName"><?= $value->designation ?></p>
                                        <p><?= $value->message ?></p>
                                    </div>
                                    <?php if (!empty($value->image)) { ?>
                                        <figure><img src="<?= base_url() . $value->image; ?>"></figure>    
                                    <?php } else {
                                        ?>
                                        <figure><img src="<?= base_url(); ?>assets/front/images/clint-say.png"></figure>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                    <?php }
                    ?>




                </div>

            </div>
        </div>
    </div>
</section>


<section class="ourPartner">
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <h3 class="title"><?= getContentLanguageSelected('PARTNERS_TITTLE', defaultSelectedLanguage()) ?></h3>
                <p class="subTitle"><?= getContentLanguageSelected('PARTNERS_DESCRIPTION', defaultSelectedLanguage()) ?></p>


                <div id="partner" class="owl-carousel">
                    <?php foreach ($partners as $key => $value) { ?>
                        <div class="item"><figure>
                                <?=
                                !empty($value->image) ?
                                        '<img src=' . base_url($value->image) . ' class="img-responsive">' :
                                        '<img src=' . base_url("assets/front/images/image-coming-soon.jpg") . ' class="img-responsive">'
                                ?>
                            </figure></div>
                    <?php } ?>
                </div>


            </div>
        </div>
    </div>
</section>


<section class="newsLetter">
    <div class="container">
        <div class="row">
            <div class="col-xs-12 col-sm-10 col-sm-offset-1">
                <h3 class="title"><?= getContentLanguageSelected('SUBSCRIBE_TO_OUR_NEWSLETTER', defaultSelectedLanguage()) ?></h3>
                <span class="success_news"></span>
                <span id="blank_error_msg"></span>               
                <span id="error_msg"></span>
                <div class="subScrib">
                    <form>
                        <input type="email" name="email" id="email" placeholder="Your Email Address" class="inputFild">
                        <input type="button" id="subscribe" value="SUBSCRIBE" class="submitBtn">
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<script  src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<script>
    $(document).ready(function () {
        $('#subscribe').click(function () {
            var email = $("#email").val();

            var dataString = 'email=' + email;
            if (email == '') {
                $('#blank_error_msg').html('<div class="alert alert-danger"> Please Fill the Email Address</div>');
                $('#error_msg').html('');
            } else {
                $('#blank_error_msg').html('');
                $.ajax({
                    type  : "POST",
                    url   : "<?php echo base_url('front/newsletter'); ?>",
                    data  : dataString,
                    cache : false,
                    success: function (result) {
                        var response = JSON.parse(result);
                        if(response.status == 'failed') {
                            $('#error_msg').html(response.error_message);
                        } else {
                            $('#error_msg').html('');
                            $(".success_news").html(response.success_message);
                            $('#email').val('');
                             $("#success").fadeTo(2000, 500).slideUp(500, function () {
                                $("#success").slideUp(500);
                            });
                        }
                    }
                });
            }
            return false;


        });
    });
</script>


<!-- Modal -->
  <div class="modal fade" id="vidPop" role="dialog">
    <div class="modal-dialog modal-lg">
    
      <!-- Modal content-->
      <div class="modal-content">
      <button type="button" class="close" data-dismiss="modal">&times;</button>
        <div class="modal-body">
          <iframe width="100%" height="400" src="<?= getVideoUrl()?>" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
        </div>
      </div>
      
    </div>
  </div>
<!-- Modal -->