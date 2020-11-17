<section class="insurForm">
   <div class="container">
      <form action="" method="post"  enctype="multipart/form-data">
         <div class="row">
            <div class="col-xs-12">
               <h3 class="title"><?=getContentLanguageSelected('MOTAR_INSURANCE',defaultSelectedLanguage())?></h3>
            </div>
         </div>

         

      <?php $upload= $this->session->flashdata('do_upload'); 
      if(!empty($upload)) { ?>
      <div class="panel panel-warning">
        <div class="panel-heading">
          <?php echo $this->session->flashdata('do_upload'); ?>
        </div>
      </div>
      <?php } ?>


         <div class="formFildes">
            <div class="col-xs-12">
               <h3 class="carOwner"><?=getContentLanguageSelected('CAR_OWNER_DETAILS',defaultSelectedLanguage())?></h3>
            </div>
            <div class="col-xs-12">
               <div class="form-group radioCheck">
                  <p><?=getContentLanguageSelected('ARE_YOU_THE_OWNER_OF_VEHICLE_?',defaultSelectedLanguage())?></p>
                  <label><input checked="checked" type="radio" selected="true" name="owner" value="1" ><?=getContentLanguageSelected('YES',defaultSelectedLanguage())?></label>
                  <label><input type="radio" name="owner" value="0" ><?=getContentLanguageSelected('NO',defaultSelectedLanguage())?></label>
                  <?=form_error('owner'); ?>
               </div>
            </div>
            <div class="col-xs-12 col-sm-6">
               <div class="form-group">
                  <label><?=getContentLanguageSelected('NAME',defaultSelectedLanguage())?><span class="required">*</span></label>
                  <input type="text" readonly id="user_id"  value="<?=getUserName($this->session->userdata('user_id'))?>" name="user_id" placeholder="<?=getContentLanguageSelected('NAME',defaultSelectedLanguage())?>">
                  <?=form_error('user_id'); ?>
               </div>
               <div class="form-group">
                  <label><?=getContentLanguageSelected('ADDRESS',defaultSelectedLanguage())?><span class="required">*</span></label>
                  <input type="text" id="address" name="address" placeholder="<?=getContentLanguageSelected('ADDRESS',defaultSelectedLanguage())?>">
                  <?=form_error('address'); ?>
               </div>
               <div class="form-group">
                  <label><?=getContentLanguageSelected('OWNER_DETAIL_IMAGE',defaultSelectedLanguage())?><span class="required">*</span></label>
                  <div class="selectFile">
                     <input type="file" name="image" id="image" placeholder="Choose Image ">
                     <p class="placeHolder"><?=getContentLanguageSelected('CHOOSE_IMAGE',defaultSelectedLanguage())?></p>
                  </div>
                  <?=form_error('image'); ?>
               </div>
            </div>
            <div class="col-xs-12 col-sm-6">
               <div class="form-group">
                  <label><?=getContentLanguageSelected('REGION',defaultSelectedLanguage())?><span class="required">*</span></label>
                  <?php $data = ' class="form-control input" onChange = "getDepartmentByRegionId(this.value);" ';
                     echo form_dropdown('region_id',getRegionOptions('tbl_region','Select Region',1),set_value("region_id"),$data);?>
                  <?=form_error('region_id'); ?>
               </div>
               <div class="form-group">
                  <label><?=getContentLanguageSelected('DEPARTMENT',defaultSelectedLanguage())?><span class="required">*</span></label>
                  <?php $data = ' class="form-control input" onChange = "getCommuneByDepartmentId(this.value);" id="department_by_region"';
                     echo form_dropdown('department_id',getDepartmentByRegionId(set_value('region_id')),set_value("department_id"),$data);?>
                  <?=form_error('department_id'); ?>
               </div>
               <div class="form-group">
                  <label><?=getContentLanguageSelected('COMMUNE',defaultSelectedLanguage())?><span class="required">*</span></label>
                  <?php $data = ' class="form-control input"  id="commune_by_department"';
                     echo form_dropdown('commune_id',getCommuneByDepartmentId(set_value('region_id')),set_value("commune_id"),$data);?>
                  <?=form_error('commune_id'); ?>
               </div>
            </div>
            <div class="col-xs-12">
               <div class="form-group inputCheck">
                  <input type="submit" value="Save And Proceed" class="subBtn">
                  <div class="clearfix"></div>
               </div>
            </div>
            <div class="clearfix"></div>
         </div>
      </form>
   </div>
</section>
<hr>