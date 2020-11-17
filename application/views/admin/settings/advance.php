<div class="content-wrapper">
   <!-- Content Header (Page header) -->
   <section class="content-header">
      <div class="header-icon">
         <i class="pe-7s-box1"></i>
      </div>
      <div class="header-title">
         
         <h1>Advance Settings</h1>
         <small>Advance Settings</small>
         <ol class="breadcrumb hidden-xs">
            <li><a href="<?=base_url('admin/dashboard');?>"><i class="pe-7s-home"></i> Home</a></li>
            <li class="active">Advance Setting</li>
         </ol>
      </div>
   </section>
   <?php 
      if(!empty($smtpData))
      {
      extract($smtpData);
      }
      ?>
   <section class="content">
      <div class="row">
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
                  <div class="btn-group"> 
                    <h3>Advance Setting</h3>  
                  </div>
               </div>
               <div class="panel-body">
                  <form method="post" class="form-horizontal">
                     <fieldset>
                        <div class="control-group">
                           <div class="col-md-2">
                              <label for="normal-field" class="control-label">Currency</label>
                           </div>
                           <div class="col-md-9">
                              <div class="form-group">
                        <?php $data = 'class="form-control"';
                          echo form_dropdown('currency',getCurrencySign(),set_value('currency', isset($advanceData['currency'])?$advanceData['currency']:""),$data);?>
                           <?php echo form_error('currency'); ?>
                              </div>
                           </div>
                        </div>
                     </fieldset>
                     <div class="control-group">
                        <div class="col-md-2">
                        </div>
                        <div class="col-md-9">
                           <div class="form-group">
                              <button class="btn btn-primary" type="submit">Save </button>
                           </div>
                        </div>
                     </div>
                  </form>
               </div>
            </div>
         </div>
      </div>
</section> <!-- /.content -->
</div>

<div style="height: 200px; clear: both;"></div>