
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="header-icon">
            <i class="pe-7s-note2"></i>
        </div>
        <div class="header-title">

            <h1><?= getContentLanguageSelected('PAGES', defaultSelectedLanguage()) ?></h1>
            <small><?= getContentLanguageSelected('PAGES_EDIT', defaultSelectedLanguage()) ?></small>
            <ol class="breadcrumb hidden-xs">
                <li><a href="<?= base_url('admin/dashboard'); ?>"><i class="pe-7s-home"></i><?= getContentLanguageSelected('HOME', defaultSelectedLanguage()) ?></a></li>
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
                            <a class="btn btn-primary" href="<?= base_url('admin/pages/lists') ?>"> <i class="fa fa-list"></i> <?= getContentLanguageSelected('PAGES_LIST', defaultSelectedLanguage()) ?> </a>  
                        </div>
                    </div>
                    <div class="panel-body">
                        <form  method="post" enctype="multipart/form-data">
                            <div class="col-sm-10" >
                                <div class="form-group">
                                    <label><?= getContentLanguageSelected('TITLE', defaultSelectedLanguage()) ?><span class="required">*</span></label>
                                    <input type="text" class="form-control" name="name" id="name" placeholder="Pages Name" value="<?= set_value('name', isset($dataCollection->name) ? $dataCollection->name : ""); ?>" >
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
                            
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label><?= getContentLanguageSelected('DESCRIPTION', defaultSelectedLanguage()) ?> <span class="required">*</span></label>
                                    <textarea class="form-control" name="description" placeholder="Description" id="description" rows="10"><?= set_value('description', isset($dataCollection->description) ? $dataCollection->description : ""); ?></textarea>
                                    <?= form_error('description'); ?>
                                </div>
                            </div>
                            <?php if (getSlug($id) == 'about-us') { ?>


                                <div class="col-sm-10">
                                    <div class="form-group">
                                        <input type="file"  name="image" id="image"/>
                                        <div style="height: 20px; clear: both"></div>
                                        <div class=""> 
                                            <img width="150" src="<?php echo base_url() . $dataCollection->featured_img; ?>" >
                                        </div>
                                    </div>
                                </div>
                            <?php } ?>
                            <div class="col-sm-10" >
                                <div class="form-group">
                                    <label><?= getContentLanguageSelected('META_TITLE', defaultSelectedLanguage()) ?> Meta Title</label>
                                    <textarea class="form-control" name="meta_title" id="meta_title" placeholder="Meta Title" rows="3"><?= set_value('meta_title', isset($dataCollection->meta_title) ? $dataCollection->meta_title : ""); ?></textarea>

                                </div>
                            </div>
                            <div class="col-sm-10" >
                                <div class="form-group">
                                    <label><?= getContentLanguageSelected('META_KEY', defaultSelectedLanguage()) ?> Meta Key</label>
                                    <textarea class="form-control" name="meta_key" placeholder="Meta Key" id="meta_key"  rows="3"><?= set_value('meta_key', isset($dataCollection->meta_key) ? $dataCollection->meta_key : ""); ?></textarea>
                                </div>
                            </div>
                            <div class="col-sm-10" >
                                <div class="form-group">
                                    <label><?= getContentLanguageSelected('META_DESCRIPTION', defaultSelectedLanguage()) ?></label>
                                    <textarea class="form-control" name="meta_description" placeholder="Meta Description" id="meta_description"  rows="3"><?= set_value('meta_description', isset($dataCollection->meta_description) ? $dataCollection->meta_description : ""); ?></textarea>
                                </div>
                            </div>
                            <div class="col-sm-10" >
                                <div class="form-check">
                                    <label><?= getContentLanguageSelected('STATUS', defaultSelectedLanguage()) ?></label><br>
                                    <label class="radio-inline">
                                        <?php $status = $dataCollection->status ?>
                                        <input type="radio" name="status" value="1" <?php if ($status == 1) { ?>  checked="checked" <?php } ?>>Active</label>
                                    <label class="radio-inline"><input type="radio" name="status" value="0" <?php if ($status == 0) { ?>  checked="checked" <?php } ?>>Inctive</label>
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