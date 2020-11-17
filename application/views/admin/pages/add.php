<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="header-icon">
            <i class="pe-7s-note2"></i>
        </div>
        <div class="header-title">

            <h1><?= getContentLanguageSelected('PAGES', defaultSelectedLanguage()) ?></h1>
            <small><?= getContentLanguageSelected('PAGES', defaultSelectedLanguage()) ?></small>
            <ol class="breadcrumb hidden-xs">
                <li><a href="<?= base_url('admin/dashboard'); ?>"><i class="pe-7s-home"></i> <?= getContentLanguageSelected('HOME', defaultSelectedLanguage()) ?></a></li>
                <li class="active"><?= getContentLanguageSelected('PAGES', defaultSelectedLanguage()) ?></li>
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
                            <a class="btn btn-primary" href="<?= base_url('admin/pages/lists') ?>"> <i class="fa fa-list"></i>  <?= getContentLanguageSelected('PAGES_LIST', defaultSelectedLanguage()) ?></a>  
                        </div>
                    </div>
                    <div class="panel-body">
                        <form  method="post" enctype="multipart/form-data">
                            <div class="col-sm-10" >
                                <div class="form-group">
                                    <label><?= getContentLanguageSelected('TITLE', defaultSelectedLanguage()) ?><span class="required">*</span></label>
                                    <input type="text" class="form-control" name="name" id="name" placeholder="Page Name" value="<?php echo set_value('name') ?>" >
                                    <?= form_error('name'); ?>
                                </div>
                            </div>

                            <div class="col-sm-10" >
                                <div class="form-group">
                                    <label><?= getContentLanguageSelected('language', defaultSelectedLanguage()) ?><span class="required">*</span></label>
                                    <?php
                                    $selected = ($this->input->post('langusge_id')) ? $this->input->post('langusge_id') : $dataCollection->langusge_id;
                                    $language = ['' => '---Select Langusge--'];
                                    $lang_data = $this->db->get_where('tbl_language', ['status' => '1'])->result();
                                    foreach ($lang_data as $key => $val) {
                                        $language[$val->id] = $val->name;
                                    }
                                    echo form_dropdown('langusge_id', $language, $selected, array('class' => 'form-control'));
                                    ?>
                                    <?= form_error('langusge_id'); ?>
                                </div>
                            </div>

                            <div class="col-sm-10">
                                <div class="form-group">
                                    <label><?= getContentLanguageSelected('DESCRIPTION', defaultSelectedLanguage()) ?><span class="required">*</span></label>
                                    <textarea class="form-control " name="description" id="description" placeholder="Description" rows="10"><?php echo set_value('description') ?></textarea>
                                    <?= form_error('description'); ?>
                                </div>
                            </div>
                            <div class="col-sm-10">
                                <div class="form-group">
                                    <label class="control-label"><?= getContentLanguageSelected('IMAGE', defaultSelectedLanguage()) ?></label>
                                    <input type="file"  name="featured_img" id="featured_img"/>
                                </div>
                            </div>
                            <div class="col-sm-10" >
                                <div class="form-group">
                                    <label><?= getContentLanguageSelected('META_TITLE', defaultSelectedLanguage()) ?></label>
                                    <textarea class="form-control" name="meta_title" id="meta_title"  placeholder="Meta Title" rows="3"><?php echo set_value('meta_title') ?></textarea>
                                </div>
                            </div>
                            <div class="col-sm-10" >
                                <div class="form-group">
                                    <label><?= getContentLanguageSelected('META_KEY', defaultSelectedLanguage()) ?></label>
                                    <textarea class="form-control" name="meta_key" id="meta_key"  placeholder="Meta Key" rows="3"><?php echo set_value('meta_key') ?></textarea>
                                </div>
                            </div>
                            <div class="col-sm-10" >
                                <div class="form-group">
                                    <label><?= getContentLanguageSelected('META_DESCRIPTION', defaultSelectedLanguage()) ?></label>
                                    <textarea class="form-control" name="meta_description" id="meta_description"  placeholder="Meta Description" rows="3"><?php echo set_value('meta_description') ?></textarea>
                                </div>
                            </div>
                            <div class="col-sm-10" >
                                <div class="form-check">
                                    <label><?= getContentLanguageSelected('STATUS', defaultSelectedLanguage()) ?></label><br>
                                    <label class="radio-inline">
                                        <input type="radio" name="status" value="1" checked="checked">Active</label>
                                    <label class="radio-inline"><input type="radio" name="status" value="0" >Inctive</label>
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

