<div class="content-wrapper">
  <section class="content-header">
    <div class="header-icon">
      <i class="pe-7s-box1"></i>
    </div>
    <div class="header-title"> 
      <h1><?=getContentLanguageSelected('SOCIAL',defaultSelectedLanguage())?></h1>
      <small><?=getContentLanguageSelected('SOCIAL_SETTINGS',defaultSelectedLanguage())?></small>
      <ol class="breadcrumb hidden-xs">
        <li><a href="<?=base_url('admin/dashboard');?>"><i class="pe-7s-home"></i> <?=getContentLanguageSelected('HOME',defaultSelectedLanguage())?></a></li>
        <li class="active"><?=getContentLanguageSelected('DASHBOARD',defaultSelectedLanguage())?></li>
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
              </a> -->  
            </div>        
          </div>
          <div class="panel-body">
            <form method="post" class="form-horizontal">
              <fieldset>
                <div class="control-group">
                  <div class="col-md-2">
                    <label for="normal-field" class="control-label"><?=getContentLanguageSelected('FACEBOOK',defaultSelectedLanguage())?></label>
                  </div>
                  <div class="col-md-9">
                    <div class="form-group">
                      <input type="text" class="form-control" value="<?=set_value('facebook', isset($facebook)?$facebook:""); ?>" name="facebook" id="facebook">
                      <?php echo form_error('facebook'); ?>
                    </div>
                  </div>
                </div>

                <div class="control-group">
                  <div class="col-md-2">
                    <label for="normal-field" class="control-label"><?=getContentLanguageSelected('INSTAGRAM',defaultSelectedLanguage())?></label>
                  </div>
                  <div class="col-md-9">
                    <div class="form-group">
                      <input type="text" class="form-control" value="<?=set_value('instagram', isset($instagram)?$instagram:""); ?>" name="instagram" id="instagram">
                      <?php echo form_error('instagram'); ?>
                    </div>
                  </div>
                </div> 

                <div class="control-group">
                  <div class="col-md-2">
                    <label for="normal-field" class="control-label"><?=getContentLanguageSelected('TWITTER',defaultSelectedLanguage())?></label>
                  </div>
                  <div class="col-md-9">
                    <div class="form-group">
                      <input type="text" class="form-control" value="<?=set_value('twitter', isset($twitter)?$twitter:""); ?>" name="twitter" id="twitter">
                      <?php echo form_error('twitter'); ?>
                    </div>
                  </div>
                </div>

                <!--  <div class="control-group">
                        <div class="col-md-2">
                          <label for="normal-field" class="control-label">Linkedin</label>
                        </div>
                        <div class="col-md-9">
                          <div class="form-group">
                            <input type="text" class="form-control" value="<?=set_value('linkedin', isset($linkedin)?$linkedin:""); ?>" name="linkedin" id="linkedin">
                            <?php echo form_error('linkedin'); ?>
                          </div>
                        </div>
                      </div>  -->
                <!-- <div class="control-group">
                  <div class="col-md-2">
                    <label for="normal-field" class="control-label">Google</label>
                  </div>
                  <div class="col-md-9">
                    <div class="form-group">
                      <input type="text" class="form-control" value="<?=set_value('google', isset($google)?$google:""); ?>" name="google" id="google">
                      <?php echo form_error('google'); ?>
                    </div>
                  </div>
                </div>  -->
                <!--       <div class="control-group">
                <div class="col-md-2">
                  <label for="normal-field" class="control-label">Pinterest</label>
                </div>
                  <div class="col-md-9">
                    <div class="form-group">
                      <input type="text" class="form-control" value="<?=set_value('pinterest', isset($pinterest)?$pinterest:""); ?>" name="pinterest" id="pinterest">
                      <?php echo form_error('pinterest'); ?>
                    </div>
                  </div>
                </div> -->
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