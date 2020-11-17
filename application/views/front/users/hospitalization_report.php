
<style>
    .tableCustom table.table{margin:0px;}
    .tableCustom td.pad0{padding:0px !important;}
    .tableCustom table hr.line1{padding:0px; margin:0px; border-color:#000;}
    .tableCustom table hr.line2{padding:0px; margin:0px; border-color:#000; border-width:2px;}
    .tableCustom table.borderless > tbody > tr > td{border:0px;}
    .tableCustom table.borderless > thead > tr > th{border:0px;}
</style>

<body>
    <!-- PDF TABLE -->

    <?php
    $company_logo = getCompanyLogo($hospitalization->insurance_company_id);
    // print_r($payment_data)
    ?>
    
    
    <div class="container tableCustom">
        <h2 class="text-center">Hospitalization Report as on  <?php echo date('d M Y'); ?></h2>
        <hr>
        <div style="width:33%;float:left;">
            <img src="<?= $company_logo ?>" style="width: 30%;">
        </div>
        <div style="width:33%;float:left;">
            <h2> <?= getContentLanguageSelected('COMPANY', defaultSelectedLanguage()) ?> : <?= $hospitalization['Insurance Company Name']?> </h2>
        </div>
        
        
        
        <table class="table borderless">
           
            <tbody>
                <tr>
                    <td>
                        <table class="table borderless">
                            <tbody>
                                <tr>
                                    <td>
                                        <table class="table borderless">
                                            <tbody>
                                                <tr>
                                                    <td colspan="2" class="pad0"><hr class="line1"></td>
                                                </tr>
                                                <tr>
                                                    <td colspan="2">
                                                        <b><?= getContentLanguageSelected('HOSPITALIZATION_DETAILS', defaultSelectedLanguage()) ?></b>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td colspan="2" class="pad0"><hr class="line2"></td>
                                                </tr>

                                                <?php foreach ($hospitalization as $key => $value) { ?>
                                                    <tr>
                                                        <td><b><?= $key ?></b></td>
                                                        <td align="right"><?= $value ?></td>
                                                    </tr>
                                                <?php }
                                                ?>

                                                <tr>
                                                    <td colspan="2" class="pad0"><hr class="line1"></td>
                                                </tr>
                                                
                                                <tr>
                                                    <td colspan="2" class="pad0"><hr class="line2"></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </td> 
                                </tr>
                            </tbody>
                        </table>
                    </td>
                </tr>
               
            </tbody>
        </table>
    </div>
