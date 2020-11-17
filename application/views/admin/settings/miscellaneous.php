<div class="content-wrapper">
<section class="content-header">
<div class="header-icon">
<i class="pe-7s-box1"></i>
</div>
<div class="header-title">
  
<h1><?=getContentLanguageSelected('MISCELLANEOUS',defaultSelectedLanguage())?></h1>
<small><?=getContentLanguageSelected('MISCELLANEOUS_SETTINGS',defaultSelectedLanguage())?></small>
<ol class="breadcrumb hidden-xs">
<li><a href="<?=base_url('admin/dashboard');?>"><i class="pe-7s-home"></i> Home</a></li>
<li class="active"><?=getContentLanguageSelected('MISCELLANEOUS',defaultSelectedLanguage())?></li>
</ol>
</div>
</section>
<!-- Main content -->
<?php 
if(!empty($settingsData))
{
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
<!--   <div class="panel-heading">
    <div class="btn-group"> 
      <a class="btn btn-success" href="<?=base_url('admin/settings/smtp')?>"> <i class="fa fa-plus"></i> SMTP
      </a>  
    </div>        
  </div> -->
  <div class="panel-body">
    <form method="post" class="form-horizontal">
      <fieldset>
        <div class="control-group">
          <div class="col-md-2">
            <label for="normal-field" class="control-label"><?=getContentLanguageSelected('TAX',defaultSelectedLanguage())?></label>
          </div>
          <div class="col-md-9">
            <div class="form-group">
              <input type="text" class="form-control" value="<?=set_value('tax_percent', isset($tax_percent)?$tax_percent:""); ?>" name="tax_percent" id="tax_percent">
              <?php echo form_error('tax_percent'); ?>
            </div>
          </div>

          <div class="col-md-2">
            <label for="normal-field" class="control-label"><?=getContentLanguageSelected('AREA_CODE',defaultSelectedLanguage())?></label>
          </div>
          <div class="col-md-9">
            <div class="form-group">
              <input type="text" class="form-control" value="<?=set_value('area_code', isset($area_code)?$area_code:""); ?>" name="area_code" id="area_code">
              <?php echo form_error('area_code'); ?>
            </div>
          </div>

          <div class="col-md-2">
            <label for="normal-field" class="control-label"><?=getContentLanguageSelected('VIDEO_URL',defaultSelectedLanguage())?></label>
          </div>
          <div class="col-md-9">
            <div class="form-group">
              <input type="text" class="form-control" value="<?=set_value('video_url', isset($video_url)?$video_url:""); ?>" name="video_url" id="video_url">
              <?php echo form_error('video_url'); ?>
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