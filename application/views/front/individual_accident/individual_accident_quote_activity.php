<!-- Insurance -->
<section class="travelInsur"> <img src="<?= base_url();?>assets/front/images/accident-insurance.jpg" class="img-responsive insImg">
  <div class="container">
    <div class="row">
        <div class="col-xs-12 col-sm-8 col-sm-offset-4 col-md-6 col-md-offset-6">
        	<h1><?=getContentLanguageSelected('INDIVIDUAL_ACCIDENT_INSURANCE',defaultSelectedLanguage())?></h1>
	      	<div class="insureForm">
	      		<form method="post" action="">
		      		<div class="form-group">
	                   <label><?=getContentLanguageSelected('ACTIVITY',defaultSelectedLanguage())?><span class="required">*</span></label>
	                    <?php $data = ' class="form-control" input"  ';
	                      echo form_dropdown('individual_accident_activity_id',getIndividualAccidentActivityOptions('tbl_activity','Select Activity',1),set_value("individual_accident_activity_id"),$data);?>
	                   <?=form_error('individual_accident_activity_id'); ?>
	                </div>

	                <button type="submit" id=""><?=getContentLanguageSelected('SAVE_AND_PROCEED',defaultSelectedLanguage())?></button>
                </form>
	      	</div>
        </div>
  	</div>
	</div>
</section>