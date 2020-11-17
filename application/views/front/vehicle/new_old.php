<section class="motorInsur">
<img src="<?=base_url(); ?>/assets/front/images/motor-insurance.png" class="motorImg">
	<div class="container">
    	<div class="row">
        	<div class="col-xs-12 col-sm-8 col-sm-offset-4 col-md-6 col-md-offset-6">
            		<h3 class="title"><?=getContentLanguageSelected('MOTAR_INSURANCE',defaultSelectedLanguage())?></h3>

                        <?php $success= $this->session->flashdata('message'); 
                        if(!empty($success)) { ?>
                        <div class="panel panel-warning">
                          <div class="panel-heading">
                            <?php echo $this->session->flashdata('message'); ?>
                          </div>
                        </div>
                        <?php } ?>

                    <div class="quckDetail">
                        <form action="" method="post" id="new_old_submit">
                        	<label><?=getContentLanguageSelected('FOR_QUICK_DETAILS',defaultSelectedLanguage())?></label>
                            <input type="text" name="car_number" id="car_number" placeholder="<?=getContentLanguageSelected('PLEASE_ENTER_CAR_NUMBER',defaultSelectedLanguage())?>">
                            <input type="button" name="quick_details" id="quick_details" value="SUBMIT">
                                 <?=form_error('car_number'); ?>
                        </form>
                        <div class="orLine">
                        	<span><?=getContentLanguageSelected('OR',defaultSelectedLanguage())?></span>
                        </div>
                        <p class="text-center"><?=getContentLanguageSelected('BRAND_NEW_CAR?',defaultSelectedLanguage())?> <a href="<?=base_url('vehicle/basic-info')?>"><?=getContentLanguageSelected('CLICK_HERE',defaultSelectedLanguage())?></a></p>
                    </div>
            </div>
        </div>
    </div>
</section>

<hr>
