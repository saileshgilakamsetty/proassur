<div class="content-wrapper">
   <?php //print_r($dataCollection); ?>
   <section class="content-header">
      <div class="header-icon">
         <i class="pe-7s-note2"></i>
      </div>
      <div class="header-title">
         <h1>Event Claim</h1>
         <small>Event Claim Edit</small>
         <ol class="breadcrumb hidden-xs">
            <li><a href="<?=base_url('admin/dashboard');?>"><i class="pe-7s-home"></i> Home</a></li>
            <li class="active">Event Claim</li>
         </ol>
      </div>
   </section>
   <section class="content">
      <div class="row">
         <div class="col-sm-12">
            <div class="panel panel-bd">
               <div class="panel-heading">
                  <div class="btn-group"> 
                     <a class="btn btn-primary" href="<?=base_url('admin/event-claim/lists')?>"> <i class="fa fa-list"></i>  Event Claim List</a>  
                  </div>
               </div>
               <div class="panel-body">
                  <form  method="post" enctype="multipart/form-data">

                     <div class="col-md-6" >

                      <div class="form-group">
                           <label>Company<span class="required">*</span></label>
                           <?php $data = 'class="form-control "';
                              $company_id = $dataCollection->company_id;
                              
                              echo form_dropdown('company_id',getSingleOptions('tbl_company','Select Company',1),set_value("company_id",isset($company_id)?$company_id:""),$data);?>
                           <?=form_error('company_id'); ?>
                        </div>

                      <div class="form-group">
                           <label>Event<span class="required">*</span></label>
                           <?php $data = 'class="form-control "';
                              $event_id = $dataCollection->event_id;
                              
                              echo form_dropdown('event_id',getSingleOptions('tbl_event','Select Event',1),set_value("event_id",isset($event_id)?$event_id:""),$data);?>
                           <?=form_error('event_id'); ?>
                        </div>

                        <div class="form-group">
                           <label>Judicial Fee<span class="required">*</span></label>
                           <input type="text" class="form-control" name="judicial_fee" id="judicial_fee" placeholder="Claim" value="<?=set_value('judicial_fee', isset($dataCollection->judicial_fee)?$dataCollection->judicial_fee:""); ?>" >
                           <?=form_error('judicial_fee'); ?>
                        </div>

                        <div class="form-group">
                           <label>Claim<span class="required">*</span></label>
                           <input type="text" class="form-control" name="claim_raised" id="claim_raised" placeholder="Claim" value="<?=set_value('claim_raised', isset($dataCollection->claim_raised)?$dataCollection->claim_raised:""); ?>" >
                           <?=form_error('claim_raised'); ?>
                        </div>                        
                        <div class="form-check">
                           <label>Status</label><br>
                           <label class="radio-inline">
                           <?php $status=$dataCollection->status ?>
                           <input type="radio" name="status" value="1" <?php if($status==1) { ?>  checked="checked" <?php } ?>>Active</label>
                           <label class="radio-inline"><input type="radio" name="status" value="0" <?php if($status==0) { ?>  checked="checked" <?php } ?>>Inctive</label>
                        </div>
                     </div>
                     <div class="col-md-6" >

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
