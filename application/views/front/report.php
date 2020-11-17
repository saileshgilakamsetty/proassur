
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
    $company_logo = getCompanyNameByInsuranceTypeAndInsuredId($insurance_type_id, $insured_id);
    // print_r($payment_data)
    ?>
    
    
    <div class="container tableCustom">
        <h2 class="text-center">Policy Report as on  <?php echo date('d-m-Y'); ?></h2>
        <hr>
        <div style="width:33%;float:left;">
            <img src="<?= $company_logo ?>" style="width: 30%;">
        </div>
        <div style="width:33%;float:left;">
            <h2><?= getInsuranceType($insurance_type_id); ?> INSURANCE</h2>
        </div>
        <div style="width:33%;float:left;">
           <img src="<?php echo base_url('upload/qr_image/'.$qrcode);?>" style="width: 30%; float: right"> 
        </div>
        
        
        
        <table class="table borderless">
           
            <tbody>
                <tr>
                    <td>
                        <table class="table borderless">
                            <tbody>
                                <tr>
                                    <td width="50%">
                                        <table class="table borderless">
                                            <tbody>
                                                <tr>
                                                    <td colspan="2" class="pad0"><hr class="line1"></td>
                                                </tr>
                                                <tr>
                                                    <td colspan="2">
                                                        <?= getInsuranceType($insurance_type_id); ?>
                                                        INSURANCE</td>
                                                </tr>
                                                <tr>
                                                    <td colspan="2" class="pad0"><hr class="line2"></td>
                                                </tr>

                                                <?php foreach ($payment_data['payment_details'] as $key => $value) { ?>
                                                    <tr>
                                                        <td><?= $key ?></td>
                                                        <td align="right"><?= $value ?></td>
                                                    </tr>

                                                <?php }
                                                ?>

                                                <tr>
                                                    <td colspan="2" class="pad0"><hr class="line1"></td>
                                                </tr>
                                                <tr>
                                                    <td colspan="2"><?= getInsuranceType($insurance_type_id); ?>
                                                        INSURANCE</td>
                                                </tr>
                                                <tr>
                                                    <td colspan="2"><h2><?= getInsuranceType($insurance_type_id); ?>
                                                            INSURANCE</h2></td>
                                                </tr>
                                                <tr>
                                                    <td colspan="2"><h3><?= getInsuranceType($insurance_type_id); ?>
                                                            INSURANCE</h3></td>
                                                </tr>
                                                <tr>
                                                    <td colspan="2" class="pad0"><hr class="line2"></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </td>
                                    <td width="50%">
                                        <table class="table borderless">
                                            <tbody>
                                                <tr>
                                                    <td colspan="2" class="pad0"><hr class="line1"></td>
                                                </tr>
                                                <tr>
                                                    <td colspan="2"><?= getInsuranceType($insurance_type_id); ?>
                                                        INSURANCE</td>
                                                </tr>
                                                <tr>
                                                    <td colspan="2" class="pad0"><hr class="line2"></td>
                                                </tr>
                                                <?php
                                                if (!empty($payment_data['vehicle_detail'])) {
                                                    foreach ($payment_data['vehicle_detail'] as $key => $value) {
                                                        ?>
                                                        <tr>
                                                            <td><?= $key ?></td>
                                                            <td align="right"><?= $value ?></td>
                                                        </tr>
                                                        <?php
                                                    }
                                                } else if (!empty($payment_data['health_insurance_detail'])) {
                                                    foreach ($payment_data['health_insurance_detail'] as $key => $value) {
                                                        ?>
                                                        <tr>
                                                            <td><?= $key ?></td>
                                                            <td align="right"><?= $value ?></td>
                                                        </tr>
                                                        <?php
                                                    }

                                                    if (!empty($payment_data['health_insurance_person_details'])) {
                                                        ?>
                                                        <tr>
                                                            <td colspan="2" class="pad0"><hr class="line1"></td>
                                                        </tr>

                                                        <?php foreach ($payment_data['health_insurance_person_details'] as $key => $value) { ?>
                                                            <tr>
                                                                <td><?= $key ?></td>
                                                                <td align="right"><?= $value ?></td>
                                                            </tr>
                                                            <?php
                                                        }
                                                    }
                                                } else if (!empty($payment_data['travel_people_insured'])) {
                                                    foreach ($payment_data['travel_people_insured'] as $key => $value) {
                                                        ?>
                                                        <tr>
                                                            <td><?= $key ?></td>
                                                            <td align="right"><?= $value ?></td>
                                                        </tr>
                                                        <?php
                                                    }

                                                    if (!empty($payment_data['travel_people_details'])) {
                                                        ?>
                                                        <?php foreach ($payment_data['travel_people_details'] as $key => $value) { ?>
                                                            <tr>
                                                                <td><?= $key ?></td>
                                                                <td align="right"><?= $value ?></td>
                                                            </tr>
                                                            <?php
                                                        }
                                                    }

                                                    if (!empty($payment_data['travel_destination_details'])) {
                                                        foreach ($payment_data['travel_destination_details'] as $key => $value) {
                                                            ?>
                                                            <tr>
                                                                <td><?= $key ?></td>
                                                                <td align="right"><?= $value ?></td>
                                                            </tr>
                                                            <?php
                                                        }
                                                    }
                                                } else if (!empty($payment_data['proffesional_multirisk_quote_details'])) {
                                                    foreach ($payment_data['proffesional_multirisk_quote_details'] as $key => $value) {
                                                        ?>
                                                        <tr>
                                                            <td><?= $key ?></td>
                                                            <td align="right"><?= $value ?></td>
                                                        </tr>
                                                        <?php
                                                    }
                                                } else if (!empty($payment_data['individual_accident_person_details'])) {
                                                    foreach ($payment_data['individual_accident_person_details'] as $key => $value) {
                                                        ?>
                                                        <tr>
                                                            <td><?= $key ?></td>
                                                            <td align="right"><?= $value ?></td>
                                                        </tr>
                                                        <?php
                                                    }
                                                } else if (!empty($payment_data['credit_detail'])) {
                                                    foreach ($payment_data['credit_detail'] as $key => $value) {
                                                        ?>
                                                        <tr>
                                                            <td><?= $key ?></td>
                                                            <td align="right"><?= $value ?></td>
                                                        </tr>
                                                        <?php
                                                    }

                                                    if (!empty($payment_data['credit_calculation_rate_details'])) {
                                                        foreach ($payment_data['credit_calculation_rate_details'] as $key => $value) {
                                                            ?>
                                                            <tr>
                                                                <td><?= $key ?></td>
                                                                <td align="right"><?= $value ?></td>
                                                            </tr>
                                                            <?php
                                                        }
                                                    }

                                                    if (!empty($payment_data['credit_calculation_rate_details_by_year'])) {
                                                        ?>
                                                        <tr>
                                                            <td colspan="2" class="pad0"><hr class="line1"></td>
                                                        </tr>
                                                        <?php foreach ($payment_data['credit_calculation_rate_details_by_year'] as $key => $value) { ?>
                                                            <tr>
                                                                <td><?= $key ?></td>
                                                                <td align="right"><?= $value ?></td>
                                                            </tr>
                                                            <?php
                                                        }
                                                    }
                                                } else if (!empty($payment_data['house_detail'])) {
                                                    foreach ($payment_data['house_detail'] as $key => $value) {
                                                        ?>
                                                        <tr>
                                                            <td><?= $key ?></td>
                                                            <td align="right"><?= $value ?></td>
                                                        </tr>
                                                        <?php
                                                    }
                                                }
                                                ?>
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
                                                    <td><strong>Warranties</strong></td>
                                                    <td align="right"><strong>Amount</strong></td>
                                                </tr>
                                                <tr>
                                                    <td colspan="2" class="pad0"><hr class="line1"></td>
                                                </tr>

                                                <?php
                                                if (!empty($payment_data['vehicle_warranties'])) {
                                                    foreach ($payment_data['vehicle_warranties'] as $key => $value) {
                                                        ?>
                                                        <tr>
                                                            <td><?= $key ?></td>
                                                            <td align="right"><?= $value ?></td>
                                                        </tr>
                                                        <?php
                                                    }
                                                } else if (!empty($payment_data['professional_multirisk_warranties'])) {
                                                    foreach ($payment_data['professional_multirisk_warranties'] as $key => $value) {
                                                        ?>
                                                        <tr>
                                                            <td><?= $key ?></td>
                                                            <td align="right"><?= $value ?></td>
                                                        </tr>
                                                        <?php
                                                    }
                                                } else if (!empty($payment_data['credit_warranties'])) {
                                                    foreach ($payment_data['credit_warranties'] as $key => $value) {
                                                        ?>
                                                        <tr>
                                                            <td><?= $key ?></td>
                                                            <td align="right"><?= $value ?></td>
                                                        </tr>
                                                        <?php
                                                    }
                                                } else if (!empty($payment_data['house_warranties'])) {
                                                    foreach ($payment_data['house_warranties'] as $key => $value) {
                                                        ?>
                                                        <tr>
                                                            <td><?= $key ?></td>
                                                            <td align="right"><?= $value ?></td>
                                                        </tr>
                                                        <?php
                                                    }
                                                }
                                                ?>


                                            </tbody>
                                        </table>
                                    </td>
                                    <td>
                                        <table class="table borderless text-center">
                                            <tbody>
                                                <tr>
                                                    <td colspan="2" class="pad0"><hr class="line1"></td>
                                                </tr>
                                                <tr>
                                                        <!-- <td colspan="2"><strong>Franchises</strong></td> -->
                                                    <td><strong>Franchises</strong></td>
                                                    <td align="right"><strong>Amount</strong></td>
                                                </tr>
                                                <tr>
                                                    <td colspan="2" class="pad0"><hr class="line1"></td>
                                                </tr>


                                                <?php
                                                if (!empty($payment_data['vehicle_franchises'])) {
                                                    foreach ($payment_data['vehicle_franchises'] as $key => $value) {
                                                        ?>
                                                        <tr>
                                                            <td><?= $key ?></td>
                                                            <td align="right"><?= $value ?></td>
                                                        </tr>
                                                        <?php
                                                    }
                                                } else if (!empty($payment_data['professional_multirisk_franchises'])) {
                                                    foreach ($payment_data['professional_multirisk_franchises'] as $key => $value) {
                                                        ?>
                                                        <tr>
                                                            <td><?= $key ?></td>
                                                            <td align="right"><?= $value ?></td>
                                                        </tr>
                                                        <?php
                                                    }
                                                } else if (!empty($payment_data['credit_franchises'])) {
                                                    foreach ($payment_data['credit_franchises'] as $key => $value) {
                                                        ?>
                                                        <tr>
                                                            <td><?= $key ?></td>
                                                            <td align="right"><?= $value ?></td>
                                                        </tr>
                                                        <?php
                                                    }
                                                } else if (!empty($payment_data['house_franchises'])) {
                                                    foreach ($payment_data['house_franchises'] as $key => $value) {
                                                        ?>
                                                        <tr>
                                                            <td><?= $key ?></td>
                                                            <td align="right"><?= $value ?></td>
                                                        </tr>
                                                        <?php
                                                    }
                                                }
                                                ?>
                                            </tbody>
                                        </table>
                                    </td>
                                    <td>
                                        <table class="table borderless">
                                            <tbody>
                                                <tr>
                                                    <td colspan="2" class="pad0"><hr class="line1"></td>
                                                </tr>
                                                <tr>
                                                    <td><strong>Finalized Data</strong></td>
                                                    <td align="right"><strong>Amount</strong></td>
                                                </tr>
                                                <tr>
                                                    <td colspan="2" class="pad0"><hr class="line1"></td>
                                                </tr>

                                                <?php
                                                if (!empty($payment_data['data_final'])) {
                                                    foreach ($payment_data['data_final'] as $key => $value) {
                                                        ?>
                                                        <tr>
                                                            <td><?= $key ?></td>
                                                            <td align="right"><?= $value ?></td>
                                                        </tr>
                                                        <?php
                                                    }
                                                } else if (!empty($payment_data['data_final_health'])) {
                                                    foreach ($payment_data['data_final_health'] as $key => $value) {
                                                        ?>
                                                        <tr>
                                                            <td><?= $key ?></td>
                                                            <td align="right"><?= $value ?></td>
                                                        </tr>
                                                        <?php
                                                    }
                                                } else if (!empty($payment_data['data_final_travel'])) {
                                                    foreach ($payment_data['data_final_travel'] as $key => $value) {
                                                        ?>
                                                        <tr>
                                                            <td><?= $key ?></td>
                                                            <td align="right"><?= $value ?></td>
                                                        </tr>
                                                        <?php
                                                    }
                                                } else if (!empty($payment_data['data_final_professional_multirisk'])) {
                                                    foreach ($payment_data['data_final_professional_multirisk'] as $key => $value) {
                                                        ?>
                                                        <tr>
                                                            <td><?= $key ?></td>
                                                            <td align="right"><?= $value ?></td>
                                                        </tr>
                                                        <?php
                                                    }
                                                } else if (!empty($payment_data['data_final_individual_accident'])) {
                                                    foreach ($payment_data['data_final_individual_accident'] as $key => $value) {
                                                        ?>
                                                        <tr>
                                                            <td><?= $key ?></td>
                                                            <td align="right"><?= $value ?></td>
                                                        </tr>
                                                        <?php
                                                    }
                                                } else if (!empty($payment_data['data_final_credit'])) {
                                                    foreach ($payment_data['data_final_credit'] as $key => $value) {
                                                        ?>
                                                        <tr>
                                                            <td><?= $key ?></td>
                                                            <td align="right"><?= $value ?></td>
                                                        </tr>
                                                        <?php
                                                    }
                                                } else {
                                                    foreach ($payment_data['data_final_house'] as $key => $value) {
                                                        ?>
                                                        <tr>
                                                            <td><?= $key ?></td>
                                                            <td align="right"><?= $value ?></td>
                                                        </tr>
                                                        <?php
                                                    }
                                                }
                                                ?> 

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
