<div class="content-wrapper">
<!-- Content Header (Page header) -->
<section class="content-header">
	<div class="header-icon">
		<i class="pe-7s-box1"></i>
	</div>
	<div class="header-title">  
		<h1><?=getContentLanguageSelected('SMTP',defaultSelectedLanguage())?></h1>
		<small><?=getContentLanguageSelected('SMTP_SETTINGS',defaultSelectedLanguage())?></small>
		<ol class="breadcrumb hidden-xs">
			<li><a href="<?=base_url('admin/dashboard');?>"><i class="pe-7s-home"></i> Home</a></li>
			<li class="active"><?=getContentLanguageSelected('DASHBOARD',defaultSelectedLanguage())?></li>
		</ol>
	</div>
</section>
<!-- Main content -->
<?php 
	if(!empty($smtpData)) {
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
				<a class="btn btn-success" href="<?=base_url('admin/settings/social')?>"> <i class="fa fa-plus"></i> Social
				</a>  
			</div>        
		</div>
		<div class="panel-body">
			<form method="post" class="form-horizontal">
				<fieldset>
					<div class="control-group">
						<div class="col-md-2">
							<label for="normal-field" class="control-label"><?=getContentLanguageSelected('SMTP_USERNAME',defaultSelectedLanguage())?></label>
						</div>
						<div class="col-md-9">
							<div class="form-group">
								<input type="text" class="form-control" value="<?=set_value('smtp_user', isset($smtp_user)?$smtp_user:""); ?>" name="smtp_user" id="smtp_user">
								<?php echo form_error('smtp_user'); ?>
							</div>
						</div>
					</div>

					<div class="control-group">
						<div class="col-md-2">
							<label for="normal-field" class="control-label"><?=getContentLanguageSelected('SMTP_HOST',defaultSelectedLanguage())?></label>
						</div>
						<div class="col-md-9">
							<div class="form-group">
								<input type="text" class="form-control" value="<?=set_value('smtp_host', isset($smtp_host)?$smtp_host:""); ?>" name="smtp_host" id="smtp_host">
								<?php echo form_error('smtp_host'); ?>
							</div>
						</div>
					</div>

					<div class="control-group">
						<div class="col-md-2">
							<label for="normal-field" class="control-label"><?=getContentLanguageSelected('SMTP_PORT',defaultSelectedLanguage())?></label>
						</div>
						<div class="col-md-9">
							<div class="form-group">
								<input type="text" class="form-control" value="<?=set_value('smtp_port', isset($smtp_port)?$smtp_port:""); ?>" name="smtp_port" id="smtp_port">
								<?php echo form_error('smtp_port'); ?>
							</div>
						</div>
					</div>

					<div class="control-group">
						<div class="col-md-2">
							<label for="normal-field" class="control-label"><?=getContentLanguageSelected('SMTP_PASSWORD',defaultSelectedLanguage())?></label>
						</div>
						<div class="col-md-9">
							<div class="form-group">
								<input type="text" class="form-control" value="<?=set_value('smtp_pass', isset($smtp_pass)?$smtp_pass:""); ?>" name="smtp_pass" id="smtp_pass">
								<?php echo form_error('smtp_pass'); ?>
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
</div>
<div style="height: 200px; clear: both;"></div>
</section> <!-- /.content -->
</div> 