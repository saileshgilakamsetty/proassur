<div class="content-wrapper">
   <!-- Content Header (Page header) -->
   <?php //print_r($dataCollection); ?>
   <section class="content-header">
      <div class="header-icon">
         <i class="pe-7s-box1"></i>
      </div>
      <div class="header-title">
         <h1><?=getContentLanguageSelected('SELECT_PREMIUM_DURATION',defaultSelectedLanguage())?></h1>
         <small><?=getContentLanguageSelected('SELECT_PREMIUM_DURATION',defaultSelectedLanguage())?></small>
         <ol class="breadcrumb hidden-xs">
            <li><a href="<?=base_url('admin/dashboard');?>"><i class="pe-7s-home"></i> <?=getContentLanguageSelected('HOME',defaultSelectedLanguage())?></a></li>
            <li class="active"><?=getContentLanguageSelected('SELECT_PREMIUM_DURATION',defaultSelectedLanguage())?></li>
         </ol>
      </div>
   </section>
   <!-- Main content -->
   <section class="content">
      <div class="row">
         <form  method="post" enctype="multipart/form-data">


      <div class="col-sm-12">

                        <?php $success= $this->session->flashdata('message'); 
                        if(!empty($success)) { ?>
                        <div class="panel panel-success">
                          <div class="panel-heading">
                            <?php echo $this->session->flashdata('message'); ?>
                          </div>
                        </div>
                        <?php } ?>

         <div class="panel panel-bd">
            <div class="panel-heading">
               <div class="panel-body">
                  <form  method="post" enctype="multipart/form-data">
                   
                     <div class="col-md-6" >
                        <div class="form-group">
                         <label><?=getContentLanguageSelected('DURATION_OF_THE_PREMIUM',defaultSelectedLanguage())?><span class="required">*</span></label>
                         <br>
                         <label><?=getContentLanguageSelected('FROM',defaultSelectedLanguage())?></label>
                         <input type="text" class="form-control" name="from" id="from" placeholder="From" value="<?php echo set_value('from') ?>">
                           <?=form_error('from'); ?>

                         <br>
                           <label><?=getContentLanguageSelected('TO',defaultSelectedLanguage())?></label>
                           <input type="text" class="form-control" name="to" id="to" placeholder="To" value="<?php echo set_value('to') ?>">
                        </div>
                           <?=form_error('to'); ?>

                        <div class="form-group">
                           <label><?=getContentLanguageSelected('TACIT_POLICY',defaultSelectedLanguage())?></label><br>
                           <label class="cus_radio">
                           <input type="radio" name="tacit_policy" value="1" >Yes</label>
                           <label class="cus_radio"><input type="radio" name="tacit_policy" value="0" checked="checked" >No</label>
                           <?=form_error('tacit_policy'); ?>
                        </div>
                     </div>   

                     <div class="col-md-12" >
                        <div class="reset-button">
                           <button class="btn btn-success"><?=getContentLanguageSelected('SAVE',defaultSelectedLanguage())?></button>
                        </div>
                     </div>
                  </form>
               </div>
            </div>
         </div>
      </div>


         </form>
      </div>
   </section>
   <!-- /.content -->
</div>