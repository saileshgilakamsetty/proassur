<div class="content-wrapper">
   <!-- Content Header (Page header) -->
   <section class="content-header">
      <div class="header-icon">
         <i class="pe-7s-note2"></i>
      </div>
      <div class="header-title">
         <h1><?=getContentLanguageSelected('TESTIMONIAL',defaultSelectedLanguage())?></h1>
         <small><?=getContentLanguageSelected('TESTIMONIAL_ADD',defaultSelectedLanguage())?></small>
         <ol class="breadcrumb hidden-xs">
            <li><a href="<?=base_url('admin/dashboard');?>"><i class="pe-7s-home"></i> <?=getContentLanguageSelected('HOME',defaultSelectedLanguage())?></a></li>
            <li class="active"><?=getContentLanguageSelected('TESTIMONIAL',defaultSelectedLanguage())?></li>
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
                     <a class="btn btn-primary" href="<?=base_url('admin/slidder/slidder-lists')?>"> <i class="fa fa-list"></i><?=getContentLanguageSelected('TESTIMONIAL_LIST',defaultSelectedLanguage())?></a>  
                  </div>
               </div>
               <div class="panel-body">
                  <form  method="post" enctype="multipart/form-data">
                     <div class="col-md-6" >
                        <div class="form-group">
                           <label><?=getContentLanguageSelected('NAME',defaultSelectedLanguage())?><span class="required">*</span></label>
                           <input type="text" class="form-control" name="name" id="name" placeholder="" value="<?php echo set_value('name') ?>">
                           <?=form_error('name'); ?>
                        </div>
                        <div class="form-group">
                           <label><?=getContentLanguageSelected('DESIGNATION',defaultSelectedLanguage())?><span class="required">*</span></label>
                           <input type="text" class="form-control" name="designation" id="designation" placeholder="" value="<?php echo set_value('designation') ?>">
                           <?=form_error('designation'); ?>
                        </div>

                         <div class="form-group">
                             <label><?=getContentLanguageSelected('MESSAGE',defaultSelectedLanguage())?></label>
                             <textarea class="form-control" name="message" id="message"  placeholder="" rows="3"><?php echo set_value('message') ?></textarea>
                         </div>
                                    
                        <div class="form-group">
                           <label><?=getContentLanguageSelected('IMAGE',defaultSelectedLanguage())?></label>
                           <input type="file"  name="image" id="image"/>
                        </div>
                        <div class="control-group">
                           <label><?=getContentLanguageSelected('STATUS',defaultSelectedLanguage())?></label><br>
                           <label class="cus_radio">
                           <input type="radio" name="status" value="1" checked="checked"><?=getContentLanguageSelected('ACTIVE',defaultSelectedLanguage())?></label>
                           <label class="cus_radio"><input type="radio" name="status" value="0" ><?=getContentLanguageSelected('INACTIVE',defaultSelectedLanguage())?></label>
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
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>