
<section class="insurForm">
  	<div class="container">
	    <div class="row">
	      	<div class="col-xs-12">
	      		<h3 class="title"><?=getContentLanguageSelected('HEALTH_INSURANCE',defaultSelectedLanguage())?></h3>
	      	</div>
	  	</div>
  	</div>

  	<div class="container">
  		<div class="formFildes">
  			<div class="col-xs-12 policyCalc">
  				<div id="message"></div>
	            <div>
	              <input type="hidden" name="health_insurance_id" id="health_insurance_id" value="<?=$health_insurance_id?>">
	            </div>
				<?php print_r($claim_reimbursement_rate_array); ?>
  				<?php print_r($qwerty); ?>
				<div class="col-xs-12 text-center">
		            <input value="<?=getContentLanguageSelected('FINALIZE_COMPANY',defaultSelectedLanguage())?>" class="subBtn" id="finalize_company_health_insurance" type="submit">
		        </div>
		    </div>
  			<div class="clearfix"></div>
  		</div>
  	</div>

</section>
