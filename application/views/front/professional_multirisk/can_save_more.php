<section class="insurForm">
<div class="container">
   <div class="formFildes">
      <div class="col-xs-12">
         <h3 class="carOwner">You Can Save More</h3>
      </div>


      <div class="col-xs-12">
      	<div class="gerSelectAll">   
      	    <form  method="post" enctype="multipart/form-data">
                  <input type="hidden" id="professional_multirisk_quote_id" name="professional_multirisk_quote_id" value="<?=$professional_multirisk_quote_id?>" >
                  <input type="hidden" id="warranties_selected_professional_multirisk" name="warranties_selected_professional_multirisk" value=<?=implode(",",$selected_warranty_name_id)?> >
                  <input type="hidden" id="franchises_selected_professional_multirisk" name="franchises_selected_professional_multirisk" value=<?=implode(",",$selected_franchise_name_id)?> >
      			<div class="form-group">
      				<label><?=getContentLanguageSelected('SELECT_COMPANIES',defaultSelectedLanguage())?><span class="required">*</span></label>
      				<?php $data = 'class="form-control multiselect"';
      					$company_id = $company_id;
      				   echo form_multiselect('company_id[]',getMultipleOptions('tbl_company','Select Company',1),set_value("company_id[]",$company_id),$data);?>
      				<?=form_error('company_id[0]'); ?>
      			</div>
                  <div class="reset-button">
                      <button class="btn btn-success" id="get_the_value"><?=getContentLanguageSelected('SUBMIT',defaultSelectedLanguage())?></button>
                  </div>
              </form>
      	</div>
      </div>


       
      <?php print_r($qwerty); ?>
      <div class="clearfix"></div>
   </div>
</div>
</section>
<hr>