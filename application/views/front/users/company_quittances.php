<link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.6.1/css/buttons.dataTables.min.css">
<div class="container-fluid">
    <div class="mainTitle">
        <h1><?= getContentLanguageSelected('QUITTANCES', defaultSelectedLanguage()) ?></h1>
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
        <div class="panel-heading"><?= getContentLanguageSelected('ADVANCE_SEARCH', defaultSelectedLanguage()) ?> </div>
        <div class="panel-body">
            
            <div class="form-group col-sm-4">
                <label><?= getContentLanguageSelected('STATUS', defaultSelectedLanguage()) ?></label>
                <?php /*
                $selected = '';
                $insurance_type_id = array('' => '---Select Insurance Type---');
                $data = $this->db->get_where('tbl_insurance_type', ['status' => '1'])->result();
                foreach ($data as $val) {
                    $insurance_type_id[$val->id] = $val->type;
                }
                echo form_dropdown('insurance_type_id', $insurance_type_id, $selected, array('class' => 'form-control', 'id' => 'insurance_type_id', 'required' => TRUE));*/
                ?>
                <?php $data = ' class="form-control input " id="quittance_status"  name="quittance_status" required="true" ';
                    echo form_dropdown('quittance_status',getQuittanceStatusOptions('Select Status'),set_value("quittance_status",!empty($this->input->post('quittance_status'))?$this->input->post("quittance_status"):''),$data);
                ?>
            </div>
            
            <div class="form-group col-sm-4">
                <label><?= getContentLanguageSelected('FROM', defaultSelectedLanguage()) ?></label>
                <input type="text" name="start_date" class="form-control" id="start_date" autocomplete="off" placeholder="<?php echo date('d-m-Y'); ?>">
            </div>
            
            <div class="form-group col-sm-4">
                <label><?= getContentLanguageSelected('TO', defaultSelectedLanguage()) ?></label>
                <input type="text" name="end_date" class="form-control" id="end_date" autocomplete="off" placeholder="<?php echo date('d-m-Y'); ?>">
            </div>
            <button class="btn btn-primary" id="search"><?= getContentLanguageSelected('SEARCH', defaultSelectedLanguage()) ?></button>
            
        </div>
    </div>
    
    
    <div class="table-responsive">
        <table class="table display nowrap" id="example">
            <thead>
                <tr>    
                    <th>Sr.No.</th>
                    <th><?= getContentLanguageSelected('USER_NAME', defaultSelectedLanguage()) ?> </th>
                    <th><?= getContentLanguageSelected('POLICY_NUMBER', defaultSelectedLanguage()) ?> </th>
                    <th><?= getContentLanguageSelected('BRANCH', defaultSelectedLanguage()) ?> </th>
                    <th><?= getContentLanguageSelected('RISQUE', defaultSelectedLanguage()) ?> </th>
                    <th><?= getContentLanguageSelected('NET_PREMIUM', defaultSelectedLanguage()) ?> </th>
                    <th><?= getContentLanguageSelected('TAX', defaultSelectedLanguage()) ?> </th>
                    <th><?= getContentLanguageSelected('ACCESSORIES', defaultSelectedLanguage()) ?> </th>
                    <th><?= getContentLanguageSelected('POLICY_CREATION_DATE', defaultSelectedLanguage()) ?> </th>
                    <th><?= getContentLanguageSelected('ADMIN_POLICY_COMMISSION', defaultSelectedLanguage()) ?> </th>
                    <th><?= getContentLanguageSelected('TOTAL_PREMIUM', defaultSelectedLanguage()) ?> </th>
                    <th><?= getContentLanguageSelected('PREVIEW/PRINT', defaultSelectedLanguage()) ?> </th>
                    <th><?= getContentLanguageSelected('DOWNLOAD', defaultSelectedLanguage()) ?> </th>
                </tr>
            </thead>
            <tbody>
                <tfoot>
                <tr>
                    <th colspan="4" style="text-align:right">Total:</th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                </tr>
            </tfoot>
            </tbody>
        </table>
    </div>

</div>
</div>
</div>

<script  src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
<script  src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js"></script>

<script src="https://cdn.datatables.net/buttons/1.6.1/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.flash.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.print.min.js"></script>

<script type="text/javascript">
    var mytable;
    $(document).ready(function () {
        $('body').tooltip({selector: '[data-toggle="tooltip"]'});
        fill_datatable();
        function fill_datatable(quittance_status = '', start_date='', end_date='') {
            mytable = $('#example').DataTable({
                "footerCallback": function ( row, data, start, end, display ) {
                    var api = this.api(), data;
                    var hostname = window.location.hostname;
                    console.log(hostname);
                    // Remove the formatting to get integer data for summation
                    var intVal = function ( i ) {
                        return typeof i === 'string' ?
                            i.replace(/[\$,]/g, '')*1 :
                            typeof i === 'number' ?
                                i : 0;
                    };
                    

                    // Total over this page
                    total_net_premium = api
                        .column( 5 )
                        .data()
                        .reduce( function (a, b) {
                            return intVal(a) + intVal(b);
                        }, 0 );
         
                    // Total over this page
                    total_tax = api
                        .column( 6, { page: 'current'} )
                        .data()
                        .reduce( function (a, b) {
                            return intVal(a) + intVal(b);
                        }, 0 );


                    // Total over this page
                    total_accessories = api
                        .column( 7, { page: 'current'} )
                        .data()
                        .reduce( function (a, b) {
                            return intVal(a) + intVal(b);
                        }, 0 );
                        


                    // Total over this page
                    total_admin_commission = api
                        .column( 9, { page: 'current'} )
                        .data()
                        .reduce( function (a, b) {
                            return intVal(a) + intVal(b);
                        }, 0 );
                        


                    // Total over this page
                    total_premium = api
                        .column( 10, { page: 'current'} )
                        .data()
                        .reduce( function (a, b) {
                            return intVal(a) + intVal(b);
                        }, 0 );

                    // Update footer
                    $( api.column( 5 ).footer() ).html(total_net_premium);
                    $( api.column( 6 ).footer() ).html(total_tax);
                    $( api.column( 7 ).footer() ).html(total_accessories);
                    $( api.column( 9 ).footer() ).html(total_admin_commission);
                    $( api.column( 10 ).footer() ).html(total_premium);
                    /*$( api.column( 5 ).footer() ).html(
                        '$'+pageTotal +' ( $'+ total +' total)'
                    );*/
                },

                "processing"  : true,
                "serverSide"  : true,
                "ordering"    : false,
                "language"    : {
                   processing : '<i class="fa fa-spinner fa-spin fa-3x fa-fw"></i><span class="sr-only">Loading...</span> '
                },
                dom           : 'Bfrtip',
                buttons       : [ 
                    {
                        extend: 'excelHtml5',
                        exportOptions: {
                            columns: [ 0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10 ],
                            title:'quittance_status'
                        },
                        text: 'Export to Excel'
                    },

                    {
                        extend: 'pdfHtml5',
                        exportOptions: {
                            columns: [ 0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10 ]
                        },
                        text: 'Export to Pdf'
                    },

                    {
                        extend: 'print',
                        exportOptions: {
                            columns: [ 0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10 ]
                        },
                        text:'Print Quittances'
                    },

                    {
                        text:'Export/Print All Quittances',
                        action: function ( e, dt, node, config ) {
                            var hostname = window.location.hostname;
                            location.href = '<?php echo base_url("user/all_company_quittancesList");?>';
                        }
                    }

                ],
                "ajax"        : {
                    "url"     : "<?php echo site_url('user/company_quittancesList') ?>",
                    "type"    : "POST",
                    data      : {
                     quittance_status:quittance_status, start_date:start_date, end_date:end_date
                    }
                }

            });
        }
        $('#search').click(function () {
            var quittance_status = $('#quittance_status').val();
            var start_date       = $('#start_date').val();
            var end_date         = $('#end_date').val();
            if (quittance_status != '' || start_date!='' || end_date!='') {
                $('#example').DataTable().destroy();
                fill_datatable(quittance_status,start_date,end_date);
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

