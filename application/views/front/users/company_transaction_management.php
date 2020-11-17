<div class="container-fluid">
    <div class="mainTitle">
        <h1><?= getContentLanguageSelected('PAYMENTS', defaultSelectedLanguage()) ?></h1>
       <div class="selectArea">      
           
            <aside class="pull-right">
                <a href="mailto:<?= getSettings('support_email')?>" class="askAdmin"><?= getContentLanguageSelected('ASK_ADMIN_FOR_THE_MODIFICATION', defaultSelectedLanguage()) ?></a>
            </aside>
        </div>
    </div>
        
        
    <div class="mngPay">
    <div class="payBox">
        
    
    <hr>

    <div class="panel panel-primary">
        <div class="panel-heading">Advance Search</div>
        <div class="panel-body">
            
            <div class="form-group col-sm-4">
                <label>Insurance Type:</label>
                <?php
                $selected = '';
                $insurance_type_id = array('' => '---Select Insurance Type---');
                $data = $this->db->get_where('tbl_insurance_type', ['status' => '1'])->result();
                foreach ($data as $val) {
                    $insurance_type_id[$val->id] = $val->type;
                }
                echo form_dropdown('insurance_type_id', $insurance_type_id, $selected, array('class' => 'form-control', 'id' => 'insurance_type_id', 'required' => TRUE));
                ?>
            </div>
            
            <div class="form-group col-sm-4">
                <label>From Date:</label>
                <input type="text" name="start_date" class="form-control" id="start_date" placeholder="<?php echo date('d-m-Y'); ?>">
            </div>
            
            <div class="form-group col-sm-4">
                <label>To Date:</label>
                <input type="text" name="end_date" class="form-control" id="end_date" placeholder="<?php echo date('d-m-Y'); ?>">
            </div>
            <button class="btn btn-primary" id="search">Search</button>
            
        </div>
    </div>
    
    
    <div class="table-responsive">
        <table class="table" id="example">
            <thead>
                <tr>    
                    <th>Sr.No.</th>
                    <th><?= getContentLanguageSelected('Amount', defaultSelectedLanguage()) ?> </th>
                    <th><?= getContentLanguageSelected('Payment Mode', defaultSelectedLanguage()) ?> </th>
                    <th><?= getContentLanguageSelected('Insurance Type', defaultSelectedLanguage()) ?> </th>
                    <th><?= getContentLanguageSelected('Date', defaultSelectedLanguage()) ?> </th>                    
                    <th><?= getContentLanguageSelected('Download', defaultSelectedLanguage()) ?> </th>
                </tr>
            </thead>

        </table>
    </div>

</div>
</div>
</div>

<script  src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
<script  src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js"></script>

<script type="text/javascript">
    var mytable;
    $(document).ready(function () {
        $('body').tooltip({selector: '[data-toggle="tooltip"]'});
        fill_datatable();
        function fill_datatable(insurance_type_id = '', start_date='', end_date='') {
            mytable = $('#example').DataTable({
                "processing": true,
                "serverSide": true,
                "ordering": false,
                "language": {
                   processing: '<i class="fa fa-spinner fa-spin fa-3x fa-fw"></i><span class="sr-only">Loading...</span> '
                },
                "ajax": {
                    "url": "<?php echo site_url('user/company_transactionList') ?>",
                    "type": "POST",
                    data: {
                        insurance_type_id: insurance_type_id, start_date:start_date, end_date:end_date
                    }
                }
            });
        }
        $('#search').click(function () {
            var insurance_type_id = $('#insurance_type_id').val();
            var start_date = $('#start_date').val();
            var end_date = $('#end_date').val();
            
            
            if (insurance_type_id != '' || start_date!='' || end_date!='') {
                $('#example').DataTable().destroy();
                fill_datatable(insurance_type_id,start_date,end_date);

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

