<div class="content-wrapper">
   <!-- Content Header (Page header) -->
   <section class="content-header">
      <div class="header-icon">
         <i class="pe-7s-note2"></i>
      </div>
      <div class="header-title">
         <h1>Event Claim</h1>
         <small>Event Claim Add</small>
         <ol class="breadcrumb hidden-xs">
            <li><a href="<?=base_url('admin/dashboard');?>"><i class="pe-7s-home"></i> Home</a></li>
            <li class="active">Event Claim</li>
         </ol>
      </div>
   </section>
   <!-- Main content -->
   <section class="content">
      <div class="row">
         <!-- Form controls -->
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
                           <?php $data = 'class="form-control"';
                              echo form_dropdown('company_id',getSingleOptions('tbl_company','Select Company',1),set_value("company_id"),$data);?>
                           <?=form_error('company_id'); ?>
                        </div>                        

                        <div class="form-group">
                           <label>Event<span class="required">*</span></label>
                           <?php $data = 'class="form-control"';
                              echo form_dropdown('event_id',getSingleOptions('tbl_event','Select Event',1),set_value("event_id"),$data);?>
                           <?=form_error('event_id'); ?>
                        </div>                        

                        <div class="form-group">
                           <label>Judicial Fee<span class="required">*</span></label>
                           <input type="text" class="form-control" name="judicial_fee"  placeholder="Judicial Fee" id="judicial_fee" value="<?=set_value('judicial_fee')?>" >
                           <?=form_error('judicial_fee'); ?>
                        </div>                        

                        <div class="form-group">
                           <label>Claim<span class="required">*</span></label>
                           <input type="text" class="form-control" name="claim_raised" placeholder="Claim Raised" id="claim_raised" value="<?=set_value('claim_raised')?>" >
                        </div>


                        <div class="control-group">
                           <label>Status</label><br>
                           <label class="cus_radio">
                           <input type="radio" name="status" value="1" checked="checked">Active</label>
                           <label class="cus_radio"><input type="radio" name="status" value="0" >InActive</label>
                        </div>
                     </div>
                     <div class="col-md-6" >
                     </div>
                     <div class="col-md-12" >
                        <div class="reset-button">
                           <button class="btn btn-success">Save</button>
                        </div>
                     </div>
                  </form>
               </div>
            </div>
         </div>
      </div>
   </section>
   <!-- /.content -->
</div>
