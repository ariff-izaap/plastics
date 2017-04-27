<!DOCTYPE html>
<html>
<head>
	<title>Print SO - #<?=$so_id;?></title>
	<link rel="stylesheet" type="text/css" href="<?=base_url();?>assets/css/bootstrap.min.css"> 
	<!-- <script type="text/javascript" src="<?=base_url();?>assets/js/bootstrap.min.js"></script> -->
</head>
<body>
	<div class="container">
		<div class="row">
			<div class="col-md-8">
				<h4><strong>INDEPENDENT PLASTICS, INC.</strong></h4>
				<p><strong>6611 PETROPARK DRIVE <br>HOUSTON, TX 77041-4924</strong></p>
			</div>
			<div class="col-md-4">
				<h4 class="text-right"><strong>SALES ORDER</strong></h4>
			</div>
		</div>
		<div class="row">
			<div class="col-md-4">
				<p>(800) 822-9008<br> (713) 329-9966  FAX</p>
			</div>
			<div class="col-md-4 text-center">
				<p>
					<strong><u>VISIT US AT OUR WEBSITE</u></strong><br>
					www.independentplastic.com
				</p>
			</div>
			<div class="col-md-4 text-right">
				<p>SO Number : <?=$so_id;?></p>
				<p>SO Date : <?=date('m-d-Y',strtotime($so_details['created_date']));?></p>
			</div>
		</div>
		<div class="row">
			<div class="col-md-6 padding-zero">
				<p><strong>Bill To:</strong></p>
				<div class="col-md-12 border box">
					<p><?php
						$address = get_customer_billing_address($so_details['billing_address_id'])['data'];
						echo $address['business_name'] ."<br>".$address['address1'].", ".$address['address2'],", 
						".$address['city'].",<br>".$address['state'].", ".$address['country'].", ".$address['zipcode'];?></p>
				</div>
			</div>
			<div class="col-md-6 pull-right" style="padding-right: 0px;">
				<p><strong>Ship To:</strong></p>
				<div class="col-md-12 border box">
					<p><?php
							$ship_addr =  get_address_by_contact_id($so_details['shipping_address_id'])['data'];
							echo $ship_addr['name'] ."<br>".$ship_addr['address_1'].", ".$ship_addr['address_2'],", 
						".$ship_addr['city'].",<br>".$ship_addr['state'].", ".$ship_addr['country'].", ".$ship_addr['zipcode'];?></p>
				</div>
			</div>
		</div><br>
		<div class="row">
    	<div class="col-md-4">
    		<label>Shipment Type : <strong><?=get_shipping_type($so_details['shipping_type'])[0]['type'];?></strong></label>
    	</div>
    	<div class="col-md-4">
    		<label>Shipment Service : <strong><?=get_carrier($so_details['carrier'])[0]['name'];?></strong></label>
    	</div>
    	<div class="col-md-4">
    		<label>Payment Term : <strong><?=$so['payment_term_name'];?></strong></label>
    	</div>
    </div><br>
		<div class="row">
			<div class="col-md-12 padding-zero">
				<table class="table">
					<thead>
						<th width="45%">Description</th>
						<th width="12%">Type</th>
						<th width="12%">Color</th>
						<th width="12%">Form</th>
						<th width="10%">Quantity</th>
						<th class="text-center" width="30%">Unit Price</th>
						<th width="5%">Net</th>
					</thead>
					<tbody>
						<?php
						// echo "<pre>";print_r($so['product_details']);echo "</pre>";
						if($so['product_details'])
						{
							$total[] = '';$qty[]='';
							foreach ($so['product_details'][1] as $key => $value)
							{
								$po_id = $value['po_id'];
								$total[] = $value['qty'] * $value['unit_price'];
								$qty[]=$value['qty'];
								?>
										<tr>
											<td><?=$value['product_name'];?></td>
											<td><?=get_prodcut_type($value['rowid'])[0]['name'];?></td>
											<td><?=get_colors($value['rowid'])[0]['name'];?></td>
											<td><?=get_forms($value['rowid'])[0]['name'];?></td>
											<td class="text-center"><?=$value['qty'];?></td>
											<td class="text-center"><?="$".number_format($value['unit_price'],3);?></td>
											<td class="text-center"><?="$".number_format($value['unit_price'] * $value['qty'],2);?></td>
										</tr>
									<?php
								}
						}
						?>
					</tbody>
					<tfoot>
						<tr>
							<td colspan="4" class="text-right">Total</td>
							<td class="text-center"><?=array_sum($qty);?></td>
							<td>&nbsp;</td>
							<td>$<?=number_format(array_sum($total),2);?></td>
						</tr>
					</tfoot>
				</table>
			</div>
		</div>
		<div class="row">
      	<div class="col-md-12">
      		<label><strong>SO Notes : </strong></label>
      		<br><?=$so['so_details']['so_instructions'];?>
      	</div>
    </div>
    <div class="row">
    	<div class="col-md-12">
    		<label><strong>BOL Instructions :</strong> </label>
    		<br><?=$so['so_details']['bol_instructions'];?>
    	</div>
    </div>
    <br>
    <div class="row">
    	<div class="col-md-4">
    		<button class="btn btn-danger footer-btn" onclick="window.print();">Print</button>
    		<button class="btn btn-info footer-btn" onclick="window.close();">Close</button>
    	</div>
    </div>
	</div>
</body>
</html>
<style type="text/css">

   	/*@import("<?=base_url();?>assets/css/bootstrap.min.css");*/
		.container{width: 60%;}
		.border{border: 2px solid black;border-radius: 5px;}
		.box p{margin: 0;padding: 5px;}
		.padding-zero{padding: 0;}
		.border-bottom{border-bottom:3px solid black;}
		hr{border: 1px solid black;}
		@media print
		{
			/*.col-md-3,.col-md-4,.col-md-5,.col-md-6,.col-md-12,.col-md-8{border: 1px solid red;}*/
			.container{width: 90%;}
			.col-md-8 {width: 66.66666667%;}
			.col-md-1, .col-md-10, .col-md-11, .col-md-12, .col-md-2, .col-md-3, .col-md-4, .col-md-5, .col-md-6, .col-md-7, .col-md-8, .col-md-9 {float: left;}
			.col-md-4 {width: 33.33333333%;}
			.col-md-6 {width: 50%;}
			.col-md-12 {width: 100%;}
			.col-md-3 {width: 25%;}
			.col-md-5 {width: 41.66666667%;}
			.padding-zero{padding: 0;}
			hr{border: 1px solid black;}
			.footer-btn{display: none;}
		}
</style>
<script type="text/javascript">
	// window.print();
</script>