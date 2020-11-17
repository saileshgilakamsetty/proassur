<?php
	//$transaction_id = random_string('numeric',5);
	if($user_payment_data['payment_status'] == 0) {
    	$payment_status = 'Pending';
	} else if($user_payment_data['payment_status'] == 1) {
	    $payment_status = 'Failed';
	} else if($user_payment_data['payment_status'] == 2) {
	    $payment_status = 'Success';
	} else {
	    $payment_status = 'Expired';
	}

	$policy_creater_role = $this->session->userdata('role');
?>
<section class="insurForm">
	<div class="container">
	   	<div class="formFildes">
	   		
	      	<div class="col-xs-12">
	        	<h3 class="carOwner"><?=getContentLanguageSelected('REQUIRED_DETAILS_FOR_PAYMENT',defaultSelectedLanguage())?></h3>
	        	<?php 
		            if($this->session->flashdata('message')) { ?>
		                <h3 class="carOwner"><?= $this->session->flashdata('message');?></h3>
		            <?php }
		        ?>
	      	</div>
	      	<input type="hidden" id="insurance_type_id" value="<?= $user_payment_data['insurance_type_id']?>">
			<input type="hidden" id="user_id" value="<?= $user_payment_data['user_id']?>">
			<input type="hidden" id="insured_id" value="<?= $user_payment_data['insured_id']?>">
			<input type="hidden" id="accessories_id" value="<?= $user_payment_data['accessories_id']?>">
			<input type="hidden" id="amount" value="<?= $user_payment_data['amount']?>">

			<div class="col-xs-12 policyCalc">
				<div class="table-responsive tableTopFix">
					<table class="table table-bordered">
						<tbody>
							<tr>
								<td><strong><?=getContentLanguageSelected('PAYMENT_METHOD',defaultSelectedLanguage())?></strong></td>
								<td><strong><?=getContentLanguageSelected('REQUIRED_DETAILS',defaultSelectedLanguage())?></strong></td>
								<td></td>
							</tr>
							<tr>
								<td class="select_payment_method" value="0">
									<?php
										$dateh        = date('c');
										$identifiant  = md5("2214926760");
										$ref_commande = "OM201905WEBP045";
										$site         = md5("1311893837");
										$total        = $user_payment_data['amount'];
										$commande     = "TEST Paiement par Orange Money";
										$algo         = "SHA512";
										$cle_secrete  = "4B820041902C84D1AB6D9E69960CAFA79231A90A3BFA4358ED69E2CA517872E2";
										$cle_bin      = pack("H*", $cle_secrete);
										$message      = "S2M_COMMANDE=$commande".
										"&S2M_DATEH=$dateh".
										"&S2M_HTYPE=$algo".
										"&S2M_IDENTIFIANT=$identifiant".
										"&S2M_REF_COMMANDE=$ref_commande".
										"&S2M_SITE=$site".
										"&S2M_TOTAL=$total";
										$hmac = strtoupper(hash_hmac(strtolower($algo), $message, $cle_bin));
									?>
									<form method="POST" id="orangePay_form" action="https://api.paiementorangemoney.com">
										<input type="hidden" name="S2M_IDENTIFIANT" value="<?php echo $identifiant;?>">
										<input type="hidden" name="S2M_SITE" value="<?php echo $site;?>">
										<input type="hidden" name="S2M_TOTAL" value="<?php echo $total;?>">
										<input type="hidden" name="S2M_REF_COMMANDE" value="<?php echo $ref_commande;?>">
										<input type="hidden" name="S2M_COMMANDE" value="<?php echo $commande;?>">
										<input type="hidden" name="S2M_DATEH" value="<?php echo $dateh;?>">
										<input type="hidden" name="S2M_HTYPE" value="<?php echo $algo;?>">
										<input type="hidden" name="S2M_HMAC" value="<?php echo $hmac;?>">
										<input type="submit" name="Orange Pay" value="Orange Pay" alt="Payer" />
									</form/>
								</td>
								<td><?=getContentLanguageSelected('USER_NAME',defaultSelectedLanguage())?></td>
								<td><?= getUserName($user_payment_data['user_id'])?></td>
							</tr>
							
							<tr>
								<td class="select_payment_method" value="1" >
									<form method="POST" id="wariPay_form" action="<?php echo  base_url('wariPay'); ?>">    
                                        <input type="hidden" name="id" value="<?php echo $payment_id; ?>">                                            
                                        <input type="submit" name="Wari Pay" value=" Wari Pay" alt="Payer" />
                                    </form>
								</td>
								<td><?=getContentLanguageSelected('AMOUNT',defaultSelectedLanguage())?></td>
								<td><?= $user_payment_data['amount']?></td>
							</tr>
							<tr>
	                            <td class="select_payment_method" value="2" ><?php echo $jula_form;?></td>
	                            <td><?= getContentLanguageSelected('PAYMENT_STATUS', defaultSelectedLanguage()) ?></td>
	                            <td><?= $payment_status ?></td>
	                        </tr>
	                        <?php
	                        	if($policy_creater_role == 3) { ?>
	                        		<tr>
			                        	<td class="select_payment_method" value="5">
			                        		
			                        		<form method="post" id="wallet_form" action = "<?php echo base_url('payment/wallet_payment');?>">
			                        			<input type="hidden" name="payment_amount"value="<?= $user_payment_data['amount']?>" >
			                        			<input type="hidden" name="payment_id"value="<?= $payment_id?>" >
			                        			<input type="submit" name="wallet" value="<?= getContentLanguageSelected('WALLET', defaultSelectedLanguage()) ?>" />
			                        		</form>
			                        	</td>
			                        	<td></td>
			                        	<td></td>
			                        </tr>
	                        	<?php }
	                        ?>
						</tbody>
					</table>
				</div>
			</div>
	  	</div>
	</div>
</section>