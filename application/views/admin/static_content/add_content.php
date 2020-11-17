<div class="content-wrapper">
    <section class="content-header">
        <div class="header-icon">
            <i class="pe-7s-note2"></i>
        </div>
        <div class="header-title">
            <h1>Content</h1>
            <small>Content list</small>
            <ol class="breadcrumb hidden-xs">
                <li><a href="<?= base_url('admin/dashboard'); ?>"><i class="pe-7s-home"></i> Home</a></li>
                <li class="active">Content</li>
            </ol>
        </div>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-sm-12">
                <div class="panel panel-bd">
                    <div class="panel-heading">
                        <div class="btn-group"> 
                            <a class="btn btn-primary" href="<?= base_url('admin/settings/static_content') ?>"> <i class="fa fa-list"></i>  Content List</a>  
                        </div>
                    </div>
                    <div class="panel-body">
                        <form  method="post" enctype="multipart/form-data">
                            <div class="col-sm-6" >
                                <div class="form-group">
                                    <label>Content Name<span class="required">*</span></label>
                                    <input type="text" class="form-control" name="name" id="name" placeholder="Content Name" onchange="this.value = getUnderscoreForSpace(this.value);">
                                    <?php echo form_error('name'); ?>
                                </div>

                                <div class="form-group">
                                    <label>Langauge<span class="required">*</span></label>
                                    <?php
                                    $data = 'class="form-control input" ';
                                    $language = $dataCollection->language_id;

                                    echo form_dropdown('language_id', getSingleOptions('tbl_language', 'Select Langauge', 1), set_value("language_id", isset($language) ? $language : $language), $data);
                                    ?>
                                    <?= form_error('language_id'); ?>
                                </div>

                            </div>

                            <div class="col-sm-10">
                                <div class="form-group">
                                    <label>Description<span class="required">*</span></label>
                                    <textarea class="form-control" name="description"  rows="3"></textarea>
                                    <?php echo form_error('description'); ?>
                                </div>
                            </div>
                            <div class="col-sm-6" >
                                <div class="form-check">
                                    <div class="reset-button">
                                        <button class="btn btn-success">Save</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<script type="text/javascript">
    function getUnderscoreForSpace(value) {
        var i = 0, valueLength = value.length;
        for (i; i < valueLength; i++) {
            value = value.replace(" ", "_");
        }
        value = value.toUpperCase();
        return value;
    }
</script>