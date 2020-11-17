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
<style type="text/css">
  .cardWidth{width:100%;}
  <?php
    if($card_details->insurance_type_id == 1) { ?>
      .cardWidth strong,
      img {visibility:hidden;} <?php 
    }
  ?>
</style>
  <div class="cardWidth">
  <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" style="padding:15px; border:1px solid #ddd;">
  <tbody>

    <tr>
      <td colspan="2" style="border-bottom:1px solid #000;">
        <img src="<?php echo $card_details->company_logo; ?>" style="border:none; max-width:80px; max-height:50px;"/>
      </td>
    </tr>

    <tr>
      <td>
        <table border="0">
          
          <tr>
            <td align="left" valign="middle" style="font-family:Arial, Helvetica, sans-serif; font-size:14px;padding-top:10px;"><strong><?= getContentLanguageSelected('POLICY_NUMBER', defaultSelectedLanguage());?></strong> : <?php echo $card_details->policy_number;?>
            </td>
          </tr>

          <tr>
            <td align="left" valign="middle" style="font-family:Arial, Helvetica, sans-serif; font-size:14px;"><strong><?= getContentLanguageSelected('POLICY_EFFECT_DATE', defaultSelectedLanguage());?></strong> : <?php echo date('m/d/y',strtotime($start_date));?>
            </td>
          </tr>

          <tr>
            <td align="left" valign="middle" style="font-family:Arial, Helvetica, sans-serif; font-size:14px;"><strong><?= getContentLanguageSelected('POLICY_END_DATE', defaultSelectedLanguage());?></strong> : <?php echo date('m/d/y',strtotime($end_date));?>
            </td>
          </tr>

          <tr>
            <td align="left" valign="middle" style="font-family:Arial, Helvetica, sans-serif; font-size:14px;"><strong><?= getContentLanguageSelected('INSURED_NAME', defaultSelectedLanguage());?></strong> : <?php echo $card_details->user_name;?></td>
          </tr>

          <tr>
            <td align="left" valign="middle" style="font-family:Arial, Helvetica, sans-serif; font-size:14px;"><strong><?= getContentLanguageSelected('VEHICLE_PLATE', defaultSelectedLanguage());?></strong> : <?php echo $card_details->vehicle_plate;?>
            </td>
          </tr>

          <tr>
            <td align="left" valign="middle" style="font-family:Arial, Helvetica, sans-serif; font-size:14px;"><strong><?= getContentLanguageSelected('VEHICLE_TYPE', defaultSelectedLanguage());?></strong> : <?php echo $card_details->vehicle_type;?>
            </td>
          </tr>

          <tr>
            <td align="left" valign="middle" style="font-family:Arial, Helvetica, sans-serif; font-size:14px;"><strong><?= getContentLanguageSelected('VEHICLE_MAKE', defaultSelectedLanguage());?></strong> : <?php echo $card_details->vehicle_make;?>
            </td>
          </tr>
        
        </table>
      </td>

      <td align="left" valign="top" style="padding-top:15px;">
        <img src="<?php echo $card_details->user_image;?>" style="border:none; width:100px; height:100px;"/>
      </td>
    </tr>


    <tr>
      <td colspan="2" align="left" valign="middle" style="font-family:Arial, Helvetica, sans-serif; font-size:14px; padding-left:4px;"><strong><?= getContentLanguageSelected('SUBSCRIBER_ADDRESS', defaultSelectedLanguage());?></strong> : <?php echo $user_info['address'];?>
      </td>
    </tr> 

   
  </tbody>
</table>
</div>
</body>
</html>
