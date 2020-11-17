
<div class="content-wrapper">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <div class="header-icon">
                        <i class="pe-7s-note2"></i>
                    </div>
                    <div class="header-title">
                        
                        <h1>Insurance Type</h1>
                        <small>Insurance Type Edit</small>
                        <ol class="breadcrumb hidden-xs">
                            <li><a href="<?=base_url('admin/dashboard');?>"><i class="pe-7s-home"></i> Home</a></li>
                            <li class="active">Insurance Type</li>
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
                                        <a class="btn btn-primary" href="<?=base_url('admin/insurance-type/lists')?>"> <i class="fa fa-list"></i>  Insurance Type List</a>  
                                    </div>
                                </div>
                                <div class="panel-body">
                                    <form  method="post" enctype="multipart/form-data">
                                    <div class="col-sm-10" >
                                        <div class="form-group">
                                            <label>Tittle<span class="required">*</span></label>
                                            <input type="text" class="form-control" name="name" id="name" placeholder="Insurance Type" value="<?=set_value('name', isset($dataCollection->name)?$dataCollection->name:""); ?>" >
                                             <?=form_error('name'); ?>
                                        </div>
                                    </div>
                                   <div class="col-sm-12">
                                      <div class="form-group">
                                         <label>Description<span class="required">*</span></label>
                                         <textarea class="form-control" name="description" placeholder="Description" id="description" rows="10"><?=set_value('description',isset($dataCollection->description)?$dataCollection->description:"");?></textarea>
                                         <?=form_error('description'); ?>
                                      </div>
                                   </div>
                                    <div class="col-sm-10" >
                                        <div class="form-check">
                                          <label>Status</label><br>
                                          <label class="radio-inline">
                                              <?php $status=$dataCollection->status ?>
                                              <input type="radio" name="status" value="1" <?php if($status==1) { ?>  checked="checked" <?php } ?>>Active</label>
                                              <label class="radio-inline"><input type="radio" name="status" value="0" <?php if($status==0) { ?>  checked="checked" <?php } ?>>Inctive</label>
                                          </div>                                            
                                          <div class="reset-button">
                                           <button class="btn btn-success">Save</button>
                                       </div>
                                   </div>
                                   </form>
                               </div>
                           </div>
                       </div>
                   </div>
               </section> <!-- /.content -->
           </div>