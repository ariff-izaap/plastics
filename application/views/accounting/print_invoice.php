<!DOCTYPE html>
<html>
<head>
	<title>Print Invoice - #<?=$invoices[0]['invoice_no'];?></title>
	<link rel="stylesheet" type="text/css" href="<?=base_url();?>assets/css/bootstrap.min.css"> 
	<!-- <script type="text/javascript" src="<?=base_url();?>assets/js/bootstrap.min.js"></script> -->
</head>
<body>
	<?php
		$ship_date = explode(",",$invoices[0]['invoice_date']);
	?>
	<div class="container">
		<div class="row">
			<div class="col-md-8">
				<h3><strong>INDEPENDENT PLASTICS, INC.</strong></h3>
				<p><strong>6611 PETROPARK DRIVE <br>HOUSTON, TX 77041-4924</strong></p>
			</div>
			<div class="col-md-4">
				<h3 class="text-right"><strong>INVOICE</strong></h3>
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
				<p>Invoice Number : <?=$invoices[0]['invoice_no'];?></p>
				<p>Invoice Date : <?=date('m-d-Y',strtotime($invoices[0]['invoice_date']));?></p>
			</div>
		</div>
		<br>
		<div class="row">
			<div class="col-md-6 padding-zero">
				<p><strong>Sold To:</strong></p>
				<div class="col-md-12 border box">
					<p><?=$invoices[0]['b_name'];?><br>
						 <?=$invoices[0]['b_city'];?><br>
						 <?=$invoices[0]['b_state'];?>, <?=$invoices[0]['b_country'];?> <?=$invoices[0]['b_zipcode'];?></p>
				</div>
			</div>
			<div class="col-md-6 pull-right" style="padding-right: 0px;">
				<p><strong>Ship To:</strong></p>
				<div class="col-md-12 border box">
					<p><?=$invoices[0]['name'];?><br>
						 <?=$invoices[0]['city'];?><br>
						 <?=$invoices[0]['state'];?>, <?=$invoices[0]['country'];?> <?=$invoices[0]['zipcode'];?></p>
				</div>
			</div>
		</div>
		<br>
		<div class="row">
			<div class="col-md-12 border padding-zero">
			<div class="col-md-6 box">
				<label class="col-md-12 padding-zero">
					<p class="col-md-5"><strong>Ship Via :</strong></p>
					<p class="col-md-6 text-left"><?=$invoices[0]['carrier'];?></p>
				</label>
				<label class="col-md-12 padding-zero">
					<p class="col-md-5"><strong>Ship Date :</strong></p>
					<p class="col-md-6 text-left"><?=date("m-d-Y",strtotime($ship_date[0]));?></p>
				</label>
				<label class="col-md-12 padding-zero">
					<p class="col-md-5"><strong>Terms :</strong></p>
					<p class="col-md-6 text-left"><?=$invoices[0]['credit_type'];?></p>
				</label>
			</div>
			<div class="col-md-6 box">
				<label class="col-md-12 padding-zero">
					<p class="col-md-5"><strong>Cust ID :</strong></p>
					<p class="col-md-6 text-left"><?=$invoices[0]['customer_id'];?></p>
				</label>
				<label class="col-md-12 padding-zero">
					<p class="col-md-5"><strong>PO# :</strong></p>
					<p class="col-md-6 text-left"><?=($invoices[0]['po_id']!=0)?$invoices[0]['po_id']:"NIL";?></p>
				</label>
				<label class="col-md-12 padding-zero">
					<p class="col-md-5"><strong>Our Order# :</strong></p>
					<p class="col-md-6 text-left">234234/N</p>
				</label>
				<label class="col-md-12 padding-zero">
					<p class="col-md-5"><strong>Salesperson :</strong></p>
					<p class="col-md-6 text-left"><?=$invoices[0]['salesman'];?></p>
				</label>
			</div>
			</div>	
		</div>
		<br>
		<div class="row">
			<div class="col-md-12 padding-zero">
				<table class="table">
					<thead>
						<th width="65%">Description</th>
						<th width="10%">Quantity</th>
						<th class="text-center" width="20%">Unit Price</th>
						<th width="5%">Net</th>
					</thead>
					<tbody>
						<?php
						if($invoices)
						{
							$total[] = '';$qty[]='';
							foreach ($invoices as $key => $value)
							{								
								$inv_id = $value['item_id'];
								$product = $this->db->query("select a.*,b.name from invoice_items a,product b where a.product_id = b.id and a.invoice_id='".$inv_id."'")->result_array();
								// print_r($product);
								foreach ($product as $key => $pvalue)
								{
									$total[] = $pvalue['quantity'] * $pvalue['unit_price'];
									$qty[]=$pvalue['quantity'];
									?>
										<tr>
											<td><?=$pvalue['name'];?></td>
											<td class="text-center"><?=$pvalue['quantity'];?></td>
											<td class="text-center"><?="$".number_format($pvalue['unit_price'],3);?></td>
											<td class="text-center"><?="$".number_format($pvalue['unit_price'] * $pvalue['quantity'],2);?></td>
										</tr>
									<?php
								}
							}
						}
						?>
					</tbody>
					<tfoot>
						<tr>
							<td colspan="1" class="text-right">Total</td>
							<td class="text-center"><?=array_sum($qty);?></td>
							<td>&nbsp;</td>
							<td>$<?=number_format(array_sum($total),2);?></td>
						</tr>
					</tfoot>
				</table>
			</div>
		</div>
		<div class="row">
			<div class="col-md-8 padding-zero">
				<p class="text-justify" style="font-size: 8px;">We cannot negotiate claims for quality or short weights unless they are submitted to us in writing within 14 of this date. INDEPENDENT PLASTICS, INC. (IPI) liability for unusable materila is limited to either replacement of the material or credit based upon number of pounds actually returned. IPI is not liable for any material used, any machine time or any labor charges. No cliams are allowed on any parts produced from material bought from IPI. All warranties, expressed or implied, including warranties of merchantability for a particular purpose or use are excluded and disclaimed. IPI assumes no liability for use of products in infringement of any patent. Payment is due to Indepenedent Plastics, INC. 6611 Petropark Drive, Houston, TX 77041-4924. Any disputes shall be resolved or initgated through a court of competent jurisdiction in Harris County. Texas, and throught receipt of this mechandise, buyer acknowledges that jurisdiction for all disputes, either as to character or quality of the merchandise, or as to any dispute or the sums owed by buyer to IPI will be resolved in a court of competent jurisdiction in Harris County, Texas.</p>
			</div>
			<div class="col-md-4 padding-zero  text-right">
				<div class="col-md-12 padding-zero ">
					<div class="col-md-6 padding-zero text-right">
						<h4><strong> Total:</strong></h4>
					</div>
					<div class="col-md-6 text-right padding-zero">
						<h4><strong> $<?=number_format(array_sum($total),2);?></strong></h4>
					</div>
				</div>
				<div class="col-md-12 padding-zero ">
					<div class="col-md-6 padding-zero text-right">
						<h4><strong> Due Date:</strong></h4>
					</div>
					<div class="col-md-6 text-right padding-zero">
						<h4><strong> <?=date("m-d-Y",strtotime($invoices[0]['due_date']));?></strong></h4>
					</div>
				</div>
			</div>
		</div>
		<div class="row border-bottom">
		</div>
	</div>
	<br><br>
</body>
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
		}
</style>
</html>

