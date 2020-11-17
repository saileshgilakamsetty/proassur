
<section class="insurForm">
  	<div class="container">
	    <div class="row">
	      	<div class="col-xs-12">
	      		<h3 class="title"><?=getContentLanguageSelected('TRAVEL_INSURANCE',defaultSelectedLanguage())?></h3>
	      	</div>
	  	</div>
  	</div>

  	<div class="container">
  		<div class="formFildes">
  			<div class="col-xs-12 policyCalc">
  				<div id="message"></div>
	            <div>
	               <input type="hidden" name="travel_id" id="travel_id" value="<?=$travel_id?>">
	            </div>
  				<?php
					print_r($travel_estimation);
				?>
				<div class="col-xs-12 text-center">
		            <input value="<?=getContentLanguageSelected('FINALIZE_COMPANY',defaultSelectedLanguage())?>" class="subBtn" id="finalize_company_travel" type="submit">
		        </div>
		    </div>
  			<div class="clearfix"></div>
  		</div>
  	</div>

</section>
