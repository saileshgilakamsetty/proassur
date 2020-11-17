
<?php
/* Question Controller
 * Author: Arvind Kumar Singh
 * Date: 11-12-2019
 */
?>

<div class="container-fluid">

    <div class="mainTitle">
        <h1><?php echo $title; ?> </h1>
         <div class="selectArea">      
           
            <aside class="pull-right">
               <a href="mailto:<?= getSettings('support_email')?>" class="askAdmin"><?= getContentLanguageSelected('ASK_ADMIN_FOR_THE_MODIFICATION', defaultSelectedLanguage()) ?></a>
            </aside>
        </div>
    </div>
    <!---->
    <div class="mngPay">
        <div class="payBox">
             <div class="pull-right">
            <a href="<?php echo base_url('question/add'); ?>"> <button class="btn btn-success"><?= getContentLanguageSelected('ADD_QUESTION', defaultSelectedLanguage()) ?></button></a>
            </div>
            <div class="selectArea">
                <div class="row">
                    <aside class="col-sm-5">


                        <?php
                        $selected = '';
                        $ins_type_id = array('' => 'Select Insurance');
                        $data = $this->db->get_where('tbl_insurance_type', ['status' => '1'])->result();
                        foreach ($data as $val) {
                            $ins_type_id[$val->id] = $val->type;
                        }
                        echo form_dropdown('ins_type_id', $ins_type_id, $selected, array('class' => 'form-control', 'id' => 'ins_type_id', 'required' => TRUE));
                        ?>
                    </aside>
                    
                    
                   
                </div>
            </div>
           
            <!---->
            <span id="success"></span>
            <span id="fail"></span>
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
            <div class="table-responsive">
                <table class="table" id="example" width="100%">
                    <thead>
                        <tr>
                            <th><?=getContentLanguageSelected('S_NO',defaultSelectedLanguage())?></th>
                            <th><?=getContentLanguageSelected('QUESTION',defaultSelectedLanguage())?></th>
                            <th><?=getContentLanguageSelected('INSURANCE_TYPE',defaultSelectedLanguage())?></th>
                            <th><?=getContentLanguageSelected('DATE',defaultSelectedLanguage())?></th>
                            <th><?=getContentLanguageSelected('STATUS',defaultSelectedLanguage())?></th>
                            <th><?=getContentLanguageSelected('ACTION',defaultSelectedLanguage())?></th>
                        </tr>
                    </thead>            
                </table>
            </div>
        </div>
    </div>
</div>
<script  src="https://code.jquery.com/jquery-3.3.1.js"></script>
<script  src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
<script  src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js"></script>

<script type="text/javascript">
    var mytable;
    $(document).ready(function () {
        $('body').tooltip({selector: '[data-toggle="tooltip"]'});
        fill_datatable();
        function fill_datatable(ins_type_id = '') {
            mytable = $('#example').DataTable({
                "processing": true,
                "serverSide": true,
                "ordering": false,
                "ajax": {
                    "url": "<?php echo site_url('question/DataList') ?>",
                    "type": "POST",
                    data: {
                        ins_type_id: ins_type_id
                    }
                }
            });
        }
        $("#ins_type_id").on('change', function () {
            var ins_type_id = $('#ins_type_id').val();

            if (ins_type_id != '') {
                $('#example').DataTable().destroy();
                fill_datatable(ins_type_id);

            } else {
                alert('Please select at least one option');
                $('#example').DataTable().destroy();
                fill_datatable();
            }
        });
    });
</script>

<script>
    $(document).ready(function () {
        $(document).on('click', '.del', function () {
            var id = $(this).data('delete');
            //alert(id);
            $.ajax({
                type: 'POST',
                url: '<?php echo site_url('question/ajaxdelete') ?>',
                data: {id: id},
                success: function (data) {
                    //alert(data);
                    if (data == 1) {
                        // alert(data);
                        $("#success").empty();
                        $("#success").append("<div class='alert alert-success alert-dismissible'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><i class='icon fa fa-check'></i> Success! Status Changed Suceessfully!</div>");
                        mytable.draw();
                        $("#success").fadeTo(2000, 500).slideUp(500, function () {
                            $("#success").slideUp(500);
                        });
                    } else {
                        $("#failed").empty();
                        $("#failed").append("<div class='alert alert-danger alert-dismissible'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><i class='icon fa fa-check'></i> Error! Oops went wrong!</div>");
                        $("#failed").fadeTo(2000, 500).slideUp(500, function () {
                            $("#failed").slideUp(500);
                        });
                    }

                }

            })
        })
        $(".alert-success").fadeTo(2000, 500).slideUp(500, function () {
            $(".alert-success").slideUp(500);
        });
        $(".alert-danger").fadeTo(2000, 500).slideUp(500, function () {
            $(".alert-danger").slideUp(500);
        });



    });

</script>

