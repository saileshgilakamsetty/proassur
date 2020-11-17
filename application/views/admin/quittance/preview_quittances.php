<style>@import url(https://fonts.googleapis.com/css?family=Roboto:400,100,300,700,900);</style>

<style>
  table tr td{padding:10px;}
  table tr th{padding:10px; border-top:1px solid #CCC; text-align:left;}
</style>
<div>
  <table width="900" border="0" style="padding:20px;margin:0 auto;border:5px solid #347ea3;">
    <tbody>
      <tr>
		  <td colspan="4">
            <div style="width:33%;float:left;">
              <img src="<?= getCompanyLogo($_GET['company_id']) ?>" style="width: 100%;">
            </div>
          </td>
        <td align="center" colspan="4">
          <b><?=getContentLanguageSelected('QUITTANCES_REPORT',defaultSelectedLanguage())?></b><br><br>
          <?php
            if(!empty($this->input->get('policy_start_date'))) { ?>
              <b>Period : From <?= date('d/m/Y',strtotime($_GET['policy_start_date']));?> To <?= date('d/m/Y',strtotime($_GET['policy_end_date'])); ?></b><br>
           <?php }
          ?>
        </td>
      </tr>
      <tr>
        <?php if(!empty($this->input->get('company_id'))) { ?>
          <td align="center" colspan="12">
            <b><?= getContentLanguageSelected('COMPANY',defaultSelectedLanguage()) ?> : <?= getCompanyName($_GET['company_id'])?></b>
          </td>
        <?php }?>
      </tr>

      <tr>
        <td>
          &nbsp;
        </td>
      </tr>
   
         
        <tr>
		  <th><?=getContentLanguageSelected('QUITTANCE_NUMBER',defaultSelectedLanguage())?></th>
          <th><?=getContentLanguageSelected('USER_NAME',defaultSelectedLanguage())?></th>
          <th><?=getContentLanguageSelected('POLICY_NUMBER',defaultSelectedLanguage())?></th>
          <?php if(empty($this->input->get())) { ?>
            <th><?=getContentLanguageSelected('COMPANY',defaultSelectedLanguage())?></th>
          <?php } ?>
          <th><?=getContentLanguageSelected('BRANCH',defaultSelectedLanguage())?></th>
          <th><?=getContentLanguageSelected('RISQUE',defaultSelectedLanguage())?></th>
          <th><?=getContentLanguageSelected('NET_PREMIUM',defaultSelectedLanguage())?></th>
          <th><?=getContentLanguageSelected('TAX',defaultSelectedLanguage())?></th>
          <th><?=getContentLanguageSelected('ACCESSORIES',defaultSelectedLanguage())?></th>
          <th><?=getContentLanguageSelected('POLICY_START_DATE',defaultSelectedLanguage())?></th>
          <th><?=getContentLanguageSelected('POLICY_END_DATE',defaultSelectedLanguage())?></th>
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
				<td><?= $value->id;?></td>  
                <td><?= $value->user_name;?></td>
                <td><?= $value->policy_number;?></td>
                <?php if(empty($this->input->get())) { ?>
                  <td><?= getCompanyName($value->company_id)?></td>
                <?php }?>
                <td><?= ($value->branch_id)?getBranchName($value->branch_id):'';?></td>
                <td><?= ($value->risque_id)?getRisqueName($value->risque_id):'Not Available';?></td>
                <td><?= $value->net_premium;?></td>
                <td><?= $value->tax;?></td>
                <td><?= $value->accessories;?></td>
                <td><?= date('d M, Y',strtotime($value->policy_start_date));?></td>
                <td><?= date('d M, Y',strtotime($value->policy_end_date));?></td>
                <td><?= date('d M, Y',strtotime($value->policy_creation_date));?></td>
                <td><?= $value->admin_policy_commission;?></td>
                <td><?= $value->total_amount;?></td>
              </tr>     
              <?php 
            }
          }
        ?>
         <tr>
          <th></th>
          <th></th>
          <th></th>
          <?php if(empty($this->input->get())) { ?>
            <th></th>
          <?php } ?>
          <th></th>
          <th><?=getContentLanguageSelected('TOTAL',defaultSelectedLanguage())?></th>
          <th><?=$net_premium;?></th>
          <th><?=$tax;?></th>
          <th><?=$accessories;?></th>
          <th></th>
          <th></th>
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
