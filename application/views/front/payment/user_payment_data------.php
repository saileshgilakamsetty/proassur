<!-- <section class="insurForm">
	<div class="container">
	   	<div class="formFildes">
	      	<div class="col-xs-12">
	        	<h3 class="carOwner"><?=getContentLanguageSelected('REQUIRED_DETAILS_FOR_PAYMENT',defaultSelectedLanguage())?></h3>
	      	</div>
	  	</div>
	</div>
</section> -->
<!-- <section class="insurForm">
  	<div class="row">
		<div class="col-sm-12">
			<div class="panel panel-bd">
				<div class="panel-heading">
					<h2><?=getContentLanguageSelected('REQUIRED_DETAILS_FOR_PAYMENT',defaultSelectedLanguage())?></h2>
				</div>
				<input type="hidden" id="insurance_type_id" value="<?= $user_payment_data['insurance_type_id']?>">
				<input type="hidden" id="user_id" value="<?= $user_payment_data['user_id']?>">
				<input type="hidden" id="insured_id" value="<?= $user_payment_data['insured_id']?>">
				<input type="hidden" id="amount" value="<?= $user_payment_data['amount']?>">
				<div class="panel-body">
					<div class="table-responsive">
						<table id="example2" class="table table-bordered table-hover">
							<thead>
								<tr>
									<th><?=getContentLanguageSelected('PAYMENT_METHOD',defaultSelectedLanguage())?></th>
									<th><?=getContentLanguageSelected('REQUIRED_DETAILS',defaultSelectedLanguage())?></th>
									<th></th>
								</tr>
							</thead>
							<tbody>
								
								<tr>
									<td class="select_payment_method" value="0" >Orange Pay</td>
									<td><?=getContentLanguageSelected('USER_NAME',defaultSelectedLanguage())?></td>
									<td><?= getUserName($user_payment_data['user_id'])?></td>
								</tr>
								<tr>
									<td class="select_payment_method" value="1" >PayPal</td>
									<td><?=getContentLanguageSelected('INSURANCE_TYPE',defaultSelectedLanguage())?></td>
									<td><?= getInsuranceType($user_payment_data['insurance_type_id'])?></td>
								</tr>
								<tr>
									<td class="select_payment_method" value="2" >Wari Pay</td>
									<td><?=getContentLanguageSelected('AMOUNT',defaultSelectedLanguage())?></td>
									<td><?= $user_payment_data['amount']?></td>
								</tr>
								<tr>
									<td class="select_payment_method" value="3" >Payfast</td>
									<td><?=getContentLanguageSelected('PAYMENT_STATUS',defaultSelectedLanguage())?></td>
									<td><?= $payment_status?></td>
								</tr>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
    </div>
</section> -->