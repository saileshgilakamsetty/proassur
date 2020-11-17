<section class="insurForm">
<div class="container">
   <div class="formFildes">
      <div class="col-xs-12">
         <h3 class="carOwner">You Can Save More</h3>
      </div>

      <?php foreach ($selected_warranty_name_id as $key => $value) {
         $warrantyname_id[] = $value['warranty_name_id'];
      } ?>
      <div class="col-xs-12">
      	<div class="gerSelectAll">   
      	    <form  method="post" enctype="multipart/form-data">
                  <input type="hidden" id="credit_detail_id" name="credit_detail_id" value="<?=$credit_detail_id?>" >
                  <input type="hidden" id="warranties_selected_credit" name="warranties_selected_credit" value="<?=implode(",",$warrantyname_id)?>" >
               <div class="col-md-8">
         			<div class="form-group">
         				<label><?=getContentLanguageSelected('SELECT_COMPANIES',defaultSelectedLanguage())?><span class="required">*</span></label>
         				<?php $data = 'class="form-control multiselect"';
         					$company_id = $company_id;
         				   echo form_multiselect('company_id[]',getMultipleOptions('tbl_company','Select Company',1),set_value("company_id[]",$company_id),$data);?>
         				<?=form_error('company_id[0]'); ?>
         			</div>
               </div>
               <div class="col-md-4">
                  <div class="reset-button">
                     <button class="btn btn-success" id="get_the_value"><?=getContentLanguageSelected('SUBMIT',defaultSelectedLanguage())?></button>
                  </div>
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