<!doctype html>
<html>
<head>
<meta charset="utf-8">
<!-- <title>Proassur Card</title> -->
</head>
<?php
  // print_r($card_details->insurance_dates);
  $start_date = $card_details->insurance_dates->start_date;
  $end_date   = $card_details->insurance_dates->end_date;
  $dob        = $card_details->dob_of_person;
  $user_info  = $card_details->user_data;
?>
<body style="padding:0;margin:0;font-family:Arial, Helvetica, sans-serif;font-size:14px;color:#000;">
	<table width="350" border="0" align="center" cellpadding="0" cellspacing="0" style="padding:15px;border:1px solid #ddd;">
  <tbody>
    <tr>
      <td align="left" valign="middle">
        <img src="<?php echo $card_details->company_logo; ?>" style="border:none;display:block; width:60%;"/>
      </td>
      <td align="right" valign="middle">
        <img src="<?php echo $card_details->user_image;?>" style="border:none;display:block; width:50%;"/></td>
    </tr>

    <tr>
      <td colspan="2" align="left" valign="middle" style="font-family:Arial, Helvetica, sans-serif; font-size:15px;font-weight:600;line-height:24px;">Policy Number : <?php echo $card_details->policy_number;?>
      </td>
    </tr>

    <tr>
      <td colspan="2" align="left" valign="middle" style="font-family:Arial, Helvetica, sans-serif; font-size:15px;font-weight:600;line-height:24px;">Policy Effect Date : <?php echo date('m/d/y',strtotime($start_date));?>
      </td>
    </tr>

    <tr>
      <td colspan="2" align="left" valign="middle" style="font-family:Arial, Helvetica, sans-serif; font-size:15px;font-weight:600;line-height:24px;">Policy End Date : <?php echo date('m/d/y',strtotime($end_date));?>
      </td>
    </tr>

  	<tr>
      <td colspan="2" align="left" valign="middle" style="font-family:Arial, Helvetica, sans-serif; font-size:15px;font-weight:600;line-height:24px;">Insured Name : <?php echo $card_details->user_name;?></td>
  	</tr>
    <?php
      if($card_details->insurance_type_id == 2) { ?>
        <tr>
          <td colspan="2" align="left" valign="middle" style="font-family:Arial, Helvetica, sans-serif; font-size:15px;font-weight:600;line-height:24px;">Date Of Birth : <?php echo date('m/d/y',strtotime($dob));?>
          </td>
        </tr>

        <tr>
          <td colspan="2" align="left" valign="middle" style="font-family:Arial, Helvetica, sans-serif; font-size:15px;font-weight:600;line-height:24px;">Insurance Reimbursement Policy Rate : <?php echo $card_details->insurance_reimbursement_rate."%";?>
          </td>
        </tr>
      <?php } else { ?>
        <tr>
          <td colspan="2" align="left" valign="middle" style="font-family:Arial, Helvetica, sans-serif; font-size:15px;font-weight:600;line-height:24px;">Subscriber Address : <?php echo $user_info['address'];?>
          </td>
        </tr>

        <tr>
          <td colspan="2" align="left" valign="middle" style="font-family:Arial, Helvetica, sans-serif; font-size:15px;font-weight:600;line-height:24px;">Vehicle Plate : <?php echo $card_details->vehicle_plate;?>
          </td>
        </tr>

        <tr>
          <td colspan="2" align="left" valign="middle" style="font-family:Arial, Helvetica, sans-serif; font-size:15px;font-weight:600;line-height:24px;">Vehicle Type : <?php echo $card_details->vehicle_type;?>
          </td>
        </tr>

        <tr>
          <td colspan="2" align="left" valign="middle" style="font-family:Arial, Helvetica, sans-serif; font-size:15px;font-weight:600;line-height:24px;">Vehicle Make : <?php echo $card_details->vehicle_make;?>
          </td>
        </tr>
      <?php }
    ?>
   
  </tbody>
</table>

</body>
</html>