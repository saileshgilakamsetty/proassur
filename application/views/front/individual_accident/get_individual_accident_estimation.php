
<section class="insurForm">
  	<div class="container">
	    <div class="row">
	      	<div class="col-xs-12">
	      		<h3 class="title"><?=getContentLanguageSelected('INDIVIDUAL_ACCIDENT_INSURANCE',defaultSelectedLanguage())?></h3>
	      	</div>
	  	</div>
  	</div>

  	<div class="container">
  		<div class="formFildes">
  			<div class="col-xs-12 policyCalc">
  				<div id="message"></div>
	            <div>
	              <input type="hidden" name="individual_insurance_option_details_id" id="individual_insurance_option_details_id" value="<?=$individual_insurance_option_details_id?>">
	            </div>
  				<?php
					print_r($qwerty);
				?>
				<div class="col-xs-12 text-center">
		            <input value="<?=getContentLanguageSelected('FINALIZE_COMPANY',defaultSelectedLanguage())?>" class="subBtn" id="finalize_company_individual_accident" type="submit">
		        </div>
		    </div>
  			<div class="clearfix"></div>
  		</div>
  	</div>

</section>
