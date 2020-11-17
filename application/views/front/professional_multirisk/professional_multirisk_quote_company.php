<section class="insurForm">
	<div class="container">
    	<div class="row">
        	<div class="col-xs-12">
        		<h3 class="title"><?=getContentLanguageSelected('PROFESSIONAL_MULTIRISK_INSURANCE',defaultSelectedLanguage())?></h3>
            </div>
        </div>
         
         
        <div class="formFildes">
         	<div class="col-xs-12">
         		<h3 class="planTitle">Select the best offer:</h3>
            </div>
            
                <?php foreach ($company_id_array as $company_id) { ?>
                    <div class="col-xs-6 col-md-4 xs12">
                    	<div class="selectPlan">
                            <label><input type="radio" class="select_professional_multirisk_company" name="select_professional_multirisk_company" professional_multirisk_quote_id="<?= $professional_multirisk_quote_id;?>" value="<?= $company_id;?>" >
                            <!-- <h3>12,500</h3> -->
                            <p class="planName"><?= getCompanyName($company_id)?> </p></label>
                        </div>
                    </div>
                <?php } ?>
                <div class="col-xs-12">
                    <div id="selected_professional_multirisk_company_message"></div>
                    <input type="hidden" name="selected_professional_multirisk_company" id="selected_professional_multirisk_company" value="">
                    <input type="hidden" name="professional_multirisk_quote_id" id="professional_multirisk_quote_id" value="<?= $professional_multirisk_quote_id;?>">
                </div>
                <div class="col-xs-12">
                	<input type="button" id="get_professional_multirisk_company" value="<?=getContentLanguageSelected('SAVE_AND_PROCEED',defaultSelectedLanguage())?>" class="subBtn">
                </div>
            
            <div class="clearfix"></div>
        </div>
        
        </div>
</section>