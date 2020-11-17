<style>@import url(https://fonts.googleapis.com/css?family=Roboto:400,100,300,700,900);</style>

<style>
  table tr td{padding:10px;}
  table tr th{padding:10px; border-top:1px solid #CCC; text-align:left;}
</style>
<div>
  <table width="900" border="0" style="padding:20px;margin:0 auto;border:5px solid #347ea3;">
    <tbody>
      <tr>
        <td align="center" colspan="8">
          <b><?=getContentLanguageSelected('SLIP_REPORT',defaultSelectedLanguage())?></b><br>
          <b>Period : From <?= date('d/m/Y',strtotime($slip_details->quittances_start_interval));?> To <?= date('d/m/Y',strtotime($slip_details->quittances_end_interval)); ?></b><br>
          <b>Month : </b> <?= date('F Y',strtotime($slip_details->created_date));?>
        </td>
      </tr>
      <tr>
        <td>
          
        </td>
      </tr>
      <tr>
        <td align="left" colspan="8">
          <b><?=getContentLanguageSelected('SLIP_NAME',defaultSelectedLanguage())?> :</b> <?php echo $slip_name;?>
        </td>
      </tr>

      <tr>
        <td align="left" colspan="8">
          <b><?=getContentLanguageSelected('CREATED_DATE',defaultSelectedLanguage())?> :</b> <?php echo date('d M, Y',strtotime($slip_details->created_date));?>
        </td>
      </tr>

      <tr>
        <td>
          &nbsp;
        </td>
      </tr>
   
         
        <tr>
          <th><?=getContentLanguageSelected('USER_NAME',defaultSelectedLanguage())?></th>
          <th><?=getContentLanguageSelected('POLICY_NUMBER',defaultSelectedLanguage())?></th>
          <th><?=getContentLanguageSelected('NET_PREMIUM',defaultSelectedLanguage())?></th>
          <th><?=getContentLanguageSelected('TAX',defaultSelectedLanguage())?></th>
          <th><?=getContentLanguageSelected('ACCESSORIES',defaultSelectedLanguage())?></th>
          <th><?=getContentLanguageSelected('POLICY_CREATION_DATE',defaultSelectedLanguage())?></th>
          <th><?=getContentLanguageSelected('ADMIN_POLICY_COMMISSION',defaultSelectedLanguage())?></th>
          <th><?=getContentLanguageSelected('TOTAL_AMOUNT',defaultSelectedLanguage())?></th>
        </tr>
        <?php
          if(!empty($policy_data)) {
            $net_premium  = 0;
            $tax          = 0;
            $accessories  = 0;
            $total_amount = 0;
            foreach ($policy_data as $key => $value) { 
              $net_premium  += $value->net_premium;
              $tax          += $value->tax;
              $accessories  += $value->accessories;
              $admin_policy_commission += $value->admin_policy_commission;
              $total_amount += $value->total_amount;
              ?>
              <tr>
                <td><?= $value->user_name;?></td>
                <td><?= $value->policy_number;?></td>
                <td><?= $value->net_premium;?></td>
                <td><?= $value->tax;?></td>
                <td><?= $value->accessories;?></td>
                <td><?= date('d M, Y', strtotime($value->policy_creation_date));?></td>
                <td><?= $value->admin_policy_commission;?></td>
                <td><?= $value->total_amount;?></td>
              </tr>     
              <?php 
            }
          }
        ?>
         <tr>
          <th></th>
          <th><?=getContentLanguageSelected('TOTAL',defaultSelectedLanguage())?></th>
          <th><?=$net_premium;?></th>
          <th><?=$tax;?></th>
          <th><?=$accessories;?></th>
          <th></th>
          <th><?=$admin_policy_commission;?></th>
          <th><?=$total_amount;?></th>
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
