<div class="content-wrapper">
   <?php //print_r($dataCollection); ?>
   <section class="content-header">
      <div class="header-icon">
         <i class="pe-7s-note2"></i>
      </div>
      <div class="header-title">
         <h1>Company</h1>
         <small>Company Edit</small>
         <ol class="breadcrumb hidden-xs">
            <li><a href="<?=base_url('admin/dashboard');?>"><i class="pe-7s-home"></i> Home</a></li>
            <li class="active">company</li>
         </ol>
      </div>
   </section>
   <section class="content">
      <div class="row">
         <div class="col-sm-12">
            <div class="panel panel-bd">
               <div class="panel-heading">
                  <div class="btn-group"> 
                     <a class="btn btn-primary" href="<?=base_url('admin/company/lists')?>"> <i class="fa fa-list"></i>  Company List</a>  
                  </div>
               </div>
               <div class="panel-body">
                  <form  method="post" enctype="multipart/form-data">

                     <div class="col-md-6" >
                        <div class="form-group">
                           <label> Name<span class="required">*</span></label>
                           <input type="text" class="form-control" name="name" id="name" placeholder="Name" value="<?=set_value('name', isset($dataCollection->name)?$dataCollection->name:""); ?>" >
                           <?=form_error('name'); ?>
                        </div>

        
                        <div class="form-group">
                           <label>Phone Number<span class="required">*</span></label>
                           <input type="text" class="form-control" name="mobile" id="mobile" placeholder="Enter Mobile" value="<?=set_value('mobile', isset($dataCollection->mobile)?$dataCollection->mobile:""); ?>">
                           <?=form_error('mobile'); ?>
                        </div>
 
                        <div class="form-group">
                           <label>Email<span class="required">*</span></label>
                           <input type="text" class="form-control" name="email" id="email" placeholder="Enter Email" value="<?=set_value('email', isset($dataCollection->email)?$dataCollection->email:""); ?>" readonly="true" >
                           <?=form_error('email'); ?>
                        </div>

                        <div class="form-check">
                           <label>Status</label><br>
                           <label class="radio-inline">
                           <?php $status=$dataCollection->status ?>
                           <input type="radio" name="status" value="1" <?php if($status==1) { ?>  checked="checked" <?php } ?>>Active</label>
                           <label class="radio-inline"><input type="radio" name="status" value="0" <?php if($status==0) { ?>  checked="checked" <?php } ?>>Inctive</label>
                        </div>


                        <div class="form-group">
                           <input type="file"  name="image" id="image"/>
                           <div class="pull-right"> 
                              <?php echo $dataCollectionImage; ?>
                           </div>
                        </div>

                     </div>
                     <div class="col-sm-6">
                        <div class="form-group">
                           <label for="location">Address<span class="required">*</span></label>
                           <input type="text" class="form-control" id="site_location" name="site_location" value="<?=set_value('address', isset($dataCollection->address)?$dataCollection->address:""); ?>">
                           <?=form_error('site_location'); ?>
                        </div>

                        <div class="control-group">
                           <label for="disabled-input" class="control-label ">Country<span class="required">*</span></label>
                           <div class="controls">
                              <div class="form-group">
                                 <input type="text" name="country" id="country" class="form-control" placeholder="Country"  value="<?=(isset($dataCollection->country))?$dataCollection->country:'';?>" >
                                 <?=form_error('country'); ?>
                              </div>
                           </div>
                        </div>

                        <div class="control-group">
                           <label for="disabled-input" class="control-label ">State<span class="required">*</span></label>
                           <div class="controls">
                              <div class="form-group">
                                 <input type="text" name="state" id="administrative_area_level_1" class="form-control" placeholder="State" value="<?=(isset($dataCollection->state))?$dataCollection->state:'';?>" >
                                 <?=form_error('state'); ?>
                              </div>
                           </div>
                        </div>

                        <div class="control-group">
                           <label for="disabled-input" class="control-label ">City<span class="required">*</span></label>
                           <div class="controls">
                              <div class="form-group">
                                 <input type="text" name="city" class="form-control" placeholder="City" value="<?=(isset($dataCollection->city))?$dataCollection->city:'';?>" id="locality">
                                 <?=form_error('city'); ?>
                              </div>
                           </div>
                        </div>

                        <div class="control-group">
                           <label for="disabled-input" class="control-label ">Zip Code</label>
                           <div class="controls">
                              <div class="form-group">
                                 <input type="text" name="postal_code" class="form-control" placeholder="Zip Code" value="<?=(isset($dataCollection->postal_code))?$dataCollection->postal_code:'';?>" id="postal_code">
                                 <?=form_error('postal_code'); ?>
                              </div>
                           </div>
                        </div>
                     </div>
                     <div id="address">
                        <input type="hidden" id="street_number" disabled="true">
                        <input type="hidden" id="route" disabled="true">                
                        <input type="hidden" id="latitude" name="latitude" value="<?=(isset($dataCollection->latitude))?$dataCollection->latitude:'';?>">     
                        <input type="hidden" id="longitude" name="longitude" value="<?=(isset($dataCollection->longitude))?$dataCollection->longitude:'';?>">    
                     </div>

                     <div class="col-sm-12">
                        <div class="form-group">
                           <label>Description</label>
                           <textarea class="form-control" name="description" placeholder="Description" id="description"  rows="10"><?=set_value('description', isset($dataCollection->description)?$dataCollection->description:""); ?></textarea>
                           <?=form_error('description'); ?>
                        </div>
                     </div>

                     <div class="col-sm-10" >
                        <div class="reset-button">
                           <button class="btn btn-success">Update</button>
                        </div>
                     </div>
                  </form>
               </div>
            </div>
         </div>
      </div>
   </section>
</div>
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script> 
<script>
   var ckbox = $('#checkbox');
   $('input').click(function () {
       if (ckbox.is(':checked')) {
           $('#password').show();
           $('#re_password').show();
           $('#checked_password').attr('value',1);
   
       } else {
           $('#password').hide();
           $('#re_password').hide();
           $('#checked_password').attr('value',0); 
       }
   });
</script>