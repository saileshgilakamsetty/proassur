<div class="content-wrapper">
   <!-- Content Header (Page header) -->
   <section class="content-header">
      <div class="header-icon">
         <i class="pe-7s-note2"></i>
      </div>
      <div class="header-title">
         <h1>Policy</h1>
         <small>Policy Add</small>
         <ol class="breadcrumb hidden-xs">
            <li><a href="<?=base_url('admin/dashboard');?>"><i class="pe-7s-home"></i> Home</a></li>
            <li class="active">Policy</li>
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
                     <a class="btn btn-primary" href="<?=base_url('admin/policy/lists')?>"> <i class="fa fa-list"></i>  Policy List</a>  
                  </div>
               </div>
               <div class="panel-body">
                  <form  method="post" enctype="multipart/form-data">
                     <div class="col-md-6" >
                        <div class="form-group">
                           <label>Name<span class="required">*</span></label>
                           <input type="text" class="form-control" name="name" id="name" placeholder="Company Name" value="<?php echo set_value('name') ?>">
                           <?=form_error('name'); ?>
                        </div>



                        <div class="control-group">
                           <label>Status</label><br>
                           <label class="cus_radio">
                           <input type="radio" name="status" value="1" checked="checked">Active</label>
                           <label class="cus_radio"><input type="radio" name="status" value="0" >InActive</label>
                        </div>


                     </div>

                     <div class="col-sm-6">


                        <div class="control-group">
                           <label for="disabled-input" class="control-label ">Email<span class="required">*</span></label>
                           <div class="controls">
                              <div class="form-group">
                                 <input type="text" name="email" id="email" class="form-control" placeholder="email"  value="<?=(isset($dataCollection->email))?$dataCollection->email:'';?>" >
                                 <?=form_error('email'); ?>
                              </div>
                           </div>
                        </div>



                     </div>


                     <div class="col-sm-12">
                        <div class="form-group">
                           <label>Description</label>
                           <textarea class="form-control" name="description" placeholder="Description" id="description"  rows="10"><?=set_value('description', isset($dataCollection->notes)?$dataCollection->notes:""); ?></textarea>
                           <?=form_error('description'); ?>
                        </div>
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
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>