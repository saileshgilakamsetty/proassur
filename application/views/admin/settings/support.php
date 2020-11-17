<div class="content-wrapper">
<section class="content-header">
  <div class="header-icon">
    <i class="pe-7s-box1"></i>
  </div>
  <div class="header-title">
    <h1><?=getContentLanguageSelected('SUPPORT',defaultSelectedLanguage())?></h1>
    <small><?=getContentLanguageSelected('SUPPORT_SETTINGS',defaultSelectedLanguage())?></small>
    <ol class="breadcrumb hidden-xs">
      <li><a href="<?=base_url('admin/dashboard');?>"><i class="pe-7s-home"></i> Home</a></li>
      <li class="active">Dashboard</li>
    </ol>
  </div>
</section>
<!-- Main content -->
<?php 
  if(!empty($settingsData)) {
    extract($settingsData);
  }
?>
<section class="content">
<div class="row">
<div class="col-sm-12">
<?php $success= $this->session->flashdata('message'); 
if(!empty($success)) { ?>
<div class="panel panel-success ">
<div class="panel-heading">
<?php echo $this->session->flashdata('message'); ?>
</div>
</div>
<?php } ?>
<div class="panel panel-bd ">
  <div class="panel-heading">
    <div class="btn-group"> 
      <!-- <a class="btn btn-success" href="<?=base_url('admin/settings/smtp')?>"> <i class="fa fa-plus"></i> SMTP
      </a>  --> 
    </div>        
  </div>
  <div class="panel-body">
    <form method="post" class="form-horizontal">
      <fieldset>
      <div class="control-group">
      <div class="col-md-2">
      <label for="normal-field" class="control-label"><?=getContentLanguageSelected('SUPPORT_EMAIL',defaultSelectedLanguage())?></label>
      </div>
      <div class="col-md-9">
      <div class="form-group">
      <input type="text" class="form-control" value="<?=set_value('support_email', isset($support_email)?$support_email:""); ?>" name="support_email" id="support_email">
      <?php echo form_error('support_email'); ?>
      </div>
      </div>
      </div>

      <div class="control-group">
      <div class="col-md-2">
      <label for="normal-field" class="control-label"><?=getContentLanguageSelected('SUPPORT_CODE',defaultSelectedLanguage())?></label>
      </div>
      <div class="col-md-9">
      <div class="form-group">
      <input type="text" class="form-control" value="<?=set_value('support_contact_code', isset($support_contact_code)?$support_contact_code:""); ?>" name="support_contact_code" id="support_contact_code">
      <?php echo form_error('support_contact_code'); ?>
      </div>
      </div>
      </div>      
      <div class="control-group">
      <div class="col-md-2">
      <label for="normal-field" class="control-label"><?=getContentLanguageSelected('SUPPORT_CONTACT',defaultSelectedLanguage())?></label>
      </div>
      <div class="col-md-9">
      <div class="form-group">
      <input type="text" class="form-control" value="<?=set_value('support_contact', isset($support_contact)?$support_contact:""); ?>" name="support_contact" id="support_contact">
      <?php echo form_error('support_contact'); ?>
      </div>
      </div>
      </div>

      </fieldset>
    <div class="control-group">
      <div class="col-md-2">
      </div>
      <div class="col-md-9">
        <div class="form-group">
          <button class="btn btn-primary" type="submit"><?=getContentLanguageSelected('SAVE',defaultSelectedLanguage())?></button>
        </div>
      </div>
      </div>
    </form>
  </div>
</div>
</div>
</div>
<div style="height: 200px; clear: both;"></div>
</section>
</div> 