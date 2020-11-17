<link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.6.1/css/buttons.dataTables.min.css">
<div class="container-fluid">
    <!-- <div class="mainTitle">
        <h1><?= getContentLanguageSelected('QUITTANCES', defaultSelectedLanguage()) ?></h1>
       <div class="selectArea">      
           
            <aside class="pull-right">
                <a href="mailto:<?= getSettings('support_email')?>" class="askAdmin"><?= getContentLanguageSelected('ASK_ADMIN_FOR_THE_MODIFICATION', defaultSelectedLanguage()) ?></a>
            </aside>
        </div>
    </div>
         -->
        
    <div class="mngPay">
    <div class="payBox">
        
    
    <hr>

    
    
    
    <div class="table-responsive">
        <table class="table display nowrap" id="example" style="width:100%">
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
                    <!-- <th><?= getContentLanguageSelected('PREVIEW/PRINT', defaultSelectedLanguage()) ?> </th>
                    <th><?= getContentLanguageSelected('DOWNLOAD', defaultSelectedLanguage()) ?> </th> -->
                </tr>
            </thead>
            <tbody>
                <?php $i=1; foreach($list as $list_mem){?>
                    <tr>
                        <th><?=$i++?></th>
                        <th><?=getUserName($list_mem->user_id);?></th>
                        <th><?=$list_mem->policy_number;?></th>
                        <th><?=(getBranchName($list_mem->branch_id))?getBranchName($list_mem->branch_id):'Not Available';?></th>
                        <th><?=(getRisqueName($list_mem->risque_id))?getRisqueName($list_mem->risque_id):'Not Available';?></th>
                        <th><?=$list_mem->amount;?></th>
                        <th><?=$list_mem->tax;?></th>
                        <th><?=$list_mem->accessories;?></th>
                        <th><?=date('d M, Y',strtotime($list_mem->policy_creation_date));?></th>
                        <th><?=$list_mem->admin_policy_commission;?></th>
                        <th><?=$list_mem->total_amount;?></th>
                        
                    </tr>
                <?php }?>
            </tbody>
        </table>
    </div>

</div>
</div>
</div>



<script type="text/javascript">
    $(document).ready(function() {
        $('#example').DataTable( {
            dom: 'Bfrtip',
            buttons: [
                {
                    extend: 'excelHtml5',
                    exportOptions: {
                        columns: [ 0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10 ],
                        title:'quittance_status'
                    },
                    text: 'Export All to Excel'
                },

                {
                    extend: 'pdfHtml5',
                    exportOptions: {
                        columns: [ 0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10 ]
                    },
                    text: 'Export All to Pdf'
                },

                {
                    extend: 'print',
                    exportOptions: {
                        columns: [ 0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10 ]
                    },
                    text:'Print All Quittances'
                }
            ]
        } );
    } );
</script>
<script  src="https://code.jquery.com/jquery-3.3.1.js"></script>
<script  src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
<script  src="https://cdn.datatables.net/buttons/1.6.1/js/dataTables.buttons.min.js"></script>
<script  src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.print.min.js"></script>

<script src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.flash.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.html5.min.js"></script>
