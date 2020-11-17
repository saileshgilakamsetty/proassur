
<div class="container-fluid">
    <div class="mainTitle">
        <h1><?php echo $title; ?></h1>
    </div>
    <div class="mngPay">
        <div class="payBox">
            <div class="pull-right"> <a href="<?php echo base_url('question'); ?>"> <button class="btn btn-primary"><?=getContentLanguageSelected('BACK',defaultSelectedLanguage())?></button></a></div>

            <?php if ($this->session->flashdata('success')) { ?>
                <div class="alert alert-success alert-dismissible">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <strong>Success!</strong> <?php echo $this->session->flashdata('success'); ?>
                </div>
            <?php } ?>

            <?php if ($this->session->flashdata('error')) { ?>
                <div class="alert alert-danger alert-dismissible">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <strong>Error!</strong> <?php echo $this->session->flashdata('error'); ?>
                </div>
            <?php } ?>
            <?php
            $action = isset($result['id']) ? 'question/Update/' . $result['id'] : 'question/add';
            echo form_open_multipart($action);
            ?>

            <div class="col-md-12">                                
                <div class="form-group">
                    <label class="control-label"><?=getContentLanguageSelected('INSURANCE_TYPE',defaultSelectedLanguage())?></label>
                    <?php
                    $selected = isset($result['ins_type_id']) ? $result['ins_type_id'] : $this->input->post('ins_type_id');
                    $ins_type_id = array('' => '---Select Insurance--');
                    $data = $this->db->get_where('tbl_insurance_type', ['status' => '1'])->result();
                    foreach ($data as $val) {
                        $ins_type_id[$val->id] = $val->type;
                    }
                    echo form_dropdown('ins_type_id', $ins_type_id, $selected, array('class' => 'form-control', 'required' => TRUE));
                    ?>
                    <?= form_error('ins_type_id'); ?>
                </div>
            </div>  
            <div class="after-add-more">

                <div class="col-md-10">                                
                    <div class="form-group">
                        <label class="control-label"><?=getContentLanguageSelected('QUESTION',defaultSelectedLanguage())?></label>
                        <?php echo form_input(array('name' => 'question[]', 'type' => 'text', 'class' => 'form-control', 'required' => TRUE, 'placeholder' => 'Enter Question', 'value' => isset($result['question']) ? set_value("question", $result['question']) : set_value("question"))); ?>
                       
                    </div>
                </div>                        

                <div class="col-md-2">
                    <div class="form-group change">
                        <label for="">&nbsp;</label><br/>
                        <a class="btn btn-success add-more"><i class="fa fa-plus"></i> <?=getContentLanguageSelected('ADD_MORE',defaultSelectedLanguage())?></a>
                    </div>
                </div>                            

            </div>


            <input type="submit" class="btn btn-primary" name="add" value="<?php echo isset($result['id']) ? 'Update' : 'Submit' ?>" style="margin: 6px 0px 13px 15px;">

            <?php
            echo form_close();

            if (!isset($result['question'])) {
                ?>


                <hr style="border-color:#d2d1d1;">
                <span class="text-center" style="display:block;"><strong style="display: inline-block;background: #fff;vertical-align: top;margin-top: -10px;padding: 0 10px;background:#fff;">OR</strong></span>
                <a href="<?php echo base_url('assets/demo/demo.xls'); ?>"><button type="button" class="btn btn-success pull-right"><i class="fa fa-file-excel"></i> <?=getContentLanguageSelected('DOWNLOAD_EXAMPLE_FILE',defaultSelectedLanguage())?></button></a>
                <?php echo form_open_multipart('question/addQuestionexcel'); ?>
                <div class="col-md-12">                                
                    <div class="form-group">
                        <label class="control-label"><?=getContentLanguageSelected('INSURANCE_TYPE',defaultSelectedLanguage())?></label>
                        <?php
                        $selected = '';
                        $ins_type_id = array('' => '---Select Insurance--');
                        $data = $this->db->get_where('tbl_insurance_type', ['status' => '1'])->result();
                        foreach ($data as $val) {
                            $ins_type_id[$val->id] = $val->type;
                        }
                        echo form_dropdown('ins_type_id', $ins_type_id, $selected, array('class' => 'form-control', 'required' => TRUE));
                        ?>
                        <?= form_error('ins_type_id'); ?>
                    </div>
                </div>  

                <div class="col-md-12">                                
                    <div class="form-group">
                        <input type="file" name="importfile" class="form-control" style="padding: 0;" required="">
                    </div>
                </div>  

                <input type="submit" class="btn btn-primary" name="add" value="Import File" style="margin: 6px 0px 13px 15px;">
                <?php
                echo form_close();
            }
            ?>

        </div>
    </div>

</div>
<script>
    $(document).ready(function () {
        $("body").on("click", ".add-more", function () {
            var html = $(".after-add-more").first().clone();
            $(html).find(".change").html("<label for=''>&nbsp;</label><br/><a class='btn btn-danger remove'>- Remove</a>");

            $(".after-add-more").last().after(html);
            $(".addMores").last().val('');

        });

        $("body").on("click", ".remove", function () {
            $(this).parents(".after-add-more").remove();
        });
    });
</script>