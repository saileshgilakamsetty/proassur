<link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.6.1/css/buttons.dataTables.min.css">


<div class="container-fluid">
    <div class="mainTitle">
        <h1><?= getContentLanguageSelected('HOSPITALIZATION_MANAGEMENT', defaultSelectedLanguage()) ?></h1>
       <div class="selectArea">      
           
            <aside class="pull-right">
                <a href="mailto:<?= getSettings('support_email')?>" class="askAdmin"><?= getContentLanguageSelected('ASK_ADMIN_FOR_THE_MODIFICATION', defaultSelectedLanguage()) ?></a>
            </aside>
        </div>
    </div>
    <div class="pull-right">
        <a href="<?php echo base_url('hospitalization'); ?>"> <button class="btn btn-success"><?= getContentLanguageSelected('ADD_NEW_HOSPITALIZATION', defaultSelectedLanguage()) ?></button></a>
    </div>        
        
    <div class="mngPay">
    <div class="payBox">
        
    
    <hr>
    
    <div class="table-responsive">
        <table class="table" id="example">
            <thead>
                <tr>    
                    <th>Sr.No.</th>
                    <th><?= getContentLanguageSelected('POLICY_HOLDER_NAME', defaultSelectedLanguage()) ?> </th>
                    <th><?= getContentLanguageSelected('POLICY_NUMBER', defaultSelectedLanguage()) ?> </th>
                    <th><?= getContentLanguageSelected('COMPANY_NAME', defaultSelectedLanguage()) ?> </th>
                    <th><?= getContentLanguageSelected('THE_PATIENT_NAME', defaultSelectedLanguage()) ?> </th>
                    <th><?= getContentLanguageSelected('HEALTHCARE_PROVIDER_NAME', defaultSelectedLanguage()) ?> </th>
                    <th><?= getContentLanguageSelected('APPROVED_STATUS', defaultSelectedLanguage()) ?> </th>
                    <th><?= getContentLanguageSelected('ACTION', defaultSelectedLanguage()) ?> </th>
                </tr>
            </thead>
        </table>
    </div>

</div>
</div>
</div>

<script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js"></script>
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
        function fill_datatable(start_date='', end_date='') {
            mytable = $('#example').DataTable({
                
                "processing" : true,
                "serverSide" : true, 
                "ordering"   : false,
                "language": {
                   processing: '<i class="fa fa-spinner fa-spin fa-3x fa-fw"></i><span class="sr-only">Loading...</span> '
                },
                dom          : 'Bfrtip',
                buttons      : [ 'excel', 'pdf', 'print' ],
                "ajax"       : {
                    "url"  : "<?php echo site_url('user/hospitalizationList') ?>",
                    "type" : "POST",
                    data   : {
                        start_date:start_date, end_date:end_date
                    }
                }
            });
        }
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

