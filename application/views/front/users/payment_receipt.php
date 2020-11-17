<style>@import url(https://fonts.googleapis.com/css?family=Roboto:400,100,300,700,900);</style>

<style>
  table tr td{padding:10px;}
  table tr th{padding:10px; border-top:1px solid #CCC; text-align:left;}
  table table.tableBox thead tr th{text-align:center; border:1px solid #CCC; height:150px; vertical-align:top;}
</style>
<div>
  <table width="900" border="0" style="padding:20px;margin:0 auto;border:5px solid #347ea3;">
    <tbody>
      <tr>
        <td align="left" colspan="6">
          <b>PROASSUR S.A.</b><br>
          <b>POINT E, AVENUE BIRAGO DIOP</b><br>
          <b>TEL : </b><?=getSettings('support_contact_code')?> <?=getSettings('support_contact')?> &nbsp; <b>FAX : </b>+221 33 825 23 46<br>
        </td>
        <td align="right" colspan="6">
          <b><?=getContentLanguageSelected('RECEIPT_NUMBER',defaultSelectedLanguage())?>:</b> <?php echo $payment_data->id;?><br>
          <b><?=getContentLanguageSelected('TOTAL_AMOUNT',defaultSelectedLanguage())?>:</b> <?php echo $payment_data->amount;?>
        </td>
      </tr>
      <tr>
        <td align="left" colspan="6">
          <b><?=getContentLanguageSelected('PAYMENT_AMOUNT',defaultSelectedLanguage())?> :</b> <?php echo $payment_data->amount;?> <br>
          <b><?=getContentLanguageSelected('PAYMENT_METHOD',defaultSelectedLanguage())?> :</b> <?php echo getPaymentMode($payment_data->payment_method);?>
        </td>
        <td align="right" colspan="6">
          <b><?= getContentLanguageSelected('PAYMENT_DATE',defaultSelectedLanguage())?>:</b> <?= date('d M, Y', strtotime($payment_data->modified_date));?></b>
        </td>
      </tr>


      <tr>
        <td>
          &nbsp;
        </td>
      </tr>
   
      <tr>
        <td align="center" colspan="8">
          <b><?= getContentLanguageSelected('DETAILS',defaultSelectedLanguage())?>
        </td>
      </tr>
         
        <tr>
          <th><?=getContentLanguageSelected('CLIENT',defaultSelectedLanguage())?></th>
          <th><?=getContentLanguageSelected('USER_NAME',defaultSelectedLanguage())?></th>
          <th><?=getContentLanguageSelected('POLICY_NUMBER',defaultSelectedLanguage())?></th>
          <th><?=getContentLanguageSelected('QUITTANCE_NUMBER',defaultSelectedLanguage())?></th>
          <th><?=getContentLanguageSelected('POLICY_START_DATE',defaultSelectedLanguage())?></th>
          <th><?=getContentLanguageSelected('POLICY_END_DATE',defaultSelectedLanguage())?></th>
          <th><?=getContentLanguageSelected('AMOUNT',defaultSelectedLanguage())?></th>
          <th><?=getContentLanguageSelected('REMARK',defaultSelectedLanguage())?></th>
        </tr>
        <?php
          if(!empty($payment_data)) {
            $insurance_details = getFinalizedInsuranceDetails($payment_data->insured_id,$payment_data->insurance_type_id); ?>
            <tr>
              <td></td>
              <td><?= getUsername($payment_data->user_id);?></td>
              <td><?= $payment_data->policy_number;?></td>
              <td></td>
              <td><?= date('d M, Y', strtotime($insurance_details['policy_start_date']));?></td>
              <td><?= date('d M, Y', strtotime($insurance_details['policy_end_date']));?></td>
              <td><?= $payment_data->amount;?></td>
            </tr>     
            <?php 
          }
        ?>


        <tr></tr>
        <br><br><br><br>

        <tr><td align="left" colspan="8">Done at <b><?= date('d M, Y', strtotime($payment_data->modified_date));?></b></td></tr>

        <tr>
          <td colspan="8">
            <table class="tableBox" cellspacing="0" width="100%">
              <thead>
                <tr>
                  <th><?=getContentLanguageSelected('CLIENT',defaultSelectedLanguage())?></th>
                  <th><?=getContentLanguageSelected('CASHIER',defaultSelectedLanguage())?></th>
                  <th><?=getContentLanguageSelected('MANAGEMENT',defaultSelectedLanguage())?></th>
                  <th><?=getContentLanguageSelected('STAMP',defaultSelectedLanguage())?></th>
                </tr>
              </thead>
            </table>
          </td>
        </tr>

      <tr><td>
          &nbsp;
        </td></tr>
      <tr>
        <td>
          <p>Team, Proassur</p>        
        </td>
      </tr>
      <tr>
        <td style="text-align:center;font-family:roboto;font-size:11px;padding:0px;">
          <p>Copyright@<?php echo date('Y')?> </p>
        </td>
      </tr>
    </tbody>
  </table>
</div>
