<link rel="stylesheet" type="text/css" href="<?=site_url('assets/css/bootstrap.min.css');?>">
<br>
<div class="container">
	<div class="row">
		<div class="col-md-12">
			<div class="form-group">
				<label><strong>Request : INVCHK</strong></label>
				<p><strong>Invoice Register</strong></p>
				<div class="col-md-3">
					<p><b>Page 1</b></p>
				</div>
				<div class="col-md-5">
					<label class="col-md-2"><b>Filters:</b></label>
					<p class="col-md-10">
						SO Shipdate is between <?=date('m-d-Y',strtotime($date['start_date']));?>,<?=date('m-d-Y',strtotime($date['end_date']));?>
					</p>
				</div>
			</div>
		</div>
	</div>
	
		<div class="row">
			<table class="table">
				<thead>
					<th width="40%">Shipdate</th>
					<th width="20%">SO ID</th>
                    <th>Customer</th>
                    <th>Quantity Shipped</th>
					<th>Total Price</th>
                    <th>Salesman</th>
				</thead>
				<tbody>
					<?php
					if($shipping_order)
					{
						
						foreach ($shipping_order as $skey => $svalue)
						{
							$total_price += $svalue['total_amount'];
                            $quantity    += $svalue['quantity'];
							?>
							<tr>
                                <td><?=$svalue['ship_date'];?></td>
                                <td><?=$svalue['id'];?></td>
								<td><?=$svalue['business_name'];?></td>
								<td class="text-center"><?=$svalue['quantity'];?></td>
								<td class="text-center"><?=$svalue['total_amount'];?></td>
								<td class="text-center"><?=$svalue['first_name'];?></td>
							</tr>
							<?php
						}
					}
					?>
				</tbody>
				<tfoot>
					<tr>
						<td colspan="2"><b>Totals</b></td>
						<td class="text-center">$<?=$total_price;?></td>
						<td class="text-center">$<?=$quantity;?></td>
					</tr>
				</tfoot>			
			</table>
		</div>
	<footer>
		<div class="row">
			<table class="table">
				<tfoot>
					<tr>
						<td width="60%"><b>Grand Totals</b></td>
						<td width="12%" class="text-center">$<?=number_format(array_sum($price),2);?></td>
						<td width="12%" class="text-center">$<?=number_format(array_sum($wprice),2);?></td>
						<td class="text-center"><?=array_sum($items);?></td>
					</tr>
				</tfoot>
			</table>
		</div>
		<div class="row">
			<div class="col-md-12">
				<p><b><?=count($shipping_order);?> Records Selected</b></p>
			</div>
		</div>
	</footer>
</div>

<style type="text/css">
	@media print
	{
		.col-md-2 {width: 16.66666667%;}.col-md-3 {width: 25%;}.col-md-5 {width: 41.66666667%;}.col-md-12 {width: 100%;}
		.col-md-10 {width: 83.33333333%;}
		.col-md-1,.col-md-2,.col-md-3,.col-md-4,.col-md-5,.col-md-6,.col-md-7,.col-md-8,.col-md-9,.col-md-10,.col-md-11,.col-md-12{float: left;}
		.col-lg-1, .col-lg-10, .col-lg-11, .col-lg-12, .col-lg-2, .col-lg-3, .col-lg-4, .col-lg-5, .col-lg-6, .col-lg-7, .col-lg-8, 
		.col-lg-9, .col-md-1, .col-md-10, .col-md-11, .col-md-12, .col-md-2, .col-md-3, .col-md-4, .col-md-5, .col-md-6, .col-md-7, 
		.col-md-8, .col-md-9, .col-sm-1, .col-sm-10, .col-sm-11, .col-sm-12, .col-sm-2, .col-sm-3, .col-sm-4, .col-sm-5, .col-sm-6, 
		.col-sm-7, .col-sm-8, .col-sm-9, .col-xs-1, .col-xs-10, .col-xs-11, .col-xs-12, .col-xs-2, .col-xs-3, .col-xs-4, .col-xs-5, 
		.col-xs-6, .col-xs-7, .col-xs-8, .col-xs-9 {position: relative;min-height: 1px;padding-right: 15px;padding-left: 15px;}
	}
	table {border:none !important;border-collapse: separate;border-spacing: 15px;font-size: 14px;font-weight: bold;}
	table thead th{border-bottom: 2px solid black !important;}
	table tfoot tr td{border-top: 2px solid black !important;}
	footer{position: fixed;bottom: 0;width: 85%;}
</style>